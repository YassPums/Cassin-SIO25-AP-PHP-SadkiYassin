# Environnement de travail

## 1. Présentation

Pour ce projet, nous utilisons un environnement de développement sous Windows avec WSL.

Le projet sera développé en PHP avec une base de données MariaDB et un serveur Apache.

Visual Studio Code sera utilisé pour écrire le code et Git avec GitHub permettra de suivre les différentes versions du projet.

---

## 2. Logiciels utilisés

Voici les principaux logiciels utilisés pour le projet :

| Logiciel | Version |
|---|---|
| Windows | À compléter |
| Ubuntu / WSL | À compléter |
| Visual Studio Code | À compléter |
| Git | À compléter |
| Apache | À compléter |
| PHP | À compléter |
| MariaDB | À compléter |
| Composer | À compléter |

Pour afficher les versions installées :

```bash
git --version
apache2 -v
php -v
mariadb --version
composer --version
```

---

## 3. Installation de l'environnement

Avant l'installation, nous mettons à jour les paquets :

```bash
sudo apt update
sudo apt upgrade
```

Installation d'Apache :

```bash
sudo apt install apache2
```

Installation de PHP :

```bash
sudo apt install php libapache2-mod-php php-mysql
```

Installation de MariaDB :

```bash
sudo apt install mariadb-server
```

Installation de Git :

```bash
sudo apt install git
```

Installation de Composer :

```bash
sudo apt install composer
```

Pour démarrer Apache :

```bash
sudo service apache2 start
```

Pour démarrer MariaDB :

```bash
sudo service mariadb start
```



Pour ce connecter avec le réseau du lycée :

```bash
sudo nano /etc/environment
http_proxy="http://10.129.254.254:3128"
https_proxy="http://10.129.254.254:3128"
```

---

## 4. Organisation des dossiers

Le projet utilise une organisation MVC.

```text
projet-qcm/
├── app/
│   ├── Controllers/
│   ├── Models/
│   ├── Views/
│   ├── Middleware/
│   ├── Security/
│   └── Core/
│
├── public/
│   ├── index.php
│   └── assets/
│       ├── css/
│       ├── js/
│       └── images/
│
├── uploads/
│
├── storage/
│   ├── logs/
│   └── cache/
│
├── config/
│
├── docs/
│   ├── projet/
│   │   └── planification.md
│   └── technique/
│       └── environnement.md
│
├── tests/
│
├── .gitignore
├── composer.json
└── README.md
```

Le dossier `app` contient le code principal de l'application.

Le dossier `Controllers` contient les contrôleurs.

Le dossier `Models` contient les modèles liés aux données.

Le dossier `Views` contient les pages affichées à l'utilisateur.

Le dossier `public` contient les fichiers accessibles depuis le navigateur.

Le dossier `config` contient les fichiers de configuration.

Le dossier `docs` contient la documentation du projet.

Le dossier `tests` sera utilisé pour les tests de l'application.

---

## 5. Sécurité

L'organisation des dossiers permet de séparer les fichiers accessibles depuis le navigateur du reste du projet.

Le dossier `public` contient les fichiers qui doivent être accessibles depuis le web.

Les autres dossiers comme `config`, `app` ou `storage` ne doivent pas être directement accessibles depuis le navigateur.

Le projet prévoit également des dossiers `Middleware` et `Security` pour gérer les contrôles liés à l'authentification, aux autorisations et à la sécurité des utilisateurs.

Les fichiers envoyés par les utilisateurs sont placés dans le dossier `uploads`, en dehors du dossier `public`.

---

## 6. Utilisation de Git

Git et GitHub sont utilisés pour suivre les modifications du projet.

Nous utilisons principalement les branches suivantes :

```text
main
develop
feature/nom-fonctionnalite
```

La branche `main` contient la version stable du projet.

La branche `develop` contient le travail en cours.

Une branche `feature` est créée lorsqu'une nouvelle fonctionnalité doit être développée.

Exemple :

```bash
git checkout develop
git checkout -b feature/gestion-utilisateurs
```

Une fois le travail terminé, la fonctionnalité pourra être intégrée dans la branche `develop`.

---

## 7. Conventions de commits

Les messages de commit doivent être courts et permettre de comprendre rapidement ce qui a été modifié.

Nous utilisons par exemple :

```text
feat: ajout gestion utilisateurs
fix: correction formulaire connexion
docs: ajout documentation environnement
style: modification de l'affichage
test: ajout des tests
refactor: modification organisation du code
```

Les préfixes permettent de savoir quel type de modification a été effectué.

| Préfixe | Signification |
|---|---|
| feat | ajout d'une fonctionnalité |
| fix | correction d'un problème |
| docs | modification de la documentation |
| style | modification de l'affichage |
| test | ajout ou modification de tests |
| refactor | réorganisation du code |

---

## 8. Déploiement sur l'environnement de test

Un environnement de test sera utilisé pour vérifier le fonctionnement de l'application avant la version finale.

Pour récupérer le projet depuis GitHub :

```bash
git clone URL_DU_DEPOT
```

Puis entrer dans le dossier du projet :

```bash
cd projet-qcm
```

Pour installer les dépendances PHP :

```bash
composer install
```

Pour récupérer les dernières modifications du projet :

```bash
git pull
```

Apache, PHP et MariaDB doivent être installés sur l'environnement de test.

Le serveur web doit utiliser le dossier `public` comme dossier accessible depuis le navigateur.

L'application pourra ensuite être testée avant d'être intégrée dans la version stable du projet.

---

## 9. Travail en groupe

Le projet est réalisé en groupe de trois.

GitHub permet aux membres du groupe de travailler sur le même projet et de suivre les différentes modifications.

Les Issues permettent de répartir les tâches et les Milestones permettent de suivre les différentes étapes du projet.
