@extends('master')
@section('content')
    <div class="col-12 col-md-9 py-5 ps-3">


        <div class="mb-4">
            <ul class="nav nav-pills">
                <li class="nav-item">
                    <a class="nav-link {{route('category.index') == request()->url()? 'active':''}}" aria-current="page" href="{{route('category.index')}}">Category List</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{route('category.create') == request()->url()? 'active':''}}" href="{{route('category.create')}}">Add Category</a>
                </li>
            </ul>
        </div>

       <div class="row">
           <div class="col-12">
               <h4>
                   <i class="fas fa-plus-circle text-primary"></i>
                   Add Category
               </h4>
               @if(session('status'))
                   <div class="alert alert-success d-flex justify-content-between align-items-center fade show" role="alert">
                       <div>
                           {{session('status')}}
                       </div>
                       <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                   </div>
               @endif
                   <form action="{{route('category.store')}}" method="post">
                           @csrf
                           <div class="row">
                               <div class="col-4">
                                   <div class="">
                                       <input type="text" class="form-control @error('name') is-invalid @enderror " name="name">
                                   </div>
                               </div>
                               <div class="col-4">
                                   <button class="btn btn-outline-primary ">Add</button>

                               </div>
                           </div>
                           @error('name')
                           <p class="text-danger small">{{$message}}</p>
                           @enderror
                       </form>

           </div>
       </div>

        <div class="row">
            <div class="col-12">
{{--                @include('category.list')--}}
            </div>
        </div>
    </div>

@endsection
