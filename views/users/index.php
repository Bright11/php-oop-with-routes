<?php include __DIR__ . '/../layout/header.php'; ?>

<div class="container mx-auto px-4 py-6">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold">All Users</h1>
        <a href="<?= BASE_URL ?>/?action=create" class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">+ Create User</a>
    </div>

    <?php if ($msg = $this->getFlash('success')): ?>
        <div class="bg-green-100 text-green-800 p-3 rounded mb-4"><?= $msg ?></div>
    <?php endif; ?>

    <table class="w-full bg-white border rounded shadow text-sm">
        <thead class="bg-gray-100">
            <tr>
                <th class="p-3 text-left">Name</th>
                <th class="p-3 text-left">Image</th>

                <th class="p-3 text-left">Email</th>
                <th class="p-3 text-right">Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($users as $user): ?>
                <tr class="border-t">
                    <td class="p-3"><?= htmlspecialchars($user['name']) ?></td>
                    <td class="p-3">
                        <img src="<?= BASE_URL ?>/uploads/<?= htmlspecialchars($user['photo']) ?>" alt="Photo" class="h-10 w-10 rounded-full object-cover">

                    </td>
                    <td class="p-3"><?= htmlspecialchars($user['email']) ?></td>
                    <td class="p-3 text-right space-x-2">
                        <a href="<?= BASE_URL ?>/?action=edit&id=<?= $user['id'] ?>" class="text-blue-500 hover:underline">Edit</a>
                        <a href="<?= BASE_URL ?>/?action=delete&id=<?= $user['id'] ?>" onclick="return confirm('Delete this user?')" class="text-red-500 hover:underline">Delete</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<?php include __DIR__ . '/../layout/footer.php'; ?>