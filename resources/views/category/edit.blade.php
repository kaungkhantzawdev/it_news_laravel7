@extends('layouts.app')
@section('title') Category Manager @endsection
@section('content')
    <x-bread-crumb>
        <li class="breadcrumb-item"><a href="{{ route('category.index') }}">Category Manager</a></li>
        <li class="breadcrumb-item active" aria-current="page">Edit Category</li>
    </x-bread-crumb>
    <div class="row">
        <div class="col-12">
            <div class="">
                <div class="card border-0">
                    <div class="card-body">
                        <div class="">
                            <h4 class="mb-0">
                                <i class="mr-2 feather-layers"></i>
                                Edit Category
                            </h4>
                        </div>
                        <hr>
                        <div class="mb-3">
                            <form action="{{ route('category.update', $category->id) }}" class="" method="post">
                                @csrf
                                @method('put')
                                <div class="form-group d-flex align-items-center">
                                    <input type="text" value="{{ old('title', $category->title) }}" name="title" class="form-control @error('title') is-invalid @enderror form-control-lg w-50 mr-2" required>
                                    <button class="btn btn-primary btn-lg">Update</button>
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
