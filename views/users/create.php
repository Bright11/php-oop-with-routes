<?php include __DIR__ . '/../layout/header.php'; ?>

<div class="max-w-md mx-auto mt-10 p-6 bg-white rounded shadow">
    <h2 class="text-xl font-bold mb-4">Create User</h2>

    <?php
    $old = $_SESSION['old'] ?? [];
    $errors = $_SESSION['errors'] ?? [];
    unset($_SESSION['old'], $_SESSION['errors']);
    ?>

    <form method="POST" action="<?= BASE_URL ?>/?action=store" enctype="multipart/form-data">
        <input type="text" name="name" placeholder="Name" class="w-full border p-2 mb-2 rounded" value="<?= htmlspecialchars($old['name'] ?? '') ?>">
        <?php if (isset($errors['name'])): ?>
            <div class="text-red-500 text-sm mb-2"><?= $errors['name'] ?></div>
        <?php endif; ?>
        <input type="file" name="photo" class="w-full border p-2 mb-2 rounded" accept="image/*">


        <input type="email" name="email" placeholder="Email" class="w-full border p-2 mb-2 rounded" value="<?= htmlspecialchars($old['email'] ?? '') ?>">
        <?php if (isset($errors['email'])): ?>
            <div class="text-red-500 text-sm mb-2"><?= $errors['email'] ?></div>
        <?php endif; ?>

        <button class="w-full bg-blue-600 text-white py-2 rounded hover:bg-blue-700">Save</button>
    </form>
</div>

<?php include __DIR__ . '/../layout/footer.php'; ?>