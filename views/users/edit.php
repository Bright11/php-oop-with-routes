<?php include __DIR__ . '/../layout/header.php'; ?>

<div class="max-w-md mx-auto mt-10 p-6 bg-white rounded shadow">
    <h2 class="text-xl font-bold mb-4">Edit User</h2>

    <form method="POST" action="<?= BASE_URL ?>/?action=update&id=<?= $user['id'] ?>" enctype="multipart/form-data">
        <input type="text" name="id" class="w-full border p-2 mb-2 rounded" value="<?= htmlspecialchars($user['id']) ?>" required hidden>
        <input type="text" name="name" class="w-full border p-2 mb-2 rounded" value="<?= htmlspecialchars($user['name']) ?>" required>
        <input type="file" name="photo" class="w-full border p-2 mb-2 rounded" accept="image/*">
        <input type="email" name="email" class="w-full border p-2 mb-2 rounded" value="<?= htmlspecialchars($user['email']) ?>" required>
        <button class="w-full bg-blue-600 text-white py-2 rounded hover:bg-blue-700">Update</button>
    </form>
</div>

<?php include __DIR__ . '/../layout/footer.php'; ?>