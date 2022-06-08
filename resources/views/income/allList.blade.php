@extends('master')
@section('content')



    <div class="col-12 col-md-9 col-xl-10 vh-100 py-5 ps-3 mb-5">
        <div class="mb-4 d-flex justify-content-between align-items-center">
            <ul class="nav nav-pills">
                <li class="nav-item">
                    <a class="nav-link {{route('toDayInCome') == request()->url()? 'active':''}}" aria-current="page" href="{{route('toDayInCome')}}">Today Income</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{route('dailyInCome') == request()->url()? 'active':''}}" href="{{route('dailyInCome')}}">Daily InCome</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{route('allInComeVouchers') == request()->url()? 'active':''}}" href="{{route('allInComeVouchers')}}">All InCome Voucher</a>
                </li>
            </ul>
            <div class="">
                <h6 class="text-end p-3">Date : {{\Illuminate\Support\Carbon::now()->toDayDateTimeString()}}</h6>

{{--                <div class="">--}}
{{--                    <span class="p-2 border rounded-2 text-center me-1">--}}
{{--                        <lable class="text-black-50">Today InCome : </lable>--}}
{{--                        {{\App\Models\VoucherList::whereDate('created_at',\Illuminate\Support\Carbon::today() )->sum('cost')}}--}}
{{--                    </span>--}}
{{--                    <span class="p-2 border rounded-2 text-center me-1">--}}
{{--                        <label class="text-black-50">Today Total Voucher :</label>--}}
{{--                        {{count(\App\Models\Voucher::whereDate('created_at',\Illuminate\Support\Carbon::today())->get())}}--}}
{{--                    </span>--}}
{{--                </div>--}}
            </div>
        </div>



        <div class="d-flex justify-content-between">
            <h3>All Income Voucher</h3>
{{--            <button class="btn btn-lg btn-primary" data-bs-toggle="modal" data-bs-target="#staticBackdrop">Today စာရင်းချုပ်မယ်</button>--}}
        </div>
        @if(session('status'))
            <div class="alert alert-success my-1">
                {{session('status')}};
            </div>
        @endif
        <div class="py-3 table-responsive-sm mb-5">
            <table class="table table-hover table-borderless align-middle">
                <thead class="table-primary">
                <tr class="">
                    <th>#</th>
                    <th>Date</th>
                    <th class="">Customer Name</th>
                    <th class="text-nowrap">Invoice Number</th>
                    <th class="text-center">Total Items</th>
                    <th class="text-center">Total Price</th>
                    <th class="text-center">Control</th>
                    <th class="text-end">Created_at</th>
                </tr>
                </thead>
                <tbody>
                @forelse($vouchers as $voucher)
                    <tr class="border-bottom">
                        <td>
                            {{$voucher->id}}
                        </td>
                        <td>{{$voucher->date}}</td>
                        <td>{{$voucher->customer_name}}</td>
                        <td class="">{{$voucher->invoice_number}}</td>
                        <td class="text-center">
                            {{$voucher->total_item}}
                            {{--                            {{$voucher->voucherLists->count('item_id')}}--}}

                        </td>
                        <td class="text-center">{{$voucher->total_price}}</td>
                        <td class="text-center">
                            <div class="">
                                <a href="{{route('voucherDetail',$voucher->id)}}" class="btn btn-outline-info me-1">
                                    <i class="fa-solid fa-info-circle fa-fw"></i>
                                </a>
                                @sayargyi
                                <a href="" class="btn btn-outline-warning me-1">
                                    <i class="fa-solid fa-pencil-alt fa-fw"></i>
                                </a>
                                <form action="" class="d-inline-flex" method="post">
                                    @csrf
                                    @method('delete')
                                    <button class="btn btn-outline-danger me-1">
                                        <i class="fa-solid fa-trash-alt fa-fw"></i>
                                    </button>
                                </form>
                                @endsayargyi
                            </div>
                        </td>
                        <td class="text-end">
                            <p class="small mb-0 text-nowrap">
                                <i class="fas fa-calendar"></i>
                                {{$voucher->created_at->format('d m Y')}}
                            </p>
                            <p class="small mb-0">
                                <i class="fas fa-clock"></i>
                                {{$voucher->created_at->format('h i a')}}
                            </p>
                        </td>
                        {{--                                               {{$voucher->created_at->diffForHumans()}}--}}
                    </tr>

                @empty
                    <tr>
                        <td colspan="5">There is no data</td>
                    </tr>
                @endforelse
                </tbody>
            </table>
            <div class="my-2">
                {{$vouchers->links()}}
            </div>
        </div>

    </div>


@endsection
