@extends('layouts.dashboard')

{{-- Title --}}
@section('title')
    {{ config('app.name') }} | General Settings
@endsection

{{-- Active Menu --}}
@section('generalSettings')
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
                Gerneral Settings
            </li>
        </ol>
    </div>
@endsection

{{-- Page Content --}}
@section('content')
    <section id="basic-vertical-layouts">
        <div class="row">
            <div class="col-md-7 col-12 m-auto">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">General Settings</h4>
                        @if (session('success'))
                        <div class="alert alert-success">{{ session('success') }}</div>
                        @endif
                        @if (session('warning'))
                            <div class="alert alert-warning">{{ session('warning') }}</div>
                        @endif
                    </div>
                    <div class="card-body">
                        <form action="{{ route('generalSettings.update', $generalSettings->id) }}" method="POST" class="form form-vertical" enctype="multipart/form-data">
                            @csrf
                            {{ method_field('PUT') }}
                            <div class="row">
                                <div class="col-12">
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label for="logo">Logo</label>
                                                <div class="custom-file">
                                                    <input type="file" name="site_logo" class="custom-file-input" id="site_logo">
                                                    <label class="custom-file-label" for="site_logo">Choose file</label>
                                                </div>
                                                @error('site_logo')
                                                    <small class="text-danger">{{ $message }}</small>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <img src="{{ asset('uploads/generalSettings') }}/{{ generalSettings()->logo }}" style="max-height: 60px" alt="Not Found">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="row align-items-center">
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label for="footer_logo">Footer logo</label>
                                                <div class="custom-file">
                                                    <input type="file" name="footer_logo" class="custom-file-input" id="footer_logo">
                                                    <label class="custom-file-label" for="footer_logo">Choose file</label>
                                                </div>
                                                @error('footer_logo')
                                                    <small class="text-danger">{{ $message }}</small>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <img src="{{ asset('uploads/generalSettings') }}/{{ generalSettings()->footer_logo }}" style="max-height: 60px" alt="Not Found">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="row align-items-center">
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label for="favicon">Favicon</label>
                                                <div class="custom-file">
                                                    <input type="file" name="favicon" class="custom-file-input" id="favicon">
                                                    <label class="custom-file-label" for="favicon">Choose file</label>
                                                </div>
                                                @error('favicon')
                                                    <small class="text-danger">{{ $message }}</small>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <img src="{{ asset('uploads/generalSettings') }}/{{ generalSettings()->favicon }}" style="max-height: 60px" alt="Not Found">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group">
                                        <label for="phone">Phone</label>
                                        <input type="number" name="phone" value="{{ generalSettings()->phone }}" id="phone" class="form-control" placeholder="Enter address"/>
                                        @error('phone')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group">
                                        <label for="common_button_text">Common button text</label>
                                        <input type="text" name="common_button_text" value="{{ generalSettings()->common_button_text }}" id="common_button_text" class="form-control" placeholder="Enter address"/>
                                        @error('common_button_text')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group">
                                        <label for="text">Arrow Icon</label>
                                        <input type="text" name="arrow_icon" value="{{ generalSettings()->arrow_icon }}" id="arrow_icon" class="form-control" placeholder="Enter email address"/>
                                        @error('arrow_icon')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group">
                                        <label for="text">Copyright</label>
                                        <input type="text" name="copyright" value="{{ generalSettings()->copyright }}" id="arrow_icon" class="form-control" placeholder="copyright"/>
                                        @error('copyright')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
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
