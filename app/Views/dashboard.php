<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Note App</title>
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

        <!-- Create Note Section -->
        <div class="bg-white rounded-xl shadow-md p-6 mb-8">
            <h2 class="text-xl font-bold text-gray-800 mb-4">Create New Note</h2>
            <form method="POST" action="/note/create" class="space-y-4">
                <div>
                    <label for="title" class="block text-sm font-medium text-gray-700 mb-2">Title</label>
                    <input 
                        type="text" 
                        id="title" 
                        name="title" 
                        required
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent outline-none transition"
                        placeholder="Enter note title"
                    >
                </div>

                <div>
                    <label for="content" class="block text-sm font-medium text-gray-700 mb-2">Content</label>
                    <textarea 
                        id="content" 
                        name="content" 
                        required
                        rows="5"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent outline-none transition resize-vertical"
                        placeholder="Write your note here..."
                    ></textarea>
                </div>

                <button 
                    type="submit" 
                    class="bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-6 rounded-lg transition"
                >
                    Save Note
                </button>
            </form>
        </div>

        <!-- Notes List Section -->
        <div>
            <h2 class="text-xl font-bold text-gray-800 mb-4">Your Notes (<?= count($notes) ?>)</h2>
            
            <?php if (empty($notes)): ?>
                <div class="bg-white rounded-xl shadow-md p-8 text-center">
                    <p class="text-gray-500 text-lg">No notes yet. Create your first note above!</p>
                </div>
            <?php else: ?>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    <?php foreach ($notes as $note): ?>
                        <div class="bg-white rounded-xl shadow-md p-6 hover:shadow-lg transition">
                            <h3 class="text-lg font-bold text-gray-800 mb-2"><?= htmlspecialchars($note['title']) ?></h3>
                            <p class="text-gray-600 text-sm mb-4 line-clamp-4"><?= htmlspecialchars($note['content']) ?></p>
                            <p class="text-gray-400 text-xs mb-4">
                                Created: <?= date('M d, Y H:i', strtotime($note['created_at'])) ?>
                            </p>
                            <a 
                                href="/note/delete/<?= $note['id'] ?>" 
                                onclick="return confirm('Are you sure you want to delete this note?');"
                                class="inline-block bg-red-600 hover:bg-red-700 text-white font-semibold py-1 px-4 rounded-lg transition text-sm"
                            >
                                Delete
                            </a>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>
        </div>
    </div>
</body>
</html>
