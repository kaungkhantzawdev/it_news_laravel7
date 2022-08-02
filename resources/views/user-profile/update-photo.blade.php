@extends('layouts.app')
@section('title') Update-Photo @endsection
@section('content')
    <x-bread-crumb>
        <li class="breadcrumb-item"><a href="{{ route('profile') }}">Profile</a></li>
        <li class="breadcrumb-item active" aria-current="page">Update Photo</li>
    </x-bread-crumb>
    <div class="row">
        <div class="col-12 col-md-4">
            <div class="">
                <div class="card border-0">
                    <div class="card-body">
                        <div class="text-center">
                            <img src="{{ isset(Auth::user()->photo)? asset('storage/profile/'.Auth::user()->photo) : asset('dashboard/img/user.png')  }}" alt="" class="rounded-circle img-thumbnail my-3 shadow-sm" style="width: 150px; height: 150px; object-fit: cover; object-position: center">
                            <form action="{{ route('profile.update-edit-photo') }}" class="" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="d-flex justify-content-between align-items-end">
                                    <div class="form-group mb-0 mr-2">
                                        <label class="text-center">
                                            <i class="mr-1 feather-image"></i>
                                            Select New Photo
                                        </label>
                                        <input type="file" name="photo" class="form-control p-1 mr-2 overflow-hidden" required>

                                    </div>
                                    <button type="submit" class="btn btn-primary">
                                        <i class="mr-1 feather-upload"></i>
                                    </button>
                                </div>
                                <small class="d-block my-2 text-black-50"> image dimensions ratio is 1/1.</small>
                                @error("photo")
                                <small class="font-weight-bold text-danger text-center">{{ $message }}</small>
                                @enderror
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
