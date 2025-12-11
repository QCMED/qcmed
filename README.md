# QCMED

## À propos

<script src="https://kit.fontawesome.com/ba53b41613.js" crossorigin="anonymous"></script>

<span style="font-weight:bold">L'alternative gratuite à ECNi, Hypocampus et Asclépia !</span>
<p style = "text-align: justify">
QCMED est un projet de banque de QCMs par des étudiants en médecine, pour des étudiants en médecine!
Notre objectif est de créer une plateforme <span style="font-weight:bold">gratuite</span> que les différents tutorats des années supérieurs pourront utiliser pour proposer des questions et des dossiers progressifs à leurs étudiants.
Le projet est ambitieux et se veut conforme à toute la docimologie de l'EDN et compétitif avec les plateformes payantes déjà existantes.
Pour l'instant l'équipe est composée d'étudiants en médecine amateurs d'informatique, auto-didacte et qui ont quelques années d'expérience en associatif.</p>

## Table des matières

- 🪧 [À propos](#à-propos)
- 🚀 [Installation](#installation)
- 🛠️ [Utilisation](#utilisation)
- 🤝 [Contribution](#contribution)
- 🏗️ [Construit avec](#construit-avec)
- 📝 [Licence](#licence)


## Installation

Pensez à bien avoir les dernières versions de php et de composer sur votre appareil!

### Cloner le dépôt distant

```powershell
git clone https://github.com/QCMED/qcmed.git
```

### Après avoir téléchargé le dépôt git (pour Linux et WSL)

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

Vous pouvez également commencer directement avec l'utilisateur admin@example.com et le mot de passe password après avoir seed votre base de données. 

Le tutoriel pour le déploiement arrivera dès qu'une version bêta-test sera disponible!

## Contribution

Pour contribuer au code vous pouvez nous contacter sur [Facebook <i class="fab facebook"></i>](https://www.facebook.com/ragy.edward.9), [Instagram](https://www.instagram.com/ragyedward/), [Mail](ragyedward2001@gmail.com), [Discord](ragy6511)

Vous pouvez consulter notre document pour les guidelines pour [contribuer](CONTRIBUTING.md)

## Construit avec

### Langages & Frameworks

![My Skills](https://go-skill-icons.vercel.app/api/icons?i=php,laravel,livewire,tailwind,filament&title=true&theme=dark)

[PHP](https://www.php.net/docs.php) | [Laravel](https://laravel.com/docs/installation) | [Livewire](https://laravel-livewire.com/) | [Tailwind](https://tailwindcss.com/) | [Filament](https://filamentphp.com/docs)

### Outils

#### Code editor
![My Skills](https://go-skill-icons.vercel.app/api/icons?i=vscodium&title=true&theme=dark)

[VS Codium](https://vscodium.com/)

#### Code review

![My Skills](https://go-skill-icons.vercel.app/api/icons?i=phpstan&title=true&theme=dark)

[phpinsights](https://github.com/nunomaduro/phpinsights) | 
[phpstan](https://phpstan.org/) | 
[larastan](https://github.com/larastan/larastan)

#### Style

![My Skills](https://go-skill-icons.vercel.app/api/icons?i=pint&title=true&theme=dark)

[laravelpint](https://laravel.com/docs/12.x/pint)

#### DebugBar

[Debugbar](https://github.com/barryvdh/laravel-debugbar)

#### CI

![My Skills](https://go-skill-icons.vercel.app/api/icons?i=git,github&title=true&theme=dark)

[git](https://git-scm.com/docs) | 
[github](https://docs.github.com/fr)

#### Déploiement

![My Skills](https://go-skill-icons.vercel.app/api/icons?i=jenkins,docker,kubernetes&title=true&theme=dark)


[Jenkins](https://www.jenkins.io/doc/) |
[Docker](https://docs.docker.com/) | 
[Kubernetes](https://kubernetes.io/docs/home/)


## Licence

Ce projet est sous [License Clause BSD 2](LICENSE.md) 
