<?php

namespace App\Http\Controllers;

use App\Models\Voucher;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Storage;

class ReportController extends Controller
{
    //

    public function downloadPDF(){
        $vouchers = Voucher::whereDate('date',Carbon::today())->get();
        view()->share('vouchers',$vouchers);

        $pdf = PDF::loadView('reportPDF.todayInComePdf',[
            'vouchers'=>$vouchers
        ])->setPaper('A4', 'landscape');

      //        $pdf->download(date('d-M-Y').'_Income.pdf')->getOriginalContent();
//        $pdf = $pdf->download()->getOriginalContent();
        $dir = 'public/pdf/';
        $newName = date('d-M-Y').'_Income'.uniqid().'.pdf';
        return $pdf->download($newName);
        Storage::put($dir.$newName,$pdf);
        return redirect()->back()->with('pdfStatus',$newName);
    }

    public function toDayInComePDFView(){
        $vouchers = Voucher::whereDate('date',Carbon::today())->get();
        return view('reportPDF.todayInComePdf',[
            'vouchers'=>$vouchers,
        ]);
    }

}
