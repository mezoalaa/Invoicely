@extends('layouts.master')
@php
    use App\Models\Invoice;
@endphp

@section('title')
    لوحة التحكم - برنامج الفواتير
@stop
@section('css')
    <!--  Owl-carousel css-->
    <link href="{{ URL::asset('assets/plugins/owl-carousel/owl.carousel.css') }}" rel="stylesheet" />
    <!-- Maps css -->
    <link href="{{ URL::asset('assets/plugins/jqvmap/jqvmap.min.css') }}" rel="stylesheet">
@endsection
@section('page-header')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="left-content">
            <div>
                <h2 class="main-content-title tx-24 mg-b-1 mg-b-lg-1">Hi, welcome back!</h2>
                <p class="mg-b-0">Sales monitoring dashboard template.</p>
            </div>
        </div>
        <div class="main-dashboard-header-right">
            <div>
                <label class="tx-13">Customer Ratings</label>
                <div class="main-star">
                    <i class="typcn typcn-star active"></i> <i class="typcn typcn-star active"></i> <i
                        class="typcn typcn-star active"></i> <i class="typcn typcn-star active"></i> <i
                        class="typcn typcn-star"></i> <span>(14,873)</span>
                </div>
            </div>
            <div>
                <label class="tx-13">Online Sales</label>
                <h5>563,275</h5>
            </div>
            <div>
                <label class="tx-13">Offline Sales</label>
                <h5>783,675</h5>
            </div>
        </div>
    </div>
    <!-- /breadcrumb -->
@endsection
@section('content')
<div class="row row-sm">
    <div class="col-xl-3 col-lg-6 col-md-6 col-xm-12">
        <div class="card overflow-hidden sales-card bg-primary-gradient">
            <div class="pl-3 pt-3 pr-3 pb-2 pt-0">
                <div class="">
                    <h6 class="mb-3 tx-12 text-white">اجمالي الفواتير</h6>
                </div>
                <div class="pb-0 mt-0">
                    <div class="d-flex">
                        <div class="">
                            <h4 class="tx-20 font-weight-bold mb-1 text-white">
                                {{ number_format(Invoice::sum('Total'), 2) }}
                            </h4>
                            <p class="mb-0 tx-12 text-white op-7">{{ Invoice::count() }}</p>
                        </div>
                        <span class="float-right my-auto mr-auto">
                            <i class="fas fa-arrow-circle-up text-white"></i>
                            <span class="text-white op-7">100%</span>
                        </span>
                    </div>
                </div>
            </div>
            <span id="compositeline" class="pt-1">5,9,5,6,4,12,18,14,10,15,12,5,8,5,12,5,12,10,16,12</span>
        </div>
    </div>
    <div class="col-xl-3 col-lg-6 col-md-6 col-xm-12">
        <div class="card overflow-hidden sales-card bg-danger-gradient">
            <div class="pl-3 pt-3 pr-3 pb-2 pt-0">
                <div class="">
                    <h6 class="mb-3 tx-12 text-white">الفواتير الغير مدفوعة</h6>
                </div>
                <div class="pb-0 mt-0">
                    <div class="d-flex">
                        <div class="">
                            <h3 class="tx-20 font-weight-bold mb-1 text-white">
                                {{ number_format(Invoice::where('Value_Status', 2)->sum('Total'), 2) }}
                            </h3>
                            <p class="mb-0 tx-12 text-white op-7">{{ Invoice::where('Value_Status', 2)->count() }}</p>
                        </div>
                        <span class="float-right my-auto mr-auto">
                            <i class="fas fa-arrow-circle-down text-white"></i>
                            <span class="text-white op-7">
                                @php
                                    $count_all = Invoice::count();
                                    $count_invoices2 = Invoice::where('Value_Status', 2)->count();

                                    echo $count_invoices2 == 0 ? 0 : number_format(($count_invoices2 / $count_all) * 100, 2);
                                @endphp
                            </span>
                        </span>
                    </div>
                </div>
            </div>
            <span id="compositeline2" class="pt-1">3,2,4,6,12,14,8,7,14,16,12,7,8,4,3,2,2,5,6,7</span>
        </div>
    </div>
    <div class="col-xl-3 col-lg-6 col-md-6 col-xm-12">
        <div class="card overflow-hidden sales-card bg-success-gradient">
            <div class="pl-3 pt-3 pr-3 pb-2 pt-0">
                <div class="">
                    <h6 class="mb-3 tx-12 text-white">الفواتير المدفوعة</h6>
                </div>
                <div class="pb-0 mt-0">
                    <div class="d-flex">
                        <div class="">
                            <h4 class="tx-20 font-weight-bold mb-1 text-white">
                                {{ number_format(Invoice::where('Value_Status', 1)->sum('Total'), 2) }}
                            </h4>
                            <p class="mb-0 tx-12 text-white op-7">{{ Invoice::where('Value_Status', 1)->count() }}</p>
                        </div>
                        <span class="float-right my-auto mr-auto">
                            <i class="fas fa-arrow-circle-up text-white"></i>
                            <span class="text-white op-7">
                                @php
                                    $count_all = Invoice::count();
                                    $count_invoices1 = Invoice::where('Value_Status', 1)->count();

                                    echo $count_invoices1 == 0 ? 0 : number_format(($count_invoices1 / $count_all) * 100, 2);
                                @endphp
                            </span>
                        </span>
                    </div>
                </div>
            </div>
            <span id="compositeline3" class="pt-1">5,10,5,20,22,12,15,18,20,15,8,12,22,5,10,12,22,15,16,10</span>
        </div>
    </div>
    <div class="col-xl-3 col-lg-6 col-md-6 col-xm-12">
        <div class="card overflow-hidden sales-card bg-warning-gradient">
            <div class="pl-3 pt-3 pr-3 pb-2 pt-0">
                <div class="">
                    <h6 class="mb-3 tx-12 text-white">الفواتير المدفوعة جزئيا</h6>
                </div>
                <div class="pb-0 mt-0">
                    <div class="d-flex">
                        <div class="">
                            <h4 class="tx-20 font-weight-bold mb-1 text-white">
                                {{ number_format(Invoice::where('Value_Status', 3)->sum('Total'), 2) }}
                            </h4>
                            <p class="mb-0 tx-12 text-white op-7">{{ Invoice::where('Value_Status', 3)->count() }}</p>
                        </div>
                        <span class="float-right my-auto mr-auto">
                            <i class="fas fa-arrow-circle-down text-white"></i>
                            <span class="text-white op-7">
                                @php
                                    $count_all = Invoice::count();
                                    $count_invoices3 = Invoice::where('Value_Status', 3)->count();

                                    echo $count_invoices3 == 0 ? 0 : number_format(($count_invoices3 / $count_all) * 100, 2);
                                @endphp
                            </span>
                        </span>
                    </div>
                </div>
            </div>
            <span id="compositeline4" class="pt-1">5,9,5,6,4,12,18,14,10,15,12,5,8,5,12,5,12,10,16,12</span>
        </div>
    </div>
</div>
<!-- row closed -->
<div class="row row-sm">
    <!-- Bar Chart -->
    <div class="col-md-12 col-lg-12 col-xl-7">
        <div class="card">
            <div class="card-header bg-transparent pd-b-0 pd-t-20 bd-b-0">
                <div class="d-flex justify-content-between">
                    <h4 class="card-title mb-0">نسبة احصائية الفواتير</h4>
                    <i class="mdi mdi-dots-horizontal text-gray"></i>
                </div>
            </div>
            <div class="card-body" style="width: 100%;">
                <canvas id="barChart" style="height: 250px;"></canvas>
            </div>
        </div>
    </div>

    <!-- Pie Chart -->
    <div class="col-lg-12 col-xl-5">
        <div class="card card-dashboard-map-one">
            <label class="main-content-label">نسبة احصائية الفواتير</label>
            <div style="width: 100%">
                <canvas id="pieChart" style="height: 250px;"></canvas>
            </div>
        </div>
    </div>
</div>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        // Ensure the data from Laravel is properly passed to JavaScript
        const totalInvoices = {{ Invoice::count() }};
        const paidInvoices = {{ Invoice::where('Value_Status', 1)->count() }};
        const unpaidInvoices = {{ Invoice::where('Value_Status', 2)->count() }};
        const partiallyPaidInvoices = {{ Invoice::where('Value_Status', 3)->count() }};

        // Log the values for debugging
        console.log('Paid Invoices:', paidInvoices);
        console.log('Unpaid Invoices:', unpaidInvoices);
        console.log('Partially Paid Invoices:', partiallyPaidInvoices);

        // Define chart data
        const barChartData = {
            labels: ['مدفوعة', 'غير مدفوعة', 'مدفوعة جزئياً'],
            datasets: [{
                label: 'عدد الفواتير',
                data: [paidInvoices, unpaidInvoices, partiallyPaidInvoices],
                backgroundColor: ['#28a745', '#dc3545', '#FFA500'],
                borderColor: ['#28a745', '#dc3545', '#ffc107'],
                borderWidth: 1
            }]
        };

        const pieChartData = {
            labels: ['مدفوعة', 'غير مدفوعة', 'مدفوعة جزئياً'],
            datasets: [{
                data: [paidInvoices, unpaidInvoices, partiallyPaidInvoices],
                backgroundColor: ['#28a745', '#dc3545', '#FFA500']
            }]
        };

        // Render Bar Chart
        const barCtx = document.getElementById('barChart').getContext('2d');
        new Chart(barCtx, {
            type: 'bar',
            data: barChartData,
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        display: false
                    }
                },
                scales: {
                    x: {
                        title: {
                            display: true,
                            text: 'حالة الفواتير'
                        }
                    },
                    y: {
                        title: {
                            display: true,
                            text: 'عدد الفواتير'
                        },
                        beginAtZero: true
                    }
                }
            }
        });

        // Render Pie Chart
        const pieCtx = document.getElementById('pieChart').getContext('2d');
        new Chart(pieCtx, {
            type: 'pie',
            data: pieChartData,
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'bottom'
                    }
                }
            }
        });
    });
</script>

</div>
    <!-- Container closed -->
@endsection
@section('js')
    <!--Internal  Chart.bundle js -->
    <script src="{{ URL::asset('assets/plugins/chart.js/Chart.bundle.min.js') }}"></script>
    <!-- Moment js -->
    <script src="{{ URL::asset('assets/plugins/raphael/raphael.min.js') }}"></script>
    <!--Internal  Flot js-->
    <script src="{{ URL::asset('assets/plugins/jquery.flot/jquery.flot.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/jquery.flot/jquery.flot.pie.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/jquery.flot/jquery.flot.resize.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/jquery.flot/jquery.flot.categories.js') }}"></script>
    <script src="{{ URL::asset('assets/js/dashboard.sampledata.js') }}"></script>
    <script src="{{ URL::asset('assets/js/chart.flot.sampledata.js') }}"></script>
    <!--Internal Apexchart js-->
    <script src="{{ URL::asset('assets/js/apexcharts.js') }}"></script>
    <!-- Internal Map -->
    <script src="{{ URL::asset('assets/plugins/jqvmap/jquery.vmap.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/jqvmap/maps/jquery.vmap.usa.js') }}"></script>
    <script src="{{ URL::asset('assets/js/modal-popup.js') }}"></script>
    <!--Internal  index js -->
    <script src="{{ URL::asset('assets/js/index.js') }}"></script>
    <script src="{{ URL::asset('assets/js/jquery.vmap.sampledata.js') }}"></script>
    <script src="{{ mix('js/app.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/4.4.1/chart.min.js" integrity="sha512-L0Shl7nXXzIlBSUUPpxrokqq4ojqgZFQczTYlGjzONGTDAcLremjwaWv5A+EDLnxhQzY5xUZPWLOLqYRkY0Cbw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="path/to/chartjs/dist/chart.umd.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>


@endsection
