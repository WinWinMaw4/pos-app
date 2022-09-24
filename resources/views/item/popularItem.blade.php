@extends('master')
@section('head')
    <style>
        .table_id_filter {
            text-align: right;
            display: none !important;
        }
    </style>
@endsection
@section('content')
   <div class="col-12 col-md-9 col-lg-10 py-3">
       <h1>Best Selling Product</h1>

          <div class="">
              <table class="table table-hover align-middle pt-2 table-borderless" id="popularItem_table">

                  <thead class="table-primary align-middle">
                  <tr>
{{--                      <th colspan="5" class="text-end" style="background-color: #F7F7F7">{{\Illuminate\Support\Carbon::now()->toDayDateTimeString()}}--}}
{{--                      </th>--}}
                      <th>#</th>
                      <th colspan="2"class="w-25 overflow-hidden" >Product</th>
                      <th class="text-center">Category</th>
                      <th class="text-center">Unit Price</th>
                      <th class="text-center">Percentage</th>
                      <th class="text-center">Sales Qty</th>
                      <th>Sales Price</th>
                  </tr>
                  </thead>
                  <tbody>
                  @foreach ($popular_item as $item)
                      <tr>
                          <td>{{$item->id}}</td>
                          <td >
                              <div class="rounded-circle overflow-hidden bg-ligth border" style="height: 40px;width: 40px;">
                                  <a href="{{asset('storage/item/'.$item->photo)}}">
                                      <img src="{{asset('storage/item/'.$item->photo)}}" style="width: 100%;height: 100%;object-fit: cover;" alt="">
                                  </a>
                              </div>
                          </td>
                          <td class="text-truncate">{{$item->name}}</td>
                          <td class="text-center"> {{$item->category->name}}</td>
                          <td class="text-center"> {{$item->price}}</td>
                          <td class="text-center">
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
                          <td class="text-center"> {{$item->total_sales}}</td>
                          <td>{{round($item->price * $item->total_sales,2)}} <small>MMK</small></td>
                      </tr>
                  @endforeach
                  </tbody>

              </table>
          </div>
{{--          <table class="table">--}}
{{--              @foreach ($dates as $day => $voucher_lists)--}}
{{--                  <tr>--}}
{{--                      <th colspan="3"--}}
{{--                          style="background-color: #F7F7F7">{{ $day }}: {{ $voucher_lists->count() }} Vouchers List</th>--}}
{{--                  </tr>--}}
{{--                  @foreach ($voucher_lists as $voucher_list => $items)--}}

{{--                  <tr>--}}
{{--                          <td>--}}
{{--                              {{$items[0]->item_id}}--}}
{{--                              {{$items[0]->item_name}}--}}
{{--                          </td>--}}
{{--                          <td>{{$items[0]->items->category->name}}</td>--}}
{{--                          <td>{{$items->sum('quantity')}}</td>--}}
{{--                  </tr>--}}


{{--                  @endforeach--}}
{{--              @endforeach--}}
{{--          </table>--}}


   </div>
@endsection
@push('scripts')


    <script>
        $(document).ready( function () {
            $('#popularItem_table').DataTable({
                searching:true
            });
        } );
    </script>
@endpush
