@extends('layouts.app')

@section('title', 'Lombok News - Berita Terkini')

@section('content')

    {{-- HERO BANNER --}}
    @if(isset($heroPost))
        @include('sections.hero', ['post' => $heroPost])
    @else
        <div class="bg-gray-800 text-white p-8 text-center">
            <h2 class="text-2xl font-bold">Belum ada berita headline.</h2>
        </div>
    @endif

    <main class="max-w-7xl mx-auto px-4 py-8">
        <div class="grid grid-cols-1 lg:grid-cols-4 gap-8">
            <div class="lg:col-span-3">
                {{-- BERITA TERBARU --}}
                @include('sections.berita-terbaru', ['posts' => $latestPosts])
                
                {{-- BERITA PILIHAN --}}
                @include('sections.berita-pilihan', ['posts' => $editorChoices])
            </div>

            <div class="lg:col-span-1">
                @include('sections.sidebar')
            </div>
        </div>
    </main>

@endsection