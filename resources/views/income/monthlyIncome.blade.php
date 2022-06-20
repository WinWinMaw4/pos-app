@extends('master')
@section('head')
    <style>
        div.dataTables_wrapper div.dataTables_filter {
            text-align: right;
            display: none;
        }
    </style>
@endsection
@section('content')

    <div class="col-12 col-md-9 col-lg-10 py-5 ps-3">
        <div class="mb-4 d-flex justify-content-between align-items-center">
            <ul class="nav nav-pills">
                <li class="nav-item">
                    <a class="nav-link {{route('toDayInCome') == request()->url()? 'active':''}}" aria-current="page" href="{{route('toDayInCome')}}">Today Income</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{route('dailyInCome') == request()->url()? 'active':''}}" href="{{route('dailyInCome')}}">Daily InCome</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{route('monthlyInCome') == request()->url()? 'active':''}}" href="{{route('monthlyInCome')}}">Monthly Income</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{route('allInComeVouchers') == request()->url()? 'active':''}}" href="{{route('allInComeVouchers')}}">All InCome Voucher</a>
                </li>
            </ul>
            <div class="">
                <h6 class="text-end p-3"><i class="fas fa-calendar-alt calendar-icon"></i> : {{\Illuminate\Support\Carbon::now()->toDayDateTimeString()}} </h6>
                {{--                <input type="date" class="form-control form-control-sm w-25 " id="calendar-input" value="{{today()}}" onclick="calendarClick();">--}}

                <div class="">
                   <span class="p-2 border rounded-2 text-center me-1">
                 <lable class="text-black-50">Current Month Income : </lable>
                   {{\App\Models\DailyVoucher::whereMonth('date',\Illuminate\Support\Carbon::now()->month )->sum('total_price')}}
                </span>
                    <span class="p-2 border rounded-2 text-center me-1">
                    <label class="text-black-50">Current Month Total Voucher :</label>
                     {{count(\App\Models\DailyVoucher::whereMonth('date',\Illuminate\Support\Carbon::now()->month )->get())}}
                </span>
                </div>
            </div>
        </div>



        <div class="d-flex justify-content-between">
            <h3>Monthly InCome Lists</h3>
            <button class="btn btn-lg btn-primary" disabled data-bs-toggle="modal" data-bs-target="#staticBackdrop">Yearly စာရင်းချုပ်</button>
        </div>

        <div class="py-3 table-responsive-sm">
            <table class="table table-hover table-borderless align-middle py-2" id="dailyInCome_table">
                <thead class="table-primary">
                <tr class="">
                    <th>#</th>
                    <th class="text-nowrap">Date</th>
                    <th class="text-center">Total Days</th>
                    <th class="text-center">Total Price</th>
                    <th class="text-center">Control</th>
                    <th class="text-end">Created_at</th>
                </tr>
                </thead>
                <tbody>
                @forelse($monthlyInCome as $voucher)
                    <tr class="border-bottom">
                        <td>{{$voucher->id}}</td>
                        <td  class="text-nowrap">{{$voucher->date}}</td>
                        <td class="text-center">{{$voucher->total_day}}</td>
                        <td class="text-center">{{$voucher->total_price}}</td>
                        <td class="text-center">
                            <div class="">
                                <a href="{{route('voucherListDaily',$voucher->date)}}" class="btn btn-outline-info me-1">
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
        </div>

        <div class="">
            {{--            {{$vouchers->links()}}--}}
        </div>

        <form action="{{route('totalToday')}}" id="toDayInCome" method="post">
            @csrf
        </form>
        <!-- Modal -->
        @forelse($monthlyInCome as $voucher)
            <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="staticBackdropLabel">Monthly စာရင်းချုပ်</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="total-voucher d-flex justify-content-end p-3">
                                <input type="hidden" name="date"  form="toDayInCome" value="{{today()}}">
                                <label for="" class="text-black-50 me-1">Date : </label>
                                {{now()}}
                            </div>
                            <ul class="list-group list-group-flush">
                                <li class="list-group-item">
                                    <div class="total-voucher d-flex justify-content-between align-items-center" >
                                        <label for="">Total Voucher</label>
{{--                                        <input name="total_voucher"  form="toDayInCome" type="hidden" value="{{count(\App\Models\Voucher::whereDate('date',today())->get())}}" >--}}
{{--                                        {{count(\App\Models\Voucher::whereDate('date',today())->get())}}--}}
                                    </div>
                                </li>
                                <li class="list-group-item">
                                    <div class="total-price d-flex justify-content-between align-items-center " name="total-price">
                                        <label for="">Total Price</label>
{{--                                        <input type="hidden" form="toDayInCome" name="total_price" value="{{\App\Models\VoucherList::whereDate('date',today() )->sum('cost')}}">--}}
{{--                                        <span>--}}
{{--                                        {{\App\Models\VoucherList::whereDate('date',\Illuminate\Support\Carbon::today() )->sum('cost')}}--}}
{{--                                        <i>ks</i>--}}
{{--                                    </span>--}}
                                    </div>
                                </li>
                            </ul>
                            <div class="d-flex justify-content-end align-items-center p-3 text-end">
                                <button type="button" class="btn btn-lg btn-secondary me-1" data-bs-dismiss="modal">Close</button>
                                <button type="submit" form="toDayInCome" class="btn btn-lg btn-primary">Done</button>
                            </div>


                        </div>

                    </div>
                </div>
            </div>
        @empty
        @endforelse

    </div>


@endsection
@push('scripts')
{{--    <script>--}}
{{--        let calendarIcon = document.getElementsByClassName('calendar-icon');--}}
{{--        let calendarInput = document.getElementById('calendar-input');--}}
{{--        for(let i=0;i<=calendarIcon.length;i++){--}}
{{--            calendarIcon[i].addEventListener('click',_=>calendarInput.click());--}}
{{--        }--}}

{{--    </script>--}}
    <script>
        $(document).ready( function () {
            $('#dailyInCome_table').DataTable({
                "order": [[ 1, "desc" ]],
            });
        } );
    </script>
@endpush
