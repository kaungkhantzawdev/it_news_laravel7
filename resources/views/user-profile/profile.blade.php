@extends('layouts.app')
@section('title') Profile @endsection
@section('content')
    <x-bread-crumb>
        <li class="breadcrumb-item active" aria-current="page">Profile</li>
    </x-bread-crumb>
    <div class="row">
        <div class="col-12 col-md-4">
            <div class="">
                <div class="card border-0">
                    <div class="card-body">
                        <div class="text-center">
                            <img src="{{ isset(Auth::user()->photo)? asset('storage/profile/'.Auth::user()->photo) : asset('dashboard/img/user.png')  }}" alt="" class="rounded-circle img-thumbnail my-3 shadow-sm" style="width: 150px; height: 150px; object-fit: cover; object-position: center">
                            <h3 class="mb-0 font-weight-bold">
                                {{ Auth::user()->name }}
                            </h3>
                            <small class="text-black-50">
                                {{ Auth::user()->email }}
                            </small>
                            <table class="table mb-0 mt-4 text-left">
                                <tr>
                                    <td class="w-25">Phone</td>
                                    <td>{{ Auth::user()->phone }}</td>
                                </tr>
                                <tr>
                                    <td>Address</td>
                                    <td>{{ Auth::user()->address }}</td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
