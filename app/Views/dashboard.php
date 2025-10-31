<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Note App</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        .line-clamp-4 {
            display: -webkit-box;
            -webkit-line-clamp: 4;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }
    </style>
</head>
<body class="bg-slate-50">
    <!-- Navigation Bar -->
    <nav class="bg-blue-600 text-white shadow">
        <div class="max-w-7xl mx-auto px-4 py-4 flex justify-between items-center">
            <div>
                <h1 class="text-2xl font-bold">Note App</h1>
                <p class="text-blue-100 text-sm">Welcome, <?= session()->get('user_name') ?></p>
            </div>
            <a 
                href="/auth/logout" 
                class="bg-red-500 hover:bg-red-600 text-white font-semibold py-2 px-4 rounded transition"
            >
                Logout
            </a>
        </div>
    </nav>

    <!-- Main Content -->
    <div class="max-w-7xl mx-auto px-4 py-8">
        <!-- Success/Error Messages -->
        <?php if (session()->getFlashdata('success')): ?>
            <div class="mb-6 p-4 bg-green-100 border-l-4 border-green-500 text-green-700 rounded">
                <?= session()->getFlashdata('success') ?>
            </div>
        <?php endif; ?>

        <?php if (session()->getFlashdata('error')): ?>
            <div class="mb-6 p-4 bg-red-100 border-l-4 border-red-500 text-red-700 rounded">
                <?= session()->getFlashdata('error') ?>
            </div>
        <?php endif; ?>

        <!-- Create Note Section -->
        <div class="flex justify-between items-center mb-6">
            <h2 class="text-2xl font-bold text-gray-800">My Notes</h2>
            <button 
                onclick="openCreateModal()" 
                class="bg-blue-500 hover:bg-blue-600 text-white font-semibold py-2 px-6 rounded transition"
            >
                + Add Note
            </button>
        </div>

        <!-- Notes List Section -->
        <div>
            <h2 class="text-lg font-semibold text-blue-700 mb-4">Your Notes (<?= count($notes) ?>)</h2>
            
            <?php if (empty($notes)): ?>
                <div class="bg-white rounded-lg shadow p-8 text-center border-t-4 border-blue-400">
                    <p class="text-gray-500">No notes yet. Create your first note above!</p>
                </div>
            <?php else: ?>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    <?php foreach ($notes as $note): ?>
                        <div class="bg-white rounded-lg shadow hover:shadow-lg transition p-6 flex flex-col border-t-4 border-blue-400">
                            <div class="flex justify-between items-start mb-3">
                                <h3 class="text-lg font-semibold text-gray-800"><?= htmlspecialchars($note['title']) ?></h3>
                                <?php if ($note['pinned']): ?>
                                    <a href="/note/toggle-pin/<?= $note['id'] ?>" class="text-yellow-400 hover:text-yellow-500">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                        </svg>
                                    </a>
                                <?php else: ?>
                                    <a href="/note/toggle-pin/<?= $note['id'] ?>" class="text-gray-300 hover:text-gray-400">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                        </svg>
                                    </a>
                                <?php endif; ?>
                            </div>
                            
                            <p class="text-gray-400 text-xs mb-3">
                                <?= date('M d, Y H:i', strtotime($note['created_at'])) ?>
                            </p>
                            
                            <p class="text-gray-600 text-sm mb-4 line-clamp-4 flex-grow"><?= htmlspecialchars($note['content']) ?></p>
                            
                            <div class="flex justify-end gap-2 mt-auto">
                                <button 
                                    onclick="openEditModal(<?= $note['id'] ?>, '<?= htmlspecialchars(addslashes($note['title'])) ?>', '<?= htmlspecialchars(addslashes($note['content'])) ?>');" 
                                    class="bg-blue-500 hover:bg-blue-600 text-white font-semibold py-1 px-4 rounded text-sm transition"
                                >
                                    Edit
                                </button>
                                <a 
                                    href="/note/delete/<?= $note['id'] ?>" 
                                    onclick="return confirm('Are you sure you want to delete this note?');"
                                    class="bg-red-500 hover:bg-red-600 text-white font-semibold py-1 px-4 rounded text-sm transition"
                                >
                                    Delete
                                </a>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>
        </div>
    </div>

    <!-- Create Note Modal -->
    <div id="createModal" class="hidden fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50">
        <div class="bg-white rounded-lg shadow-lg p-8 w-full max-w-md mx-4">
            <h2 class="text-2xl font-bold mb-6">Create New Note</h2>
            <form method="POST" action="/note/create" class="space-y-4">
                <div>
                    <label for="createTitle" class="block text-sm font-medium text-gray-700 mb-2">Title</label>
                    <input 
                        type="text" 
                        id="createTitle" 
                        name="title" 
                        required
                        class="w-full px-4 py-2 border-2 border-gray-200 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent outline-none transition"
                        placeholder="Enter note title"
                    >
                </div>

                <div>
                    <label for="createContent" class="block text-sm font-medium text-gray-700 mb-2">Content</label>
                    <textarea 
                        id="createContent" 
                        name="content" 
                        required
                        rows="5"
                        class="w-full px-4 py-2 border-2 border-gray-200 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent outline-none transition resize-vertical"
                        placeholder="Write your note here..."
                    ></textarea>
                </div>

                <div class="flex space-x-4">
                    <button 
                        type="submit" 
                        class="flex-1 bg-blue-500 hover:bg-blue-600 text-white font-semibold py-2 px-6 rounded-lg transition"
                    >
                        Save Note
                    </button>
                    <button 
                        type="button" 
                        onclick="closeCreateModal()" 
                        class="flex-1 bg-gray-300 hover:bg-gray-400 text-gray-800 font-semibold py-2 px-6 rounded-lg transition"
                    >
                        Cancel
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Edit Note Modal -->
    <div id="editModal" class="hidden fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50">
        <div class="bg-white rounded-lg shadow-lg p-8 w-full max-w-md mx-4 border-t-4 border-indigo-500">
            <h2 class="text-2xl font-bold text-indigo-600 mb-6">Edit Note</h2>
            <form id="editForm" method="POST" class="space-y-4">
                <div>
                    <label for="editTitle" class="block text-sm font-medium text-gray-700 mb-2">Title</label>
                    <input 
                        type="text" 
                        id="editTitle" 
                        name="title" 
                        required
                        class="w-full px-4 py-2 border-2 border-gray-200 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent outline-none transition"
                        placeholder="Enter note title"
                    >
                </div>

                <div>
                    <label for="editContent" class="block text-sm font-medium text-gray-700 mb-2">Content</label>
                    <textarea 
                        id="editContent" 
                        name="content" 
                        required
                        rows="5"
                        class="w-full px-4 py-2 border-2 border-gray-200 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent outline-none transition resize-vertical"
                        placeholder="Write your note here..."
                    ></textarea>
                </div>

                <div class="flex space-x-4">
                    <button 
                        type="submit" 
                        class="flex-1 bg-indigo-500 hover:bg-indigo-600 text-white font-semibold py-2 px-6 rounded-lg transition"
                    >
                        Update Note
                    </button>
                    <button 
                        type="button" 
                        onclick="closeEditModal()" 
                        class="flex-1 bg-gray-300 hover:bg-gray-400 text-gray-800 font-semibold py-2 px-6 rounded-lg transition"
                    >
                        Cancel
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Modal Scripts -->
    <script>
        function openCreateModal() {
            document.getElementById('createModal').classList.remove('hidden');
            document.getElementById('createTitle').focus();
        }

        function closeCreateModal() {
            document.getElementById('createModal').classList.add('hidden');
            document.getElementById('createTitle').value = '';
            document.getElementById('createContent').value = '';
        }

        function openEditModal(id, title, content) {
            document.getElementById('editModal').classList.remove('hidden');
            document.getElementById('editTitle').value = title;
            document.getElementById('editContent').value = content;
            document.getElementById('editForm').action = '/note/update/' + id;
            document.getElementById('editTitle').focus();
        }

        function closeEditModal() {
            document.getElementById('editModal').classList.add('hidden');
            document.getElementById('editTitle').value = '';
            document.getElementById('editContent').value = '';
        }

        // Close modals when clicking outside
        window.onclick = function(event) {
            const createModal = document.getElementById('createModal');
            const editModal = document.getElementById('editModal');
            
            if (event.target == createModal) {
                closeCreateModal();
            }
            if (event.target == editModal) {
                closeEditModal();
            }
        };
    </script>
</body>
</html>