@extends('blog/master')
@section('content')

    @forelse($articles as $article)


                <div class="">
                    <div class="py-3">
                        <div class="small post-category mb-3">
                            <a href="{{route('blog.category',$article->category->id)}}" rel="category tag">{{$article->category->title}}</a>
                        </div>

                        <a class="fw-bold h4 d-block text-decoration-none"
                           href="{{route('blog.detail',$article->id)}}">
                            {{$article->title}} </a>
                        <div class="my-3 feature-image-box">

                                <img width="1024" height="682" src="{{asset('dashboard/img/user-default-photo.png')}}">


                            <div class="d-block d-md-flex justify-content-between align-items-center my-3">

                                <div class="">
                                    @if(isset($article->user->photo))
                                        <img alt="" src="{{asset('storage/profile/'.$article->user->photo)}}"
                                             class="avatar avatar-30 photo rounded-circle" height="30" width="30" loading="lazy">
                                    @else
                                    <img alt="" src="{{asset('dashboard/img/user-default-photo.png')}}"
                                         class="avatar avatar-30 photo rounded-circle" height="30" width="30" loading="lazy">
                                    @endif
                                    <span>
                                        <i class="feather-user"></i>
                                        {{$article->user->name}}
                                    </span>
                                </div>

                                <div class="">
                                    <span>
                                    <i class="feather-calendar"></i>
                                    {{ $article->created_at->format("d-F-Y")}}
                                    </span>
                                    <span class="small">
                                        <i class="feather-clock"></i>
                                        {{ $article->created_at->format("h:i A")}}
                                    </span>

                                </div>
                            </div>

                            <p>
                                {{ \Illuminate\Support\Str::words($article->description,50) }}
                            </p>


                            <div class="nav d-flex justify-content-end  p-3">
                                <a class="btn btn-outline-primary px-3 rounded-pill" href="{{route('blog.detail',$article->slug)}}">
                                    Read More
                                </a>
                            </div>
                        </div>


                    </div>

                    <div class="d-block d-lg-none d-flex justify-content-center">
                    </div>

                </div>





    @empty
        <div class="col-12 col-lg-6">

            <div class="mb-4 pb-4">
                <div class="py-5 my-5 text-center text-lg-start">
                    <p class="fw-bold text-primary">Dear Viewer</p>
                    <h1 class="fw-bold">
                        There is no article 😔 ...
                    </h1>
                    <p>Please go back to Home Page</p>
                    <a class="btn btn-outline-primary rounded-pill px-3" href="{{route('index')}}">
                        <i class="feather-home"></i>
                        Blog Home
                    </a>

                </div>
            </div>
        </div>

    @endforelse
    <div class="d-block d-lg-none" id="pagination">
        <div class="pagination justify-content-center">
            <ul class="pagination">
                {{$articles->onEachSide(1)->links() }}
            </ul>
        </div>
    </div>

@endsection

@section('paginate-plan')

    <div class="d-none d-lg-block" id="pagination">
        <div class="pagination">
            <ul class="pagination">
                {{$articles->onEachSide(1)->links() }}
            </ul>
        </div>
    </div>

    @endsection
