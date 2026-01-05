@extends('layouts.public')

@section('title', 'Contato - Escola Parque')

@section('content')
<div class="py-12 bg-gray-50">
    <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="mb-8 text-center">
            <h1 class="text-4xl font-bold text-gray-900">Entre em Contato</h1>
            <p class="mt-2 text-lg text-gray-600">Estamos aqui para ajudar. Envie sua mensagem!</p>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <div class="lg:col-span-2">
                <div class="card">
                    <form method="POST" action="{{ route('contact.store') }}" class="space-y-6">
                        @csrf

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label class="label">Nome Completo</label>
                                <input type="text" name="name" value="{{ old('name') }}" required class="input-field @error('name') border-red-500 @enderror">
                                @error('name')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label class="label">Email</label>
                                <input type="email" name="email" value="{{ old('email') }}" required class="input-field @error('email') border-red-500 @enderror">
                                @error('email')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label class="label">Telefone</label>
                                <input type="tel" name="phone" value="{{ old('phone') }}" class="input-field @error('phone') border-red-500 @enderror">
                                @error('phone')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label class="label">Assunto</label>
                                <input type="text" name="subject" value="{{ old('subject') }}" required class="input-field @error('subject') border-red-500 @enderror">
                                @error('subject')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <div>
                            <label class="label">Mensagem</label>
                            <textarea name="message" rows="6" required class="input-field @error('message') border-red-500 @enderror">{{ old('message') }}</textarea>
                            @error('message')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="flex justify-end space-x-4">
                            <a href="{{ route('home') }}" class="btn-secondary">
                                Cancelar
                            </a>
                            <button type="submit" class="btn-primary">
                                Enviar Mensagem
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <div class="space-y-6">
                <div class="card">
                    <h3 class="text-xl font-bold mb-4">Informações de Contato</h3>
                    <div class="space-y-4">
                        <div class="flex items-start">
                            <svg class="w-6 h-6 text-primary-600 mr-3 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                            </svg>
                            <div>
                                <p class="font-semibold">Email</p>
                                <p class="text-gray-600">contato@escolaparque.com.br</p>
                            </div>
                        </div>

                        <div class="flex items-start">
                            <svg class="w-6 h-6 text-primary-600 mr-3 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                            </svg>
                            <div>
                                <p class="font-semibold">Telefone</p>
                                <p class="text-gray-600">(11) 1234-5678</p>
                            </div>
                        </div>

                        <div class="flex items-start">
                            <svg class="w-6 h-6 text-primary-600 mr-3 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                            </svg>
                            <div>
                                <p class="font-semibold">Endereço</p>
                                <p class="text-gray-600">Rua Exemplo, 123<br>São Paulo, SP</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card">
                    <h3 class="text-xl font-bold mb-4">Horário de Atendimento</h3>
                    <div class="space-y-2 text-gray-700">
                        <p><span class="font-semibold">Segunda a Sexta:</span> 7h - 18h</p>
                        <p><span class="font-semibold">Sábado:</span> 8h - 12h</p>
                        <p><span class="font-semibold">Domingo:</span> Fechado</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
