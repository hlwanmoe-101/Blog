@extends('layouts.app')

@section("title") Article Detail @endsection

@section('head')
    <style>
        .description{
            white-space: pre-line;
        }
    </style>
    @endsection

@section('content')

    <x-bread-crumb>
        <li class="breadcrumb-item"><a href="{{ route('article.index') }}">Article List</a></li>
        <li class="breadcrumb-item active" aria-current="page">Article Detail</li>
    </x-bread-crumb>

    <div class="row">
        <div class="col-12 col-lg-6">
            <div class="card">
                <div class="card-body">
                    <h4 class="font-weight-bold">{{$article->title}}</h4>
                    <div class="mt-2 mb-4 text-primary">
                        <span class="small font-weight-bold mr-2">
                            <i class="feather-layers"></i>
                            {{$article->category->title}}
                        </span>
                        <span class="small font-weight-bold mr-2">
                            <i class="feather-user"></i>
                            {{$article->user->name}}
                        </span>
                        <span class="small font-weight-bold mr-2">
                            <i class="feather-calendar"></i>
                            {{ $article->created_at->format("d-m-Y")}}
                        </span>
                        <span class="small font-weight-bold mr-2">
                            <i class="feather-clock"></i>
                            {{$article->created_at->format("h:i A")}}
                        </span>
                    </div>
                    <p class="text-justify text-black-50 description">{{$article->description}}</p>
                    <hr>
                    <div class="d-flex justify-content-between">
                        <div>
                            <a href="{{ route('article.edit',$article->id) }}" class="btn btn-outline-primary">Edit</a>
                            <a href="{{ route('article.index') }}" class="btn btn-outline-dark">All Article</a>
{{--                            <form action="{{route('article.destroy',$article->id)}}" class="d-inline-block" method="post">--}}
{{--                                @csrf--}}
{{--                                @method('delete')--}}
{{--                                <button class="btn btn-outline-danger" onclick="return confirm(`R U sure to delete '{{$article->title}}' article?`)">Delete</button>--}}
{{--                            </form>--}}
                        </div>
                        <p>{{$article->created_at->diffForHumans()}}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

