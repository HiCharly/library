<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'Laravel') }}</title>
    <link rel="icon" href="/favicon.ico" sizes="any">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600,700" rel="stylesheet" />

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-gradient-to-br from-neutral-50 to-orange-50 min-h-screen">
    <!-- Navigation -->
    <nav class="relative px-4 sm:px-6 py-4">
        <div class="max-w-7xl mx-auto flex items-center justify-between">
            <!-- Logo & Brand -->
            <div class="flex items-center space-x-2 sm:space-x-3">
                <img
                    src="{{ asset('logo.png') }}"
                    alt="{{ config('app.name', 'Laravel') }}"
                    class="w-8 h-8 sm:w-10 sm:h-10 object-contain rounded-lg">
                <span class="text-lg sm:text-xl font-bold text-neutral-900">
                    {{ config('app.name', 'Laravel') }}
                </span>
            </div>

            <!-- Auth Links (Desktop Only) -->
            <div class="hidden sm:flex items-center space-x-4">
                @auth
                <a
                    href="{{ url('/dashboard') }}"
                    class="px-4 py-2 text-base bg-orange-500 text-white rounded-lg hover:bg-orange-600 transition-colors duration-200 font-medium">
                    Accéder à mon espace
                </a>
                @else
                <flux:button variant="ghost" href="{{ route('login') }}">
                    Se connecter
                </flux:button>
                <flux:button variant="primary" href="{{ route('register') }}">
                    S'inscrire
                </flux:button>
                @endauth
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <main class="max-w-7xl mx-auto px-4 sm:px-6 py-8 sm:py-16">
        <!-- Hero Section -->
        <section class="text-center mb-12 sm:mb-16">
            <h1 class="text-3xl sm:text-4xl md:text-5xl lg:text-6xl font-bold text-neutral-900 mb-4 sm:mb-6">
                Bienvenue sur
                <span class="bg-gradient-to-r from-orange-500 to-orange-600 bg-clip-text text-transparent block sm:inline">
                    {{ config('app.name', 'Laravel') }}
                </span>
            </h1>
            <p class="text-lg sm:text-xl text-neutral-600 mb-6 sm:mb-8 max-w-3xl mx-auto leading-relaxed px-4">
                Partagez et gérez les ressources documentaires de votre établissement. Une solution simple pour que chaque enseignant puisse accéder à l'ensemble des livres disponibles.
            </p>
        </section>

        <!-- Features Grid -->
        <section class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 sm:gap-8 mb-12 sm:mb-16">
            <!-- Feature 1: Google Books API -->
            <div class="bg-white p-6 sm:p-8 rounded-xl transition-shadow duration-300">
                <div class="w-10 h-10 sm:w-12 sm:h-12 bg-orange-100 rounded-lg flex items-center justify-center mb-4 sm:mb-6">
                    <svg class="w-5 h-5 sm:w-6 sm:h-6 text-orange-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                    </svg>
                </div>
                <h3 class="text-lg sm:text-xl font-semibold text-neutral-900 mb-3 sm:mb-4">
                    Base de données Google
                </h3>
                <p class="text-sm sm:text-base text-neutral-600">
                    Ajoutez vos livres en scannant simplement leur code-barres. Nous récupérons automatiquement toutes les informations : titre, auteur, couverture et résumé.
                </p>
            </div>

            <!-- Feature 2: Collaborative Sharing -->
            <div class="bg-white p-6 sm:p-8 rounded-xl transition-shadow duration-300">
                <div class="w-10 h-10 sm:w-12 sm:h-12 bg-orange-100 rounded-lg flex items-center justify-center mb-4 sm:mb-6">
                    <svg class="w-5 h-5 sm:w-6 sm:h-6 text-orange-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                    </svg>
                </div>
                <h3 class="text-lg sm:text-xl font-semibold text-neutral-900 mb-3 sm:mb-4">
                    Partage collaboratif
                </h3>
                <p class="text-sm sm:text-base text-neutral-600">
                    Partagez vos bibliothèques avec vos collègues enseignants. Chacun peut contribuer à l'inventaire et consulter les ressources disponibles.
                </p>
            </div>

            <!-- Feature 3: Open Source -->
            <div class="bg-white p-6 sm:p-8 rounded-xl transition-shadow duration-300 sm:col-span-2 lg:col-span-1">
                <div class="w-10 h-10 sm:w-12 sm:h-12 bg-orange-100 rounded-lg flex items-center justify-center mb-4 sm:mb-6">
                    <svg class="w-5 h-5 sm:w-6 sm:h-6 text-orange-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 20l4-16m4 4l4 4-4 4M6 16l-4-4 4-4" />
                    </svg>
                </div>
                <h3 class="text-lg sm:text-xl font-semibold text-neutral-900 mb-3 sm:mb-4">
                    Open Source
                </h3>
                <p class="text-sm sm:text-base text-neutral-600">
                    Développé en open source avec Laravel et Livewire, ce projet encourage la collaboration. Contribuez, personnalisez et améliorez l'outil selon vos besoins.
                </p>
            </div>
        </section>

        <!-- Call to Action -->
        <section class="bg-gradient-to-r from-orange-500 to-orange-600 rounded-xl sm:rounded-2xl p-6 sm:p-8 lg:p-12 text-center text-white">
            <h2 class="text-2xl sm:text-3xl font-bold mb-3 sm:mb-4">
                Prêt à commencer ?
            </h2>

            @auth
            <a
                href="{{ url('/dashboard') }}"
                class="px-6 py-3 sm:px-8 sm:py-4 bg-white text-orange-600 rounded-lg hover:bg-gray-100 transition-all duration-200 font-semibold text-base sm:text-lg transform hover:-translate-y-1">
                Accéder à mon espace
            </a>
            @else
            <div class="flex flex-col sm:flex-row gap-3 sm:gap-4 justify-center max-w-md sm:max-w-none mx-auto">
                <a
                    href="{{ route('register') }}"
                    class="px-6 py-3 sm:px-8 sm:py-4 bg-white text-orange-600 rounded-lg hover:bg-gray-100 transition-all duration-200 font-semibold text-base sm:text-lg transform hover:-translate-y-1">
                    Créer un compte
                </a>
                <a
                    href="{{ route('login') }}"
                    class="px-6 py-3 sm:px-8 sm:py-4 border-2 border-white text-white rounded-lg hover:bg-white hover:text-orange-600 transition-all duration-200 font-semibold text-base sm:text-lg">
                    Se connecter
                </a>
            </div>
            @endauth
        </section>
    </main>

    <!-- Footer -->
    <footer class="bg-neutral-800 text-white py-6 sm:py-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 text-center">
            <div class="flex flex-col items-center space-y-4">
                <!-- GitHub Links -->
                <div class="flex flex-col sm:flex-row items-center space-y-3 sm:space-y-0 sm:space-x-6">
                    <a
                        href="https://github.com/HiCharly/library"
                        target="_blank"
                        rel="noopener noreferrer"
                        class="flex items-center space-x-2 text-neutral-400 hover:text-white transition-colors duration-200 text-sm sm:text-base">
                        <svg class="w-4 h-4 sm:w-5 sm:h-5" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M12 0c-6.626 0-12 5.373-12 12 0 5.302 3.438 9.8 8.207 11.387.599.111.793-.261.793-.577v-2.234c-3.338.726-4.033-1.416-4.033-1.416-.546-1.387-1.333-1.756-1.333-1.756-1.089-.745.083-.729.083-.729 1.205.084 1.839 1.237 1.839 1.237 1.07 1.834 2.807 1.304 3.492.997.107-.775.418-1.305.762-1.604-2.665-.305-5.467-1.334-5.467-5.931 0-1.311.469-2.381 1.236-3.221-.124-.303-.535-1.524.117-3.176 0 0 1.008-.322 3.301 1.23.957-.266 1.983-.399 3.003-.404 1.02.005 2.047.138 3.006.404 2.291-1.552 3.297-1.23 3.297-1.23.653 1.653.242 2.874.118 3.176.77.84 1.235 1.911 1.235 3.221 0 4.609-2.807 5.624-5.479 5.921.43.372.823 1.102.823 2.222v3.293c0 .319.192.694.801.576 4.765-1.589 8.199-6.086 8.199-11.386 0-6.627-5.373-12-12-12z" />
                        </svg>
                        <span>Projet GitHub</span>
                    </a>

                    <a
                        href="https://github.com/HiCharly"
                        target="_blank"
                        rel="noopener noreferrer"
                        class="flex items-center space-x-2 text-neutral-400 hover:text-white transition-colors duration-200 text-sm sm:text-base">
                        <svg class="w-4 h-4 sm:w-5 sm:h-5" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M12 0c-6.626 0-12 5.373-12 12 0 5.302 3.438 9.8 8.207 11.387.599.111.793-.261.793-.577v-2.234c-3.338.726-4.033-1.416-4.033-1.416-.546-1.387-1.333-1.756-1.333-1.756-1.089-.745.083-.729.083-.729 1.205.084 1.839 1.237 1.839 1.237 1.07 1.834 2.807 1.304 3.492.997.107-.775.418-1.305.762-1.604-2.665-.305-5.467-1.334-5.467-5.931 0-1.311.469-2.381 1.236-3.221-.124-.303-.535-1.524.117-3.176 0 0 1.008-.322 3.301 1.23.957-.266 1.983-.399 3.003-.404 1.02.005 2.047.138 3.006.404 2.291-1.552 3.297-1.23 3.297-1.23.653 1.653.242 2.874.118 3.176.77.84 1.235 1.911 1.235 3.221 0 4.609-2.807 5.624-5.479 5.921.43.372.823 1.102.823 2.222v3.293c0 .319.192.694.801.576 4.765-1.589 8.199-6.086 8.199-11.386 0-6.627-5.373-12-12-12z" />
                        </svg>
                        <span>@HiCharly</span>
                    </a>
                </div>

                <!-- Copyright -->
                <p class="text-neutral-400 text-xs sm:text-sm border-t border-neutral-700 pt-4">
                    &copy; {{ date('Y') }} {{ config('app.name', 'Laravel') }}. Tous droits réservés.
                </p>
            </div>
        </div>
    </footer>
</body>

</html>