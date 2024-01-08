@extends('layouts.app')

@section('Title')
@endsection
@section('content')

    <div class="py-4">
        <x-post-card :post="$post"/>
    </div>

@endsection
