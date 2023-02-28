@extends('layouts.dashboard')

{{-- Title --}}
@section('title')
{{ config('app.name') }} | User
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
            <li class="breadcrumb-item ">User</li>
            <li class="breadcrumb-item active">Update User</li>
        </ol>
    </div>
@endsection

@section('content')

<div class="row">
    <div class="col-md-10 col-12 m-auto">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Update Permission</h4>
            </div>
            <div class="card-body">
                <form class="form form-vertical" action="{{ route('permission.update',$permission->id) }}" enctype="multipart/form-data" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="row">
                        <div class="col-12">
                            <label for="">Permission Name</label>
                            <input disabled type="text" name="name" value="{{ $permission->name }}" class="form-control">
                        </div>
                        <div class="col-12">
                            <div class="form-group">
                                <label>Role Name<span class="text-danger">*</span></label>
                                <select name="role[]" class="form-control" multiple>
                                    @foreach ($roles as $item)
                                        <option value="{{ $item->id }}" {{ in_array($item->id, $permission_role) ? 'selected' : '' }}>{{ $item->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-12">
                            <button type="submit" class="btn btn-primary mr-1">Update Permission</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
