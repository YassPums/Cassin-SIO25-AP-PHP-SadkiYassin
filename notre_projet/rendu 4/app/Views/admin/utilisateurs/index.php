<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion des utilisateurs</title>
    <link rel="stylesheet" href="/assets/css/style.css">
</head>
<body>

    <header class="barre-navigation">
        <h2>Plateforme QCM</h2>
        <a href="/dashboard">Tableau de bord</a>
    </header>

    <main class="conteneur">
        <h1>Gestion des utilisateurs</h1>

        <p>Liste des comptes de la plateforme.</p>

        <div class="tableau-conteneur">
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nom</th>
                        <th>Prénom</th>
                        <th>Email</th>
                        <th>Rôle</th>
                        <th>Classe</th>
                    </tr>
                </thead>

                <tbody>
                    <?php foreach ($utilisateurs as $utilisateur): ?>
                        <tr>
                            <td><?= (int) $utilisateur['idUtilisateur'] ?></td>
                            <td><?= htmlspecialchars($utilisateur['nom']) ?></td>
                            <td><?= htmlspecialchars($utilisateur['prenom']) ?></td>
                            <td><?= htmlspecialchars($utilisateur['email']) ?></td>
                            <td><?= htmlspecialchars($utilisateur['role']) ?></td>
                            <td><?= htmlspecialchars($utilisateur['nomClasse'] ?? '-') ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </main>

</body>
</html>
