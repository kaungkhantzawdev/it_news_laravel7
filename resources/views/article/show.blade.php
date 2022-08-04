@extends('layouts.app')
@section('title') Article Detail  @endsection
@section('head')
    <style>
        .description{
            white-space: pre-line;
        }
    </style>
@endsection
@section('content')
    <x-bread-crumb>
        <li class="breadcrumb-item"><a href="{{ route('article.index') }}">Articles</a></li>
        <li class="breadcrumb-item active" aria-current="page">Article Detail</li>
    </x-bread-crumb>
    <div class="row">
        <div class="col-12 col-lg-8">
            <div class="">
                <div class="card border-0">
                    <div class="card-body">
                        <div class="">
                            <h4 class="mb-0">
                                {{ $article->title }}
                            </h4>
                            <div class="mt-3">
                                <small class="mr-2">
                                    <i class="feather-user"></i>
                                    {{ $article->getUser->name }}
                                </small>
                                <small class="mr-2">
                                    <i class="feather-calendar"></i>
                                    {{ $article->created_at->format('d M Y') }}
                                </small>
                                <small class="mr-2">
                                    <i class="feather-clock"></i>
                                    {{ $article->created_at->format('h:i A') }}
                                </small>
                            </div>
                        </div>
                        <div class="">
                            <p class="description text-black-50">
                                {{ $article->description }}
                            </p>
                        </div>
                        <hr>
                       <div class="d-flex align-items-center justify-content-between">
                           <div class="">
                               <a href="{{ route('article.index') }}" class="btn btn-primary btn-sm">articles list</a>
                               <a href="{{ route('article.edit',$article->id) }}" class="btn btn-sm btn-warning">edit</a>
                               <form action="{{ route('article.destroy', $article->id) }}" class="d-inline-block" id="articleForm{{ $article->id }}" method="post">
                                   @csrf
                                   @method('delete')
                                   <button type="button" class="btn btn-sm btn-danger" onclick="return showAlert({{ $article->id }})">delete</button>
                               </form>
                           </div>
                           <p class="mb-0">
                               {{ $article->created_at->diffForHumans() }}
                           </p>
                       </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('foot')
    <script>
        function showAlert(id) {
            Swal.fire({
                title: 'Are you sure <br> to delete this category?',
                text: "Really Sure",
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Confirm'
            }).then((result) => {
                if (result.isConfirmed) {
                    Swal.fire(
                        'Deleted',
                        'This Category is deleted',
                        'success'
                    );
                    setTimeout(function () {
                        $("#articleForm"+id).submit();
                    }, 1500)
                }
            })
        }
    </script>
@endsection
