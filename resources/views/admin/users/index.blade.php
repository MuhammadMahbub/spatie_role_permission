@extends('layouts.dashboard')

{{-- Title --}}
@section('title')
    {{ config('app.name') }} | users
@endsection

{{-- Active Menu --}}
@section('users')
    active
@endsection


{{-- Breadcrumb --}}
@section('breadcrumb')
     <h2 class="content-header-title float-left mb-0">Admin Dashboard</h2>
    <div class="breadcrumb-wrapper">
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="{{ route('dashboard') }}">Home</a>
            </li>
            <li class="breadcrumb-item active">
                Users
            </li>
        </ol>
    </div>
@endsection

{{-- Main Content --}}
@section('content')
<div class="row" id="basic-table">
    <div class="col-md-10 col-12 m-auto">
        <div class="card">
            <div class="card-header">
                <span class="card-title"><a href="{{ route('role.create') }}">Users List</a></span>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="data_table">
                        <thead>
                            <tr>
                                <th>Sl</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($users as $user)
                            <tr>
                                <td>{{ $loop->index + 1 }}</td>
                                <td>{{ $user->name }}</span></td>
                                <td>{{ $user->email }}</span></td>
                                <td>
                                    <div class="dropdown">
                                        <button type="button" class="btn btn-sm dropdown-toggle hide-arrow" data-toggle="dropdown">
                                            <i data-feather="more-vertical"></i>
                                        </button>
                                        <div class="dropdown-menu">
                                            <a class="dropdown-item" href="{{ route('user_role_assign', $user->id) }}">
                                                <i data-feather="key" class="mr-50"></i>
                                                <span>Assign Role</span>
                                            </a>
                                            <a class="dropdown-item" href="{{ route('user_permission_assign', $user->id) }}">
                                                <i data-feather="key" class="mr-50"></i>
                                                <span>Assign Permission</span>
                                            </a>
                                            <a class="dropdown-item" href="{{ route('users.edit', $user->id) }}">
                                                <i data-feather="edit" class="mr-50"></i>
                                                <span>Edit</span>
                                            </a>
                                            <a onClick="return confirm('Delete This User?')" class="dropdown-item" href="{{ route('users.destroy', $user->id) }}">
                                                <i data-feather="trash" class="mr-50"></i>
                                                <span>Delete</span>
                                            </a>

                                        </div>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection
