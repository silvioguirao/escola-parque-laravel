@extends('layouts.public')

@section('title', $course->name . ' - Escola Parque')

@section('content')
<div class="py-12">
    <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="mb-6">
            <a href="{{ route('courses.index') }}" class="text-primary-600 hover:text-primary-700">
                ← Voltar para cursos
            </a>
        </div>

        <div class="card">
            @if($course->image_url)
                <img src="{{ $course->image_url }}" alt="{{ $course->name }}" class="w-full h-96 object-cover rounded-lg mb-8">
            @endif

            <span class="inline-block px-4 py-2 bg-primary-100 text-primary-700 text-sm rounded-full mb-4">
                {{ ucfirst($course->level) }}
            </span>

            <h1 class="text-4xl font-bold text-gray-900 mb-4">{{ $course->name }}</h1>

            @if($course->age_range)
                <p class="text-lg text-gray-600 mb-6">Idade recomendada: {{ $course->age_range }}</p>
            @endif

            <div class="prose prose-lg max-w-none mb-8">
                {!! nl2br(e($course->description)) !!}
            </div>

            @if($course->curriculum)
                <div class="mb-8">
                    <h2 class="text-2xl font-bold mb-4">Currículo</h2>
                    <div class="bg-gray-50 rounded-lg p-6">
                        @if(is_array($course->curriculum))
                            <ul class="space-y-2">
                                @foreach($course->curriculum as $item)
                                    <li class="flex items-start">
                                        <svg class="w-6 h-6 text-primary-600 mr-2 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                        </svg>
                                        <span>{{ is_string($item) ? $item : json_encode($item) }}</span>
                                    </li>
                                @endforeach
                            </ul>
                        @endif
                    </div>
                </div>
            @endif

            <div class="flex flex-col sm:flex-row gap-4">
                <a href="{{ route('enrollment.create') }}" class="btn-primary flex-1 justify-center">
                    Fazer Matrícula
                </a>
                <a href="{{ route('contact.create') }}" class="btn-secondary flex-1 justify-center">
                    Mais Informações
                </a>
            </div>
        </div>
    </div>
</div>
@endsection
