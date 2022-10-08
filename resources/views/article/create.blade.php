@extends('layouts.app')

@section("title") Create Article @endsection

@section('content')

    <x-bread-crumb>
        <li class="breadcrumb-item"><a href="{{ route('article.index') }}">Article List</a></li>
        <li class="breadcrumb-item active" aria-current="page">Create Article</li>
    </x-bread-crumb>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h4>
                        <i class="feather-plus-circle"></i>
                        Create Article
                    </h4>
                    <form action="{{route('article.store')}}" id="createArticle" method="post">
                        @csrf
                    </form>
                </div>
            </div>
        </div>
        <div class="col-12 col-lg-3">
            <div class="card mt-3">
                <div class="card-body">
                    <div class="form-group mb-0">
                       <lable>Select Category</lable>
                        <select name="category" form="createArticle" class="custom-select custom-select-lg @error('category') is-invalid @enderror" id="">
                            <option value="">Select Category</option>
                            @foreach($categories as $category)
                                <option value="{{$category->id}}" {{ old('category') == $category->id ? "selected" : " " }} >{{$category->title}}</option>
                            @endforeach
                        </select>
                        @error("category")
                        <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 col-lg-6">
            <div class="card mt-3">
                <div class="card-body">
                    <div class="form-group mb-0">
                        <div class="form-group">
                            <lable>Article Title</lable>
                            <input type="text" form="createArticle" value="{{old('title')}}" class="form-control form-control-lg @error('title') is-invalid @enderror" name="title">
                            @error("title")
                            <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div><div class="form-group">
                            <lable>Article Description</lable>
                            <textarea type="text" form="createArticle" class="form-control form-control-lg @error('description') is-invalid @enderror" rows="15" name="description">{{old('description')}}</textarea>
                            @error("description")
                            <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 col-lg-3">
            <div class="card mt-3">
                <div class="card-body">
                    <div class="form-group mb-0">
                        <button type="submit" form="createArticle" class="btn btn-primary w-100">Create Article</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

