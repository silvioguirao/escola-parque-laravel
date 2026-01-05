@extends('layouts.public')

@section('title', 'Matrícula - Escola Parque')

@section('content')
<div class="py-12 bg-gray-50">
    <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="mb-8 text-center">
            <h1 class="text-4xl font-bold text-gray-900">Matrícula</h1>
            <p class="mt-2 text-lg text-gray-600">Preencha o formulário para matricular seu filho(a)</p>
        </div>

        <div class="card">
            <form method="POST" action="{{ route('enrollment.store') }}" class="space-y-6">
                @csrf

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="label">Nome do Aluno</label>
                        <input type="text" name="student_name" value="{{ old('student_name') }}" required class="input-field @error('student_name') border-red-500 @enderror">
                        @error('student_name')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label class="label">Data de Nascimento</label>
                        <input type="date" name="birth_date" value="{{ old('birth_date') }}" required class="input-field @error('birth_date') border-red-500 @enderror">
                        @error('birth_date')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="label">Nome do Responsável</label>
                        <input type="text" name="parent_name" value="{{ old('parent_name') }}" required class="input-field @error('parent_name') border-red-500 @enderror">
                        @error('parent_name')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label class="label">Email do Responsável</label>
                        <input type="email" name="parent_email" value="{{ old('parent_email') }}" required class="input-field @error('parent_email') border-red-500 @enderror">
                        @error('parent_email')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div>
                    <label class="label">Telefone do Responsável</label>
                    <input type="tel" name="parent_phone" value="{{ old('parent_phone') }}" required class="input-field @error('parent_phone') border-red-500 @enderror">
                    @error('parent_phone')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="label">Endereço Completo</label>
                    <textarea name="address" rows="3" class="input-field @error('address') border-red-500 @enderror">{{ old('address') }}</textarea>
                    @error('address')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="label">Nível de Ensino</label>
                        <select name="level" required class="input-field @error('level') border-red-500 @enderror">
                            <option value="">Selecione</option>
                            <option value="infantil" {{ old('level') == 'infantil' ? 'selected' : '' }}>Educação Infantil</option>
                            <option value="fundamental1" {{ old('level') == 'fundamental1' ? 'selected' : '' }}>Fundamental I</option>
                            <option value="fundamental2" {{ old('level') == 'fundamental2' ? 'selected' : '' }}>Fundamental II</option>
                            <option value="medio" {{ old('level') == 'medio' ? 'selected' : '' }}>Ensino Médio</option>
                        </select>
                        @error('level')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label class="label">Curso (opcional)</label>
                        <select name="course_id" class="input-field @error('course_id') border-red-500 @enderror">
                            <option value="">Selecione um curso</option>
                            @foreach($courses as $course)
                                <option value="{{ $course->id }}" {{ old('course_id') == $course->id ? 'selected' : '' }}>
                                    {{ $course->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('course_id')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div class="flex justify-end space-x-4">
                    <a href="{{ route('home') }}" class="btn-secondary">
                        Cancelar
                    </a>
                    <button type="submit" class="btn-primary">
                        Enviar Matrícula
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
