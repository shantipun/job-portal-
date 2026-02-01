<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    
    @stack('title')

    <!-- Tailwind CDN (REQUIRED) -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Bootstrap (optional) -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    
<div class="min-h-screen flex items-center justify-center bg-gradient-to-br from-blue-50 via-white to-indigo-50 px-4">
    <div class="w-full max-w-md">

        <div class="bg-white/90 backdrop-blur rounded-3xl shadow-2xl p-8">

            <h2 class="text-2xl font-bold text-center text-gray-800">Create an account</h2>
            <p class="text-center text-gray-500 mb-6">Sign up to start your JobNest journey</p>

            <!-- Validation Errors -->
            @if ($errors->any())
                <div class="mb-4 rounded-xl bg-red-50 border border-red-200 text-red-600 px-4 py-3 text-sm">
                    <ul class="list-disc pl-5">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <!-- Register Form -->
           <form method="POST" action="{{ route('register.submit') }}" class="space-y-4" enctype="multipart/form-data">
    @csrf

    <!-- Name -->
    <div>
        <label class="block text-sm font-semibold text-gray-700 mb-1">Full Name</label>
        <input type="text" name="name" required placeholder="shanti pun"
            class="w-full rounded-xl border border-gray-300 px-4 py-2 focus:border-blue-500 focus:ring-2 focus:ring-blue-200 outline-none">
    </div>

    <!-- Email -->
    <div>
        <label class="block text-sm font-semibold text-gray-700 mb-1">Email address</label>
        <input type="email" name="email" required placeholder="shanti@gmail.com"
            class="w-full rounded-xl border border-gray-300 px-4 py-2 focus:border-blue-500 focus:ring-2 focus:ring-blue-200 outline-none">
    </div>

    <!-- Password -->
    <div class="relative">
        <label class="block text-sm font-semibold text-gray-700 mb-1">Password</label>
        <input type="password" name="password" id="password" required placeholder="••••••••"
            class="w-full rounded-xl border border-gray-300 px-4 py-2 focus:border-blue-500 focus:ring-2 focus:ring-blue-200 outline-none pr-10">
        <button type="button" onclick="togglePassword()" class="absolute right-4 top-10 text-gray-500 hover:text-blue-600">👁️</button>
    </div>

    <!-- Confirm Password -->
    <div class="relative">
        <label class="block text-sm font-semibold text-gray-700 mb-1">Confirm Password</label>
        <input type="password" name="password_confirmation" id="confirm_password" required placeholder="••••••••"
            class="w-full rounded-xl border border-gray-300 px-4 py-2 focus:border-blue-500 focus:ring-2 focus:ring-blue-200 outline-none pr-10">
        <button type="button" onclick="toggleConfirmPassword()" class="absolute right-4 top-10 text-gray-500 hover:text-blue-600">👁️</button>
    </div>

    <!-- Phone -->
    <div>
        <label class="block text-sm font-semibold text-gray-700 mb-1">Phone</label>
        <input type="text" name="phone" placeholder="+977 98XXXXXXXX"
            class="w-full rounded-xl border border-gray-300 px-4 py-2 focus:border-blue-500 focus:ring-2 focus:ring-blue-200 outline-none">
    </div>

    <!-- Location -->
    <div>
        <label class="block text-sm font-semibold text-gray-700 mb-1">Location</label>
        <input type="text" name="location" placeholder="Kathmandu, Nepal"
            class="w-full rounded-xl border border-gray-300 px-4 py-2 focus:border-blue-500 focus:ring-2 focus:ring-blue-200 outline-none">
    </div>

    

    <!-- Bio -->
    <div>
        <label class="block text-sm font-semibold text-gray-700 mb-1">Short Bio</label>
        <textarea name="bio" placeholder="Write a short bio..." rows="3"
            class="w-full rounded-xl border border-gray-300 px-4 py-2 focus:border-blue-500 focus:ring-2 focus:ring-blue-200 outline-none"></textarea>
    </div>

    <!-- Profile Image -->
    <div>
        <label class="block text-sm font-semibold text-gray-700 mb-1">Profile Image</label>
        <input type="file" name="profile_image" accept="image/*"
            class="w-full text-sm text-gray-700">
    </div>

  
<!-- Role -->
<div>
    <label class="block text-sm font-semibold text-gray-700 mb-1">Register As</label>
    <select name="role" required
        class="w-full rounded-xl border border-gray-300 px-4 py-2 focus:border-blue-500 focus:ring-2 focus:ring-blue-200 outline-none">
        <option value="user">Job Seeker</option>
        <option value="vendor">Employer</option>
          
    </select>
</div>


    <!-- Submit Button -->
    <button type="submit" class="w-full bg-gradient-to-r from-blue-600 to-indigo-600 hover:from-blue-700 hover:to-indigo-700 text-white font-semibold py-3 rounded-xl transition duration-200 shadow-lg">
        Create Account
    </button>
</form>


            <!-- Footer -->
            <p class="text-center text-sm text-gray-500 mt-8">
                Already have an account?
                <a href="{{ route('login') }}" class="text-blue-600 font-semibold hover:underline">Sign in</a>
            </p>
        </div>
    </div>
</div>
<script>
    function togglePassword() {
        const password = document.getElementById('password');
        const type = password.type === 'password' ? 'text' : 'password';
        password.type = type;
    }

    function toggleConfirmPassword() {
        const confirm = document.getElementById('confirm_password');
        const type = confirm.type === 'password' ? 'text' : 'password';
        confirm.type = type;
    }
</script>


</body>
</html>