@extends('Admin::layout')

@section('title')
    Users - Create
@endsection

@section('content')
    @error('user')
    <!--suppress ALL -->
    <div class="alert alert-danger" role="alert">{{ $message }}</div>
    @enderror

    @if(session()->has('message'))
        <div class="alert alert-info" role="alert">{{ session('message') }}</div>
    @endif

    <div class="panel panel-default">
        <div class="panel-body">
            <form action="{{ route('admin.users.store') }}" method="POST">
                @csrf

                <x-core::input type="text" name="name" :value="old('name', '')" class="form-control" required autofocus />
                <x-core::input type="email" name="email" :value="old('email', '')" class="form-control" required />
                <x-core::input type="password" name="password" class="form-control" required />

                <button class="btn btn-sm btn-primary" type="submit">Create</button>
            </form>
        </div>
    </div>
@endsection
