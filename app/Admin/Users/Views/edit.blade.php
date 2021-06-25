@php
    /** @var \App\Users\Models\User $user */
@endphp

@extends('Admin::layout')

@section('title')
    Users - Edit
@endsection

@section('content')
    @error('user')
    <div class="alert alert-danger" role="alert">{{ $message }}</div>
    @enderror

    @if(session()->has('message'))
        <div class="alert alert-info" role="alert">{{ session('message') }}</div>
    @endif

    <div class="panel panel-default">
        <form class="panel-body" action="{{ route('admin.users.update', $user->id) }}" method="POST">
            @csrf
            @method('PUT')

            <x-core::input type="text" name="name" :value="old('name', $user->name)" class="form-control" required autofocus />
            <x-core::input type="email" name="email" :value="old('email', $user->email)" class="form-control" required />
            <x-core::input type="password" name="password" class="form-control" />

            <button class="btn btn-sm btn-primary" type="submit">Edit</button>
        </form>
    </div>
@endsection
