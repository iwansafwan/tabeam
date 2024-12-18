<?php

namespace App\Http\Controllers;

use App\Models\Fund;
use App\Models\GeneralFund;
use App\Models\Ratio;
use App\Models\Invoice;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use File;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class FundController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // dd($request);

        $request->validate([
            'treasurer_id' => 'required',
            'name' => 'required',
            'description' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg|max:100000',
            'target_amount' => 'required',
            'end_date' => 'required|date|after:today',
            'ratio' => 'required|array|min:1', // Ensure ratio is an array and has at least one item

            //* to make sure all index in the array applied the condition to each element
            'ratio.*.category_name' => 'required', // Validate category IDs
            'ratio.*.percentage' => 'required|numeric|min:0|max:100', // Validate percentages between 0 and 100
        ]);
    
        $totalPercentage = array_sum(array_column($request->input('ratio'), 'percentage'));
        if ($totalPercentage !== 100) {
            return back()->withErrors(['ratio' => 'The total percentage must equal 100%.'])->withInput();
        }

        $fund = new Fund();
        $fund->treasurer_id = $request->treasurer_id;
        $fund->name = $request->name;
        $fund->target_amount = $request->target_amount;
        $fund->end_date = $request->end_date;
        $fund->description = $request->description;
        $fund->status = 'active';
        $fund->image = 'temp_image';

        $fund->save();

        if(!empty($fund)){

            if($request->has('image')){

                $file_name = $fund->id . '.' . $request->image->extension();
                $file = $request->image;
                
                $file_folder = public_path('fund_image/');
                if (!File::isDirectory($file_folder)) {
                    File::makeDirectory($file_folder, 0777, true, true);
                }
                
                $file->move($file_folder, $file_name);
        
                // Update the poster field with the correct file name
                $fund->update([
                    'image' => $file_name,
                ]);

            }
        
            // Generate QR Code content, e.g., URL or event details
            $qrContent = route('funds.fund_details', ['id' => $fund->id]);
    
            // Define the file path and name
            $qrCodePath = public_path('fund_qrcodes/');
            $qrCodeFileName = $fund->id . '_qrcode.png';
    
            // Ensure the directory exists
            if (!File::isDirectory($qrCodePath)) {
                File::makeDirectory($qrCodePath, 0777, true, true);
            }
    
            // Generate and save the QR code
            QrCode::format('png')->size(300)->generate($qrContent, $qrCodePath . $qrCodeFileName);
    
            // Save QR code path in event record
            $fund->update([
                'qr_code' => $qrCodeFileName,
            ]);

            // Save ratios
            foreach ($request->input('ratio') as $ratio) {
                $percentAmount = ($ratio['percentage'] / 100) * $fund->target_amount; // Calculate the percent amount

                Ratio::create([
                    'fund_id' => $fund->id,
                    'category_name' => $ratio['category_name'],
                    'percentage' => $ratio['percentage'],
                    'percent_amount' => $percentAmount, // Store the calculated amount
                    'total_collected' => 0,
                ]);
            }

            return redirect()->back()->with('success', 'Fund successfully created.');

        }
        else{
            
            return redirect()->back()->with('error', 'Fund failed to create.');

        }

    }

    /**
     * Show specific section
     */
    public function show($id)
    {
        $fund = Fund::with('ratio')->find($id);

        if($fund){

            return view('treasurer.fund_detail')->with('fund', $fund);

        }
        else{

            return redirect()->back()->with('error', 'Fund not found.');

        }
    }

    /**
     * Show the form for editing the specified section.
     */
    public function edit($id)
    {
        $fund = Fund::with('ratio')->find($id);

        if($fund){

            $treasurer = Auth::user();

            return view('treasurer.edit_fund')->with('fund', $fund)
                                            ->with('treasurer', $treasurer);

        }
        else{

            return redirect()->back()->with('error', 'Fund not found.');

        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {

        // dd($request);

        // Validate the incoming request
        $request->validate([
            'fund_id' => 'required',
            'treasurer_id' => 'required',
            'name' => 'required',
            'description' => 'required',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:100000',
            'target_amount' => 'required',
            'end_date' => 'required|date|after:today',
            'ratio' => 'required|array|min:1',
            'ratio.*.category_name' => 'required',
            'ratio.*.percentage' => 'required|numeric|min:0|max:100',
        ]);

        $fund = Fund::findOrFail($request->fund_id);

        $totalPercentage = array_sum(array_map('floatval', array_column($request->input('ratio'), 'percentage')));

        // dd($totalPercentage);

        if ($totalPercentage != 100) {
            return redirect()->back()->with('error', 'The total percentage must equal 100%.');
        }

        // Update image if a new image is uploaded
        if ($request->has('image')) {
            $file_name = $fund->id . '.' . $request->image->extension();
            $file = $request->image;

            $file_folder = public_path('fund_image/');
            if (!File::isDirectory($file_folder)) {
                File::makeDirectory($file_folder, 0777, true, true);
            }

            // Delete the old image if it exists
            $oldImagePath = $file_folder . $fund->image;
            if (File::exists($oldImagePath)) {
                File::delete($oldImagePath);
            }

            // Save the new image
            $file->move($file_folder, $file_name);
            $fund->image = $file_name;
        }

        // Update fund details
        $fund->treasurer_id = $request->treasurer_id;
        $fund->name = $request->name;
        $fund->target_amount = $request->target_amount;
        $fund->end_date = $request->end_date;
        $fund->description = $request->description;
        $fund->save();

        // === Update ratios ===
        $existingRatioIds = [];
        foreach ($request->input('ratio') as $key => $ratioData) {
            if (isset($ratioData['id']) && $ratioData['id'] > 0) {
                // Update existing ratio
                $existingRatioIds[] = $ratioData['id'];
                Ratio::where('id', $ratioData['id'])->update([
                    'category_name' => $ratioData['category_name'],
                    'percentage' => $ratioData['percentage'],
                    'percent_amount' => ($ratioData['percentage'] / 100) * $fund->target_amount,
                ]);
            } else {
                // Create new ratio
                $newRatio = Ratio::create([
                    'fund_id' => $fund->id,
                    'category_name' => $ratioData['category_name'],
                    'percentage' => $ratioData['percentage'],
                    'percent_amount' => ($ratioData['percentage'] / 100) * $fund->target_amount,
                    'total_collected' => 0,
                ]);
        
                // Add the new ratio ID to the array
                $existingRatioIds[] = $newRatio->id;
            }
        }
        
        // Remove deleted ratios
        Ratio::where('fund_id', $fund->id)->whereNotIn('id', $existingRatioIds)->delete();

        return redirect()->route('treasurer.funds')->with('success', 'Fund successfully updated.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Fund $fund)
    {
        //
    }

    //fund page view (view fund) act as index
    public function treasurer_fund()
    {

        $treasurer = Auth::user();

        if($treasurer){

            $funds = Fund::where('treasurer_id', $treasurer->id)->paginate(10);

            return view('treasurer.funds')->with('funds', $funds)
                                        ->with('treasurer', $treasurer);

        }
        else{

            return redirect()->back()->with('error', 'Treasurer Account not found.');

        }

    }

    //view fund for admin
    public function admin_fund()
    {

        $general_fund = GeneralFund::first();

        $funds = Fund::with('treasurer')->paginate(10);

        return view('admin.funds')->with('funds', $funds)
                                ->with('g_fund', $general_fund);

    }

    //view specific section by admin
    public function admin_show($id)
    {
        $fund = Fund::with('ratio')->with('treasurer')->find($id);

        if($fund){

            return view('admin.fund_detail')->with('fund', $fund);

        }
        else{

            return redirect()->back()->with('error', 'Fund not found.');

        }
    }

    //donator scan qr
    public function donator_scan_qr()
    {
        return view('donator.scan_qr');
    }

    //view fund detail
    public function fund_details($id)
    {

        $fund = Fund::with('ratio')->findOrFail($id);

        // dd($fund);

        if($fund){

            // Calculate the total amount collected for the fund
            $totalCollected = Invoice::where('fund_id', $id)->sum('amount'); // Replace 'amount' with your actual column name
            $fundGoal = $fund->target_amount; // Replace 'fund_goal' with your actual goal field name
    
            // Calculate progress percentage
            $progressPercentage = 0;
            if ($fundGoal > 0) {
                $progressPercentage = ($totalCollected / $fundGoal) * 100;
            }
    
            // Ensure the progress is between 0 and 100
            $progressPercentage = min(max($progressPercentage, 0), 100);
    
            return view('donator.fund_detail', [
                'fund' => $fund,
                'totalCollected' => $totalCollected,
                'progressPercentage' => $progressPercentage,
            ]);

        }
        else{

            return redirect()->back()->with('error', 'Fund detail not found.');

        }

    }

    //view specific section untuk guest/donator
    public function guest_fund_details($id)
    {

        $fund = Fund::with('ratio')->findOrFail($id);

        // dd($fund);

        if($fund){

            // Calculate the total amount collected for the fund
            $totalCollected = Invoice::where('fund_id', $id)->sum('amount'); // Replace 'amount' with your actual column name
            $fundGoal = $fund->target_amount; // Replace 'fund_goal' with your actual goal field name
    
            // Calculate progress percentage
            $progressPercentage = 0;
            if ($fundGoal > 0) {
                $progressPercentage = ($totalCollected / $fundGoal) * 100;
            }
    
            // Ensure the progress is between 0 and 100
            $progressPercentage = min(max($progressPercentage, 0), 100);
    
            return view('guest_fund_detail', [
                'fund' => $fund,
                'totalCollected' => $totalCollected,
                'progressPercentage' => $progressPercentage,
            ]);

        }
        else{

            return redirect()->back()->with('error', 'Fund detail not found.');

        }

    }

    //Donate into general -> donate page and validate
    public function donator_donate_general($fund)
    {

        $donator = Auth::user();

        $general_fund_id = $fund;

        return view('donator.donate_page')->with('general_fund_id', $general_fund_id)
                                        ->with('donator', $donator);

    }

    //Donate into main fund -> donate page and validate
    public function donator_donate_main($fund)
    {
        // Retrieves the currently logged-in user
        $donator = Auth::user();

        $fund_id = $fund;

        return view('donator.donate_page')->with('fund_id', $fund_id)
                                        ->with('donator', $donator);

    }

    //Donate into specific section -> donate page and validate
    public function donator_donate_section($fund, $section)
    {

        $donator = Auth::user();

        $fund_id = $fund;
        $ratio_id = $section;

        return view('donator.donate_page')->with('fund_id', $fund_id)
                                        ->with('ratio_id', $ratio_id)
                                        ->with('donator', $donator);

    }

    //terminate fund and direct the money to general fund
    public function treasurer_terminate_fund(Request $request)
    {

        $request->validate([
            'treasurer_id' => 'required',
            'fund_id' => 'required',
        ]);

        // dd($request);

        $general_fund = GeneralFund::first();

        if($general_fund){

            $fund = Fund::find($request->fund_id);

            $current_total = $general_fund->collected_amount;

            if($fund){

                $invoices = Invoice::where('fund_id', $fund->id)->get();

                $new_total = 0;

                if(count($invoices) > 0){

                    foreach($invoices as $inv){

                        $new_total += $inv->amount;

                        $inv->update([
                            'general_fund_id' => $general_fund->id,
                        ]);

                    }

                }

                $current_total = $current_total + $new_total;

                // dd($current_total);

                $fund->update([
                    'status' => 'terminated',
                ]);

                $general_fund->update([
                    'collected_amount' => $current_total,
                ]);

                return redirect()->back()->with('success', 'Fund successfully terminated and fund collected transferred to general fund.');

            }
            else{

                return redirect()->back()->with('error', "Treasurer's fund not found.");

            }

        }
        else{

            return redirect()->back()->with('error', "Treasurer's general fund not found.");

        }

    }

    public function update_fund_status()
    {
        // Get the current date and time
        $now = Carbon::now();
    
        // Check if there are any funds to process
        if (!Fund::exists()) {
            return response()->json(['message' => 'No funds found to update.']);
        }
    
        // Process funds in batches for better performance
        Fund::chunk(100, function ($funds) use ($now) {
            foreach ($funds as $fund) {
                // Skip updating if status is already 'terminated'
                if ($fund->status === 'terminated') {
                    continue;
                }
    
                // Update status based on the current date
                $newStatus = $now->lessThan($fund->end_date) ? 'active' : 'ended';
    
                // Save only if the status is different
                if ($fund->status !== $newStatus) {
                    $fund->status = $newStatus;
                    $fund->save();
                }
            }
        });
    
        return response()->json(['message' => 'Fund statuses updated successfully.']);

    }

    //admin view treasurer detail
    public function admin_view_treasurer($id)
    {
        $treasurer_id = $id;

        $treasurer = User::find($treasurer_id);

        if($treasurer){

            $funds = Fund::where('treasurer_id', $treasurer->id)->orderBy('created_at', 'desc')->paginate(10);

            return view('admin.treasurer_detail')->with('treasurer', $treasurer)
                                                ->with('funds', $funds);

        }
        else{

            return redirect()->back()->with('error', 'Treasurer account not found.');

        }

    }

}
