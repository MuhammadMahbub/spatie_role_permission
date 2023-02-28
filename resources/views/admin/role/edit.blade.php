@extends('layouts.dashboard')

{{-- Title --}}
@section('title')
{{ config('app.name') }} | Role
@endsection

{{-- Active Menu --}}
@section('role')
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
            <li class="breadcrumb-item ">Role</li>
            <li class="breadcrumb-item active">Update Role</li>
        </ol>
    </div>
@endsection

@section('content')

<div class="row">
    <div class="col-md-10 col-12 m-auto">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Update Role</h4>
            </div>
            <div class="card-body">
                <form class="form form-vertical" action="{{ route('role.update',$role->id) }}" enctype="multipart/form-data" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="row">
                        <div class="col-12">
                            <label for="">Role Name</label>
                            <input type="text" name="name" value="{{ $role->name }}" class="form-control">
                        </div>
                        <div class="col-12">
                            <div class="form-group">
                                <label>Permissions Name<span class="text-danger">*</span></label>
                                <select name="permission[]" id="permission_assign" class="form-control" multiple="multiple" class="form-select mt-1" style="width: 100%" aria-label="Default select example">
                                    @foreach ($permissions as $item)
                                        <option value="{{ $item->id }}" {{ in_array($item->id, $role_permissions) ? 'selected' : '' }}>{{ $item->name }}</option>
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

@section('js')
<script>
    $(document).ready(function() {
        $('#permission_assign').select2({theme: "classic"});
    });
</script>
@endsection
