@extends('layouts.public')

@section('title', 'Galeria de Fotos - Escola Parque')

@section('content')
<div class="py-12 bg-gray-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="mb-8 text-center">
            <h1 class="text-4xl font-bold text-gray-900">Galeria de Fotos</h1>
            <p class="mt-2 text-lg text-gray-600">Veja os momentos especiais da Escola Parque</p>
        </div>

        @if($albums->count() > 0)
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach($albums as $album)
                    <a href="{{ route('gallery.show', $album->id) }}" class="card hover:shadow-xl transition group">
                        @if($album->cover_image_url)
                            <div class="relative overflow-hidden rounded-lg mb-4">
                                <img src="{{ $album->cover_image_url }}"
                                     alt="{{ $album->title }}"
                                     class="w-full h-64 object-cover group-hover:scale-110 transition duration-300">
                                <div class="absolute inset-0 bg-black bg-opacity-0 group-hover:bg-opacity-20 transition"></div>
                            </div>
                        @endif
                        <div class="p-4">
                            <h2 class="text-xl font-bold mb-2">{{ $album->title }}</h2>
                            @if($album->event_date)
                                <p class="text-sm text-gray-600 mb-2">{{ $album->event_date->format('d/m/Y') }}</p>
                            @endif
                            @if($album->description)
                                <p class="text-gray-700 mb-3">{{ Str::limit($album->description, 100) }}</p>
                            @endif
                            <div class="flex items-center text-primary-600">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                </svg>
                                <span>{{ $album->photos_count }} fotos</span>
                            </div>
                        </div>
                    </a>
                @endforeach
            </div>

            <div class="mt-8">
                {{ $albums->links() }}
            </div>
        @else
            <div class="text-center py-12">
                <p class="text-gray-600 text-lg">Nenhum álbum disponível no momento.</p>
            </div>
        @endif
    </div>
</div>
@endsection
