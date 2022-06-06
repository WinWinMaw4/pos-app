@extends('master')
@section('content')
    <div class="col-12 col-md-9 py-5 ps-3" >
        <div class="mb-4">
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
            <div class="col-12 col-md-7">
                <h4>
                    <i class="fas fa-pencil-alt text-primary"></i>
                    Edit Item
                </h4>

                @if($errors->any())
                    <ul>
                        @foreach($errors->all() as $error)
                            <li class="text-danger">{{ $error }}</li>
                        @endforeach
                    </ul>
                @endif

                <form action="{{ route('item.update',$item->id) }}" id="itemAdd" method="post" enctype="multipart/form-data">
                    @csrf
                    @method('put')
                    <div class="mb-3">
                        <label class="form-label">Item Name</label>
                        <input type="text" name="name" value="{{ old('name',$item->name) }}" class="form-control @error('name') is-invalid @enderror">
                        @error('name')
                        <div class="invalid-feedback">
                            <span>{{$message}}</span>
                        </div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Select Category</label>
                        <select name="category_id" class="form-select @error('category_id') is-invalid @enderror" id="">
                            @foreach(\App\Models\Category::all() as $category)
                                <option value="{{ $category->id }}" {{ $category->id==$item->category_id ? 'selected' : '' }}>{{ $category->name }}</option>
                            @endforeach
                        </select>
                        @error('category_id')
                        <div class="invalid-feedback">
                            <span>{{$message}}</span>
                        </div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Price</label>
                        <input type="number" name="price" value="{{ old('price',$item->price) }}" class="form-control @error('price') is-invalid @enderror">
                        @error('price')
                        <div class="invalid-feedback">
                            <span>{{$message}}</span>
                        </div>
                        @enderror
                    </div>

                    <div class="mb-3 d-none">
                        <label for="photo" class="form-label text-muted">Photo</label>
                        <input type="file" id="photo" name="photo" class=" form-control @error('photo') is-invalid @enderror" accept="image/jpeg,image/png">
                        @error('photo')
                        <div class="invalid-feedback">
                            <span>{{$message}}</span>
                        </div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Description</label>
                        <textarea type="text" name="description" rows="7" class="form-control @error('description') is-invalid @enderror">{{ old('description',$item->description) }}</textarea>
                        @error('description')
                        <div class="invalid-feedback">
                            <span>{{$message}}</span>
                        </div>
                        @enderror
                    </div>
                    <button class="btn btn-primary">Update Item</button>
                </form>
            </div>
            <div class="col-12 col-md-5 py-5">
                <div id=""   class="w-100 border border-1 rounded-3  @error('photo') border-danger is-invalid @enderror" value="{{ old('photo',$item->photo)}} "  style="height: 300px;overflow: hidden">
                    <img src="{{asset('storage/item/'.$item->photo)}}" form="itemAdd" id="itemPreview" class="item-img w-100" style="height: 100%;object-fit: cover;" alt="">
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        let itemPreview = document.getElementById('itemPreview');
        let photo = document.getElementById('photo');
        itemPreview.addEventListener('click',_=>photo.click());
        photo.addEventListener("change",_=>{
            let file = photo.files[0];
            let reader = new FileReader();
            reader.onload = function (){
                itemPreview.src = reader.result;
            }
            reader.readAsDataURL(file);
        })
    </script>
@endpush
