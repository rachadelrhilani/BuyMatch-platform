# Plateforme de Gestion d'Événements Sportifs

## Présentation du projet

Ce projet est une **plateforme web de gestion d’événements sportifs** développée en **PHP orienté objet (POO)** avec une base de données **MySQL**.

Elle permet :
- aux **organisateurs** de proposer des matchs/événements,
- aux **administrateurs** de valider ou refuser les événements et de modérer la plateforme,
- aux **acheteurs** d’acheter des billets et de gérer leurs commandes.

Le projet respecte une architecture claire basée sur les principes **POO**, **Repository Pattern**, et une séparation propre des responsabilités.

---

## Objectifs pédagogiques

- Appliquer correctement la **programmation orientée objet en PHP**
- Mettre en place une **architecture professionnelle** (Entities / Repositories)
- Gérer les rôles et permissions (Admin / Organisateur / Acheteur)
- Utiliser **PDO** et les **transactions SQL**
- Comprendre et expliquer la **logique métier** devant un jury

---

## Rôles utilisateurs

### Administrateur
- Accès au dashboard admin
- Validation / refus des événements
- Modération des commentaires signalés
- Gestion des utilisateurs
- Consultation des statistiques globales

### Organisateur
- Création de matchs (événements)
- Suivi du statut : `en attente`, `validé`, `refusé`

### Acheteur
- Consultation des matchs validés
- Achat de billets
- Gestion des commandes et tickets

---

## Fonctionnalités principales

### Gestion des événements
- Création d’événements sportifs
- Validation par l’administrateur
- Filtrage automatique des **matchs à venir**

### Système de commandes
- Création de commandes avec calcul automatique du total
- Génération de billets uniques
- Vérification de la disponibilité des places
- Utilisation des **transactions SQL**

### Gestion des billets
- Chaque billet possède :
  - un numéro unique
  - une place
  - une catégorie
- Affichage des billets par utilisateur

### Sécurité
- Authentification avec vérification des rôles
- Protection des pages sensibles (`auth_check.php`)
- Accès restreint selon le rôle

---

## Choix techniques

- **PHP 8+**
- **MySQL**
- **PDO** (requêtes préparées)
- **POO stricte**
- **Repository Pattern**
- **Transactions SQL**
- **Tailwind CSS** pour l’interface

---

## Programmation Orientée Objet (POO)

### Entités (Classes métier)
Les classes comme `Order`, `Ticket`, `Event` représentent la **logique métier**.

Exemple :
- `Order` sait qu’elle contient des tickets
- `Ticket` représente une place réelle

### Repositories
Les repositories sont responsables **uniquement** de :
- communiquer avec la base de données
- exécuter les requêtes SQL

**Aucune logique métier lourde dans les pages**

---

## Base de données

Le projet repose sur plusieurs tables clés :
- `users`
- `events`
- `equipes`
- `categories`
- `orders`
- `tickets`

Les statuts utilisés :
- `en attente`
- `valide`
- `refuse`

---

## Page 404 personnalisée

Une page `404.php` est configurée via `.htaccess` pour gérer les routes inexistantes et améliorer l’expérience utilisateur.

---

## Ce que le jury attend

- Une **architecture claire**
- Une vraie séparation entre logique métier et accès aux données
- Des noms de classes cohérents
- Une utilisation correcte des transactions
- Une explication claire du **pourquoi** des choix techniques

---

## Conclusion

Ce projet démontre une **maîtrise solide du PHP orienté objet**, une compréhension des bonnes pratiques professionnelles et une capacité à structurer une application web complète et évolutive.


