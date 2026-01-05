@extends('layouts.public')

@section('title', $album->title . ' - Galeria - Escola Parque')

@section('content')
<div class="py-12 bg-gray-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="mb-6">
            <a href="{{ route('gallery.index') }}" class="text-primary-600 hover:text-primary-700">
                ← Voltar para galeria
            </a>
        </div>

        <div class="mb-8">
            <h1 class="text-4xl font-bold text-gray-900 mb-2">{{ $album->title }}</h1>
            @if($album->event_date)
                <p class="text-lg text-gray-600">{{ $album->event_date->format('d/m/Y') }}</p>
            @endif
            @if($album->description)
                <p class="mt-4 text-gray-700">{{ $album->description }}</p>
            @endif
        </div>

        @if($album->photos->count() > 0)
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
                @foreach($album->photos as $photo)
                    <div class="group relative overflow-hidden rounded-lg shadow-md hover:shadow-xl transition">
                        <img src="{{ $photo->image_url }}"
                             alt="{{ $photo->caption ?? $album->title }}"
                             class="w-full h-64 object-cover group-hover:scale-110 transition duration-300">
                        @if($photo->caption)
                            <div class="absolute bottom-0 left-0 right-0 bg-gradient-to-t from-black/70 to-transparent p-4 opacity-0 group-hover:opacity-100 transition">
                                <p class="text-white text-sm">{{ $photo->caption }}</p>
                            </div>
                        @endif>
                    </div>
                @endforeach
            </div>
        @else
            <div class="text-center py-12">
                <p class="text-gray-600 text-lg">Nenhuma foto neste álbum.</p>
            </div>
        @endif
    </div>
</div>
@endsection
