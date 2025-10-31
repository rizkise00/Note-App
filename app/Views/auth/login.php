<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Note App</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gradient-to-br from-blue-50 to-indigo-100 min-h-screen flex items-center justify-center p-4">
    <div class="w-full max-w-md">
        <div class="bg-white rounded-2xl shadow-2xl p-8">
            <h1 class="text-3xl font-bold text-center text-gray-800 mb-2">Note App</h1>
            <p class="text-center text-gray-500 text-sm mb-8">Welcome back! Sign in to your account</p>

            <?php if (session()->getFlashdata('success')): ?>
                <div class="mb-6 p-4 bg-green-100 border border-green-400 text-green-700 rounded-lg text-sm">
                    <?= session()->getFlashdata('success') ?>
                </div>
            <?php endif; ?>

            <?php if (isset($error)): ?>
                <div class="mb-6 p-4 bg-red-100 border border-red-400 text-red-700 rounded-lg text-sm">
                    <?= $error ?>
                </div>
            <?php endif; ?>

            <form method="POST" action="/auth/do-login" class="space-y-4">
                <div>
                    <label for="email" class="block text-sm font-medium text-gray-700 mb-2">Email Address</label>
                    <input 
                        type="email" 
                        id="email" 
                        name="email" 
                        required
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent outline-none transition"
                        placeholder="you@example.com"
                    >
                    <?php if (isset($errors['email'])): ?>
                        <p class="text-red-500 text-xs mt-1"><?= $errors['email'] ?></p>
                    <?php endif; ?>
                </div>

                <div>
                    <label for="password" class="block text-sm font-medium text-gray-700 mb-2">Password</label>
                    <input 
                        type="password" 
                        id="password" 
                        name="password" 
                        required
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent outline-none transition"
                        placeholder="••••••••"
                    >
                    <?php if (isset($errors['password'])): ?>
                        <p class="text-red-500 text-xs mt-1"><?= $errors['password'] ?></p>
                    <?php endif; ?>
                </div>

                <button 
                    type="submit" 
                    class="w-full bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-4 rounded-lg transition duration-200 mt-6"
                >
                    Sign In
                </button>
            </form>

            <p class="text-center text-gray-600 text-sm mt-6">
                Don't have an account? 
                <a href="/auth/register" class="text-blue-600 hover:text-blue-700 font-semibold">Create one</a>
            </p>
        </div>
    </div>
</body>
</html>
