<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'QuickHire' }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-950 text-gray-200 font-sans antialiased">

    <!-- Navbar -->
    <nav class="bg-gray-900 border-b border-gray-800 shadow">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16 items-center">
                <!-- Logo -->
                <div class="flex items-center">
                    <span class="text-indigo-400 font-extrabold text-2xl tracking-wide">QuickHire</span>
                </div>

                <!-- Navigation Links -->
                <div class="flex space-x-6">
                    <x-nav-link href="/" :active="request()->is('/')">Home</x-nav-link>
                    <x-nav-link href="/about" :active="request()->is('about')">About</x-nav-link>
                    <x-nav-link href="/contact" :active="request()->is('contact')">Contact</x-nav-link>
                </div>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <header class="bg-gradient-to-r from-indigo-800 to-purple-800">
        <div class="mx-auto max-w-7xl py-16 px-6 text-center">
            <h1 class="text-4xl sm:text-5xl font-extrabold tracking-tight text-white">
                Find Your Dream Job Today
            </h1>
            <p class="mt-4 text-lg text-gray-300">
                Connecting top talent with the best companies 🚀
            </p>
            <div class="mt-6">
                <a href="/jobs" class="bg-indigo-500 hover:bg-indigo-600 px-6 py-3 rounded-lg shadow text-white font-semibold transition">
                    Browse Jobs
                </a>
            </div>
        </div>
    </header>

    <!-- Main Content -->
    <main>
        <div class="mx-auto max-w-7xl py-10 px-6">
            {{ $slot }}
        </div>
    </main>

    <!-- Footer -->
    <footer class="bg-gray-900 text-gray-400 py-6 mt-12 text-center border-t border-gray-800">
        <p>&copy; {{ date('Y') }} QuickHire. All rights reserved.</p>
    </footer>

</body>
</html>
