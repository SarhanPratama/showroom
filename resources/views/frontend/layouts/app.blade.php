<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manunggal Mobilindo - Jual Beli Mobil Bekas Berkualitas di Pekanbaru</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @stack('css')
</head>
<body class="bg-gray-50 smooth-scroll">
    <!-- Navigation -->
    @include('frontend.layouts.navbar')

    @yield('content')

    <!-- Footer -->
    @include('frontend.layouts.footer')

    <!-- WhatsApp Floating Button -->
    <a href="https://wa.me/6281380846977" target="_blank" class="fixed bottom-8 right-8 bg-green-500 text-white p-4 rounded-full shadow-2xl hover:bg-green-600 transition transform hover:scale-110 z-40">
        <i class="fab fa-whatsapp text-3xl"></i>
    </a>

    @stack('scripts')
</html>
