<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use Illuminate\Http\Request;
// use App\Http\Controllers\Controller;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');

    }
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    //=================احصائية نسبة تنفيذ الحالات======================

    // public function index()
    // {


    //   $count_all =Invoice::count();
    //   $count_invoices1 = Invoice::where('Value_Status', 1)->count();
    //   $count_invoices2 = invoice::where('Value_Status', 2)->count();
    //   $count_invoices3 = invoice::where('Value_Status', 3)->count();

    //   if($count_invoices2 == 0){
    //       $nspainvoices2=0;
    //   }
    //   else{
    //       $nspainvoices2 = $count_invoices2/ $count_all*100;
    //   }

    //     if($count_invoices1 == 0){
    //         $nspainvoices1=0;
    //     }
    //     else{
    //         $nspainvoices1 = $count_invoices1/ $count_all*100;
    //     }

    //     if($count_invoices3 == 0){
    //         $nspainvoices3=0;
    //     }
    //     else{
    //         $nspainvoices3 = $count_invoices3/ $count_all*100;
    //     }


    //     $chartjs = app()->chartjs
    //         ->name('barChartTest')
    //         ->type('bar')
    //         ->size(['width' => 350, 'height' => 200])
    //         ->labels(['الفواتير الغير المدفوعة', 'الفواتير المدفوعة','الفواتير المدفوعة جزئيا'])
    //         ->datasets([
    //             [
    //                 "label" => "الفواتير الغير المدفوعة",
    //                 'backgroundColor' => ['#ec5858'],
    //                 'data' => [$nspainvoices2]
    //             ],
    //             [
    //                 "label" => "الفواتير المدفوعة",
    //                 'backgroundColor' => ['#81b214'],
    //                 'data' => [$nspainvoices1]
    //             ],
    //             [
    //                 "label" => "الفواتير المدفوعة جزئيا",
    //                 'backgroundColor' => ['#ff9642'],
    //                 'data' => [$nspainvoices3]
    //             ],


    //         ])
    //         ->options([]);


    //     $chartjs_2 = app()->chartjs
    //         ->name('pieChartTest')
    //         ->type('pie')
    //         ->size(['width' => 340, 'height' => 200])
    //         ->labels(['الفواتير الغير المدفوعة', 'الفواتير المدفوعة','الفواتير المدفوعة جزئيا'])
    //         ->datasets([
    //             [
    //                 'backgroundColor' => ['#ec5858', '#81b214','#ff9642'],
    //                 'data' => [$nspainvoices2, $nspainvoices1,$nspainvoices3]
    //             ]
    //         ])
    //         ->options([]);

    //     return view('index', compact('chartjs','chartjs_2'));

    // }
    // public function index()
    // {
    //     $count_all = Invoice::count();

    //     // Calculate the count for each invoice status
    //     $statuses = [
    //         'paid' => Invoice::where('Value_Status', 1)->count(),
    //         'unpaid' => Invoice::where('Value_Status', 2)->count(),
    //         'partially_paid' => Invoice::where('Value_Status', 3)->count(),
    //     ];

    //     // Avoid division by zero and calculate percentages
    //     $percentages = array_map(function ($count) use ($count_all) {
    //         return $count_all == 0 ? 0 : ($count / $count_all) * 100;
    //     }, $statuses);

    //     // Chart configurations
    //     $barChart = app()->chartjs
    //         ->name('barChart')
    //         ->type('bar')
    //         ->size(['width' => 350, 'height' => 200])
    //         ->labels(['الفواتير الغير مدفوعة', 'الفواتير المدفوعة', 'الفواتير المدفوعة جزئيا'])
    //         ->datasets([
    //             [
    //                 "label" => "الفواتير الغير مدفوعة",
    //                 'backgroundColor' => ['#ec5858'],
    //                 'data' => [$percentages['unpaid']],
    //             ],
    //             [
    //                 "label" => "الفواتير المدفوعة",
    //                 'backgroundColor' => ['#81b214'],
    //                 'data' => [$percentages['paid']],
    //             ],
    //             [
    //                 "label" => "الفواتير المدفوعة جزئيا",
    //                 'backgroundColor' => ['#ff9642'],
    //                 'data' => [$percentages['partially_paid']],
    //             ],
    //         ])
    //         ->options([]);

    //     $pieChart = app()->chartjs
    //         ->name('pieChart')
    //         ->type('pie')
    //         ->size(['width' => 340, 'height' => 200])
    //         ->labels(['الفواتير الغير مدفوعة', 'الفواتير المدفوعة', 'الفواتير المدفوعة جزئيا'])
    //         ->datasets([
    //             [
    //                 'backgroundColor' => ['#ec5858', '#81b214', '#ff9642'],
    //                 'data' => [$percentages['unpaid'], $percentages['paid'], $percentages['partially_paid']],
    //             ],
    //         ])
    //         ->options([]);

    //     return view('index', compact('barChart', 'pieChart'));
    // }


    public function index()
    {
        $count_all = Invoice::count();
        $count_invoices1 = Invoice::where('Value_Status', 1)->count();
        $count_invoices2 = Invoice::where('Value_Status', 2)->count();
        $count_invoices3 = Invoice::where('Value_Status', 3)->count();

        $nspainvoices2 = $count_invoices2 == 0 ? 0 : ($count_invoices2 / $count_all) * 100;
        $nspainvoices1 = $count_invoices1 == 0 ? 0 : ($count_invoices1 / $count_all) * 100;
        $nspainvoices3 = $count_invoices3 == 0 ? 0 : ($count_invoices3 / $count_all) * 100;

        // Chart data
        $chartData = [
            'bar' => [
                'labels' => ['Unpaid', 'Paid', 'Partially Paid'],
                'datasets' => [
                    [
                        'label' => 'Invoices Status',
                        'backgroundColor' => ['#ec5858', '#81b214', '#ff9642'],
                        'data' => [$nspainvoices2, $nspainvoices1, $nspainvoices3],
                    ]
                ]
            ],
            'pie' => [
                'labels' => ['Unpaid', 'Paid', 'Partially Paid'],
                'datasets' => [
                    [
                        'backgroundColor' => ['#ec5858', '#81b214', '#ff9642'],
                        'data' => [$nspainvoices2, $nspainvoices1, $nspainvoices3],
                    ]
                ]
            ],
        ];

        return view('index', compact('chartData'));
    }

}
