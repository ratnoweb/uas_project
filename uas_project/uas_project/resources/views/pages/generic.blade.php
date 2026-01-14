@extends('layouts.app')

@section('title', $data['title'])

@section('content')
<div class="max-w-4xl mx-auto px-4 py-12">
    <div class="bg-white rounded-lg shadow-sm p-8 border border-gray-100">
        {{-- Breadcrumb --}}
        <div class="mb-6 text-sm text-gray-500">
            <a href="{{ route('home') }}" class="hover:text-primary">Beranda</a>
            <span class="mx-2">/</span>
            <span class="text-gray-900">{{ $data['title'] }}</span>
        </div>

        {{-- Judul --}}
        <h1 class="text-3xl font-bold text-gray-900 mb-6 pb-4 border-b">
            {{ $data['title'] }}
        </h1>

        {{-- Konten --}}
        <div class="prose max-w-none text-gray-700 leading-relaxed">
            {!! $data['content'] !!}
        </div>
    </div>
</div>
@endsection