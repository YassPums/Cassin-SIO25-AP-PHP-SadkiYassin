<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title><?= htmlspecialchars($titre) ?></title>
    <link rel="stylesheet" href="/assets/css/style.css">
</head>
<body>

    <main class="conteneur">

        <h1><?= htmlspecialchars($titre) ?></h1>

        <p>
            Bienvenue
            <?= htmlspecialchars($_SESSION['prenom']) ?>
            <?= htmlspecialchars($_SESSION['nom']) ?>
        </p>

        <p>
            Votre rôle :
            <?= htmlspecialchars($_SESSION['role']) ?>
        </p>

        <?php if ($_SESSION['role'] === 'admin'): ?>

            <a class="bouton" href="/admin/utilisateurs">
                Gérer les utilisateurs
            </a>

        <?php endif; ?>

        <br><br>

        <form action="/deconnexion" method="POST">

            <input type="hidden" name="csrf_token"
                   value="<?= htmlspecialchars($_SESSION['csrf_token']) ?>">

            <button type="submit">Se déconnecter</button>

        </form>

    </main>

</body>
</html>
