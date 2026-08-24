# ED-SEG — École Doctorale des Sciences Économiques et de Gestion

Plateforme web de l'École Doctorale des Sciences Économiques et de Gestion (ED-SEG) de l'Université d'Abomey-Calavi (UAC), Bénin.

## Présentation

Le site présente publiquement l'école (présentation, formations, admission, recherche, coopération, actualités) et fournit un backoffice d'administration pour gérer l'ensemble du contenu : candidatures, thèses, doctorants et enseignants-chercheurs (avec leurs archives — résultats annuels, publications, filières enseignées), laboratoires, séminaires, partenariats, bourses et actualités.

## Stack technique

- Laravel 12 (PHP 8.2+), authentification Breeze
- Autorisation via `spatie/laravel-permission`
- Blade + Tailwind CSS v4 + Alpine.js, build via Vite
- MySQL en production/développement, SQLite en test

## Installation

```bash
composer setup   # install, .env, clé d'application, migrations, dépendances front, build
composer dev     # serveur local + file d'attente + logs + Vite (tout en un)
```

Voir [CLAUDE.md](CLAUDE.md) pour le détail de l'architecture et des conventions du projet.
