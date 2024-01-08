@extends('layouts.app')
@section('title', 'Home')
@section('content')
    @if ($posts)
        <div class="py-6">
            @foreach ($posts as $post)
                <x-post-card :post="$post" />
            @endforeach
        </div>
    @else
        <p class="text-center">No Post Found, start following someone</p>
    @endif
@endsection
