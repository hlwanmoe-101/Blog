@extends('blog/master')
@section('content')


        <div class="">
            <div class="py-3">

                <div class="small post-category mb-3">
                    <a href="{{route('blog.category',$article->category->id)}}" rel="category tag">{{$article->category->title}}</a>
                </div>

                <h2 class="fw-bolder">{{$article->title}}</h2>
                <div class="my-3 feature-image-box">
                    <div class="d-block d-md-flex justify-content-between align-items-center my-3">

                        <div class="">
                            @if(isset($article->user->photo))
                            <img alt="" src="{{asset('storage/profile/'.$article->user->photo)}}"
                                 class="avatar avatar-30 photo rounded-circle" height="30" width="30" loading="lazy">
                            @else
                                <img alt="" src="{{asset('dashboard/img/user-default-photo.png')}}"
                                     class="avatar avatar-30 photo rounded-circle" height="30" width="30" loading="lazy">
                            @endif
                            <a
                                href="{{route('blog.user',$article->user->id)}}" class="text-decoration-none" title="Visit admin’s website"
                                rel="author external">{{$article->user->name}}
                            </a>
                        </div>

                        <div class="text-primary">
                            <span>
                                <i class="feather-calendar"></i>
                                <a
                                    href="{{route('blog.date',$article->created_at->format("Y-m-d"))}}" class="text-decoration-none" title=""
                                    rel="author external">{{ $article->created_at->format("d-m-Y")}}
                                </a>

                            </span>
                            <span class="small">
                                <i class="feather-clock"></i>
                                {{ $article->created_at->format("h:i A")}}
                            </span>
                        </div>
                    </div>

                    <p style="white-space: pre-line">
                        {{$article->description}}
                    </p>

                    @php

                        $previousArticle=\App\Article::where('id','<',$article->id)->latest("id")->first();
                        $nextArticle=\App\Article::where('id','>',$article->id)->first();


                    @endphp
                    <span>{{ $previousArticle }}</span>
                    <br>
                    <span>{{ $nextArticle }}</span>
                    <div class="nav d-flex justify-content-between p-3">
                        <a href="{{isset($previousArticle) ? route('blog.detail',$previousArticle->id) : "#"}}"
                           class="btn btn-outline-primary page-mover rounded-circle @empty($previousArticle) disabled @endempty">
                            <i class="feather-chevron-left"></i>
                        </a>

                        <a class="btn btn-outline-primary px-3 rounded-pill" href="{{route('index')}}">
                            Read All
                        </a>

                        <a href="{{isset($nextArticle) ? route('blog.detail',$nextArticle->id) : "#"}}"
                           class="btn btn-outline-primary page-mover rounded-circle
                                    @empty($nextArticle) disabled @endempty">
                            <i class="feather-chevron-right"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>

@endsection
