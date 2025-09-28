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
                    <x-nav-link href="/jobs" :active="request()->is('jobs')">Jobs</x-nav-link>
                </div>
            </div>
        </div>
    </nav>

    <!-- Hero Section: show only on Home + Jobs -->
    @if(request()->is('/') || request()->is('jobs'))
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
    @endif

   <!-- Main Content -->
    <main>
        <div class="mx-auto max-w-7xl py-10 px-6">
            @isset($heading)
                <h1 class="text-3xl font-bold text-white mb-8">{{ $heading }}</h1>
            @endisset

            {{ $slot }}
        </div>
    </main>



    <!-- Footer -->
    <footer class="bg-gray-900 text-gray-400 py-6 mt-12 text-center border-t border-gray-800">
        <p>&copy; {{ date('Y') }} QuickHire. All rights reserved.</p>
    </footer>

</body>

    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        document.getElementById('delete-form').addEventListener('submit', function(event) {
            event.preventDefault(); // Prevent the default form submission

            Swal.fire({
                title: 'Are you sure?',
                text: "This action cannot be undone.",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    // If confirmed, submit the form
                    this.submit();
                }
            });
        });
    </script>

    @include('sweetalert2::index')

</html>
