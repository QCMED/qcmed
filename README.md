# QCMED

## À propos

<p style = "text-align: justify">QCMED est un projet de banque de QCMs par des étudiants en médecine, pour des étudiants en médecine!
Notre objectif est de créer une plateforme <span style="font-weight:bold">gratuite</span> que les différents tutorats des années supérieurs pourront utiliser pour proposer des questions et des dossiers progressifs à leurs étudiants.
Le projet est ambitieux et se veut conforme à toute la docimologie de l'EDN et compétitif avec les plateformes payantes déjà existantes.
Pour l'instant l'équipe est composée d'étudiants en médecine amateurs d'informatique, auto-didacte et qui ont quelques années d'expérience en associatif.</p>

## Table des matières

- 🪧 [À propos](#à-propos)

- 📦 [Prérequis](#prérequis)
- 🚀 [Installation](#installation)
- 🛠️ [Utilisation](#utilisation)
- 🤝 [Contribution](#contribution)
- 🏗️ [Construit avec](#construit-avec)
- 📚 [Documentation](#documentation)
- 🏷️ [Gestion des versions](#gestion-des-versions)
- 📝 [Licence](#licence)

## Roadmap

![Roadmap du projet](./roadmap.png)

## Prérequis

Il n'y en a pas vraiment! Il est recommandé d'avoir un peu d'expérience en informatique, de préférence en **[php](https://www.phptutorial.net/)** et avec le framework **[Laravel](https://www.w3schools.in/laravel)**, mais on peut tout à fait apprendre sur le tas.

Pensez à bien avoir les dernières versions de php et de composer sur votre appareil!

## Installation

### Cloner le dépôt distant

```powershell
git clone https://github.com/QCMED/qcmed.git
```

### Après avoir téléchargé le dépôt git (pour Linux et WSL pour les utilisateurs sous windows)

1. Copier le fichier environnement à partir du fichier de base:

```powershell
cp .env.example .env
```

2. Installer les dépendances PHP :

```powershell
composer install
```

3. Installer les dépendances JS et compiler :

```powershell
npm install
npm run dev
```

4. Générer la clé app :

```powershell
php artisan key:generate
```

5. Configurer la base de données dans `.env` (par exemple pour sqlite pour la base de données):

```
DB_CONNECTION=sqlite
DB_DATABASE=/absolute/path/to/database/database.sqlite  # ou use :memory: pour tests
```

6. Lancer les migrations et les seeders :

```powershell
php artisan migrate --seed
```

Le seeder crée des utilisateurs de test, des items et des questions exemples.

## Utilisation

Pour accéder au dashboard d'administrateur, vous pouvez créer un utilisateur avec

```powershell
php artisan make:filament-user
```

Remplissez le formulaire qui s'affiche sur le terminal, puis accédez à la DB pour changer le 'role' de votre nouvel utilisateur de '4' à '1'

Si vous utilisez SQLite pour votre environnement dev, vous pouvez utiliser l'extension 'database client' de VS code

Vous pouvez également commencer directement avec l'utilisateur admin@example.com et le mot de passe password après avoir seed votre base de données

## Contribution

Pour contribuer au code vous pouvez nous contacter sur [Facebook](https://www.facebook.com/ragy.edward.9), [Instagram](https://www.instagram.com/ragyedward/), [Mail](ragyedward2001@gmail.com), [Discord](ragy6511)

Pour régler un bug ou pour ajouter une fonctionnalité, il faut créer une branche à part puis faire un pull request.

Les commits devraient être courts et "atomiques" (avec un petit changement à la fois).

```powershell
$ git commit -m "court résumé de ce qui a changé
> 
> Un paragraphe décrivant ce qui a changé dans le code et son impact"
```

## Construit avec

### Langages & Frameworks

[PHP](https://www.php.net/docs.php) | [Laravel](https://laravel.com/docs/installation) | [Livewire](https://laravel-livewire.com/) | [Tailwind](https://tailwindcss.com/) | [Filament](https://filamentphp.com/docs)

### Outils

#### Code editor

[VS Codium](https://vscodium.com/)

Quelques extensions VS code recommandés pour ce projet :

[Database Client](https://open-vsx.org/vscode/item?itemName=cweijan.vscode-database-client2)

[PHP Intelephense](https://open-vsx.org/vscode/item?itemName=bmewburn.vscode-intelephense-client)

[Git Blame](https://open-vsx.org/vscode/item?itemName=waderyan.gitblame) | 
[Git Lens](https://open-vsx.org/vscode/item?itemName=eamodio.gitlens)

[Laravel](https://open-vsx.org/vscode/item?itemName=laravel.vscode-laravel) | 
[Laravel Goto Components](https://open-vsx.org/vscode/item?itemName=MrChetan.goto-laravel-components) | 
[Laravel Intellisense](https://open-vsx.org/vscode/item?itemName=mohamedbenhida.laravel-intellisense) | 
[Laravel Snippets](https://open-vsx.org/vscode/item?itemName=onecentlin.laravel5-snippets) 

#### Code review

[phpinsights](https://github.com/nunomaduro/phpinsights) | 
[phpstan](https://phpstan.org/) | 
[larastan](https://github.com/larastan/larastan)

#### Style

[laravelpint](https://laravel.com/docs/12.x/pint)

#### DebugBar

[Debugbar](https://github.com/barryvdh/laravel-debugbar)

#### CI

[git](https://git-scm.com/docs) | 
[github](https://docs.github.com/fr)

#### Déploiement

[Jenkins](https://www.jenkins.io/doc/) |
[Docker](https://docs.docker.com/) | 
[Kubernetes](https://kubernetes.io/docs/home/)

## Documentation

Bientôt

## Gestion des versions

Afin de maintenir un cycle de publication claire et de favoriser la rétrocompatibilité, la dénomination des versions suit la spécification décrite par la [Gestion sémantique de version](https://semver.org/lang/fr/)

Les versions disponibles ainsi que les journaux décrivant les changements apportés sont disponibles depuis [la page des Releases](https://github.com/C2SU/qcmed-filament/releases).

## Licence

Voir le fichier [LICENSE](./LICENSE.md) du dépôt.
