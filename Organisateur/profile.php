<?php
$requiredRole = 'organisateur';
require_once '../includes/auth_check.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile</title>
</head>
<body>
    <?php include '../includes/navbar_organisateur.php'; ?>
    <?php
$requiredRole = 'organisateur';
require_once '../includes/auth_check.php';

$user = $_SESSION['user'];
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Mon Profil</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">

<?php include '../includes/navbar_organisateur.php'; ?>

<div class="max-w-xl mx-auto bg-white p-8 mt-10 rounded shadow">

    <h2 class="text-2xl font-bold mb-6">Mon Profil</h2>

    <?php if (isset($_GET['success'])): ?>
        <p class="text-green-600 mb-4">Profil mis à jour avec succès</p>
    <?php endif; ?>

    <form method="POST" action="update_profile.php" enctype="multipart/form-data" class="space-y-4">

        <!-- Photo -->
        <div class="text-center">
            <img src="../uploads/avatars/<?= htmlspecialchars($user['photo']) ?>"
                 class="w-24 h-24 rounded-full mx-auto mb-2 object-cover">
            <input type="file" name="photo" accept="image/*" class="mx-auto">
        </div>

        <!-- Nom -->
        <div>
            <label class="block font-medium">Nom</label>
            <input type="text" name="nom" required
                   value="<?= htmlspecialchars($user['nom']) ?>"
                   class="w-full border p-3 rounded">
        </div>

        <!-- Email -->
        <div>
            <label class="block font-medium">Email</label>
            <input type="email" name="email" required
                   value="<?= htmlspecialchars($user['email']) ?>"
                   class="w-full border p-3 rounded">
        </div>

        <!-- Téléphone -->
        <div>
            <label class="block font-medium">Téléphone</label>
            <input type="text" name="telephone" required
                   value="<?= htmlspecialchars($user['telephone']) ?>"
                   class="w-full border p-3 rounded">
        </div>

        <button class="w-full bg-blue-600 hover:bg-blue-700 text-white py-3 rounded font-semibold">
            Enregistrer
        </button>
    </form>
</div>

</body>
</html>


</body>
</html>