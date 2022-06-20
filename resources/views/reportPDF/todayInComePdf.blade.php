<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!-- CSS only -->
{{--    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">--}}
    <title>Today PDF</title>
{{--    <link rel="stylesheet" href="{{asset('css/app.css')}}">--}}

        <style>
            .head{
                display: flex;
                justify-content: space-between;
                align-items: center;
            }
            .total{
                /*p-2 border rounded-2 text-center me-1;*/
                padding: 5px;
                margin-bottom: 10px;
                font-size: large;
            }

         table{
             width: 100%;
            border-collapse: collapse;
         }

        table tr th{
            background-color: rgba(14, 173, 222, 0.98);
            color:white;
            /*border: 1px solid #ddd;*/
            border:none;
            padding: 8px;
        }

        table tr td{

            border: 1px solid #ddd;
            text-align: center;
            padding: 8px;

        }
        .page-break {
            page-break-after: always;
        }
        .status{
            width: 100%;
            height:50px;
            padding: 5px 15px;
            margin-bottom: 5px;
            background-color:rgba(168,227,178,0.4);
            display: flex;
            align-items: center;
            font-weight: bold;
            color: #008c3f
        }
         @media print{
            .hide-in-print{
                display:none !important;
            }
        }
    </style>
</head>
<body>


   <div class="head">
       <h1>{{date('d-m-Y')}} Income</h1>
{{--       <h3 class="hide-in-print"><a href="{{route('download-pdf')}}">Download with pdf format</a></h3>--}}
       <div class="">
        <span class="total">
            <lable class="text-black-50">Today InCome : </lable>
            {{\App\Models\VoucherList::whereDate('date',\Illuminate\Support\Carbon::today() )->sum('cost')}}
        </span><br>
           <span class="total">
            <label class="text-black-50">Today Total Voucher :</label>
            {{count(\App\Models\Voucher::whereDate('date',\Illuminate\Support\Carbon::today())->get())}}
        </span>
       </div>
   </div><br>

    @if(session('status'))
        <div class="status" ><a href="">{{session('status')}}</a> DownLoad Completed</div>
    @endif

    <div class="py-3 table-responsive-sm mb-5">
        <table class="table table-hover align-middle py-2" id="table_id">
            <thead class="table-primary">
            <tr class="">
                <th>#</th>
                <th>Date</th>
                <th class="">Customer Name</th>
                <th class="text-nowrap">Invoice Number</th>
                <th class="text-center">Total Items</th>
                <th class="text-center">Total Price</th>
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
                    </td>
                    <td class="text-center">{{$voucher->total_price}}</td>
                @empty
                    <tr>
                        <td colspan="5">There is no data</td>
                    </tr>
                @endforelse
                </tbody>
            </table>

        </div>

<div class="page-break"></div>
<div class="">Another Page</div>
{{--    <script src="{{asset('js/app.js')}}"></script>--}}

</body>
</html>
