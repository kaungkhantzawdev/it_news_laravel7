@extends('blog.master')
@section('content')
    <div class="">
        @forelse($articles as $article)
        <div class="border-bottom mb-4 pb-4 article-preview">
            <div class="p-0 p-md-3">
                <a class="fw-bold h4 d-block text-decoration-none"
                   href="{{ route('detail', $article->id) }}">
                    {{Str::words($article->title,10)}}
                </a>

                <div class="small post-category">
                    <a href="{{ route('baseOnCategory', $article->slug_category) }}" rel="category tag">{{ $article->slug_category }}</a>
                </div>

                <div class="text-black-50 the-excerpt">
                    <p style="white-space: pre-line">
                        {{ $article->excerpt }}
                    </p>
                </div>

                <div class="d-flex justify-content-between align-items-center see-more-group">
                    <div class="d-flex align-items-center">
                        <img alt="" src="{{isset($article->getUser->photo)? asset('storage/profile/'.$article->getUser->photo): asset('dashboard/img/user.png')}}"
                             class="avatar avatar-50 rounded-circle" style="object-fit: cover !important; object-position: center !important; width: 50px; height: 50px">
                        <div class="ms-2">
                            <span class="small">
                                <i class="feather-user"></i>
                                {{ $article->getUser->name }}
                            </span>
                            <br>
                            <span class="small">{{ $article->created_at->format('d F Y') }}</span>
                        </div>
                    </div>
                    <a href="{{ route('detail', $article->slug) }}" class="btn btn-outline-primary rounded-pill px-3">Read More</a>
                </div>
            </div>
        </div>
        @empty
            <div class="mb-4 pb-4">
                <div class="py-5 my-5 text-center text-lg-start">
                    <p class="fw-bold text-primary">Dear Viewer</p>
                    <h1 class="fw-bold">
                        There is no article 😔 ...
                    </h1>
                    <p>Please go back to Home Page</p>
                    <a class="btn btn-outline-primary rounded-pill px-3" href="{{ route('index') }}">
                        <i class="feather-home"></i>
                        Blog Home
                    </a>

                </div>
            </div>
        @endforelse
    </div>

    <div class="d-block d-lg-none text-center" id="pagination">
        {{ $articles->onEachSide(1)->appends(Request::all())->links() }}
    </div>
@endsection
@section('pagination')
    <div class="d-none d-lg-block" id="pagination">
        {{ $articles->onEachSide(1)->appends(Request::all())->links() }}
    </div>
@endsection
