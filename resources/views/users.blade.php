@extends('layouts.app')

@section('header')
<div class="flex items-center justify-between">
    <h2 class="font-semibold text-2xl text-gray-800 leading-tight">
        {{ __('Users') }}
    </h2>
</div>
@endsection

@section('content')
<div id="app">
    <users></users>
</div>
@endsection
