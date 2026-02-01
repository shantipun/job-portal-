<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>JobNest Forgot Password</title>

    @stack('title')

    <!-- Tailwind CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gradient-to-br from-blue-50 via-white to-indigo-50 min-h-screen flex items-center justify-center px-4">

    <div class="w-full max-w-md">

        <!-- Logo -->
        <div class="text-center mb-6">
            <h1 class="text-3xl font-extrabold text-blue-600 tracking-wide">JobNest</h1>
            <p class="text-sm text-gray-600">Find jobs. Build careers.</p>
        </div>

        <!-- Card -->
        <div class="bg-white/90 backdrop-blur rounded-3xl shadow-2xl p-8">

            <h2 class="text-2xl font-bold text-center text-gray-800">
                Forgot Password? 🔑
            </h2>
            <p class="text-center text-gray-500 mb-6">
                Enter your email to reset your password
            </p>

            <!-- Success Message -->
            @if(session('status'))
                <div class="mb-4 rounded-xl bg-green-50 border border-green-200 text-green-600 px-4 py-3 text-sm">
                    {{ session('status') }}
                </div>
            @endif

            <!-- Error Message -->
            @if($errors->any())
                <div class="mb-4 rounded-xl bg-red-50 border border-red-200 text-red-600 px-4 py-3 text-sm">
                    {{ $errors->first() }}
                </div>
            @endif

            <!-- Form -->
            <form method="POST" action="{{ route('password.email') }}" class="space-y-5">
                @csrf

                <!-- Email -->
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1">Email address</label>
                    <input type="email" name="email" required placeholder="you@example.com"
                        class="w-full rounded-xl border border-gray-300 px-4 py-3 text-sm
                               focus:border-blue-500 focus:ring-2 focus:ring-blue-200 outline-none">
                </div>

                <!-- Submit Button -->
                <button type="submit"
                    class="w-full bg-gradient-to-r from-blue-600 to-indigo-600
                           hover:from-blue-700 hover:to-indigo-700
                           text-white font-semibold py-3 rounded-xl transition duration-200 shadow-lg">
                    Send Reset Link
                </button>
            </form>

            <!-- Footer -->
            <p class="text-center text-sm text-gray-500 mt-8">
                Remembered your password?
                <a href="{{ route('login') }}" class="text-blue-600 font-semibold hover:underline">
                    Log in
                </a>
            </p>
        </div>

    </div>

</body>
</html>
