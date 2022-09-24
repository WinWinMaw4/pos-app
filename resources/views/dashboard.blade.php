@extends('master')
@section('head')
    <style>
        #todayTotalInComeChart{
            /*transform: rotateY(180deg);*/
        }
    </style>
@endsection
@section('content')
    <div class="col-12 col-md-9 col-lg-10 py-4">
       <div class="row row-cols-2">
           <div class="col">
             <div class="row g-2">
                 <div class="col">
                     <div class="bg-white card border-0 shadow p-3 pb-0" style="width: 600px;height:370px">
                         <h3>Daily InCome</h3>
                         <canvas id="myChart" class="w-100 "></canvas>
                     </div>
                 </div>
                 <div class="col my-3">
{{--                     background-image: linear-gradient(45deg,rebeccapurple,plum);--}}
                     <div class="card border-0 shadow p-0 text-light position-relative overflow-hidden" style="width: 600px;height:150px;background: #a55ee0">
                         <h3 class="p-2">Monthly InCome</h3>
                         <div class="w-100 position-absolute bottom-0 start-0" style="height: 80%">
                            <canvas id="monthlyInCome" class="w-100 position-absolute bottom-0" style="height: 100%;"></canvas>
                         </div>
                     </div>
                 </div>
             </div>



           </div>

           <div class="col">
               <div class="row g-2">
                   <div class="col-6">
                       <div class="card border-0 bg-primary pb-0">
                           <div class="card-body text-light pb-0">
                               <h4 class="d-flex justify-content-between">
                                   Total Order
                                   <i class="fas fa-cart-plus"></i>
                               </h4>
                               <div class="w-100 d-flex justify-content-end align-items-start position-relative" style="height: 120px">
                                   <h3 class="fw-bold counter-up ">{{$todayVouchers->count('id')}}</h3>
{{--                                   <h3 class="fw-bold counter-up">${{$todayVouchers->sum('total_price')}}</h3>--}}
                                   <div class=" position-absolute bottom-0 start-0" style="width:80%;margin-left: -24px;margin-bottom:-8px;">
                                       <canvas id="todayTotalOrderChart" class="w-100 m-0 p-0" ></canvas>
                                   </div>
                               </div>
{{--                               <div class="d-flex position-relative" style="height: 120px">--}}
{{--                                   <div class="w-100 w-75 position-absolute bottom-0 end-0" style="margin-left: -24px;margin-bottom:-8px ">--}}
{{--                                       <canvas id="todayTotalOrderChart" class="w-100 m-0 p-0" ></canvas>--}}
{{--                                   </div>--}}
{{--                                   <h3 class="fw-bold counter-up text-end">{{$todayVouchers->count('id')}}</h3>--}}

{{--                               </div>--}}
                           </div>
                       </div>
                   </div>
                   <div class="col-6">
                       <div class="card border-0 bg-warning pb-0">
                           <div class="card-body text-light pb-0">
                               <h4 class="d-flex justify-content-between">
                                   Revenue
                                   <i class="fas fa-dollar"></i>
                               </h4>
                               <div class="w-100 d-flex justify-content-between align-items-sm-start position-relative" style="height: 120px">
                                   <h3 class="fw-bold counter-up">${{$todayVouchers->sum('total_price')}}</h3>
                                   <div class="w-75 position-absolute bottom-0 end-0" style="margin-right: -24px;margin-bottom:-8px ">
                                       <canvas id="todayTotalInComeChart" class="w-100 m-0 p-0" ></canvas>
                                   </div>
                               </div>

                           </div>
                       </div>
                   </div>
                   <div class="col-12">
                       <div class="card border-0 bg-info my-2 shadow">
                           <div class="card-body text-light">
                              <div class="d-flex justify-content-between align-items-center">
                                  <h4 class="d-flex justify-content-start">
                                      Weekly Sales
                                      <i class="fas fa-question-circle small ms-1"></i>
                                  </h4>
                                  <h3 class="fw-bold">${{$weeklyVouchers->sum('total_price')}}</h3>
                              </div>
                               <div class="d-flex justify-content-center align-items-center">
                                   <div class="" style="width: 100%;">
                                       <canvas id="weeklyChart" class="w-100"></canvas>
                                   </div>
                               </div>
                           </div>
                       </div>
                   </div>
               </div>
           </div>
           <div class="col-12 ">
               <div class="p-2 my-3">
                   <div class="bg-white shadow p-2" style="width: 100%;height:auto;">
                       <h3>Today Best Selling Products</h3>
                    <div class="">
                        <table class="table table-hover align-middle">

                              <thead>
                                  <tr>
{{--                                      toDayDateTimeString()--}}
                                      <th colspan="7" class="text-end" style="background-color: #F7F7F7">{{\Illuminate\Support\Carbon::now()->toDayDateTimeString()}}
                                      </th>
                                  </tr>
                              </thead>
                               <tbody>
                               @forelse ($today_popular_item as $item)
                                   <tr>
                                       <td>
                                           <div class="rounded-circle overflow-hidden bg-secondary" style="height: 40px;width: 40px;">
                                               <a href="{{$item->photo}}">
                                                   <img src="{{asset('storage/item/'.$item->photo)}}" style="width: 100%;height: 100%;object-fit: cover;" alt="">
                                               </a>
                                           </div>
                                       </td>
                                       <td>{{$item->name}}</td>
                                       <td> {{$item->category->name}}</td>
                                       <td>{{$item->price}}</td>
                                       <td> {{$item->total_sales}}</td>
                                       <td>${{round($item->price * $item->total_sales,2)}}</td>
                                       <td class="w-25">
                                           @if($item->total_sales)
                                               <small class=""> {{round(($item->total_sales / $total_sale)*100)}}%</small>
                                           @else
                                               <small>0%</small>
                                           @endif
                                           <div class="progress" style="height: .7rem">
{{--                                               <div class="progress-bar bg-primary" role="progressbar" style="width:{{($item->total_sales) ? `round(($item->total_sales / $total_sale)*100)`:'0'}}%"  aria-valuemax="100"></div>--}}
                                               <div class="progress-bar bg-primary position-relative " role="progressbar" style="width:@if($item->total_sales){{round(($item->total_sales / $total_sale)*100)}}@endif%"  aria-valuemax="100">

                                               </div>

                                           </div>
                                       </td>
                                   </tr>
                               @empty
                                   no Record Found
                               @endforelse
                               </tbody>

                       </table>
                    </div>
{{--                       <canvas id="todayPopularItem" class="w-100"></canvas>--}}
{{--                       <table class="table table-hover">--}}
{{--                           @foreach ($popularItems as $day => $voucher_lists)--}}
{{--                              <thead>--}}
{{--                                  <tr>--}}
{{--                                      <th colspan="3" class="text-end" style="background-color: #F7F7F7">{{ $day }}--}}
{{--                                      </th>--}}
{{--                                  </tr>--}}
{{--                              </thead>--}}
{{--                               <tbody>--}}
{{--                               @foreach ($voucher_lists as $voucher_list => $items)--}}
{{--                                   <tr>--}}
{{--                                       <td>--}}
{{--                                           {{$items[0]->item_id}}--}}
{{--                                           {{$items[0]->item_name}}--}}
{{--                                       </td>--}}
{{--                                       <td>{{$items[0]->items->category->name}}</td>--}}
{{--                                       <td>{{$items->sum('quantity')}}</td>--}}
{{--                                   </tr>--}}
{{--                               @endforeach--}}
{{--                               </tbody>--}}
{{--                           @endforeach--}}
{{--                       </table>--}}
                   </div>


               </div>
           </div>
       </div>
    </div>

@endsection
@push('scripts')
    <script src="http://cdnjs.cloudflare.com/ajax/libs/waypoints/2.0.3/waypoints.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
{{--    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.8.0/chart.min.js" integrity="sha512-sW/w8s4RWTdFFSduOTGtk4isV1+190E/GghVffMA9XczdJ2MDzSzLEubKAs5h0wzgSJOQTRYyaz73L3d6RtJSg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>--}}
    <script>
        let date = @json(collect($dailyVouchers)->pluck('date'));
        let day = @json(collect($weeklyVouchers)->pluck('date'));
        let Day = @json(collect($Day)->pluck('date'));

        let weekly_total_price = @json(collect($weeklyVouchers)->pluck('total_price'));
        let weekly_total_voucher = @json(collect($weeklyVouchers)->pluck('total_voucher'));
        let monthly_income_price = @json(collect($monthlyInCome)->pluck('total_price'));
        let monthly_income_month = @json(collect($monthlyInCome)->pluck('date'));


        let total_price = @json(collect($dailyVouchers)->pluck('total_price'));
        let total_voucher = @json(collect($dailyVouchers)->pluck('total_voucher'));

        let today_price = @json(collect($voucherLists)->pluck('cost'));
        let today_voucher = @json(collect($voucherLists)->count('voucher_id'));

        {{--        let todayDate = @json(collect(\Illuminate\Support\Carbon::today()));--}}


        // console.log(total_price);
        //Daily Income
        const ctx = document.getElementById('myChart');
        const myChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: date,
                datasets: [{
                    label: 'Daily total price',
                    data: total_price,
                    backgroundColor: [
                        'rgba(54, 162, 235, 0.2)',
                    ],
                    borderColor: [
                        'rgb(99,235,54)',
                    ],
                    // borderWidth: 1,
                    tension:0.4,
                    // fill:'origin'
                    pointRadius:0
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: false,
                        ticks:{
                            // stepSize:3
                        },
                    }
                }
            },
            plugins: {

            }
        });


        //Monthly Income
        const ctx5 = document.getElementById('monthlyInCome');
        const monthlyInCome = new Chart(ctx5, {
            type: 'line',
            data: {
                labels: ['Jan','Feb','March','Apr','May','Jun'],
                datasets: [{
                    label: 'Monthly Income',
                    data: monthly_income_price,
                    backgroundColor: [
                        'rgb(202,234,245)',
                    ],
                    borderColor: [
                        'rgb(0,252,224)',
                    ],
                    borderWidth: 4,
                    tension:0.2,
                    fill:false
                    // pointRadius:0
                }]
            },
            options: {
                plugins: {
                    legend:{
                        display:false
                    }
                },
                scales: {
                    x:{
                        ticks:{
                            display:true
                        },
                        grid:{
                            display:false,
                            drawOnChartArea:false,
                            // borderWidth:0,
                            drawBorder:false
                        }
                    },
                    y: {
                        beginAtZero: false,
                        ticks:{
                            display:false
                        },
                        grid:{
                            display:false,
                            drawOnChartArea:false,
                            drawBorder:false
                            // borderWidth:0,
                        }
                    }
                }
            },
            plugins: {

            }
        });


        //Today Order Chart
        const ctx2 = document.getElementById('todayTotalOrderChart');
        const todayTotalOrderChart = new Chart(ctx2, {
            type: 'line',
            data: {
                labels:  Day,
                datasets: [{
                    label: 'Total Order',
                    data:total_price,
                    backgroundColor: [
                        'rgb(255,244,130)',
                        // 'rgb(0,217,255)',
                    ],
                    borderColor: [
                        'rgb(255,213,0)',
                        'rgb(219,0,255)',
                        'rgb(246,123,0)',
                        'rgb(129,15,199)',
                        'rgb(127,255,1)',
                        'rgb(255,0,44)',

                    ],
                    // borderWidth: 1,
                    tension:0.4,
                    fill:'origin',
                    // pointRadius:0
                }]
            },
            options: {
                plugins: {
                    legend:{
                        display:false
                    }
                },
                scales: {
                    x:{
                        ticks:{
                            display:false
                        },
                        grid:{
                            display:false,
                            drawOnChartArea:false,
                            // borderWidth:0,
                            drawBorder:false
                        }
                    },
                    y: {
                        beginAtZero: true,
                        ticks:{
                            display:false
                        },
                        grid:{
                            display:false,
                            drawOnChartArea:false,
                            drawBorder:false
                            // borderWidth:0,
                        }
                    }
                }
            },

        });

        //Today InCome Chart
        const ctx3 = document.getElementById('todayTotalInComeChart');
        const todayTotalInComeChart = new Chart(ctx3, {
            type: 'bar',
            data: {
                labels: Day,
                datasets: [{
                    label: 'Total InCome',
                    data: total_price,
                    backgroundColor: [
                        'rgb(65,150,255)',
                        'rgb(54,80,246)',
                        'rgb(3,43,255)',
                        'rgb(0,47,208)',
                        'rgb(2,30,161)',
                        'rgb(10,2,140)',
                        'rgb(6,0,101)',
                    ],
                    borderColor: [
                        'rgb(65,150,255)',
                        'rgb(54,80,246)',
                        'rgb(3,43,255)',
                        'rgb(0,47,208)',
                        'rgb(2,30,161)',
                        'rgb(10,2,140)',
                        'rgb(6,0,101)',
                    ],
                    borderWidth: 1,
                    borderRadius:20,
                    // borderSkipped:true,
                    barPercentage:0.6,
                    categoryPercentage:0.5
                }]
            },
            options: {
                plugins: {
                    legend:{
                        display:false
                    }
                },
                scales: {
                    x:{
                        ticks:{
                            display:false
                        },
                        grid:{
                            display:false,
                            drawOnChartArea:false,
                            // borderWidth:0,
                            drawBorder:false
                        }
                    },
                    y: {
                        beginAtZero: true,
                        ticks:{
                            display:false,

                        },
                        grid:{
                            display:false,
                            drawOnChartArea:false,
                            drawBorder:false,
                            borderWidth:3,
                        }
                    }
                }
            },

        });


        //weekly Charts
        const ctx4 = document.getElementById('weeklyChart');
        const myChart2 = new Chart(ctx4, {
            type: 'bar',
            data: {
                labels: ['Monday','Tuesday','Wednesday','Thursday','Friday','SaturDay','Sunday'],
                datasets: [{
                    label: 'Weekly Selling',
                    data: weekly_total_price,
                    backgroundColor: [
                        'rgba(255, 99, 132, 1)',
                        'rgb(255,176,97)',
                        'rgb(246,236,108)',
                        'rgb(30,94,255)',
                        'rgb(107,241,110)',
                        'rgb(191,101,252)',
                        'rgb(255,84,135)'
                    ],
                    borderColor: [
                        'rgb(255,42,91)',
                        'rgb(255,136,15)',
                        'rgb(211,197,0)',
                        'rgb(0,71,255)',
                        'rgb(0,180,3)',
                        'rgb(155,16,252)',
                        'rgb(255,6,79)'
                    ],
                    borderWidth: 2,
                    borderRadius:20,
                    borderSkipped:false,
                    barPercentage:0.5,
                    categoryPercentage:0.8
                }]
            },
            options: {
                plugins:{
                  legend:{
                      display:false
                  }
                },

                scales: {
                    x:{
                        ticks:{
                            display:true
                        },
                        grid:{
                            display:false,
                            drawOnChartArea:false,
                        }
                    },
                    y: {
                        beginAtZero: true,
                        ticks:{
                            display:true,
                        },
                        grid:{
                            // display:false,
                            drawTicks:true,
                            drawOnChartArea:false
                        }
                    }
                }
            }
        });




    </script>
@endpush
