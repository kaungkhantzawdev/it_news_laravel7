@extends('layouts.app')
@section('title') Articles @endsection
@section('content')
    <x-bread-crumb>
        <li class="breadcrumb-item active" aria-current="page">Articles</li>
    </x-bread-crumb>
    <div class="row">
        <div class="col-12">
            <div class="">
                <div class="card border-0">
                    <div class="card-body">
                        <div class="">
                            <h4 class="mb-0">
                                <i class="mr-2 feather-list"></i>
                                Article list
                            </h4>
                        </div>
                        <hr>
                        <div class="mb-3 d-flex align-items-center justify-content-between">
                            <div class="d-flex align-items-center">
                                <a href="{{ route('article.create') }}" class="btn btn-outline-primary btn-lg">create article</a>
                                @isset(request()->search)
                                    <a href="{{ route('article.index') }}" class="btn btn-outline-primary btn-lg ml-2">articles list</a>
                                    <h5 class="mb-0 ml-2">search by : " {{ request()->search }} "</h5>
                                @endisset
                            </div>
                            <form action="{{ route('article.index') }}" method="get">
                                <div class="form-group d-flex align-items-center">
                                    <input type="text" value="{{ request()->search }}" name="search" class="form-control form-control-lg mr-2" required>
                                    <button class="btn btn-primary btn-lg"><i class="feather-search"></i></button>
                                </div>
                            </form>
                        </div>
                        <div class="">
                            <table class="table mb-0 table-hover table-bordered">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Article</th>
                                    <th>Category</th>
                                    <th>Owner</th>
                                    <th>Control</th>
                                    <th>Created at</th>
                                    <th>Updated at</th>
                                </tr>
                                </thead>
                                <tbody>
                                @forelse($articles as $article)
                                    <tr>
                                        <td>{{ $article->id }}</td>
                                        <td>
                                            <span class="font-weight-bold">{{ Str::words($article->title,5) }}</span>
                                            <br>
                                            <small class="text-black-50">{{ Str::words($article->description,10) }}</small>
                                        </td>
                                        <td>{{ $article->getCategory->title }}</td>
                                        <td>{{ $article->getUser->name }}</td>
                                        <td class="text-nowrap">
                                            <a href="{{ route('article.show',$article->id) }}" class="btn btn-sm btn-primary">show</a>
                                            <a href="{{ route('article.edit',$article->id) }}" class="btn btn-sm btn-warning">edit</a>
                                            <form action="{{ route('article.destroy', [$article->id,'page'=>request()->page]) }}" class="d-inline-block" id="articleForm{{ $article->id }}" method="post">
                                                @csrf
                                                @method('delete')
                                                <button type="button" class="btn btn-sm btn-danger" onclick="return showAlert({{ $article->id }})">delete</button>
                                            </form>
                                        </td>
                                        <td>
                                            <small>
                                                <i class="feather-calendar"></i>
                                                {{ $article->created_at->format('d M Y') }}
                                            </small>
                                            <br>
                                            <small>
                                                <i class="feather-clock"></i>
                                                {{ $article->created_at->format('h:i A') }}
                                            </small>
                                        </td>
                                        <td>
                                            <small>
                                                <i class="feather-calendar"></i>
                                                {{ $article->updated_at->format('d M Y') }}
                                            </small>
                                            <br>
                                            <small>
                                                <i class="feather-clock"></i>
                                                {{ $article->updated_at->format('h:i A') }}
                                            </small>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="7" class="text-center">There is no article!</td>
                                    </tr>
                                @endforelse
                                </tbody>
                            </table>
                            <div class="mt-3 d-flex align-items-center justify-content-between">
                                {{ $articles->appends(Request::all())->links() }}
                                <h5 class="mb-0">Total : {{ $articles->total() }}</h5>
                            </div>
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
