<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Escola Parque - Educação de Qualidade')</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased bg-gray-50">
    <!-- Navigation -->
    <nav class="bg-white shadow-lg sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">
                <div class="flex">
                    <div class="flex-shrink-0 flex items-center">
                        <a href="{{ route('home') }}" class="text-2xl font-bold text-primary-600">
                            Escola Parque
                        </a>
                    </div>
                    <div class="hidden sm:ml-6 sm:flex sm:space-x-8">
                        <a href="{{ route('home') }}" class="@if(request()->routeIs('home')) border-primary-500 text-gray-900 @else border-transparent text-gray-500 hover:border-gray-300 hover:text-gray-700 @endif inline-flex items-center px-1 pt-1 border-b-2 text-sm font-medium">
                            Início
                        </a>
                        <a href="{{ route('news.index') }}" class="@if(request()->routeIs('news.*')) border-primary-500 text-gray-900 @else border-transparent text-gray-500 hover:border-gray-300 hover:text-gray-700 @endif inline-flex items-center px-1 pt-1 border-b-2 text-sm font-medium">
                            Notícias
                        </a>
                        <a href="{{ route('courses.index') }}" class="@if(request()->routeIs('courses.*')) border-primary-500 text-gray-900 @else border-transparent text-gray-500 hover:border-gray-300 hover:text-gray-700 @endif inline-flex items-center px-1 pt-1 border-b-2 text-sm font-medium">
                            Cursos
                        </a>
                        <a href="{{ route('gallery.index') }}" class="@if(request()->routeIs('gallery.*')) border-primary-500 text-gray-900 @else border-transparent text-gray-500 hover:border-gray-300 hover:text-gray-700 @endif inline-flex items-center px-1 pt-1 border-b-2 text-sm font-medium">
                            Galeria
                        </a>
                        <a href="{{ route('enrollment.create') }}" class="@if(request()->routeIs('enrollment.*')) border-primary-500 text-gray-900 @else border-transparent text-gray-500 hover:border-gray-300 hover:text-gray-700 @endif inline-flex items-center px-1 pt-1 border-b-2 text-sm font-medium">
                            Matrícula
                        </a>
                        <a href="{{ route('contact.create') }}" class="@if(request()->routeIs('contact.*')) border-primary-500 text-gray-900 @else border-transparent text-gray-500 hover:border-gray-300 hover:text-gray-700 @endif inline-flex items-center px-1 pt-1 border-b-2 text-sm font-medium">
                            Contato
                        </a>
                    </div>
                </div>
                <div class="hidden sm:ml-6 sm:flex sm:items-center space-x-2">
                    @auth
                        <a href="{{ route('dashboard') }}" class="btn-primary">
                            Dashboard
                        </a>
                    @else
                        <a href="{{ route('login') }}" class="text-gray-500 hover:text-gray-700 px-3 py-2 text-sm font-medium">
                            Login
                        </a>
                        <a href="{{ route('register') }}" class="btn-primary">
                            Registrar
                        </a>
                    @endauth
                </div>
            </div>
        </div>
    </nav>

    <!-- Page Content -->
    <main>
        @if(session('success'))
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-4">
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
                    <span class="block sm:inline">{{ session('success') }}</span>
                </div>
            </div>
        @endif

        @if(session('error'))
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-4">
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
                    <span class="block sm:inline">{{ session('error') }}</span>
                </div>
            </div>
        @endif

        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="bg-gray-800 text-white mt-16">
        <div class="max-w-7xl mx-auto py-12 px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div>
                    <h3 class="text-xl font-bold mb-4">Escola Parque</h3>
                    <p class="text-gray-300">Educação de qualidade para o futuro dos seus filhos.</p>
                </div>
                <div>
                    <h3 class="text-xl font-bold mb-4">Links Rápidos</h3>
                    <ul class="space-y-2">
                        <li><a href="{{ route('news.index') }}" class="text-gray-300 hover:text-white transition">Notícias</a></li>
                        <li><a href="{{ route('courses.index') }}" class="text-gray-300 hover:text-white transition">Cursos</a></li>
                        <li><a href="{{ route('gallery.index') }}" class="text-gray-300 hover:text-white transition">Galeria</a></li>
                        <li><a href="{{ route('enrollment.create') }}" class="text-gray-300 hover:text-white transition">Matrícula</a></li>
                        <li><a href="{{ route('contact.create') }}" class="text-gray-300 hover:text-white transition">Contato</a></li>
                    </ul>
                </div>
                <div>
                    <h3 class="text-xl font-bold mb-4">Contato</h3>
                    <p class="text-gray-300">Email: contato@escolaparque.com.br</p>
                    <p class="text-gray-300 mt-2">Telefone: (11) 1234-5678</p>
                    <p class="text-gray-300 mt-2">Endereço: Rua Exemplo, 123 - São Paulo, SP</p>
                </div>
            </div>
            <div class="mt-8 border-t border-gray-700 pt-8 text-center">
                <p class="text-gray-400">&copy; {{ date('Y') }} Escola Parque. Todos os direitos reservados.</p>
            </div>
        </div>
    </footer>

    @stack('scripts')
</body>
</html>
