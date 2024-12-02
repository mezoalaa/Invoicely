<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Invoice;

class Invoices_Report extends Controller
{
    public function index()
    {
        return view('reports.invoices_report');
    }

    // public function Search_invoices(Request $request)
    // {
    //     $rdio = $request->rdio;

    //     // In case of searching by invoice type
    //     if ($rdio == 1) {
    //         // Without specifying a date
    //         if ($request->type && $request->start_at =='' && $request->end_at =='') {
    //             if($request->type !='كافة الفواتير'){
    //            $invoices = invoice::select('*')->where('Status','=',$request->type)->get();
    //             }
    //             else{
    //                 $invoices = invoice::all();
    //             }
    //            $type = $request->type;
    //            return view('reports.invoices_report', compact('type', 'invoices'));
    //         }

    //         // When specifying a due date range
    //         else {
    //             $start_at = date($request->start_at);
    //             $end_at = date($request->end_at);
    //             $type = $request->type;

    //             $invoices = Invoice::whereBetween('invoice_Date', [$start_at, $end_at])
    //                 ->where('Status', '=', $request->type)
    //                 ->get();

    //             return view('reports.invoices_report', compact('type', 'start_at', 'end_at', 'invoices'));
    //         }
    //     }

    //     // Searching by invoice number
    //     else {
    //         $invoices = invoice::select('*')->where('invoice_number','=',$request->invoice_number)->get();
    //         return view('reports.invoices_report', compact('invoices'));
    //     }
    // }

    public function Search_invoices(Request $request)
{
    // Validate the request inputs
    $request->validate([
        'invoice_number' => 'nullable|string',
        'type' => 'nullable|string',
        'start_at' => 'nullable|date',
        'end_at' => 'nullable|date',
    ]);

    // Check which search method is used
    $searchType = $request->input('rdio');
    $invoices = null;

    if ($searchType == 1) {
        // Search by invoice type
        $type = $request->input('type');
        $startAt = $request->input('start_at');
        $endAt = $request->input('end_at');

        $query = Invoice::query();

        if ($type) {
            $query->where('Status', $type);
        }

        if ($startAt && $endAt) {
            $query->whereBetween('invoice_Date', [$startAt, $endAt]);
        }

        $invoices = $query->get();
    } elseif ($searchType == 2) {
        // Search by invoice number
        $invoiceNumber = $request->input('invoice_number');
        if ($invoiceNumber) {
            $invoices = Invoice::where('invoice_number', $invoiceNumber)->get();
        }
    }

    return view('reports.invoices_report', compact('invoices'));
}

}
