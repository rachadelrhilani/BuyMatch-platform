<?php
$requiredRole = 'admin';
require_once '../includes/auth_check.php';
require_once '../repositories/AdminRepository.php';

$repo = new AdminRepository();
$users = $repo->getAllUsers();
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Gestion des utilisateurs</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-950 text-gray-200 min-h-screen">

<?php require_once '../includes/navbar_admin.php'; ?>

<div class="max-w-7xl mx-auto p-6">

    <h1 class="text-3xl font-bold mb-8">👥 Gestion des utilisateurs</h1>

    <div class="bg-gray-900 rounded-xl shadow border border-gray-800 overflow-hidden">
        <table class="w-full text-left">
            <thead class="bg-gray-800 text-gray-400 uppercase text-sm">
                <tr>
                    <th class="px-6 py-4">Nom</th>
                    <th class="px-6 py-4">Email</th>
                    <th class="px-6 py-4">Rôle</th>
                    <th class="px-6 py-4">Statut</th>
                    <th class="px-6 py-4">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($users as $u): ?>
                    <tr class="border-b border-gray-800 hover:bg-gray-800/40 transition">

                        <td class="px-6 py-4 font-medium text-white">
                            <?= htmlspecialchars($u['nom']) ?>
                        </td>

                        <td class="px-6 py-4 text-gray-300">
                            <?= htmlspecialchars($u['email']) ?>
                        </td>

                        <td class="px-6 py-4">
                            <span class="px-3 py-1 rounded-full text-xs 
                                <?= $u['role'] === 'admin'
                                    ? 'bg-purple-600/20 text-purple-400'
                                    : 'bg-blue-600/20 text-blue-400' ?>">
                                <?= ucfirst($u['role']) ?>
                            </span>
                        </td>

                        <td class="px-6 py-4">
                            <span class="px-3 py-1 rounded-full text-xs 
                                <?= $u['actif']
                                    ? 'bg-green-600/20 text-green-400'
                                    : 'bg-red-600/20 text-red-400' ?>">
                                <?= $u['actif'] ? 'Actif' : 'Désactivé' ?>
                            </span>
                        </td>

                        <td class="px-6 py-4">
                            <a href="toggle_user.php?id=<?= $u['id'] ?>"
                               class="px-4 py-2 rounded-lg text-sm font-medium
                               <?= $u['actif']
                                    ? 'bg-red-600 hover:bg-red-700'
                                    : 'bg-green-600 hover:bg-green-700' ?>
                               text-white transition">
                                <?= $u['actif'] ? 'Désactiver' : 'Activer' ?>
                            </a>
                        </td>

                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

</div>

</body>
</html>
