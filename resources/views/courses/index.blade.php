@extends('layouts.public')

@section('title', 'Cursos - Escola Parque')

@section('content')
<div class="py-12 bg-gray-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="mb-8 text-center">
            <h1 class="text-4xl font-bold text-gray-900">Nossos Cursos</h1>
            <p class="mt-2 text-lg text-gray-600">Conheça os cursos oferecidos pela Escola Parque</p>
        </div>

        @if($courses->count() > 0)
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach($courses as $course)
                    <div class="card hover:shadow-xl transition">
                        @if($course->image_url)
                            <img src="{{ $course->image_url }}" alt="{{ $course->name }}" class="w-full h-48 object-cover rounded-t-lg mb-4">
                        @endif
                        <div class="p-6">
                            <span class="inline-block px-3 py-1 bg-primary-100 text-primary-700 text-sm rounded-full mb-4">
                                {{ ucfirst($course->level) }}
                            </span>
                            <h2 class="text-2xl font-bold mb-3">{{ $course->name }}</h2>
                            @if($course->age_range)
                                <p class="text-sm text-gray-600 mb-3">Idade: {{ $course->age_range }}</p>
                            @endif
                            <p class="text-gray-700 mb-4">{{ Str::limit($course->description, 150) }}</p>
                            <a href="{{ route('courses.show', $course->slug) }}" class="btn-primary w-full text-center justify-center">
                                Ver Detalhes
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <div class="text-center py-12">
                <p class="text-gray-600 text-lg">Nenhum curso disponível no momento.</p>
            </div>
        @endif
    </div>
</div>
@endsection
