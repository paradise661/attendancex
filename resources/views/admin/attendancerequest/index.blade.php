@extends('layouts.admin.master')
@section('content')
    @include('admin.includes.message')

    <div class="grid grid-cols-12 gap-6 mt-4">
        <div class="xl:col-span-12 col-span-12">
            @livewire('attendance-request.filter')
        </div>
    </div>
@endsection
