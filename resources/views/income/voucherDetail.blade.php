@extends('master')
@section('content')
    <div class="col-12 col-md-9 col-xl-10 vh-100 py-5 ps-3">
        <div class="mb-4 d-flex justify-content-between align-items-center">
            <ul class="nav nav-pills">
                <li class="nav-item">
                    <a class="nav-link {{route('toDayInCome') == request()->url()? 'active':''}}" aria-current="page" href="{{route('toDayInCome')}}">Today Income</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{route('dailyInCome') == request()->url()? 'active':''}}" href="{{route('dailyInCome')}}">Current Month InCome</a>
                </li>
            </ul>
            <div class="">
                <h6 class="text-end p-3">Date : {{\Illuminate\Support\Carbon::now()->toDayDateTimeString()}}</h6>

                <div class="">
                    <span class="p-2 border rounded-2 text-center me-1">
                        <lable class="text-black-50">Today InCome : </lable>
                        {{\App\Models\VoucherList::whereDate('created_at',\Illuminate\Support\Carbon::today() )->sum('cost')}}
                    </span>
                    <span class="p-2 border rounded-2 text-center me-1">
                        <label class="text-black-50">Today Total Voucher :</label>
                        {{count(\App\Models\Voucher::whereDate('created_at',\Illuminate\Support\Carbon::today())->get())}}
                    </span>
                </div>
            </div>
        </div>



        <h3 class="mb-3">Voucher Detail</h3>
       <div class="">
         @foreach($voucher as $v)
               <ul class="list-group list-group-horizontal-md h5 border-0">
                   <li class="list-group-item border-0"><span class="small text-black-50">Customer Name : </span>{{$v->customer_name}}</li>
                   <li class="list-group-item border-0"><span class="small text-black-50">Invoice Number : </span>{{$v->invoice_number}}</li>
                   <li class="list-group-item border-0"><span class="small text-black-50">Total Price : </span>{{$v->total_price}} <i>ks</i></li>
                   <li class="list-group-item border-0"><span class="small text-black-50">Date : </span>{{\Illuminate\Support\Carbon::createFromDate($v->created_at)->toDayDateTimeString()}}</li>
               </ul>
           @endforeach
       </div>

        <div class="py-3 table-responsive-sm">
            <table class="table table-hover table-borderless align-middle">
                <thead class="table-primary">
                <tr class="">
                    <th>#</th>
                    <th>Photo</th>
                    <th>Item Name</th>
                    <th>Category</th>
                    <th class="text-center">Unit Price</th>
                    <th class="text-center">Quantity</th>
                    <th class="text-start">Cost</th>
                    <th class="text-end">Created_at</th>
                </tr>
                </thead>
                <tbody>
                @forelse($voucherLists as $voucherlist)
                    <tr class="border-bottom">
                        <td>{{$voucherlist->id}}</td>
                        <td class="text-center">
                            <div class="rounded-circle overflow-hidden bg-secondary" style="height: 50px;width: 50px;">
{{--                                <a href="{{asset("storage/item/".$voucherlist->items->photo)}}">--}}
{{--                                    <img src="{{asset("storage/item/".$voucherlist->items->photo)}}" style="width: 100%;height: 100%;object-fit: cover;" alt="">--}}
{{--                                </a>--}}
                                <a href="{{$voucherlist->items->photo}}">
                                    <img src="{{$voucherlist->items->photo}}" style="width: 100%;height: 100%;object-fit: cover;" alt="">
                                </a>
                            </div>
                        </td>
                        <td>{{$voucherlist->item_name}}</td>
                        <td>{{$voucherlist->items->category->name}}</td>
                        <td class="text-center">{{$voucherlist->unit_price}}</td>
                        <td class="text-center">{{$voucherlist->quantity}}</td>
                        <td class="text-start">{{$voucherlist->cost}}</td>
                        <td class="text-end">
                            <p class="small mb-0 text-nowrap">
                                <i class="fas fa-calendar"></i>
                                {{$voucherlist->created_at->format('d m Y')}}
                            </p>
                            <p class="small mb-0">
                                <i class="fas fa-clock"></i>
                                {{$voucherlist->created_at->format('h i a')}}
                            </p>
                        </td>
{{--                       {{$voucherlist->created_at->diffForHumans()}}--}}
                    </tr>

                @empty
                    <tr>
                        <td colspan="5">There is no data</td>
                    </tr>
                @endforelse
                </tbody>
            </table>
        </div>

        <div class="">
            {{$voucherLists->links()}}
        </div>

    </div>


@endsection
