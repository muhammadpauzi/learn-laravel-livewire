@extends('layouts.app')

@section('content')

{{-- @livewire('comments') --}}
<div class="grid grid-cols-[.9fr_1fr] gap-4">
    <livewire:tickets />
    <livewire:comments />
</div>

@endsection