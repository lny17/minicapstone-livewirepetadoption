<!DOCTYPE html>
<html lang="en" class="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>AdoptMe Dashboard</title>
    @vite('resources/css/app.css')
</head>

<body class="dark:bg-zinc-900 min-h-screen transition-colors duration-300">
    <div class="min-h-screen flex flex-col items-center justify-center p-6 dark:bg-zinc-900">
        <!-- Main Content Container -->
        <div class="max-w-4xl w-full mx-auto">
            <!-- Header Section -->
            <div class="text-center">
                <div class="flex justify-center p-8 ">
                    <img src="{{ asset('images/petWhiteLogo.png') }}" alt="AdoptMe Logo" class="w-40 object-contain">
                </div>

                <h1 class="text-5xl md:text-6xl font-bold mb-6 text-zinc-900 dark:text-white transition-colors">
                    Welcome to <span class="text-blue-600">AdoptMe</span>
                </h1>

                <p class="text-md md:text-xl text-zinc-600 dark:text-zinc-400 max-w-5xl mx-auto mb-10 leading-relaxed">
                    AdoptMe is a powerful and easy-to-use <span class="font-semibold text-blue-600">Pet Management System</span>
                    designed to help shelters, rescuers, and pet owners organize and care for their animals efficiently.
                    From tracking pet records and adoption requests to managing staff and daily operations — everything you need
                    is in one place. Simplify your workflow, stay organized, and give every pet the best care possible with AdoptMe.
                </p>
            </div>

            <!-- CTA Section -->
            <div class="text-center">
                <a href="{{ route('myDashboard') }}"
                   class="inline-flex items-center px-8 py-4 bg-blue-600 hover:bg-blue-700 text-white font-semibold rounded-xl shadow-lg transition-all duration-300 transform hover:scale-105 hover:shadow-xl mb-5">
                    Go to Dashboard
                </a>

                <p class="mt-10 text-gray-500 dark:text-gray-400 text-sm">
                    Join shelters and pet owners managing their animals efficiently with <a href="" class="font-semibold text-blue-500">AdoptMe</a>
                </p>
            </div>
        </div>

        <!-- Footer -->
        <footer class="mt-16 text-center text-gray-500 dark:text-gray-600 text-sm">
            <p>© 2025 AdoptMe. All rights reserved. Made with for Pets</p>
        </footer>
    </div>
</body>
</html>
