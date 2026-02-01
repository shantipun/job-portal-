<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vendor Register | JobNest</title>

    <!-- Tailwind CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body>

<div class="min-h-screen flex items-center justify-center bg-gradient-to-br from-blue-50 via-white to-indigo-50 px-4">
    <div class="w-full max-w-md">

        <div class="bg-white/90 backdrop-blur rounded-3xl shadow-2xl p-8">

            <h2 class="text-2xl font-bold text-center text-gray-800">
                Vendor Registration
            </h2>
            <p class="text-center text-gray-500 mb-6">
                Create your company account on JobNest
            </p>

            {{-- Validation Errors --}}
            @if ($errors->any())
                <div class="mb-4 rounded-xl bg-red-50 border border-red-200 text-red-600 px-4 py-3 text-sm">
                    <ul class="list-disc pl-5">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            {{-- Vendor Register Form --}}
            <form method="POST" action="{{ route('vendor.register.submit') }}" enctype="multipart/form-data" class="space-y-4">
                @csrf

                <!-- Name -->
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1">Your Name</label>
                    <input type="text" name="name" value="{{ old('name') }}" required
                        class="w-full rounded-xl border border-gray-300 px-4 py-2 focus:ring-2 focus:ring-blue-200 outline-none">
                </div>

                <!-- Company Name -->
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1">Company Name</label>
                    <input type="text" name="company_name" value="{{ old('company_name') }}" required
                        class="w-full rounded-xl border border-gray-300 px-4 py-2 focus:ring-2 focus:ring-blue-200 outline-none">
                </div>

                <!-- Email -->
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1">Email Address</label>
                    <input type="email" name="email" value="{{ old('email') }}" required
                        class="w-full rounded-xl border border-gray-300 px-4 py-2 focus:ring-2 focus:ring-blue-200 outline-none">
                </div>

                <!-- Password -->
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1">Password</label>
                    <input type="password" name="password" required
                        class="w-full rounded-xl border border-gray-300 px-4 py-2 focus:ring-2 focus:ring-blue-200 outline-none">
                </div>

                <!-- Confirm Password -->
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1">Confirm Password</label>
                    <input type="password" name="password_confirmation" required
                        class="w-full rounded-xl border border-gray-300 px-4 py-2 focus:ring-2 focus:ring-blue-200 outline-none">
                </div>

                <!-- Phone -->
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1">Phone</label>
                    <input type="text" name="phone" value="{{ old('phone') }}" placeholder="+977 98XXXXXXXX"
                        class="w-full rounded-xl border border-gray-300 px-4 py-2 focus:ring-2 focus:ring-blue-200 outline-none">
                </div>

                <!-- Website -->
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1">Website</label>
                    <input type="url" name="website" value="{{ old('website') }}" placeholder="https://company.com"
                        class="w-full rounded-xl border border-gray-300 px-4 py-2 focus:ring-2 focus:ring-blue-200 outline-none">
                </div>

                <!-- Location -->
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1">Location</label>
                    <input type="text" name="location" value="{{ old('location') }}" placeholder="Kathmandu, Nepal"
                        class="w-full rounded-xl border border-gray-300 px-4 py-2 focus:ring-2 focus:ring-blue-200 outline-none">
                </div>

                <!-- Company Image -->
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1">Company Logo</label>
                    <input type="file" name="image" accept="image/*"
                        class="w-full text-sm text-gray-700">
                </div>

                <!-- Submit -->
                <button type="submit"
                    class="w-full bg-gradient-to-r from-blue-600 to-indigo-600 hover:from-blue-700 hover:to-indigo-700 text-white font-semibold py-3 rounded-xl shadow-lg transition">
                    Register as Vendor
                </button>
            </form>

            <!-- Footer -->
            <p class="text-center text-sm text-gray-500 mt-6">
                Already a vendor?
                <a href="{{ route('vendor.login') }}" class="text-blue-600 font-semibold hover:underline">
                    Login here
                </a>
            </p>

        </div>
    </div>
</div>

</body>
</html>
