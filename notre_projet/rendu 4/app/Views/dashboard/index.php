<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title><?= htmlspecialchars($titre) ?></title>
</head>
<body>

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

    <form action="/deconnexion" method="POST">

        <input type="hidden" name="csrf_token"
               value="<?= htmlspecialchars($_SESSION['csrf_token']) ?>">

        <button type="submit">Se déconnecter</button>

    </form>

</body>
</html>
