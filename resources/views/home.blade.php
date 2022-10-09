@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <i class="fas fa-home"></i>
                    {{ __('You are logged in!') }}
                    <button class="test btn btn-primary">test</button>
                        <br>
                        <br>
                        <br>
                        <button class="btn btn-primary alertSwal">Alert</button>
                        <button class="btn btn-primary test-toast">Toast</button>

                        <br>
                        <br>
                        <br>
                    {{ Request::url() }}
                        <br>
                        <br>
                        <br>
                        <br>
                    {{\App\Base::$name}}
                        <br>
                        <br>
                        <br>
                        <br>
                    {{date('d m y i h')}}
                        <br>
                        <br>
                        <br>
                        <br>
                        <br>
                    {{$categories}}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('foot')
    <script>
        $(".test").click(function (){
            alert("hello");
        })
        $(".alertSwal").click(function () {
            Swal.fire({
                icon: 'success',
                title: 'Oops...',
                text: 'Something went wrong!',

            })
        })

        $(".test-toast").click(function () {
            const Toast = Swal.mixin({
                toast: true,
                position: 'bottom-end',
                showConfirmButton: false,
                timer: 5000,
                timerProgressBar: true,
                didOpen: (toast) => {
                    toast.addEventListener('mouseenter', Swal.stopTimer)
                    toast.addEventListener('mouseleave', Swal.resumeTimer)
                }
            })

            Toast.fire({
                icon: 'success',
                title: 'Signed in successfully'
            })
        })


    </script>
@endsection
