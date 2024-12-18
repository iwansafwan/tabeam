<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use App\Models\User;
use App\Models\Fund;
use App\Models\Ratio;
use App\Models\GeneralFund;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;

class InvoiceController extends Controller
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
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Invoice $invoice)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Invoice $invoice)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Invoice $invoice)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Invoice $invoice)
    {
        //
    }

    // store payment into transaction
    public function donator_submit_payment(Request $request)
    {
        // Validate the incoming request
        $request->validate([
            'donator_id' => 'required|exists:users,id',
            'password' => 'required',
            'amount' => 'required|numeric|min:1',
            'donation_type' => 'required',
            'notes' => 'nullable',
        ]);

        if($request->donation_type == 'general'){

            $request->validate([
                'general_fund_id' => 'required',
            ]);

        }
        elseif($request->donation_type == 'section'){

            $request->validate([
                'fund_id' => 'required',
                'ratio_id' => 'required',
            ]);

        }
        else{

            $request->validate([
                'fund_id' => 'required',
            ]);

        }

        // Retrieve the donator's record
        $donator = User::find($request->donator_id);

        // dd($donator);

        // Check if the password matches
        if (!Hash::check($request->password, $donator->password)) {
            return redirect()->back()->with('error', 'The provided password is incorrect.');
        }
        

        if($request->donation_type == 'general'){

            $general_fund = GeneralFund::find($request->general_fund_id);

            if($general_fund){

                $current_total = $general_fund->collected_amount;
                $new_total = $current_total + $request->amount;
 
                $general_fund->update([
                    'collected_amount' => $new_total,
                ]);

                // Store the invoice
                $invoice = new Invoice();
                $invoice->donator_id = $request->donator_id;
                $invoice->general_fund_id = $request->general_fund_id;
                $invoice->donation_type = $request->donation_type;
                $invoice->amount = $request->amount;
                $invoice->notes = $request->notes ?? null;
                $invoice->save();

            }
            else{

                return redirect()->back()->with('error', 'General fund not found.');

            }

        }
        elseif($request->donation_type == 'section'){

            $ratio_section = Ratio::find($request->ratio_id);

            if($ratio_section){

                $current_total = $ratio_section->total_collected;
                $new_total = $current_total + $request->amount;

                $ratio_section->update([
                    'total_collected' => $new_total,
                ]);

                // Store the invoice
                $invoice = new Invoice();
                $invoice->donator_id = $request->donator_id;
                $invoice->fund_id = $request->fund_id;
                $invoice->donation_type = $request->donation_type;
                $invoice->ratio_id = $request->ratio_id;
                $invoice->amount = $request->amount;
                $invoice->notes = $request->notes ?? null;
                $invoice->save();

            }
            else{

                return redirect()->back()->with('error', 'Section / Category fund not found.');

            }

        }
        else{

            // Store the invoice
            $invoice = new Invoice();
            $invoice->donator_id = $request->donator_id;
            $invoice->fund_id = $request->fund_id;
            $invoice->donation_type = $request->donation_type;
            $invoice->amount = $request->amount;
            $invoice->notes = $request->notes ?? null;
            $invoice->save();

        }

        // Redirect with a success message
        return redirect()->route('donator.transaction')->with('success', 'Payment submitted successfully!');
    }

    // transaction list for donator
    public function donator_transaction_list()
    {

        $donator = Auth::user();

        $transactions = Invoice::where('donator_id', $donator->id)->orderBy('created_at', 'desc')->paginate(10);

        return view('donator.transactions')->with('transactions', $transactions);

    }

    // transaction list for treasurer
    public function treasurer_transaction_list()
    {

        $treasurer = Auth::user();

        // Fetch invoices related to the treasurer's funds (fund only ceated by the treasurer)
        $transactions = Invoice::whereHas('fund', function ($query) use ($treasurer) {
                $query->where('treasurer_id', $treasurer->id);
            })
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('treasurer.transactions')->with('transactions', $transactions);

    }

    // transaction list for admin
    public function admin_transaction_list()
    {

        $transactions = Invoice::orderBy('created_at', 'desc')->paginate(10);

        return view('admin.transactions')->with('transactions', $transactions);

    }

    // view donator transaction by admin
    public function admin_view_donator($id)
    {
        $donator_id = $id;

        $donator = User::find($donator_id);

        if($donator){

            $transactions = Invoice::where('donator_id', $donator->id)->orderBy('created_at', 'desc')->paginate(10);

            return view('admin.donator_detail')->with('donator', $donator)
                                                ->with('transactions', $transactions);

        }
        else{

            return redirect()->back()->with('error', 'Donator account not found.');

        }

    }

}
