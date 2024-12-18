<?php

namespace App\Http\Controllers;

use App\Models\GeneralFund;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use File;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class GeneralFundController extends Controller
{

    // show detail of general fund for admin
    public function show()
    {
        $fund = GeneralFund::first();

        if($fund){

            return view('admin.general_fund_detail')->with('fund', $fund);

        }
        else{

            return redirect()->back()->with('error', 'Fund not found.');

        }
    }



    // show detail of general fund for donator
    public function fund_details($id)
    {

        $fund = GeneralFund::findOrFail($id);

        // dd($fund);

        if($fund){
    
            return view('donator.general_fund_detail', [
                'fund' => $fund
            ]);

        }
        else{

            return redirect()->back()->with('error', 'Fund detail not found.');

        }

    }

    // show detail of general fund for guest
    public function guest_fund_details()
    {

        $fund = GeneralFund::first();

        // dd($fund);

        if($fund){
    
            return view('guest_general_fund_detail', [
                'fund' => $fund
            ]);

        }
        else{

            return redirect()->back()->with('error', 'Fund detail not found.');

        }

    }

    public function check_general_qr_code()
    {

        $general_fund = GeneralFund::first();

        if($general_fund->qr_code == NULL || $general_fund->qr_code == ''){

            // Generate QR Code content
            $qrContent = route('general_funds.fund_details', ['id' => $general_fund->id]);
    
            // Define the file path and name
            $qrCodePath = public_path('general_fund_qrcodes/');
            $qrCodeFileName = $general_fund->id . '_qrcode.png';
    
            // Ensure the directory exists
            if (!File::isDirectory($qrCodePath)) {
                File::makeDirectory($qrCodePath, 0777, true, true);
            }
    
            // Generate and save the QR code
            QrCode::format('png')->size(300)->generate($qrContent, $qrCodePath . $qrCodeFileName);
    
            // Update the General Fund record with the QR code path
            DB::table('general_funds')->where('id', $general_fund->id)->update([
                'qr_code' => $qrCodeFileName,
            ]);
    
            return response()->json(['message' => 'QR code general fund updated successfully.']);

        }
    
        return response()->json(['message' => 'QR code general fund is generated.']);

    }

}
