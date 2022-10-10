@extends('layouts.app')

@section("title") User Manager @endsection

@section('content')

    <x-bread-crumb>
{{--        <li class="breadcrumb-item"><a href="{{ route('profile') }}">Sample</a></li>--}}
        <li class="breadcrumb-item active" aria-current="page">User Manager</li>
    </x-bread-crumb>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h4>
                        <i class="feather-users"></i>
                        Users
                    </h4>
                    <hr>
                    <table class="table table-hover table-bordered">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Role</th>
                                <th>Control</th>
                                <th>Created At</th>
                            </tr>
                        </thead>
                        <tbody>
                           @foreach($users as $user)
                               <tr>
                                   <td>{{$user->id}}</td>
                                   <td>{{$user->name}}</td>
                                   <td>{{$user->email}}</td>
                                   <td>{{$user->role == 0 ? "Admin" : "User"}}</td>
                                   <td>
                                       @if($user->role == 1)
                                           <form class="d-inline-block" action="{{route('user-manager.makeAdmin')}}" id="form{{$user->id}}" method="post">
                                               @csrf
                                               <input type="hidden" name="id" value="{{$user->id}}">
                                               <button type="button" class="btn btn-sm btn-outline-primary" onclick="return askConfirm({{$user->id}})">Make Admin</button>
                                           </form>
                                            <button type="button" onclick="changePassword({{$user->id}},'{{$user->name}}')" class="btn btn-sm btn-outline-warning" >Change Password</button>
                                            @if($user->isBaned != 1)
                                                   <form class="d-inline-block" action="{{route('user-manager.baned')}}" id="banForm{{$user->id}}" method="post">
                                                       @csrf
                                                       <input type="hidden" name="id" value="{{$user->id}}">
                                                       <button type="button" class="btn btn-sm btn-outline-danger" onclick="return isBaned({{$user->id}})">Ban</button>
                                                   </form>
                                           @endif
                                       @endif
                                   </td>
                                   <td>
                                       <i class="feather-calendar"></i>
                                       {{$user->created_at->format("d-m-Y")}}
                                       <br>
                                       <i class="feather-clock"></i>
                                       {{$user->created_at->format("h:i A")}}

                                   </td>
                               </tr>
                               @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
@section("foot")
    <script>
        function askConfirm(id){
            Swal.fire({
                title: 'Are you sure to make Admin for this user?',
                text: "You won't be able to revert this!",
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Confirm!'
            }).then((result) => {
                if (result.isConfirmed) {
                    Swal.fire(
                        'Changed!',
                        'User role is now Admin.',
                        'success'
                    )
                }
                setInterval(function () {
                    $("#form"+id).submit();
                },1000)
            })
        }
        function isBaned(id){
            Swal.fire({
                title: 'Are you sure to ban this user?',
                text: "You won't be able to revert this!",
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Confirm!'
            }).then((result) => {
                if (result.isConfirmed) {
                    Swal.fire(
                        'Baned!',
                        'User is baned.',
                        'success'
                    )
                }
                setInterval(function () {
                    $("#banForm"+id).submit();
                },1000)
            })
        }
        function changePassword(id,name) {
            let url="{{route('user-manager.changePassword')}}"
            Swal.fire({
                title: 'Password change for '+name,
                input: 'password',
                inputAttributes: {
                    autocapitalize: 'off',
                    // required : 'required',
                    // minLength : 8
                },
                showCancelButton: true,
                confirmButtonText: 'Change',
                showLoaderOnConfirm: true,
                preConfirm :function (newpassword) {
                    console.log(id,newpassword);
                    $.post(url,{
                        id: id,
                        newpassword : newpassword,
                        _token : "{{csrf_token()}}",
                    }).done(function (data) {
                        if(data.status==200){
                            Swal.fire({
                                icon:"success",
                                title:"Complete Password Change",
                                text: data.message
                            })


                        }else{
                            console.log(data);
                            Swal.fire({
                                icon: "error",
                                title: "Can't Change Password",
                                text: data.message.newpassword[0]
                            })

                        }
                    })
                }
            })
        }
    </script>
    @endsection

