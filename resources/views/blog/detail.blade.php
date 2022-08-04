@extends('blog.master')
@section('content')
    <div class="py-3">
        <div class="small post-category mb-3">
            <a href="{{ route('baseOnCategory', $article->getCategory->id) }}" rel="category tag">{{ $article->getCategory->title }}</a>
        </div>

        <h2 class="fw-bolder">{{ $article->title }}</h2>
        <div class="my-3 feature-image-box">
            <div class="d-block d-md-flex justify-content-between align-items-center my-3">
                <div class="">
                    <img alt="" src="{{isset($article->getUser->photo)? asset('storage/profile/'.$article->getUser->photo): asset('dashboard/img/user.png')}}"
                         class="avatar avatar-50 rounded-circle" style="object-fit: cover !important; object-position: center !important; width: 50px; height: 50px">
                    <a href="{{ route('baseOnUser', $article->getUser->id) }}}" title="show user's posts" class="text-decoration-none">
                        {{ $article->getUser->name }}
                    </a>
                </div>

                <a href="{{ route('baseOnDate',$article->created_at->format('Y-m-d')) }}" class="text-primary text-decoration-none">
                    <i class="feather-calendar"></i>
                    {{$article->created_at->format('d F Y')}} {{ $article->created_at->diffForHumans() }}
                </a>
            </div>

            <p>{{ $article->description }}</p>

            @php
                $previousArticle = \App\Article::where('id','<',$article->id)->with(['getUser','getCategory'])->latest('id')->first();
                $nextArticle = \App\Article::where('id','>',$article->id)->with(['getUser','getCategory'])->first();
            @endphp

            <div class="nav d-flex justify-content-between p-3">
                <a href="{{ isset($previousArticle->id)? $previousArticle->id : '#' }}"
                   class="btn btn-outline-primary page-mover rounded-circle">
                    <i class="feather-chevron-left"></i>
                </a>

                <a class="btn btn-outline-primary px-3 rounded-pill" href="{{ route('index') }}">
                    Read All
                </a>

                <a href="{{ isset($nextArticle->id)? $nextArticle->id : '#' }}"
                   class="btn btn-outline-primary page-mover rounded-circle @empty($nextArticle->id) disabled @endempty">
                    <i class="feather-chevron-right"></i>
                </a>
            </div>
        </div>
    </div>
@endsection

