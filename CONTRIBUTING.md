# Comment contribuer au projet QCMed

Bienvenue ! Ce guide vous accompagne pas à pas pour contribuer au projet QCMed. Que vous soyez débutant ou développeur expérimenté, votre aide est précieuse.

## Table des matières

- [Premiers pas](#premiers-pas)
- [Prérequis](#prérequis)
- [Installation de l'environnement](#installation-de-lenvironnement)
- [Comprendre le projet](#comprendre-le-projet)
- [Workflow de contribution](#workflow-de-contribution)
- [Conventions de code](#conventions-de-code)
- [Faire une Pull Request](#faire-une-pull-request)
- [Tests](#tests)
- [Outils recommandés](#outils-recommandés)
- [Besoin d'aide ?](#besoin-daide-)

---

## Premiers pas

### 1. Rejoignez la communauté

Avant de commencer, rejoignez notre [serveur Discord](https://discord.gg/DAsceBzrqH) ! C'est le meilleur endroit pour :
- Poser vos questions
- Discuter de vos idées
- Trouver des tâches sur lesquelles travailler
- Recevoir de l'aide en temps réel

### 2. Trouvez une tâche

- Consultez les [Issues ouvertes](https://github.com/QCMED/qcmed/issues) sur GitHub
- Les issues avec le label `good first issue` sont parfaites pour débuter
- N'hésitez pas à demander des clarifications sur Discord ou dans l'issue

### 3. Signalez que vous travaillez dessus

Laissez un commentaire sur l'issue pour signaler que vous la prenez en charge. Cela évite que plusieurs personnes travaillent sur la même chose.

---

## Prérequis

Aucune expérience préalable n'est obligatoire ! Cependant, voici ce qui vous aidera :

### Connaissances utiles

| Niveau | Technologies |
|--------|--------------|
| **Idéal** | PHP, Laravel, Livewire |
| **Utile** | HTML, CSS, Tailwind |
| **Bonus** | Filament, SQL |

### Ressources pour apprendre

- [PHP Tutorial](https://www.phptutorial.net/) - Les bases de PHP
- [Laravel Bootcamp](https://bootcamp.laravel.com/) - Apprendre Laravel par la pratique
- [Laracasts](https://laracasts.com/) - Tutoriels vidéo (gratuit et payant)
- [Filament Documentation](https://filamentphp.com/docs) - Documentation officielle

### Logiciels requis

- **PHP 8.2+** (8.4 recommandé)
- **Composer** - Gestionnaire de dépendances PHP
- **Node.js 20+** et **npm**
- **Git**
- Un éditeur de code (VS Code recommandé)

---

## Installation de l'environnement

### Étape 1 : Forker et cloner le projet

```bash
# 1. Forkez le dépôt sur GitHub (bouton "Fork" en haut à droite)

# 2. Clonez votre fork
git clone https://github.com/VOTRE_USERNAME/qcmed.git
cd qcmed

# 3. Ajoutez le dépôt original comme remote
git remote add upstream https://github.com/QCMED/qcmed.git
```

### Étape 2 : Configuration de l'environnement

```bash
# 1. Copier le fichier de configuration
cp .env.example .env

# 2. Installer les dépendances PHP
composer install

# 3. Installer les dépendances JavaScript
npm install

# 4. Générer la clé de l'application
php artisan key:generate

# 5. Créer la base de données SQLite
touch database/database.sqlite

# 6. Lancer les migrations et seeders
php artisan migrate --seed
```

### Étape 3 : Lancer le serveur de développement

```bash
# Dans un premier terminal : serveur PHP
php artisan serve

# Dans un second terminal : compilation des assets
npm run dev
```

Accédez à `http://localhost:8000` dans votre navigateur.

### Connexion au dashboard

- **Email** : `admin@example.com`
- **Mot de passe** : `password`

---

## Comprendre le projet

### Structure du projet

```
qcmed/
├── app/
│   ├── Filament/          # Interface d'administration (Filament)
│   │   ├── Resources/     # Ressources admin (Users, Questions, etc.)
│   │   └── Student/       # Interface étudiants
│   ├── Http/Controllers/  # Contrôleurs Laravel
│   └── Models/            # Modèles Eloquent
├── database/
│   ├── migrations/        # Structure de la base de données
│   └── seeders/           # Données de test
├── resources/
│   ├── views/             # Vues Blade
│   ├── css/               # Styles
│   └── js/                # JavaScript
├── routes/                # Définition des routes
└── tests/                 # Tests automatisés
```

### Les modèles principaux

| Modèle | Description |
|--------|-------------|
| `User` | Utilisateurs (admin, rédacteur, étudiant) |
| `Question` | Questions de QCM |
| `Dossier` | Dossiers progressifs (ensembles de questions) |
| `Chapter` | Chapitres du programme |
| `Matiere` | Matières (disciplines médicales) |
| `Attempt` | Tentatives de réponse des étudiants |

### Rôles utilisateurs

- **SUPERADMIN** : Accès total
- **ADMIN** : Gestion du contenu
- **REDACELEC** : Rédaction de questions
- **STUDENT** : Accès aux QCM

---

## Workflow de contribution

### 1. Synchronisez votre fork

Avant de commencer, assurez-vous d'avoir la dernière version :

```bash
git checkout main
git fetch upstream
git merge upstream/main
git push origin main
```

### 2. Créez une branche

Nommez votre branche de manière descriptive :

```bash
# Pour une nouvelle fonctionnalité
git checkout -b feature/nom-de-la-fonctionnalite

# Pour une correction de bug
git checkout -b fix/description-du-bug

# Pour de la documentation
git checkout -b docs/description
```

### 3. Faites vos modifications

- Faites des commits réguliers et atomiques
- Testez vos changements localement
- Suivez les conventions de code (voir section suivante)

### 4. Commitez vos changements

Format de commit recommandé :

```bash
git commit -m "Résumé court du changement (50 caractères max)

Description plus détaillée si nécessaire. Expliquez le 'pourquoi'
plutôt que le 'quoi'. Le code montre déjà ce qui change."
```

**Exemples de bons messages :**
- `Ajoute validation des réponses QCM`
- `Corrige calcul du score dans Attempt`
- `Améliore performance requête questions`

**À éviter :**
- `fix`
- `update`
- `changements divers`

### 5. Poussez et créez une PR

```bash
git push origin nom-de-votre-branche
```

Puis créez une Pull Request sur GitHub (voir section dédiée).

---

## Conventions de code

### Style de code

Le projet utilise **Laravel Pint** pour le formatage automatique :

```bash
# Formater tout le code
./vendor/bin/pint

# Voir les changements sans appliquer
./vendor/bin/pint --test
```

### Analyse statique

Utilisez **PHPStan** pour détecter les erreurs potentielles :

```bash
./vendor/bin/phpstan analyse
```

### Qualité du code

Lancez **PHP Insights** pour un rapport complet :

```bash
./vendor/bin/phpinsights
```

### Conventions de nommage

#### Base de données

Suivez les [conventions SQL](https://medium.com/@aliakbarhosseinzadeh/best-practices-for-sql-naming-conventions-tables-columns-keys-and-more-1d5e13853e39) :

| Élément | Convention | Exemple |
|---------|------------|---------|
| Tables | snake_case, pluriel | `learning_objectives` |
| Colonnes | snake_case | `created_at`, `user_id` |
| Clés étrangères | `table_singulier_id` | `chapter_id` |
| Pivot tables | Alphabétique | `chapter_question` |

#### PHP / Laravel

| Élément | Convention | Exemple |
|---------|------------|---------|
| Classes | PascalCase | `QuestionController` |
| Méthodes | camelCase | `getActiveQuestions()` |
| Variables | camelCase | `$questionCount` |
| Constantes | UPPER_SNAKE | `MAX_ATTEMPTS` |

---

## Faire une Pull Request

### Avant de soumettre

Vérifiez que :

- [ ] Le code est formaté (`./vendor/bin/pint`)
- [ ] PHPStan ne retourne pas d'erreurs (`./vendor/bin/phpstan analyse`)
- [ ] Les tests passent (`php artisan test`)
- [ ] Votre branche est à jour avec `main`

### Template de PR

Quand vous créez votre PR, utilisez ce format :

```markdown
## Description

Courte description de ce qui a été changé.
Fixes #NUMERO_ISSUE (si applicable)

## Type de changement

- [ ] Bug fix
- [ ] Nouvelle fonctionnalité
- [ ] Breaking change
- [ ] Documentation

## Comment tester

1. Étape 1
2. Étape 2
3. Résultat attendu

## Checklist

- [ ] Mon code suit les conventions du projet
- [ ] J'ai testé mes changements
- [ ] J'ai mis à jour la documentation si nécessaire
```

### Processus de review

1. Un mainteneur reviewera votre PR
2. Des modifications peuvent être demandées
3. Une fois approuvée, votre PR sera mergée
4. Félicitations, vous êtes contributeur !

---

## Tests

### Lancer les tests

```bash
# Tous les tests
php artisan test

# Tests avec détails
php artisan test --verbose

# Un fichier spécifique
php artisan test tests/Feature/MonTest.php
```

### Écrire des tests

Les tests utilisent **Pest** (syntaxe simplifiée de PHPUnit) :

```php
// tests/Feature/QuestionTest.php
test('une question peut être créée', function () {
    $question = Question::factory()->create();

    expect($question)->toBeInstanceOf(Question::class);
    expect($question->id)->toBeInt();
});
```

### Bonnes pratiques

- Testez les cas normaux ET les cas d'erreur
- Un test = une seule chose testée
- Nommez vos tests de manière descriptive

---

## Outils recommandés

### Extensions VS Code

| Extension | Utilité |
|-----------|---------|
| [PHP Intelephense](https://marketplace.visualstudio.com/items?itemName=bmewburn.vscode-intelephense-client) | Autocomplétion PHP |
| [Laravel](https://marketplace.visualstudio.com/items?itemName=laravel.vscode-laravel) | Support Laravel |
| [Database Client](https://marketplace.visualstudio.com/items?itemName=cweijan.vscode-database-client2) | Visualiser la DB |
| [GitLens](https://marketplace.visualstudio.com/items?itemName=eamodio.gitlens) | Historique Git amélioré |

### Outils de debug

- **Laravel Debugbar** : Barre de debug dans le navigateur (activée en dev)
- **`dd()` et `dump()`** : Fonctions de debug Laravel
- **`php artisan tinker`** : Console interactive

---

## Besoin d'aide ?

### Ressources

- [Documentation Laravel](https://laravel.com/docs)
- [Documentation Filament](https://filamentphp.com/docs)
- [Roadmap du projet](./docs/images/roadmap.png)

### Contact

- **Discord** : [Rejoindre le serveur](https://discord.gg/DAsceBzrqH) (recommandé)
- **GitHub Issues** : Pour les bugs et suggestions
- **Email** : ragyedward2001@gmail.com

### FAQ

**Q: Je ne connais pas Laravel, puis-je contribuer ?**
> Oui ! Commencez par des tâches simples (documentation, corrections mineures) et apprenez progressivement.

**Q: Je veux proposer une nouvelle fonctionnalité, que faire ?**
> Créez une issue sur GitHub pour en discuter avant de coder. Cela évite de travailler sur quelque chose qui ne sera pas accepté.

**Q: Mon PR a été refusée, que faire ?**
> Pas de panique ! Lisez les commentaires, posez des questions si nécessaire, et soumettez une nouvelle version.

---

## Gestion des versions

Le projet suit la [Gestion Sémantique de Version](https://semver.org/lang/fr/) :

- **MAJEUR** : Changements incompatibles
- **MINEUR** : Nouvelles fonctionnalités compatibles
- **PATCH** : Corrections de bugs

Consultez les [Releases](https://github.com/QCMED/qcmed/releases) pour l'historique des versions.

---

Merci de contribuer à QCMed ! Chaque contribution, petite ou grande, aide les étudiants en médecine.
