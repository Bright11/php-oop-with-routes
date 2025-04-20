<?php include __DIR__ . '/../layout/header.php'; ?>

<div class="max-w-md mx-auto mt-10 p-6 bg-white rounded shadow">
    <h2 class="text-2xl font-bold mb-4">Login</h2>

    <?php if ($msg = $_SESSION['error'] ?? null): ?>
        <div class="bg-red-100 text-red-600 p-2 rounded mb-4"><?= $msg ?></div>
        <?php unset($_SESSION['error']); ?>
    <?php endif; ?>

    <form method="POST" action="<?= BASE_URL ?>/?action=login">
        <input type="text" name="username" placeholder="Username" class="w-full p-2 mb-4 border rounded" required>
        <input type="password" name="password" placeholder="Password" class="w-full p-2 mb-4 border rounded" required>
        <button class="w-full bg-blue-600 text-white p-2 rounded hover:bg-blue-700">Login</button>
    </form>
</div>

<?php include __DIR__ . '/../layout/footer.php'; ?>