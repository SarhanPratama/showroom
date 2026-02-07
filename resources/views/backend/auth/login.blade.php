<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Login Admin - Showroom Executive</title>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700&display=swap"
        rel="stylesheet" />
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js" defer></script>

    <style>
        body {
            font-family: 'Outfit', sans-serif;
        }

        /* Custom Animations */
        @keyframes float {
            0% {
                transform: translateY(0px);
            }

            50% {
                transform: translateY(-20px);
            }

            100% {
                transform: translateY(0px);
            }
        }

        .animate-float {
            animation: float 6s ease-in-out infinite;
        }

        .glass-card {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(16px);
            -webkit-backdrop-filter: blur(16px);
            border: 1px solid rgba(255, 255, 255, 0.2);
            box-shadow: 0 8px 32px 0 rgba(0, 0, 0, 0.37);
        }

        .input-glass {
            background: rgba(255, 255, 255, 0.05);
            border: 1px solid rgba(255, 255, 255, 0.1);
            color: white;
            transition: all 0.3s ease;
        }

        .input-glass:focus {
            background: rgba(255, 255, 255, 0.1);
            border-color: #a855f7;
            box-shadow: 0 0 15px rgba(168, 85, 247, 0.3);
            outline: none;
        }

        /* Animated Background Gradient */
        .bg-animated {
            background: linear-gradient(-45deg, #0f172a, #1e1b4b, #312e81, #0f172a);
            background-size: 400% 400%;
            animation: gradientBG 15s ease infinite;
        }

        @keyframes gradientBG {
            0% {
                background-position: 0% 50%;
            }

            50% {
                background-position: 100% 50%;
            }

            100% {
                background-position: 0% 50%;
            }
        }
    </style>
</head>

<body>
    <div class="flex items-center justify-center min-h-screen bg-animated relative overflow-hidden">

        <!-- Decorative Background Elements -->
        <div class="absolute top-0 left-0 w-full h-full overflow-hidden pointer-events-none">
            <div class="absolute top-1/4 left-1/4 w-96 h-96 bg-purple-600 rounded-full mix-blend-multiply filter blur-3xl opacity-20 animate-float"
                style="animation-delay: 0s;"></div>
            <div class="absolute bottom-1/4 right-1/4 w-96 h-96 bg-blue-600 rounded-full mix-blend-multiply filter blur-3xl opacity-20 animate-float"
                style="animation-delay: 2s;"></div>
            <div class="absolute -top-10 right-10 w-72 h-72 bg-pink-600 rounded-full mix-blend-multiply filter blur-3xl opacity-20 animate-float"
                style="animation-delay: 4s;"></div>
        </div>

        <!-- Login Card -->
        <div class="relative w-full max-w-md p-8 glass-card rounded-2xl mx-4 z-10">
            <div class="flex flex-col items-center mb-8">
                <!-- Branding / Logo -->
                <div class="p-3 mb-4 bg-gradient-to-tr from-purple-500 to-blue-500 rounded-full shadow-lg">
                    <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                        xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 6V4m0 2a2 2 0 100 4m0-4a2 2 0 110 4m-6 8a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4m6 6v10m6-2a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4">
                        </path>
                    </svg>
                </div>
                <h1 class="text-3xl font-bold text-transparent bg-clip-text bg-gradient-to-r from-white to-gray-400">
                    Showroom Admin
                </h1>
                <p class="mt-2 text-sm text-gray-400">Welcome back, please login only for admin</p>
            </div>

            @if($errors->any())
                <div class="mb-4 p-3 rounded-lg bg-red-500/10 border border-red-500/20 text-red-200 text-sm">
                    <ul class="list-disc list-inside">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('admin.login.submit') }}" method="POST" class="space-y-6">
                @csrf
                <div>
                    <label class="block mb-2 text-sm font-medium text-gray-300">Email Address</label>
                    <input class="w-full px-4 py-3 text-sm rounded-lg input-glass placeholder-gray-500"
                        placeholder="admin@showroom.com" name="email" type="email" required
                        value="{{ old('email') }}" />
                </div>
                <div x-data="{ show: false }">
                    <label class="block mb-2 text-sm font-medium text-gray-300">Password</label>
                    <div class="relative">
                        <input :type="show ? 'text' : 'password'"
                            class="w-full px-4 py-3 text-sm rounded-lg input-glass placeholder-gray-500 pr-10"
                            placeholder="••••••••" name="password" required />
                        <button type="button" @click="show = !show"
                            class="absolute inset-y-0 right-0 flex items-center px-3 text-gray-400 hover:text-white focus:outline-none transition-colors duration-200">
                            <!-- Eye Icon (Show) -->
                            <svg x-show="!show" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z">
                                </path>
                            </svg>
                            <!-- Eye Slash Icon (Hide) -->
                            <svg x-show="show" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                style="display: none;">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21">
                                </path>
                            </svg>
                        </button>
                    </div>
                </div>

                <div class="flex items-center justify-between mt-4">
                    <label class="flex items-center text-sm text-gray-400 cursor-pointer hover:text-gray-300">
                        <input type="checkbox" name="remember"
                            class="w-4 h-4 text-purple-600 bg-gray-800 border-gray-700 rounded focus:ring-purple-500 focus:ring-offset-gray-900">
                        <span class="ml-2">Remember me</span>
                    </label>
                    <a class="text-sm font-medium text-purple-400 hover:text-purple-300 hover:underline" href="#">
                        Forgot password?
                    </a>
                </div>

                <button type="submit"
                    class="w-full px-4 py-3 text-sm font-bold text-white transition-all duration-200 transform bg-gradient-to-r from-purple-600 to-blue-600 rounded-lg hover:from-purple-500 hover:to-blue-500 hover:scale-[1.02] focus:outline-none focus:ring-2 focus:ring-purple-500 focus:ring-offset-2 focus:ring-offset-gray-900 shadow-lg shadow-purple-900/30">
                    Sign In
                </button>
            </form>

            <div class="mt-8 text-center">
                <p class="text-xs text-gray-500">
                    &copy; {{ date('Y') }} Showroom Executive. All rights reserved.
                </p>
            </div>
        </div>
    </div>
</body>

</html>