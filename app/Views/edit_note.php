<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Note - Note App</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50">
    <!-- Navigation Bar -->
    <nav class="bg-white shadow">
        <div class="max-w-7xl mx-auto px-4 py-4 flex justify-between items-center">
            <div>
                <h1 class="text-2xl font-bold text-gray-800">Note App</h1>
                <p class="text-gray-600 text-sm">Welcome, <?= session()->get('user_name') ?></p>
            </div>
            <a 
                href="/auth/logout" 
                class="bg-red-600 hover:bg-red-700 text-white font-semibold py-2 px-4 rounded-lg transition"
            >
                Logout
            </a>
        </div>
    </nav>

    <!-- Main Content -->
    <div class="max-w-7xl mx-auto px-4 py-8">
        <div class="flex justify-between items-center mb-6">
            <h2 class="text-2xl font-bold text-gray-800">Edit Note</h2>
            <a href="/dashboard" class="bg-gray-600 hover:bg-gray-700 text-white font-semibold py-2 px-4 rounded-lg transition">
                Back to Dashboard
            </a>
        </div>

        <!-- Success/Error Messages -->
        <?php if (session()->getFlashdata('success')): ?>
            <div class="mb-6 p-4 bg-green-100 border border-green-400 text-green-700 rounded-lg">
                <?= session()->getFlashdata('success') ?>
            </div>
        <?php endif; ?>

        <?php if (session()->getFlashdata('error')): ?>
            <div class="mb-6 p-4 bg-red-100 border border-red-400 text-red-700 rounded-lg">
                <?= session()->getFlashdata('error') ?>
            </div>
        <?php endif; ?>

        <!-- Edit Note Form -->
        <div class="bg-white rounded-xl shadow-md p-6">
            <form method="POST" action="/note/update/<?= $note['id'] ?>" class="space-y-4">
                <div>
                    <label for="title" class="block text-sm font-medium text-gray-700 mb-2">Title</label>
                    <input 
                        type="text" 
                        id="title" 
                        name="title" 
                        required
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent outline-none transition"
                        placeholder="Enter note title"
                        value="<?= htmlspecialchars($note['title']) ?>"
                    >
                </div>

                <div>
                    <label for="content" class="block text-sm font-medium text-gray-700 mb-2">Content</label>
                    <textarea 
                        id="content" 
                        name="content" 
                        required
                        rows="10"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent outline-none transition resize-vertical"
                        placeholder="Write your note here..."
                    ><?= htmlspecialchars($note['content']) ?></textarea>
                </div>

                <div class="flex space-x-4">
                    <button 
                        type="submit" 
                        class="bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-6 rounded-lg transition"
                    >
                        Update Note
                    </button>
                    <a 
                        href="/dashboard" 
                        class="bg-gray-600 hover:bg-gray-700 text-white font-semibold py-2 px-6 rounded-lg transition"
                    >
                        Cancel
                    </a>
                </div>
            </form>
        </div>
    </div>
</body>
</html>