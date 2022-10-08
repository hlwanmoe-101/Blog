@extends('layouts.app')

@section("title") Article List @endsection

@section('content')

    <x-bread-crumb>
        <li class="breadcrumb-item active" aria-current="page">List</li>
    </x-bread-crumb>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h4>
                        <i class="feather-list"></i>
                        Article List
                    </h4>
                    <hr>
                    <div class="d-flex justify-content-between">
                        <div>
                            <a href="{{route('article.create')}}" class="btn btn-lg btn-outline-primary mr-3">
                                <i class="feather-plus-circle"></i>
                                Create Article
                            </a>
                            @isset(request()->search)
                                <a href="{{route('article.index')}}" class="btn btn-outline-dark">
                                    <i class="feather-list"></i>
                                    Article List
                                </a>
                                <span class="h5">Search By : "{{ request()->search }}"</span>
                            @endisset
                        </div>
                        <form action="{{route('article.index')}}" class="mb-3" method="get">
                            <div class="form-inline">
                                <input type="text" name="search" placeholder="Search Article" value="{{ request()->search }}" class="form-control form-control-lg mr-2" required>
                                <button class="btn btn-primary btn-lg">
                                    <i class="feather-search"></i>
                                    Search
                                </button>
                            </div>

                        </form>
                    </div>
                    @if(session('message'))
                        <p class="alert alert-success">{{ session('message') }}</p>
                    @endif
                    <table class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Article</th>
                                <th>Category</th>
                                <th>Owner</th>
                                <th>Controls</th>
                                <th>Created At</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($articles as $article)
                            <tr>
                                <td>{{$article->id}}</td>
                                <td>
                                    <span class="font-weight-bold">{{$article->title}}</span>
                                    <br>
                                    <small class="text-black-50">{{ \Illuminate\Support\Str::words($article->description,10) }}</small>

                                </td>
                                <td>{{$article->category->title}}</td>
                                <td>{{$article->user->name}}</td>
                                <td class="text-nowrap">
                                    <a href="{{route('article.show',$article->id)}}" class="btn btn-outline-success">Show</a>
                                    <a href="{{route('article.edit',$article->id)}}" class="btn btn-outline-primary">Edit</a>
                                    <form action="{{route('article.destroy',[$article->id,"page"=>request()->page])}}" class="d-inline-block" method="post">
                                        @csrf
                                        @method('delete')
                                        <button class="btn btn-outline-danger" onclick="return confirm(`R U sure to delete '{{$article->title}}' article?`)">Delete</button>
                                    </form>
                                </td>
                                <td class="text-nowrap">
                                    <span class="small">
                                        <i class="feather-calendar"></i>
                                        {{ $article->created_at->format("d-m-Y")}}
                                    </span>
                                    <br>
                                    <span class="small">
                                        <i class="feather-clock"></i>
                                        {{ $article->created_at->format("h:i A")}}
                                    </span>
                                </td>

                            </tr>
                                @empty
                                <tr>
                                    <td colspan="6" class="text-center">There is no record</td>
                                </tr>
                                @endforelse
                        </tbody>
                    </table>
                    <div class="d-flex justify-content-between">
                        {{$articles->appends(request()->all())->links()}}
                        <h4 class="font-weight-bold mb-0">Total : {{$articles->total()}}</h4>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

