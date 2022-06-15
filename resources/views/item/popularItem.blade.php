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
   <div class="col-12 col-md-9 py-3">s
       <h1>Best Selling Product</h1>

          <div class="">
              <table class="table table-hover align-middle pt-2 table-borderless" id="popular_item">

                  <thead class="table-primary align-middle">
                  <tr>
{{--                      <th colspan="5" class="text-end" style="background-color: #F7F7F7">{{\Illuminate\Support\Carbon::now()->toDayDateTimeString()}}--}}
{{--                      </th>--}}
                      <th>#</th>
                      <th colspan="2" >Product</th>
                      <th>Category</th>
                      <th>Sales Qty</th>
                      <th>Sales Price</th>
                  </tr>
                  </thead>
                  <tbody>
                  @foreach ($popular_item as $item)
                      <tr>
                          <td>{{$item->id}}</td>
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
            $('#popular_item').DataTable({
                "searching": false
            });


        } );
    </script>
@endpush
