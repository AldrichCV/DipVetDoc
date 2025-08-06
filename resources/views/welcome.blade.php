<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome | PetCare Booking</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100 text-gray-800">

    <!-- Navbar -->
    <nav class="bg-white shadow-md p-4 flex justify-between items-center">
        <div class="text-2xl font-bold text-blue-600">
            PetCare
        </div>
        <div>
            <a href="{{ route('login') }}" class="text-blue-500 hover:text-blue-700 font-semibold mr-4">Login</a>
            <a href="{{ route('register') }}" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">Register</a>
        </div>
    </nav>

    <!-- Welcome Message -->
    <div class="flex items-center justify-center h-screen">
        <div class="text-center">
            <h1 class="text-4xl font-bold mb-4">Welcome to PetCare Booking System 🐾</h1>
            <p class="text-lg text-gray-600">Book appointments for your pets with ease and convenience.</p>
        </div>
    </div>

</body>
</html>
