# Préparation du rendu 4 – Projet QCM

**Date :** 16 novembre 2026  
**Objectif :** préparer l’environnement de développement, récupérer la documentation à jour et synchroniser localement les branches Git avant de réaliser l’application PHP/MariaDB.

## 1. Vérification de l’environnement de travail

J’ai ouvert Ubuntu depuis Windows PowerShell avec la commande `wsl`, puis vérifié les logiciels installés :

```bash
lsb_release -a
git --version
php -v
apache2 -v
mariadb --version
composer --version
code --version
```

| Logiciel | Version relevée |
|---|---|
| Ubuntu (WSL) | 26.04.1 LTS |
| Git | 2.53.0 |
| PHP | 8.5.4 |
| Apache | 2.4.66 |
| MariaDB | 11.8.6 |
| Composer | 2.9.5 |
| Visual Studio Code | 1.146.0 |

J’ai ensuite démarré les services et vérifié leur état :

```bash
sudo service apache2 start
sudo service mariadb start
sudo service apache2 status
sudo service mariadb status
```

Les deux services étaient actifs (`active (running)`). La touche `Q` permet de quitter l’affichage du statut.

J’ai vérifié les extensions PHP nécessaires à la connexion à MariaDB :

```bash
php -m | grep -Ei 'pdo|mysql|mysqli'
```

Résultat : `mysqli`, `mysqlnd`, `PDO` et `pdo_mysql` sont installées pour PHP en ligne de commande.

Enfin, j’ai vérifié les bases existantes :

```bash
sudo mariadb -e "SHOW DATABASES;"
```

Les bases `app`, `salsa`, `phpmyadmin` et les bases système étaient présentes. La base `qcm` n’existait pas encore. Aucune base existante n’a été supprimée ou modifiée pendant ces vérifications.

## 2. Vérification du dépôt Git

Je me suis placé dans le dépôt du projet QCM, après avoir constaté que j’étais temporairement dans le dépôt d’un autre projet.

```bash
cd "/mnt/c/Users/Evguenii/Desktop/clone git/Cassin-SIO25-AP-PHP-SadkiYassin"
pwd
ls -la
git status
git branch -a
```

Au départ, j’étais sur `main`, avec quatre fichiers modifiés :

- `README.md`
- `notre_projet/docs/projet/conception.md`
- `notre_projet/docs/projet/planification.md`
- `notre_projet/docs/technique/environnement.md`

La branche `origin/develop` existait sur le dépôt distant, mais pas encore localement. Afin de respecter l’organisation GitFlow du projet, j’ai choisi de poursuivre sur `develop`.

## 3. Sauvegarde des modifications et changement de branche

```bash
git stash push -m "Corrections documentation rendus 1 2 3"
git switch -c develop --track origin/develop
git stash pop
```

`git stash` permet de mettre temporairement de côté les modifications non enregistrées dans un commit. `git switch` crée la branche locale `develop` et la rattache à la branche distante.

La récupération des modifications avec `git stash pop` a provoqué quatre conflits : un conflit de contenu dans le README et trois conflits concernant les documents absents de `develop`. Git a conservé le stash puisqu’il n’a pas pu appliquer les modifications complètement.

## 4. Analyse et résolution des premiers conflits

Pour comprendre les différences entre les branches, j’ai utilisé :

```bash
git ls-tree -r --name-only develop
git ls-tree -r --name-only main
git stash list
git stash show --stat 'stash@{0}'
git log --oneline --graph --all -15
unzip -l devlope.zip
```

La branche `main` contenait la documentation récente, le MCD, le MLD et les maquettes. La branche `develop` contenait uniquement un README et une archive `devlope.zip` avec une ancienne documentation. Aucun fichier PHP ou SQL ne figurait dans cette archive.

Une première tentative avec `git restore` n’a pas permis de constater la disparition des conflits. Après avoir vérifié que le stash était toujours présent, j’ai annulé l’application conflictuelle :

```bash
git reset --merge HEAD
git status
git stash list
```

Le résultat `nothing to commit, working tree clean` a confirmé que les conflits avaient disparu. Le stash était toujours disponible.

J’ai également comparé le fichier technique contenu dans l’archive avec celui de `main` :

```bash
unzip -p devlope.zip notre_projet/docs/technique/environnement.md | diff -u <(git show main:notre_projet/docs/technique/environnement.md) -
```

La commande n’a affiché aucune différence : ces deux versions du fichier étaient identiques. Les autres fichiers de l’archive n’ont pas fait l’objet d’une comparaison détaillée.

## 5. Fusion de main dans develop

J’ai créé une branche locale de sécurité, puis lancé une fusion sans validation automatique :

```bash
git branch sauvegarde-develop
git merge main --no-commit --no-ff
git status
```

Git a récupéré les onze fichiers de documentation et médias de `main`. Il restait un conflit dans `README.md`.

Après avoir consulté son contenu avec `cat README.md`, j’ai choisi la version de `main`, qui indiquait les noms complets des membres du groupe :

```bash
git checkout --theirs README.md
git add README.md
git status
git commit -m "Fusion de main dans develop"
```

Dans cette fusion précise, `--theirs` désignait la version provenant de `main`. Le commit de fusion a conservé les historiques des deux branches. L’archive `devlope.zip` n’a pas été supprimée.

## 6. Récupération des corrections personnelles

Une fois la fusion terminée, j’ai récupéré mes modifications :

```bash
git stash apply 'stash@{0}'
git status
git stash list
ls -la notre_projet
```

Cette fois, aucun conflit n’est apparu. Contrairement à `pop`, `apply` conserve le stash après application, ce qui permet de garder une sauvegarde.

Pour enregistrer les corrections dans Git, les commandes prévues étaient :

```bash
git diff --ignore-space-at-eol
git add README.md notre_projet/docs/
git commit -m "Mise à jour de la documentation des rendus 1 2 et 3"
```

Le statut suivant a confirmé que l’espace de travail était propre et que `develop` avait neuf commits d’avance sur la référence distante locale. Le texte exact du dernier commit et l’exécution du `diff` n’ont pas été montrés dans les résultats transmis.

## 7. Synchronisation avec GitHub : non terminée

J’ai tenté de récupérer les éventuelles modifications distantes et de publier les commits :

```bash
git fetch origin
git status
git push origin develop
```

La commande `git fetch origin` a été suspendue avec `Ctrl + Z`. Git a indiqué que la branche locale était en avance de neuf commits sur `origin/develop` et que l’espace de travail était propre. La réussite du push n’a pas été confirmée. Comme le fetch n’a pas abouti, la référence distante locale peut ne pas être à jour.

Pour ne pas retarder le développement, il a été décidé de continuer en local. La commande `fg %2` a été proposée pour reprendre le processus suspendu et `Ctrl + C` pour l’interrompre si nécessaire ; leur résultat n’a pas été communiqué.

### À reprendre ultérieurement

Lorsque la connexion à GitHub fonctionne, vérifier les processus suspendus avec `jobs`, puis terminer ou interrompre proprement le fetch suspendu. Ensuite, exécuter les commandes suivantes une par une :

```bash
git fetch origin
git status
```

Si le fetch réussit, que la branche est uniquement en avance et que le groupe est d’accord avec la fusion, publier les commits :

```bash
git push origin develop
git status
```

Si les branches ont divergé, examiner les nouveaux commits avant de poursuivre. Ne pas utiliser de push forcé. Conserver le stash et la branche `sauvegarde-develop` tant que les corrections n’ont pas été vérifiées.

## 8. Bilan avant le développement

| Élément | État |
|---|---|
| Logiciels nécessaires | Installés |
| Apache et MariaDB | Services actifs lors de la vérification |
| Extensions PHP/PDO | Vérifiées en ligne de commande |
| Branche locale develop | Créée |
| Fusion de main dans develop | Réalisée localement |
| Conflits Git | Résolus |
| Corrections de documentation | Récupérées et espace de travail propre |
| Stash et branche de sécurité | Conservés |
| Synchronisation GitHub | Non confirmée |
| Accès à localhost dans le navigateur | Reste à confirmer |
| Base de données qcm | À créer |
| Arborescence MVC et application | À réaliser |

## 9. Prochaine étape : réalisation du projet

Le dossier `notre_projet/rendu 4` existe déjà. Depuis la racine du dépôt, les prochaines commandes sont :

```bash
cd "notre_projet/rendu 4"
code .
```

Le développement s’appuiera sur le dernier MCD et le MLD à 14 tables retenus par le groupe. L’objectif est de créer une base MariaDB dédiée au QCM, puis une application en PHP natif avec PDO et une architecture MVC simple, adaptée à notre niveau. Les maquettes existantes et les issues validées par le professeur seront conservées.

**Conclusion :** l’environnement technique et Git sont prêts pour commencer le développement local. La publication des commits sur GitHub et la vérification de l’accès HTTP restent à confirmer.
