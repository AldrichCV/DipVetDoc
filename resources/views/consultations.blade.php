@extends('layouts.app')

@section('header')
<div class="flex items-center justify-between">
    <h2 class="font-semibold text-2xl text-gray-800 leading-tight">
        {{ __('Consultations') }}
    </h2>
</div>
@endsection

@section('content')
<div id="app">
   <consultations 
       :consultations='@json($consultations)'
       :all-species='@json($allSpecies)'
   ></consultations>
</div>
@endsection
