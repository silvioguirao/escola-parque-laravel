@extends('layouts.public')

@section('title', 'Escola Parque - Educação de Qualidade')

@section('content')
<!-- Hero Section / Carousel -->
<div class="relative bg-primary-600 text-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-24">
        @if($banners->count() > 0)
            <div class="text-center">
                <h1 class="text-4xl md:text-6xl font-bold mb-4">{{ $banners->first()->title }}</h1>
                @if($banners->first()->subtitle)
                    <p class="text-xl md:text-2xl mb-8">{{ $banners->first()->subtitle }}</p>
                @endif
                @if($banners->first()->cta_text && $banners->first()->cta_link)
                    <a href="{{ $banners->first()->cta_link }}" class="inline-block bg-white text-primary-600 px-8 py-3 rounded-lg font-semibold hover:bg-gray-100 transition">
                        {{ $banners->first()->cta_text }}
                    </a>
                @endif
            </div>
        @else
            <div class="text-center">
                <h1 class="text-4xl md:text-6xl font-bold mb-4">Bem-vindo à Escola Parque</h1>
                <p class="text-xl md:text-2xl mb-8">Educação de qualidade para o futuro dos seus filhos</p>
                <a href="{{ route('enrollment.create') }}" class="inline-block bg-white text-primary-600 px-8 py-3 rounded-lg font-semibold hover:bg-gray-100 transition">
                    Faça sua Matrícula
                </a>
            </div>
        @endif
    </div>
</div>

<!-- Differentials Section -->
@if($differentials->count() > 0)
<section class="py-16 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <h2 class="text-3xl font-bold text-center mb-12">Nossos Diferenciais</h2>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @foreach($differentials as $differential)
                <div class="card text-center">
                    <div class="text-4xl mb-4">{{ $differential->icon }}</div>
                    <h3 class="text-xl font-semibold mb-2">{{ $differential->title }}</h3>
                    <p class="text-gray-600">{{ $differential->description }}</p>
                </div>
            @endforeach
        </div>
    </div>
</section>
@endif

<!-- Latest News Section -->
@if($latestNews->count() > 0)
<section class="py-16 bg-gray-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center mb-12">
            <h2 class="text-3xl font-bold">Últimas Notícias</h2>
            <a href="{{ route('news.index') }}" class="text-primary-600 hover:text-primary-700 font-semibold">
                Ver todas →
            </a>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @foreach($latestNews as $news)
                <article class="card hover:shadow-lg transition">
                    @if($news->cover_image_url)
                        <img src="{{ $news->cover_image_url }}" alt="{{ $news->title }}" class="w-full h-48 object-cover rounded-t-lg mb-4">
                    @endif
                    <div class="p-4">
                        <span class="text-sm text-gray-500">{{ $news->published_at->format('d/m/Y') }}</span>
                        <h3 class="text-xl font-semibold mt-2 mb-2">{{ $news->title }}</h3>
                        @if($news->excerpt)
                            <p class="text-gray-600 mb-4">{{ Str::limit($news->excerpt, 100) }}</p>
                        @endif
                        <a href="{{ route('news.show', $news->slug) }}" class="text-primary-600 hover:text-primary-700 font-semibold">
                            Ler mais →
                        </a>
                    </div>
                </article>
            @endforeach
        </div>
    </div>
</section>
@endif

<!-- Partners Section -->
@if($partners->count() > 0)
<section class="py-16 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <h2 class="text-3xl font-bold text-center mb-12">Nossos Parceiros</h2>
        <div class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-6 gap-8">
            @foreach($partners as $partner)
                <div class="flex items-center justify-center">
                    @if($partner->website)
                        <a href="{{ $partner->website }}" target="_blank" rel="noopener noreferrer">
                            <img src="{{ $partner->logo_url }}" alt="{{ $partner->name }}" class="max-h-16 grayscale hover:grayscale-0 transition">
                        </a>
                    @else
                        <img src="{{ $partner->logo_url }}" alt="{{ $partner->name }}" class="max-h-16 grayscale">
                    @endif
                </div>
            @endforeach
        </div>
    </div>
</section>
@endif

<!-- CTA Section -->
<section class="py-16 bg-primary-600 text-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <h2 class="text-3xl font-bold mb-4">Pronto para fazer parte da nossa comunidade?</h2>
        <p class="text-xl mb-8">Entre em contato conosco ou faça sua matrícula agora mesmo!</p>
        <div class="flex flex-col sm:flex-row justify-center gap-4">
            <a href="{{ route('enrollment.create') }}" class="inline-block bg-white text-primary-600 px-8 py-3 rounded-lg font-semibold hover:bg-gray-100 transition">
                Fazer Matrícula
            </a>
            <a href="{{ route('contact.create') }}" class="inline-block bg-transparent border-2 border-white text-white px-8 py-3 rounded-lg font-semibold hover:bg-white hover:text-primary-600 transition">
                Entrar em Contato
            </a>
        </div>
    </div>
</section>
@endsection
