@extends('layouts.app')

@section('header')
<div class="flex items-center justify-between">
    <h2 class="font-semibold text-2xl text-gray-800 leading-tight">
        {{ __('Appointments') }}
    </h2>
</div>
@endsection

@section('content')
<div id="app">
    <appointments
        :initial-appointments='@json($appointments)'
        :is-admin='@json(auth()->user()->role === "admin")'
        :available-vets='@json(\App\Models\User::where("role", "vet")->get())'
    ></appointments>
</div>
@endsection

