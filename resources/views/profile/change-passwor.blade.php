@extends('master')
@section('content')
    <div class="ccol-12 col-md-9  ps-3">
        <div class="container">
            <div class="row row-cols-2 justify-content-start align-items-start">
                <div class="col-12 col-lg-6 col-xl-5">
                    <div class="">
                        <div class="text-center my-5 shadow pb-4  bg-primary rounded overflow-hidden text-white" >
                            {{--                            <h4 class="fw-bold mb-4">Edit Your Profile</h4>--}}
                            @if(auth()->user()->photo)
                                <img id="yPhoto" src="{{asset('storage/profile/'.auth()->user()->photo)}}" class="profile-image" alt="" style="width: 100%;aspect-ratio: 4/3;object-fit: cover "><br>
                            @else
                                <img id="yPhoto" src="{{asset('storage/profile/user-default.png')}}" class="profile-image" alt="" style="width: 100%;aspect-ratio: 4/3;object-fit: cover "><br>
                            @endif
                            <button class="btn btn-sm btn-secondary" id="edit-photo" style="margin-top: -25px;">
                                <i class="fas fa-camera"></i>
                            </button>
                            <p class="mb-0 h4">{{auth()->user()->name}}</p>
                            <p class="small text-white mb-0">{{auth()->user()->email}}</p>
                            <p class="small text-white mb-0">{{auth()->user()->role}}</p>

                        </div>
                    </div>
                </div>
                <div class="col-12 col-lg-6 col-xl-7">
                    <div class="my-5">
                        <ul class="nav nav-tabs mb-3" id="pills-tab" role="tablist">
                            <li class="nav-item" role="presentation">
                                <a href="{{url('/user/profile/profile-detail')}}" class="text-decoration-none">
                                    <button class="nav-link " type="button">Profile Info</button>
                                </a>
                            </li>
                            <li class="nav-item" role="presentation">
                                <a href="{{url('/user/profile/change-password')}}" class="text-decoration-none">
                                    <button class="nav-link active" type="button">Change Password</button>
                                </a>
                            </li>
                        </ul>

                        <div class="tab-content" id="pills-tabContent">
                            <div class="tab-pane fade show active" id="pills-changePassword">
                                <div class="">
                                    <form action="{{route('updatePassword',\Illuminate\Support\Facades\Auth::id())}}" id="changePasswordForm" method="post">
                                        @csrf
                                        @method('put')
                                        <div class="form-floating mb-3">
                                            <input type="password" name="old_password" id="oldPassword" class="form-control border-0 border-bottom @error('old_password') is-invalid @enderror" value="{{ old('old_password') }}">
                                            <label for="oldPassword">Current Password</label>
                                            @error('old_password')
                                            <div class="invalid-feedback ps-2">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="form-floating mb-3">
                                            <input type="password" name="password" class="form-control border-0 border-bottom @error('password') is-invalid @enderror" id="newPassword" value="{{ old('password') }}" placeholder="">
                                            <label for="newPassword">New Password</label>
                                            @error('password')
                                            <div class="invalid-feedback ps-2">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="form-floating mb-3">
                                            <input type="password" name="password_confirmation" class="form-control border-0 border-bottom @error('password_confirmation') is-invalid @enderror" id="confirmPassword" value="" placeholder="">
                                            <label for="confirmPassword">Confirm Password</label>
                                            @error('password_confirmation')
                                            <div class="invalid-feedback ps-2">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="text-start">
                                            <button class="btn btn-lg btn-primary text-white" id="changePassword-btn" type="submit">
                                                Change Password
                                            </button>
                                            <button class="btn btn-lg btn-link" id="forgot-btn">
                                                Forgot Password
                                            </button>
                                        </div>
                                        {{--                            <a href="{{route('change-password')}}" class=" float-end">Change Password</a>--}}
                                    </form>
                                </div>
                            </div>
                        </div>

                    </div>

                </div>



            </div>
        </div>

    </div>
@endsection
@push('scripts')
    <script>
        let profileImage = document.querySelector('.profile-image');
        let editPhoto = document.querySelector("#edit-photo");
        let photo = document.querySelector("[name='photo']");
        editPhoto.addEventListener('click',_=>photo.click());
        photo.addEventListener("change",_=>{
            let file = photo.files[0];
            let reader = new FileReader();
            reader.onload = function (){
                profileImage.src = reader.result;
            }
            reader.readAsDataURL(file);
        })



        //axios post
        // let laravelToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
        // let updateBtn = document.getElementById('update-btn');
        // let profileEidtForm = document.getElementById('profileEditForm');
        // profileEidtForm.addEventListener('submit',function (e) {
        //
        //     // let data = {
        //     //     your_photo : document.getElementById('yPhoto').getAttribute('src'),
        //     //     your_name : document.getElementById('yName').value,
        //     //     your_email : document.getElementById('yEmail').value,
        //     //     your_phone : document.getElementById('yPhone').value,
        //     // }
        //     // console.log(data);
        //     e.preventDefault()
        //     let formData = new FormData(this);
        //     console.log(formData);
        //
        //     axios.post(profileEidtForm.getAttribute('action'),formData)
        //         .then(function (response){
        //             if(response.data.status == "success"){
        //                 console.log(response.data);
        //             }
        //         }).catch(function (error){
        //             console.log(error);
        //     })
        //
        // })
    </script>
@endpush

