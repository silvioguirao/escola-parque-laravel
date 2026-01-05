@extends('layouts.public')

@section('title', 'Notícias - Escola Parque')

@section('content')
<div class="py-12 bg-gray-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="mb-8">
            <h1 class="text-4xl font-bold text-gray-900">Notícias</h1>
            <p class="mt-2 text-lg text-gray-600">Fique por dentro das novidades da Escola Parque</p>
        </div>

        @if($news->count() > 0)
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach($news as $newsItem)
                    <article class="card hover:shadow-lg transition">
                        @if($newsItem->cover_image_url)
                            <img src="{{ $newsItem->cover_image_url }}" alt="{{ $newsItem->title }}" class="w-full h-48 object-cover rounded-t-lg mb-4">
                        @endif
                        <div class="p-4">
                            <span class="inline-block px-3 py-1 bg-primary-100 text-primary-700 text-sm rounded-full mb-2">
                                {{ ucfirst($newsItem->category) }}
                            </span>
                            <span class="text-sm text-gray-500 ml-2">
                                {{ $newsItem->published_at->format('d/m/Y') }}
                            </span>
                            <h2 class="text-xl font-semibold mt-2 mb-2">{{ $newsItem->title }}</h2>
                            @if($newsItem->excerpt)
                                <p class="text-gray-600 mb-4">{{ Str::limit($newsItem->excerpt, 120) }}</p>
                            @endif
                            <a href="{{ route('news.show', $newsItem->slug) }}" class="text-primary-600 hover:text-primary-700 font-semibold">
                                Ler mais →
                            </a>
                        </div>
                    </article>
                @endforeach
            </div>

            <div class="mt-8">
                {{ $news->links() }}
            </div>
        @else
            <div class="text-center py-12">
                <p class="text-gray-600 text-lg">Nenhuma notícia publicada no momento.</p>
            </div>
        @endif
    </div>
</div>
@endsection
