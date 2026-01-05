@extends('layouts.public')

@section('title', $newsItem->title . ' - Escola Parque')

@section('content')
<article class="py-12">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="mb-6">
            <a href="{{ route('news.index') }}" class="text-primary-600 hover:text-primary-700">
                ← Voltar para notícias
            </a>
        </div>

        <header class="mb-8">
            <span class="inline-block px-3 py-1 bg-primary-100 text-primary-700 text-sm rounded-full mb-4">
                {{ ucfirst($newsItem->category) }}
            </span>
            <h1 class="text-4xl font-bold text-gray-900 mb-4">{{ $newsItem->title }}</h1>
            <div class="flex items-center text-gray-600 space-x-4">
                <span>Por {{ $newsItem->author->name }}</span>
                <span>•</span>
                <span>{{ $newsItem->published_at->format('d/m/Y') }}</span>
            </div>
        </header>

        @if($newsItem->cover_image_url)
            <img src="{{ $newsItem->cover_image_url }}" alt="{{ $newsItem->title }}" class="w-full h-96 object-cover rounded-lg mb-8">
        @endif

        <div class="prose prose-lg max-w-none">
            {!! nl2br(e($newsItem->content)) !!}
        </div>
    </div>
</article>

@if($relatedNews->count() > 0)
    <section class="py-12 bg-gray-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <h2 class="text-2xl font-bold mb-6">Notícias Relacionadas</h2>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                @foreach($relatedNews as $related)
                    <article class="card">
                        @if($related->cover_image_url)
                            <img src="{{ $related->cover_image_url }}" alt="{{ $related->title }}" class="w-full h-40 object-cover rounded-t-lg mb-4">
                        @endif
                        <div class="p-4">
                            <span class="text-sm text-gray-500">{{ $related->published_at->format('d/m/Y') }}</span>
                            <h3 class="text-lg font-semibold mt-2 mb-2">{{ Str::limit($related->title, 60) }}</h3>
                            <a href="{{ route('news.show', $related->slug) }}" class="text-primary-600 hover:text-primary-700 font-semibold">
                                Ler mais →
                            </a>
                        </div>
                    </article>
                @endforeach
            </div>
        </div>
    </section>
@endif
@endsection
