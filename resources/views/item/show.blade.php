@extends('master')
@section('content')
    <div class="col-12 col-md-9 col-lg-7 mt-4 pb-5 ps-3">
        <div class="mb-4 d-flex justify-content-between align-items-center" >
            <ul class="nav nav-pills">
                <li class="nav-item">
                    <a class="nav-link {{route('item.index') == request()->url()? 'active':''}}" aria-current="page" href="{{route('item.index')}}">Item List</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{route('item.create') == request()->url()? 'active':''}}" href="{{route('item.create')}}">Add Item</a>
                </li>
            </ul>
        </div>

        <div class="row">
            <div class="col-12 col-md-8">
                <div class="card">
                    <div class=" p-2">
                        <h4 class="p-0 fw-bold">{{$item->name}}</h4>
                    </div>
                    <div class="card-img-top">
                        <img src="{{$item->photo}}" alt="" class="w-100" style="height: 300px;object-fit: contain">
                    </div>
                    <div class="card-body">
                        <div class="card-text">
                            <p><span class="d-inline-block fw-bold text-black-50">Id : </span> {{$item->id}}</p>
                            <p><span class="d-inline-block fw-bold text-black-50">Name : </span> {{$item->name}}</p>
                            <p><span class="d-inline-block fw-bold text-black-50">Photo  : </span> <span class="small">{{$item->photo}}</span></p>
                            <p><span class="d-inline-block fw-bold text-black-50">Category : </span> {{$item->category->name}}</p>
                            <p><span class="d-block fw-bold text-black-50">Description</span> {{$item->description}}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
