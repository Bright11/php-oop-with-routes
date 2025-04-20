<?php include __DIR__ . '/../layout/header.php'; ?>

<div class="container mx-auto px-4 py-6">
    <h1 class="text-2xl font-bold mb-4">Users (Paginated)</h1>

    <table class="w-full bg-white border rounded shadow text-sm">
        <thead class="bg-gray-100">
            <tr>
                <th class="p-3 text-left">Name</th>
                <th class="p-3 text-left">Email</th>
                <th class="p-3 text-right">Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($users as $user): ?>
                <tr class="border-t">
                    <td class="p-3"><?= htmlspecialchars($user['name']) ?></td>
                    <td class="p-3"><?= htmlspecialchars($user['email']) ?></td>
                    <td class="p-3 text-right space-x-2">
                        <a href="<?= BASE_URL ?>/?action=edit&id=<?= $user['id'] ?>" class="text-blue-500 hover:underline">Edit</a>
                        <a href="<?= BASE_URL ?>/?action=delete&id=<?= $user['id'] ?>" class="text-red-500 hover:underline" onclick="return confirm('Delete this user?')">Delete</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <div class="flex justify-center mt-6 space-x-2">
        <?php for ($i = 1; $i <= $totalPages; $i++): ?>
            <a href="<?= BASE_URL ?>/?action=paginated&page=<?= $i ?>" class="px-4 py-2 rounded border <?= $i == $page ? 'bg-blue-600 text-white' : 'bg-white text-blue-600 border-blue-600 hover:bg-blue-100' ?>">
                <?= $i ?>
            </a>
        <?php endfor; ?>
    </div>
</div>

<?php include __DIR__ . '/../layout/footer.php'; ?>