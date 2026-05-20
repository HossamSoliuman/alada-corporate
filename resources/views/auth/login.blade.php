<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-gray-100 min-h-screen flex items-center justify-center">

    <div class="w-[50vw] bg-white rounded-2xl shadow-lg p-8">
        <div class="mb-8 text-center">
            <h1 class="text-2xl font-bold text-gray-800">Admin Panel</h1>
            <p class="text-sm text-gray-500 mt-1">Sign in to your account</p>
        </div>

        {{-- Session Status --}}
        @if (session('status'))
            <div class="mb-4 text-sm text-green-600 bg-green-50 border border-green-200 rounded-lg px-4 py-3">
                {{ session('status') }}
            </div>
        @endif

        <form method="POST" action="{{ route('login') }}">
            @csrf

            {{-- Email --}}
            <div class="mb-5">
                <label for="email" class="block text-sm font-medium text-gray-700 mb-1">
                    Email Address
                </label>
                <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus
                    autocomplete="username"
                    class="w-full px-4 py-2.5 border border-gray-300 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent @error('email') border-red-400 @enderror"
                    placeholder="admin@example.com">
                @error('email')
                    <p class="mt-1.5 text-xs text-red-500">{{ $message }}</p>
                @enderror
            </div>

            {{-- Password --}}
            <div class="mb-5">
                <label for="password" class="block text-sm font-medium text-gray-700 mb-1">
                    Password
                </label>
                <input id="password" type="password" name="password" required autocomplete="current-password"
                    class="w-full px-4 py-2.5 border border-gray-300 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent @error('password') border-red-400 @enderror"
                    placeholder="••••••••">
                @error('password')
                    <p class="mt-1.5 text-xs text-red-500">{{ $message }}</p>
                @enderror
            </div>

            {{-- Remember Me --}}
            <div class="flex items-center justify-between mb-6">
                <label for="remember_me" class="flex items-center gap-2 cursor-pointer">
                    <input id="remember_me" type="checkbox" name="remember"
                        class="rounded border-gray-300 text-indigo-600 focus:ring-indigo-500">
                    <span class="text-sm text-gray-600">Remember me</span>
                </label>

                @if (Route::has('password.request'))
                    <a href="{{ route('password.request') }}"
                        class="text-sm text-indigo-600 hover:text-indigo-800 hover:underline">
                        Forgot password?
                    </a>
                @endif
            </div>

            {{-- Submit --}}
            <button type="submit"
                class="w-full bg-indigo-600 hover:bg-indigo-700 text-white font-medium py-2.5 rounded-lg text-sm transition duration-150 cursor-pointer">
                Sign In
            </button>

        </form>
    </div>

</body>

</html>
