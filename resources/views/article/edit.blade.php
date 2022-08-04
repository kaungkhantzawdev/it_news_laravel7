@extends('layouts.app')
@section('title') Edit Article  @endsection
@section('content')
    <x-bread-crumb>
        <li class="breadcrumb-item"><a href="{{ route('article.index') }}">Articles</a></li>
        <li class="breadcrumb-item active" aria-current="page">Edit Article</li>
    </x-bread-crumb>
    <div class="row">
        <div class="col-12">
            <div class="">
                <div class="card border-0">
                    <div class="card-body">
                        <div class="">
                            <h4 class="mb-0">
                                <i class="mr-2 feather-plus-circle"></i>
                                Edit Article
                            </h4>
                        </div>
                        <hr>
                        <form action="{{ route('article.update',$article->id) }}" id="createArticle" class="" method="post">
                            @csrf
                            @method('put')
                        </form>
                        <div class="row">
                            <div class="col-12 col-lg-3">
                                <div class="card border-0">
                                    <div class="card-body">
                                        <div class="form-group">
                                            <label>Categories</label>
                                            <select form="createArticle" name="category" id="" class="custom-select-lg @error('category') is-invalid @enderror custom-select">
                                                <option value="">select category</option>
                                                @foreach($categories as $category)
                                                    <option value="{{ old('category',$category->id) }}" {{ old('category',$article->getCategory->id) == $category->id ? 'selected':'' }}>{{ $category->title }}</option>
                                                    <input type="hidden" class="" name="slug" value="{{ old('slug',$category->slug) }}">
                                                @endforeach
                                            </select>
                                            @error('category')
                                            <span class="text-danger" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-lg-6">
                                <div class="card border-0">
                                    <div class="card-body">
                                        <div class="form-group">
                                            <label>Article Title</label>
                                            <input form="createArticle" type="text" value="{{ old('title',$article->title) }}" class="form-control @error('title') is-invalid @enderror form-control-lg" name="title">
                                            @error('title')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label>Article Description</label>
                                            <textarea form="createArticle" rows="15"  value="{{ old('description',$article->description) }}" class="form-control @error('description') is-invalid @enderror form-control-lg" name="description">{{ $article->description }}</textarea>
                                            @error('description')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-lg-3">
                                <div class="card border-0">
                                    <div class="card-body">
                                        <button type="submit" form="createArticle" class="btn btn-primary btn-lg w-100">update article</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
