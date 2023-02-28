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
            <li class="breadcrumb-item active">
                Role
            </li>
        </ol>
    </div>
@endsection

@section('content')
<section id="basic-vertical-layouts">
    <div class="row">
        <div class="col-md-10 col-12 m-auto">
            <div class="card">
                <div class="card-header">
                    <span class="card-title">Assign Permission</span>
                </div>
                <div class="card-body">
                    <form action="{{ route('role_permission') }}" method="POST" class="form form-vertical">
                        @csrf
                        <div class="row">
                            <div class="col-12">
                                <h3>{{ $role->name }}</h3>
                                <input type="hidden" name="role" value="{{ $role->id }}">
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <label>Permission</label>
                                    <select name="permission[]" class="form-control" multiple>
                                        @foreach ($permissions as $item)
                                            <option value="{{ $item->id }}">{{ $item->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-12">
                                <button type="submit" class="btn btn-primary mr-1">Submit</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
