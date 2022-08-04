@extends('layouts.app')
@section('title') Category Manager @endsection
@section('content')
    <x-bread-crumb>
        <li class="breadcrumb-item active" aria-current="page">Category Manager</li>
    </x-bread-crumb>
    <div class="row">
        <div class="col-12">
            <div class="">
                <div class="card border-0">
                    <div class="card-body">
                        <div class="">
                            <h4 class="mb-0">
                                <i class="mr-2 feather-layers"></i>
                                Category Manager
                            </h4>
                        </div>
                        <hr>
                        <div class="mb-3">
                            <form action="{{ route('category.store') }}" class="" method="post">
                                @csrf
                                <div class="form-group d-flex align-items-center">
                                    <input type="text" value="{{ old('title') }}" name="title" class="form-control @error('title') is-invalid @enderror form-control-lg w-50 mr-2" required>
                                    <button class="btn btn-primary btn-lg">Add Category</button>
                                </div>
                                @error('title')
                                <span class="text-danger" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </form>

                        </div>
                        @include('category.list')
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
