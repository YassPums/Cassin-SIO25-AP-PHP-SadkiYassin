<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion - Plateforme QCM</title>
    <link rel="stylesheet" href="/assets/css/style.css">
</head>
<body class="page-connexion">

    <div class="connexion">
        <h1>Plateforme QCM</h1>
        <p>Connectez-vous à votre espace</p>

        <?php if (!empty($erreur)): ?>
            <p class="erreur">
                <?= htmlspecialchars($erreur) ?>
            </p>
        <?php endif; ?>

        <form action="/connexion" method="POST">

            <input type="hidden" name="csrf_token"
                   value="<?= htmlspecialchars($_SESSION['csrf_token']) ?>">

            <label for="email">Adresse email</label>

            <input type="email"
                   id="email"
                   name="email"
                   placeholder="Votre adresse email"
                   autocomplete="username"
                   required>

            <label for="motDePasse">Mot de passe</label>

            <input type="password"
                   id="motDePasse"
                   name="motDePasse"
                   placeholder="Votre mot de passe"
                   autocomplete="current-password"
                   required>

            <button type="submit">Se connecter</button>

        </form>
    </div>

</body>
</html>
