@extends('layouts.app')

@section("title") Sample @endsection

@section('content')

    <x-bread-crumb>
        <li class="breadcrumb-item"><a href="{{ route('profile') }}">Sample</a></li>
        <li class="breadcrumb-item active" aria-current="page">Sample</li>
    </x-bread-crumb>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h4>
                        <i></i>
                        Create
                    </h4>
                    <hr>
                    <p>pppp</p>
                </div>
            </div>
        </div>
    </div>
@endsection

