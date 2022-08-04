@extends('layouts.app')
@section('title') User Manager @endsection
@section('content')
    <x-bread-crumb>
        <li class="breadcrumb-item active" aria-current="page">user manager</li>
    </x-bread-crumb>
    <div class="row">
        <div class="col-12">
            <div class="">
                <div class="card border-0">
                    <div class="card-body">
                        <h4 class="mb-3">
                            <i class="feather-users mr-2"></i>
                            User List
                        </h4>
                        <table class="table table-bordered mb-0">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Role</th>
                                <th>Control</th>
                                <th>Created at</th>
                                <th>Updated at</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($users as $user)
                                <tr>
                                    <td>{{ $user->id }}</td>
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>{{ $user->role }}</td>
                                    <td class="text-nowrap">
                                        @if($user->role != 0)
                                            <form action="{{ route('user-manager.makeAdmin') }}" class="d-inline-block" id="form{{ $user->id }}" method="post">
                                                @csrf
                                                <input type="hidden" class="" name="id" value="{{ $user->id }}">
                                                <button type="button" class="btn btn-sm btn-outline-primary" onclick="return showAlert({{ $user->id }})">make admin</button>
                                            </form>
                                            <button class="btn btn-sm btn-outline-warning" onclick="changePassword({{ $user->id }},'{{ $user->name }}')">change password</button>
                                            @if($user->isBaned == 0)
                                                <form action="{{ route('user-manager.banUser') }}" class="d-inline-block" id="banForm{{ $user->id }}" method="post">
                                                    @csrf
                                                    <input type="hidden" class="" name="id" value="{{ $user->id }}">
                                                    <button type="button" class="btn btn-sm btn-outline-danger" onclick="return banUser({{ $user->id }})">banned</button>
                                                </form>
                                            @else
                                                <span>banned</span>
                                                <form action="{{ route('user-manager.unBanUser') }}" class="d-inline-block" id="unBanForm{{ $user->id }}" method="post">
                                                    @csrf
                                                    <input type="hidden" class="" name="id" value="{{ $user->id }}">
                                                    <button type="button" class="btn btn-sm btn-outline-success" onclick="return unBanUser({{ $user->id }})">restore</button>
                                                </form>
                                            @endif
                                        @else
                                            <span>admin</span>
                                        @endif
                                    </td>
                                    <td>
                                        <i class="feather-calendar"></i>
                                        <span>
                                            {{ $user->created_at->format("d M Y") }}
                                        </span>
                                        <br>
                                        <i class="feather-clock"></i>
                                        <span>
                                            {{ $user->created_at->format("h:i a") }}
                                        </span>
                                    </td>
                                    <td>
                                        <i class="feather-calendar"></i>
                                        <span>
                                            {{ $user->updated_at->format("d M Y") }}
                                        </span>
                                        <br>
                                        <i class="feather-clock"></i>
                                        <span>
                                            {{ $user->updated_at->format("h:i a") }}
                                        </span>
                                    </td>

                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        <div class="mt-3">
                            {{ $users->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('foot')
    <script>
        function showAlert(id) {
            Swal.fire({
                title: 'Are you sure <br> to upgrade role?',
                text: "role ချိန်လိုက်ရင် admin လုပ်ပိုင်ခွင့်များကို ရရှိမှာဖြစ်ပါတယ်။",
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Confirm'
            }).then((result) => {
                if (result.isConfirmed) {
                    Swal.fire(
                        'Role Updated',
                        'အကောင့်မြှင်တင်ချင်း အောင်မြင်ပါသည်။',
                        'success'
                    );
                    setTimeout(function () {
                        $("#form"+id).submit();
                    }, 1500)
                }
            })
        }

        function banUser(id) {
            Swal.fire({
                title: 'Are you sure <br> to ban this user?',
                text: "Banned User",
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Confirm'
            }).then((result) => {
                if (result.isConfirmed) {
                    Swal.fire(
                        'Success Banned',
                        'Banned user',
                        'success'
                    );
                    setTimeout(function () {
                        $("#banForm"+id).submit();
                    }, 1500)
                }
            })
        }

        function unBanUser(id) {
            Swal.fire({
                title: 'Are you sure <br> to restore this user?',
                text: "Restored User",
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Confirm'
            }).then((result) => {
                if (result.isConfirmed) {
                    Swal.fire(
                        'Success restore this user',
                        'normal user',
                        'success'
                    );
                    setTimeout(function () {
                        $("#unBanForm"+id).submit();
                    }, 1500)
                }
            })
        }

        let url = "{{ route('user-manager.changePassword') }}";
        function changePassword(id,name) {
            Swal.fire({
                title: 'Change Password for '+name,
                input: 'password',
                inputAttributes: {
                    autocapitalize: 'off',
                    required: "required",
                    minLength: 8
                },
                showCancelButton: true,
                confirmButtonText: 'change',
                showLoaderOnConfirm: true,
                preConfirm: function (newPassword) {
                    // console.log(id, newPassword)
                    $.post(url, {
                        id: id,
                        password: newPassword,
                        _token: "{{ csrf_token() }}"
                    }).done(function (data) {
                        if(data.status == 200){
                            Swal.fire({
                                icon: "success",
                                title: "Changed password",
                                text: data.message,
                            })
                        }else if(data.status == 422){
                            console.log(data)
                            Swal.fire({
                                icon:"error",
                                title:"Try again",
                                text: data.message.password[0]
                            });
                        }
                    })
                }
            })
        }

    </script>
@endsection
