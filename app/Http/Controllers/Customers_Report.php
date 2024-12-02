<?php

namespace App\Http\Controllers;

use App\invoices;
use App\sections;
use App\Models\Invoice;
use App\Models\Section;
use Illuminate\Http\Request;

class Customers_Report extends Controller
{
    public function index(){

      $sections = section::all();
      return view('reports.customers_report',compact('sections'));

    }


//     public function Search_customers(Request $request){


// // في حالة البحث بدون التاريخ

//     if ($request->Section && $request->product && $request->start_at =='' && $request->end_at=='') {


//         $invoices = invoice::select('*')->where('section_id','=',$request->Section)->where('product','=',$request->product)->get();
//         $sections = section::all();
//         return view('reports.customers_report', compact('sections', 'invoices'));


//     }


//   // في حالة البحث بتاريخ

//     else {

//         $start_at = date($request->start_at);
//         $end_at = date($request->end_at);

//         $invoices = Invoice::whereBetween('invoice_Date',[$start_at,$end_at])->where('section_id','=',$request->Section)->where('product','=',$request->product)->get();
//         $sections = Section::all();
//         return view('reports.customers_report', compact('sections', 'invoices'));


//     }

public function Search_customers(Request $request)
{
    // Validate user input
    $request->validate([
        'Section' => 'nullable|exists:sections,id',
        'product' => 'nullable|string',
        'start_at' => 'nullable|date',
        'end_at' => 'nullable|date|after_or_equal:start_at',
    ]);

    // Retrieve input values
    $section = $request->Section;
    $product = $request->product;
    $start_at = $request->start_at;
    $end_at = $request->end_at;

    // Fetch all sections for dropdown
    $sections = Section::all();

    // Base query
    $query = Invoice::query();

    // Apply filters
    if ($section) {
        $query->where('section_id', $section);
    }

    if ($product) {
        $query->where('product', $product);
    }

    if ($start_at && $end_at) {
        $query->whereBetween('invoice_Date', [$start_at, $end_at]);
    }

    // Execute query
    $details = $query->get();

    // Return view with data
    return view('reports.customers_report', compact('sections', 'details', 'start_at', 'end_at'));
}



    
}
