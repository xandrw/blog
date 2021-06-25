@extends('Admin::layout')

@section('title')
    Users
@endsection

@php
    $columns = [
        '#' => 'id',
        'Name' => 'name',
        'Email' => 'email',
        'Created at' => 'created_at',
        'Updated at' => 'updated_at'
    ];
@endphp

@section('content')
    @error('user')
    <div class="alert alert-danger" role="alert">{{ $message }}</div>
    @enderror

    @if(session()->has('message'))
        <div class="alert alert-info" role="alert">{{ session('message') }}</div>
    @endif

    <div class="panel panel-default">
        @can('create.users')
            <div class="panel-body">
                <a href="{{ route('admin.users.create') }}" class="btn btn-sm btn-default">Create</a>
            </div>
        @endcan

        <x-core::table
            table="users"
            :items="$users->items()"
            :columns="$columns"
            :withActions="true"
            route="admin.users"
        />
    </div>
    {{ $users->links() }}
@endsection
