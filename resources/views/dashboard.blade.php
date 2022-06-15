@extends('master')
@section('content')
    <div class="col-12 col-md-9 col-lg-10 py-4">
       <div class="row row-cols-2">
           <div class="col">
               <div class="bg-white shadow p-2" style="width: 600px;height:400px">
                   <h3>Daily InCome</h3>
                   <canvas id="myChart" class="w-100"></canvas>
               </div>


           </div>
           <div class="col">
               <div class="row">
                   <div class="col-6">
                       <div class="card border-0 bg-primary">
                           <div class="card-body text-light">
                               <h4 class="d-flex justify-content-between">
                                   Total Order
                                   <i class="fas fa-cart-plus"></i>
                               </h4>
                               <h3 class="fw-bold counter-up">{{$todayVouchers->count('id')}}</h3>


                           </div>
                       </div>
                   </div>
                   <div class="col-6">
                       <div class="card border-0 bg-warning ">
                           <div class="card-body text-light">
                               <h4 class="d-flex justify-content-between">
                                   Revenue
                                   <i class="fas fa-dollar"></i>
                               </h4>
                               <h3 class="fw-bold counter-up">${{$todayVouchers->sum('total_price')}}</h3>

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
                                      <th colspan="6" class="text-end" style="background-color: #F7F7F7">{{\Illuminate\Support\Carbon::now()->toDayDateTimeString()}}
                                      </th>
                                  </tr>
                              </thead>
                               <tbody>
                               @foreach ($today_popular_item as $item)
                                   <tr>
                                       <td>
                                           <div class="rounded-circle overflow-hidden bg-secondary" style="height: 40px;width: 40px;">
                                               <a href="{{$item->photo}}">
                                                   <img src="{{$item->photo}}" style="width: 100%;height: 100%;object-fit: cover;" alt="">
                                               </a>
                                           </div>
                                       </td>
                                       <td>{{$item->name}}</td>
                                       <td> {{$item->category->name}}</td>
                                       <td> {{$item->total_sales}}</td>
                                       <td>${{round($item->price * $item->total_sales,2)}}</td>
                                       <td class="w-25">
                                           <div class="progress" style="height: .7rem">
                                               <div class="progress-bar bg-primary" role="progressbar" style="width: {{round(($item->total_sales / $total_sale)*100)}}%" aria-valuemax="100"></div>
                                              <small> {{round(($item->total_sales / $total_sale)*100)}}%</small>
                                           </div>
                                       </td>
                                   </tr>
                               @endforeach
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
        let day = @json(collect($weeklyVouchers)->pluck('total_price'));
        {{--let day = @json(collect($weeklyVouchers)->pluck('total_price'));--}}

        let total_price = @json(collect($dailyVouchers)->pluck('total_price'));
        let total_voucher = @json(collect($dailyVouchers)->pluck('total_voucher'));

        let today_price = @json(collect($voucherLists)->pluck('cost'));
        let today_voucher = @json(collect($voucherLists)->count('voucher_id'));
        console.log(day);
        {{--        let todayDate = @json(collect(\Illuminate\Support\Carbon::today()));--}}


        // console.log(total_price);
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
                    pointRadius:0
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true,
                    }
                }
            },
            plugins: {

            }
        });

        //weekly Charts
        const ctx2 = document.getElementById('weeklyChart');
        const myChart2 = new Chart(ctx2, {
            type: 'bar',
            data: {
                labels: ['Monday','Tuesday','Wednesday','Thursday','Friday','SaturDay','Dunday',],
                datasets: [{
                    label: 'Weekly Selling',
                    data: day,
                    backgroundColor: [
                        'rgba(255, 99, 132, 1)',
                        'rgba(255, 159, 64, 1)',
                        'rgba(255, 205, 86, 1)',
                        'rgba(11,65,204,1)',
                        'rgba(0,255,133,1)',
                        'rgba(153, 102, 255, 1)',
                        'rgba(201, 203, 207, 1)'
                    ],
                    borderColor: [
                        'rgb(255, 99, 132)',
                        'rgb(255, 159, 64)',
                        'rgb(255, 205, 86)',
                        'rgb(75, 192, 192)',
                        'rgb(0,255,133)',
                        'rgb(153, 102, 255)',
                        'rgb(201, 203, 207)'
                    ],
                    borderWidth: 1,
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
                            display:true
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
