<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>PHP MVC CRUD</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-50 text-gray-900">

    <header class="bg-white shadow">
        <div class="container mx-auto px-4 py-4 flex justify-between items-center">
            <h1 class="text-xl font-bold text-blue-600">PHP MVC CRUD</h1>

            <nav class="space-x-4 text-sm">
                <a href="<?= BASE_URL ?>/?action=index" class="text-gray-700 hover:text-blue-500">Users</a>
                <a href="<?= BASE_URL ?>/?action=paginated" class="text-gray-700 hover:text-blue-500">Paginated</a>

                <?php if (isset($_SESSION['user'])): ?>
                    <span class="text-gray-500">Hi, <?= htmlspecialchars($_SESSION['user']) ?></span>
                    <a href="<?= BASE_URL ?>/?action=logout" class="text-red-600 hover:underline">Logout</a>
                <?php else: ?>
                    <a href="<?= BASE_URL ?>/?action=loginForm" class="text-blue-600 hover:underline">Login</a>
                    <a href="<?= BASE_URL ?>/?action=registerForm" class="text-blue-600 hover:underline">Register</a>
                <?php endif; ?>
            </nav>
        </div>
    </header>