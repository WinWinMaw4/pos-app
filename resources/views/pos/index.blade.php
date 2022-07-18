@extends('master')
@section('head')
    <style>
        .filter-btn:active,.filter-active{
            background: #d9d9fb;
        }

        .pos-card{
            /* position: relative; */

            height: 180px;
            max-height: 180px;
            /*height: auto;*/
            cursor: pointer;
            overflow: hidden;
            border: none;
            transition: .4s;
        }
        .pos-card:active{
            transform: scale(0.95);
        }
        .pos-card .pos-card-img-top{
            vertical-align: middle;
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: .4s;
        }
        .pos-card-img-top:hover{
            transform: scale(1.09);
        }
        .pos-card .content {
            position: absolute;
            bottom: 0;
            background: rgb(0, 0, 0); /* Fallback color */
            background: rgba(0, 0, 0, 0.5); /* Black background with 0.5 opacity */
            color: #f1f1f1;
            width: 100%;
            height: 25%;
            padding: 5px;
        }
        .voucher-col{
            position: fixed;
            right: 0;
        }
        .voucher{
            height: 92vh;
        }
        .voucher ul{
            max-height: 68vh;
            overflow: auto;
        }
        .productModalImgDiv{
            width: 100%;
            height: 300px;
            /*height: auto;*/
            overflow: hidden;

        }
        .productModalImgDiv img{
            width: 100%;
            height: 100%;
            object-fit: contain;
        }
        .voucher-list-item:hover{
            background: #ddd;
        }
        input[type="number"]::-webkit-outer-spin-button,
        input[type="number"]::-webkit-inner-spin-button{
            -webkit-appearance: none;
        }
        #productModalQuantity{
            -moz-appearance: textfield
        }
        .show-in-print{
            display: none !important;
        }

        @media print {
            .hide-in-print{
                display: none !important;
            }
            /*:not('.show-in-print'){*/
            /*    display: none !important;*/
            /*}*/
            .show-in-print{
                display: block !important;
            }
            .head-row{
                display: flex !important;
            }
            .show-in-print-small-text{
                font-size: small;
            }
            .voucher-col .voucher{
                /*color: white;*/
                /*background: yellow !important;*/
            }
        }
    </style>
@endsection
@section('content')

    @casher
    <div class=" col-12 col-md-9 col-lg-9 mt-4 pb-5 ps-3 hide-in-print">
        <div class="row mb-3">
            <div class="col">
                <input type="text" placeholder="Customer Number" id="cName"  value="{{ ucwords('Customer') }}" class="form-control">
            </div>
            <div class="col">
                <input type="text" placeholder="Invoice Number" id="cIN" value="{{ strtoupper(uniqid()) }}" class="form-control">
            </div>
            <div class="col">
                <input type="date" placeholder="Date" id="cDate" value="{{ date('Y-m-d') }}" class="form-control">
            </div>
        </div>
        <form action="{{route('pos.index')}}" method="get" class="mb-3">
            {{--            <form action="{{route('search')}}" method="get" class="mb-3">--}}
            <div class="me-2">
                <div class="input-group hide-in-print">
                    <input type="text"  name="search" value="{{request('search')}}" class="form-control border border-primary" placeholder="Search" required>
                    <button class="btn btn-outline-primary" type="submit">
                        <i class="fa-solid fa-search"></i>
                    </button>
                </div>
            </div>
        </form>
        <div class="mb-4">
            <ul class="nav nav-pills w-100 p-1" >
                <li class="nav-item filter-btn rounded-pill px-1 border me-1 mb-1 {{! request()->has('category') ? 'filter-active':''}}">
                    <a class="nav-link filter-active" aria-current="page" href="{{route('pos.index')}}">All</a>
                </li>
                @foreach($categories as $category)
                    <li class="nav-item filter-btn rounded-pill px-1 border me-1 mb-1 {{request()->has('category') && request('category')==$category->id ? 'filter-active':''}}">
                        <a class="nav-link " aria-current="page" href="{{route('pos.index',['category'=>$category->id])}}">{{$category->name}}</a>
                    </li>
                @endforeach
            </ul>
        </div>

        <div class="row">
            <div class="col-12">

                <div class="item">
                    <div class="row row-cols-5 row-cols-md-5 row-cols-lg-5 g-0" id="product-lists">
                        @forelse($items as $item)
                            <div class="col">
                                {{--                                data-bs-toggle="modal" data-bs-target="#productDetail{{$item->id}}"--}}
                                <div class="card pos-card product-card add-voucher" product-id="{{$item->id}}" data-cat="{{$item->category_id}}"  style="">
                                    @if($item->photo)
                                        {{--                                        <img src="{{ asset('storage/item/'.$item->photo) }}"  alt='{{$item->photo}}' class="pos-card-img-top product-img" alt="">--}}
                                        <img src="{{$item->photo}}"  alt='{{$item->photo}}' class="pos-card-img-top product-img" alt="">

                                    @elseif($item->photo==null)
                                        <img src="{{asset('image-default.png')}}" class="pos-card-img-top product-img" alt="">
                                    @endif
                                    {{--                                    <img src="https://www.w3schools.com/w3images/notebook.jpg" class="pos-card-img-top" alt="">--}}
                                    <div class="content d-flex justify-content-between align-items-center">
                                        <p class="h4 mb-0 product-name text-truncate">{{$item->name}}</p>
                                        <p class="fw-bold product-price mb-0">${{$item->price}}</p>
                                        <p class="small">{{$item->category->name}}</p>
                                    </div>
                                </div>
                            </div>
                        @empty
                        @endforelse
                        {{--                            //category search--}}
                        @if($categorySearch != [])
                            @forelse($categorySearch as $products)

                                @foreach ($products->items as $item)


                                    <div class="col">
                                        <div class="card pos-card product-card add-voucher" product-id="{{$item->id}}" data-cat="{{$item->category_id}}"  style="">
                                            @if($item->photo)
                                                <img src="{{$item->photo}}"  alt='{{$item->photo}}' class="pos-card-img-top product-img" alt="">

                                            @elseif($item->photo==null)
                                                <img src="{{asset('image-default.png')}}" class="pos-card-img-top product-img" alt="">
                                            @endif
                                            <img src="https://www.w3schools.com/w3images/notebook.jpg" class="pos-card-img-top" alt="">
                                            <div class="content d-flex justify-content-between align-items-center">
                                                <p class="h4 mb-0 product-name text-truncate">{{$item->name}}</p>
                                                <p class="fw-bold product-price mb-0">${{$item->price}}</p>
                                                <p class="small">{{$item->category->name}}</p>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            @empty
                            @endforelse
                        @endif
                        {{--                            end category serach--}}
                        <div class="col">
                            <a href="{{route('item.create')}}" class="text-decoration-none text-black-50" title="Add Item">
                                <div class="card pos-card bg-light border d-flex justify-content-center align-items-center">
                                    <i class="fas fa-plus fa-2x"></i>
                                </div>
                            </a>
                        </div>
                    </div>
                    @isset($categorySearch)

                        <div class="row row-cols-5 row-cols-md-5 row-cols-lg-4 g-0" id="product-lists">

                        </div>

                    @endisset
                </div>
                <div class="my-3">
                    {{$items->links()}}
                </div>
            </div>
        </div>
    </div>

    {{--    voucher --}}
    <div class="col-12 col-md-12  col-lg-3 px-0 d-md-none d-lg-block voucher-col">
        <div class="bg-white  w-100 shadow-sm voucher" style="position: relative;">
            <h4 class="d-flex justify-content-between align-items-center mb-2 py-3 hide-in-print">
                <span class="text-primary">Your Voucher</span>
                <span class="badge bg-primary rounded-pill voucherListCount" id="voucherListCount">0</span>
            </h4>
            <div class="show-in-print">
                <h3 class="text-center text-primary py-2">POS RESTAURANT <i class="fa-solid fa-bell-concierge"></i></h3>
                <small class="my-1 d-block">Date : {{ date('d-m-Y')}}</small>
                <small class="my-1 d-block">Customer: <span id="v_customer_name">{{ucwords('Customer')}}</span></small>
                <small class="my-1 d-block">InvoiceNo : <span id="v_invoice_number">{{ strtoupper(uniqid()) }}</span></small>
            </div>
            <ul class="list-group " id="voucherList">
                <li class="head-row text-black-50 px-2 list-group-item d-flex align-items-center voucher-list-item show-in-print">
                    <div class="w-50">
                        Products
                    </div>
                    <div class="small text-center text-nowrap" style="width: 30%">
                        <p class="text-black-50 unit-price voucher-product-price mb-0" >
                            Unit Price x Quantity
                        </p>
                    </div>
                    <div class="text-black-50 voucher-cost text-end text-nowrap pe-2" style="width: 20%">Cost</div>
                </li>

                {{--                        <li class="list-group-item d-flex justify-content-between align-items-center voucher-list-item px-0 pe-1">--}}
                {{--                            <i class="fas fa-times text-danger remove-list px-2 voucher-list-del hide-in-print" data-product-id="${productId}" style="cursor: pointer"></i>--}}
                {{--                            <img src="${productImg}" alt="" class="vourcher-product-img rounded-2 me-1 hide-in-print" width="40px" height="40px">--}}
                {{--                            <div class="w-50">--}}
                {{--                               <div class="">--}}
                {{--                                    <h6 class="my-0 text-truncate voucher-product-name">${title}</h6>--}}
                {{--                                    <div class="hide-in-print">--}}
                {{--                                        <small class="text-muted unit-price voucher-product-price" >--}}
                {{--                                            ${price}--}}
                {{--                                        </small>--}}
                {{--                                        x--}}
                {{--                                        <small  class="text-muted unit-price voucher-product-quantity">--}}
                {{--                                            ${quantity}--}}
                {{--                                        </small>--}}
                {{--                                    </div>--}}
                {{--                                </div>--}}
                {{--                            </div>--}}
                {{--                            <div class="text-muted w-25 voucher-cost text-end">${cost}</div>--}}
                {{--                        </li>--}}
            </ul>

            <div class="voucher-total  w-100 d-flex justify-content-between align-items-center py-3 h5 border-top">
                <div class="total-title h5" >Total</div>
                <div class="total-price text-end" id="voucherTotal">$0</div>
            </div>
            <div class="text-center w-100 text-primary small fw-bold show-in-print position-absolute bottom-0 p-3">
                <p class="mb-0">Thank For Selling From POS</p>
                <i>Phone No :0987654321</i>
            </div>
            <button class="btn btn-success btn-lg form-control py-3 position-absolute bottom-0 checkout-btn hide-in-print" >
                        <span class="h4">
                            <i class="fas fa-shopping-basket"></i>
                            CheckOut
                        </span>
            </button>
        </div>
    </div>

    @else
        <div class=" col-12 col-md-9 col-lg-7 mt-4 pb-5 ps-3 hide-in-print">
            <div class="row mb-3">
                <div class="col">
                    <input type="text" placeholder="Customer Number" id="cName"  value="{{ ucwords('Customer') }}" class="form-control">
                </div>
                <div class="col">
                    <input type="text" placeholder="Invoice Number" id="cIN" value="{{ strtoupper(uniqid()) }}" class="form-control">
                </div>
                <div class="col">
                    <input type="date" placeholder="Date" id="cDate" value="{{ date('Y-m-d') }}" class="form-control">
                </div>
            </div>
            <form action="{{route('pos.index')}}" method="get" class="mb-3">
                {{--            <form action="{{route('search')}}" method="get" class="mb-3">--}}
                <div class="me-2">
                    <div class="input-group hide-in-print">
                        <input type="text"  name="search" value="{{request('search')}}" class="form-control border border-primary" placeholder="Search" required>
                        <button class="btn btn-outline-primary" type="submit">
                            <i class="fa-solid fa-search"></i>
                        </button>
                    </div>
                </div>
            </form>
            <div class="mb-4">
                <ul class="nav nav-pills w-100 p-1" >
                    <li class="nav-item filter-btn rounded-pill px-1 border me-1 mb-1 {{! request()->has('category') ? 'filter-active':''}}">
                        <a class="nav-link filter-active" aria-current="page" href="{{route('pos.index')}}">All</a>
                    </li>
                    @foreach($categories as $category)
                        <li class="nav-item filter-btn rounded-pill px-1 border me-1 mb-1 {{request()->has('category') && request('category')==$category->id ? 'filter-active':''}}">
                            <a class="nav-link " aria-current="page" href="{{route('pos.index',['category'=>$category->id])}}">{{$category->name}}</a>
                        </li>
                    @endforeach
                </ul>
            </div>

            <div class="row">
                <div class="col-12">

                    <div class="item">
                        <div class="row row-cols-5 row-cols-md-5 row-cols-lg-4 g-0" id="product-lists">
                            @forelse($items as $item)
                                <div class="col">
                                    {{--                                data-bs-toggle="modal" data-bs-target="#productDetail{{$item->id}}"--}}
                                    <div class="card pos-card product-card add-voucher" product-id="{{$item->id}}" data-cat="{{$item->category_id}}"  style="">
                                        @if($item->photo)
                                            {{--                                        <img src="{{ asset('storage/item/'.$item->photo) }}"  alt='{{$item->photo}}' class="pos-card-img-top product-img" alt="">--}}
                                            <img src="{{$item->photo}}"  alt='{{$item->photo}}' class="pos-card-img-top product-img" alt="">

                                        @elseif($item->photo==null)
                                            <img src="{{asset('image-default.png')}}" class="pos-card-img-top product-img" alt="">
                                        @endif
                                        {{--                                    <img src="https://www.w3schools.com/w3images/notebook.jpg" class="pos-card-img-top" alt="">--}}
                                        <div class="content d-flex justify-content-between align-items-center">
                                            <p class="h4 mb-0 product-name text-truncate">{{$item->name}}</p>
                                            <p class="fw-bold product-price mb-0">${{$item->price}}</p>
{{--                                            <p class="small">{{$item->category->name}}</p>--}}
                                        </div>
                                    </div>
                                </div>
                            @empty
                            @endforelse
                            {{--                            //category search--}}
                            @if($categorySearch != [])
                                @forelse($categorySearch as $products)

                                    @foreach ($products->items as $item)


                                        <div class="col">
                                            <div class="card pos-card product-card add-voucher" product-id="{{$item->id}}" data-cat="{{$item->category_id}}"  style="">
                                                @if($item->photo)
                                                    <img src="{{$item->photo}}"  alt='{{$item->photo}}' class="pos-card-img-top product-img" alt="">

                                                @elseif($item->photo==null)
                                                    <img src="{{asset('image-default.png')}}" class="pos-card-img-top product-img" alt="">
                                                @endif
                                                <img src="https://www.w3schools.com/w3images/notebook.jpg" class="pos-card-img-top" alt="">
                                                <div class="content d-flex justify-content-between align-items-center">
                                                    <p class="h4 mb-0 product-name text-truncate">{{$item->name}}</p>
                                                    <p class="fw-bold product-price mb-0">${{$item->price}}</p>
{{--                                                    <p class="small">{{$item->category->name}}</p>--}}
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                @empty
                                @endforelse
                            @endif
                            {{--                            end category serach--}}
                            <div class="col">
                                <a href="{{route('item.create')}}" class="text-decoration-none text-black-50" title="Add Item">
                                    <div class="card pos-card bg-light border d-flex justify-content-center align-items-center">
                                        <i class="fas fa-plus fa-2x"></i>
                                    </div>
                                </a>
                            </div>
                        </div>
                        @isset($categorySearch)

                            <div class="row row-cols-5 row-cols-md-5 row-cols-lg-4 g-0" id="product-lists">

                            </div>

                        @endisset
                    </div>
                    <div class="my-3">
                        {{$items->links()}}
                    </div>
                </div>
            </div>
        </div>

        {{--    voucher --}}
        <div class="col-12 col-md-12  col-lg-3 px-0 d-md-none d-lg-block voucher-col">
            <div class="bg-white  w-100 shadow-sm voucher" style="position: relative;">
                <h4 class="d-flex justify-content-between align-items-center mb-2 py-3 hide-in-print">
                    <span class="text-primary">Your Voucher</span>
                    <span class="badge bg-primary rounded-pill voucherListCount" id="voucherListCount">0</span>
                </h4>
                <div class="show-in-print">
                    <h3 class="text-center text-primary py-2">POS RESTAURANT <i class="fa-solid fa-bell-concierge"></i></h3>
                    <small class="my-1 d-block">Date : {{ date('d-m-Y')}}</small>
                    <small class="my-1 d-block">Customer: <span id="v_customer_name">{{ucwords('Customer')}}</span></small>
                    <small class="my-1 d-block">InvoiceNo : <span id="v_invoice_number">{{ strtoupper(uniqid()) }}</span></small>
                </div>
                <ul class="list-group " id="voucherList">
                    <li class="head-row text-black-50 px-2 list-group-item d-flex align-items-center voucher-list-item show-in-print">
                        <div class="w-50">
                            Products
                        </div>
                        <div class="small text-center text-nowrap" style="width: 30%">
                            <p class="text-black-50 unit-price voucher-product-price mb-0" >
                                Unit Price x Quantity
                            </p>
                        </div>
                        <div class="text-black-50 voucher-cost text-end text-nowrap pe-2" style="width: 20%">Cost</div>
                    </li>

                    {{--                        <li class="list-group-item d-flex justify-content-between align-items-center voucher-list-item px-0 pe-1">--}}
                    {{--                            <i class="fas fa-times text-danger remove-list px-2 voucher-list-del hide-in-print" data-product-id="${productId}" style="cursor: pointer"></i>--}}
                    {{--                            <img src="${productImg}" alt="" class="vourcher-product-img rounded-2 me-1 hide-in-print" width="40px" height="40px">--}}
                    {{--                            <div class="w-50">--}}
                    {{--                               <div class="">--}}
                    {{--                                    <h6 class="my-0 text-truncate voucher-product-name">${title}</h6>--}}
                    {{--                                    <div class="hide-in-print">--}}
                    {{--                                        <small class="text-muted unit-price voucher-product-price" >--}}
                    {{--                                            ${price}--}}
                    {{--                                        </small>--}}
                    {{--                                        x--}}
                    {{--                                        <small  class="text-muted unit-price voucher-product-quantity">--}}
                    {{--                                            ${quantity}--}}
                    {{--                                        </small>--}}
                    {{--                                    </div>--}}
                    {{--                                </div>--}}
                    {{--                            </div>--}}
                    {{--                            <div class="text-muted w-25 voucher-cost text-end">${cost}</div>--}}
                    {{--                        </li>--}}
                </ul>

                <div class="voucher-total  w-100 d-flex justify-content-between align-items-center py-3 h5 border-top">
                    <div class="total-title h5" >Total</div>
                    <div class="total-price text-end" id="voucherTotal">$0</div>
                </div>
                <div class="text-center w-100 text-primary small fw-bold show-in-print position-absolute bottom-0 p-3">
                    <p class="mb-0">Thank For Selling From POS</p>
                    <i>Phone No :0987654321</i>
                </div>
                <button class="btn btn-success btn-lg form-control py-3 position-absolute bottom-0 checkout-btn hide-in-print" >
                        <span class="h4">
                            <i class="fas fa-shopping-basket"></i>
                            CheckOut
                        </span>
                </button>
            </div>
        </div>

        @endcasher


    {{--    Modal--}}
        @forelse($items as $item)
                <div class="modal fade productDetailModal" id="productDetailModal{{$item->id}}"  data-bs-backdrop="static"  aria-labelledby="productModalTitle" >
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                            <h5 class="modal-title productModalTitle" id="productModalTitle{{$item->id}}">{{ucwords($item->name)}}</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form class="text-center modalForm" data-id="{{$item->id}}">
                            <p class="productModalTitle d-none">{{ucwords($item->name)}}</p>
                            <div class="productModalImgDiv border">
{{--                                <img src="{{asset('storage/item/'.$item->photo)}}" class="productModalImg" id="productModalImg{{$item->id}}" alt="">--}}
                                <img src="{{$item->photo}}" class="productModalImg" id="productModalImg{{$item->id}}" alt="">
                            </div>
                           <div class="d-flex justify-content-between align-items-center py-3">
                               <p class="text-black-50 h5 mb-0" >
                                   <lable>Unit Price :</lable>
                                   $ <span class="productModalUnitPrice" id="productModalUnitPrice{{$item->id}}">{{$item->price}}</span>
                               </p>
                               <p class="text-black-50 h5 mb-0" >
                                   $ <span class="productModalCost" id="productModalCost{{$item->id}}">{{$item->price}}</span>
                               </p>
                           </div>

                            <div class="input-group mb-3 w-50 mx-auto">
                                <button class="btn btn-outline-secondary quantityMinus" type="button"  id="quantityMinus{{$item->id}}" >
                                    <i class="fa-solid fa-minus fa-fw"></i>
                                </button>
                                <input type="number" class="form-control text-end productModalQuantity" price="{{$item->price}}" min="1" value="1" id="productModalQuantity{{$item->id}}" placeholder="" aria-label="Example text with button addon" aria-describedby="button-addon1">
                                <button class="btn btn-outline-secondary quantityPlus" type="button" id="quantityPlus{{$item->id}}">
                                    <i class="fa-solid fa-plus fa-fw"></i>
                                </button>
                            </div>
                            <div class="d-none">
                                <textarea name="message" class="form-control productModalMessage" id="" cols="30" rows="3"></textarea>
                            </div>

                            </form>
                        </div>
                        <div class="modal-footer justify-content-center">
                            <button type="button" class="btn btn-primary addToVoucherBtn" data-bs-dismiss="modal"  id="addToVoucherBtn{{$item->id}}">Add To Voucher</button>
                        </div>
                    </div>
                </div>
            </div>
    @empty
    @endforelse
{{--    End Modal--}}
@endsection
