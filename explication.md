# CFP Mon Cœur — Analyse complète du site

> Document généré le 22 mai 2026. Il décrit **ce que fait le site aujourd'hui**, ce qui fonctionne bien, ce qui est incomplet, et ce qui devrait être amélioré.

---

## 1. C'est quoi ce site ?

**CFP Mon Cœur** est un **système de gestion en ligne** pour le Centre de Formation Professionnelle "Mon Cœur" basé à **Goma, République Démocratique du Congo**.

En clair : c'est un site qui permet à la direction du centre de **gérer les formateurs, les formations, les étudiants, les inscriptions et les dons** depuis un tableau de bord sécurisé — et de présenter le centre au public sur une belle page d'accueil.

---

## 2. Technologie utilisée (la pile technique)

| Couche | Technologie | Pourquoi |
|--------|------------|---------|
| Langage serveur | PHP 8.4 | Langage principal de Laravel |
| Framework | Laravel 12 | Framework PHP le plus populaire |
| Interactivité | Livewire 3 | Composants dynamiques sans JavaScript complexe |
| Authentification | Jetstream + Fortify + Sanctum | Connexion, sessions, 2FA intégrés |
| Base de données | SQLite | Simple, sans serveur, parfait pour commencer |
| CSS frontend | Bootstrap 5 + CSS personnalisé | Mise en page et design côté public |
| CSS backend | Bootstrap 5 + thème admin personnalisé | Interface d'administration |
| Graphiques | ApexCharts (CDN) | Graphique des inscriptions sur le dashboard |
| Polices | Google Fonts (Heebo + Nunito) | Typographie professionnelle |

---

## 3. Structure générale du site

Le site est divisé en **2 grandes parties** :

```
Site CFP Mon Cœur
├── PARTIE PUBLIQUE (visible par tout le monde)
│   ├── Page d'accueil (/acceuil)
│   └── Page À propos (/about)
│
└── PARTIE PRIVÉE (visible seulement après connexion)
    ├── Tableau de bord (/dashboard)
    ├── Formateurs (/formateur)
    ├── Formations (/formation)
    ├── Étudiants (/etudiant)
    ├── Inscriptions (/inscritption)
    └── Dons (/dons)
```

---

## 4. La partie publique (ce que voit un visiteur)

### 4.1 Page d'accueil (`/acceuil`)

**Ce qu'elle fait aujourd'hui :**
- ✅ **Navbar** : logo, liens de navigation (Accueil, À propos, Formations, Contact), boutons Connexion et S'inscrire
- ✅ **Barre de stats** : affiche "500+ Étudiants formés", nombre de formations actives, nombre de formateurs, "98% Satisfaction" — chiffres dynamiques venant de la base de données
- ✅ **Bandeau de bienvenue** : message d'accueil avec badge "Inscriptions ouvertes" et point vert animé
- ✅ **Section Hero (carousel)** : grande image avec texte accrocheur "La référence de la formation professionnelle" et bouton "Voir nos formations"
- ✅ **Section Services / Pourquoi nous choisir** : 4 cartes avec icônes (Enseignement qualifié, Cours en ligne, Certifications, Projets pratiques)
- ✅ **Section À propos** : photo du centre, texte de présentation, liste des points forts (formateurs qualifiés, certificats reconnus, etc.) avec un badge flottant "Centre de confiance — Goma, RDC"
- ✅ **Section Formations** : affiche les formations disponibles avec photo, titre, durée, formateur, prix — chargées dynamiquement depuis la base de données
- ✅ **Section Formateurs** : affiche les formateurs enregistrés avec photo, nom, domaine, contact
- ✅ **Section Témoignages** : carousel avec 3 témoignages d'étudiants avec étoiles et citations
- ✅ **CTA finale** : bannière teal "Prêt à transformer votre avenir ?" avec boutons S'inscrire et Voir les formations
- ✅ **Footer** : liens utiles, informations de contact, réseaux sociaux

**Ce qui pourrait être amélioré :**
- ⚠️ Les boutons "Voir détails" sur les formations mènent à une alerte JavaScript au lieu d'une vraie page de détail
- ⚠️ Le bouton "Voir tous nos formateurs" affiche une alerte — pas de page dédiée
- ⚠️ Pas de page "Contact" fonctionnelle (formulaire de contact inexistant)
- ⚠️ Pas de page "Formations" dédiée avec filtres de recherche

### 4.2 Page À propos (`/about`)

**Ce qu'elle fait :**
- ✅ Présente l'histoire et la mission du centre
- ✅ Affiche les formateurs de l'équipe
- ✅ Montre les chiffres clés du centre

---

## 5. L'authentification (connexion / inscription)

### 5.1 Connexion (`/login`)

- ✅ Design split-screen professionnel : panneau sombre à gauche (branding CFP) + formulaire blanc à droite
- ✅ Email + mot de passe + "Se souvenir de moi"
- ✅ Lien "Mot de passe oublié ?"
- ✅ Redirection vers `/dashboard` après connexion réussie

### 5.2 Inscription (`/register`)

- ✅ Même design split-screen que la connexion
- ✅ Formulaire : Nom, Email, Mot de passe, Confirmation
- ⚠️ **Important** : cette inscription crée un compte utilisateur basique — mais l'utilisateur n'est pas automatiquement lié à un profil Étudiant ou Formateur dans la base. Un administrateur doit le faire manuellement depuis le backend.

---

## 6. Le tableau de bord administrateur

### 6.1 Qui peut se connecter ?

Il y a **3 rôles** dans le système :

| Rôle | Accès |
|------|-------|
| `super admin` | Accès complet à tout le backend (CRUD de tout) |
| `formateur` | Accès limité (tableau de bord + "Mes cours" — en construction) |
| `etudiant` | Accès limité (tableau de bord + "Mes cours" — en construction) |

### 6.2 Tableau de bord (`/dashboard`)

**Ce qu'il affiche :**
- ✅ Message de bienvenue avec nom de l'utilisateur connecté et date du jour en français
- ✅ **5 cartes KPI** avec dégradés de couleur :
  - 🟦 Formateurs (total)
  - 🟣 Formations (total)
  - 🟠 Étudiants (total)
  - 🔴 Inscriptions (total)
  - 🟢 Dons reçus (total)
- ✅ **Graphique ApexCharts** : courbe des inscriptions sur les 6 derniers mois
- ✅ **Actions rapides** : boutons pour accéder directement aux modules (visible pour super admin uniquement)
- ✅ **Tableau des 8 dernières inscriptions** : étudiant, formation, date, statut

---

## 7. Les modules de gestion (CRUD)

> CRUD = Create (Créer), Read (Lire), Update (Modifier), Delete (Supprimer)

### 7.1 Gestion des Formateurs (`/formateur`)

**Données gérées :**
- Nom, Prénom, Domaine d'expertise
- Contact, Email, Adresse
- Date de naissance, Sexe
- Photo de profil
- Compte utilisateur lié (avec mot de passe)

**Fonctionnalités :**
- ✅ Ajouter un formateur (avec création automatique d'un compte utilisateur)
- ✅ Modifier les informations
- ✅ Supprimer un formateur
- ✅ Uploader une photo (jusqu'à 15 Mo, formats jpg/png/webp)
- ✅ Recherche par nom
- ✅ Pagination

### 7.2 Gestion des Formations (`/formation`)

**Données gérées :**
- Titre, Description, Objectifs
- Session, Prérequis, Durée
- Dates début/fin, Lieu
- Prix, Photo, Lien vidéo
- Formateur assigné

**Fonctionnalités :**
- ✅ Ajouter une formation avec tous les détails
- ✅ Modifier / Supprimer
- ✅ Upload de photo de formation
- ✅ Lier la formation à un formateur existant
- ✅ Vue grille ou liste (bouton bascule)
- ✅ Recherche par titre ou formateur
- ✅ Pagination

### 7.3 Gestion des Étudiants (`/etudiant`)

**Données gérées :**
- Nom, Prénom, Contact, Email
- Adresse, Date de naissance, Sexe
- Compte utilisateur lié

**Fonctionnalités :**
- ✅ Ajouter un étudiant (avec création de compte utilisateur)
- ✅ Modifier / Supprimer
- ✅ Recherche
- ✅ Pagination

### 7.4 Gestion des Inscriptions (`/inscritption`)

> Note : il y a une faute de frappe dans l'URL (`inscritption` au lieu de `inscription`) — à corriger.

**Données gérées :**
- Étudiant inscrit
- Formation choisie
- Date d'inscription

**Fonctionnalités :**
- ✅ Inscrire un étudiant à une formation
- ✅ Voir la liste des inscriptions
- ✅ Supprimer une inscription
- ⚠️ Pas de filtre par formation ou par étudiant
- ⚠️ Pas de statut d'inscription (payé/non payé, présent/absent, etc.)

### 7.5 Gestion des Dons (`/dons`)

**Données gérées :**
- Nom du donateur, contact
- Montant, Date du don

**Fonctionnalités :**
- ✅ Enregistrer un don
- ✅ Voir la liste
- ✅ Modifier / Supprimer
- ⚠️ Pas de total des dons affiché
- ⚠️ Pas d'export (Excel, PDF)

---

## 8. Ce qui est bien fait ✅

| Élément | Pourquoi c'est bien |
|---------|-------------------|
| Design frontend | Moderne, chaleureux, cohérent avec la charte teal/sombre du centre |
| Page login/register | Split-screen professionnel, bien mieux que le design Jetstream par défaut |
| Tableau de bord | KPI cards colorées, graphique, tableau récent — visuellement fort |
| Livewire CRUD | Pas de rechargement de page, très fluide pour l'utilisateur |
| Sidebar backend | Sombre avec hover teal, menus par rôle |
| Upload photos | Géré proprement avec validation de taille et format |
| Données dynamiques | Les formations et formateurs sur la page publique viennent de la vraie base |
| Sécurité | Routes backend protégées par `auth`, `sanctum`, et `verified` |
| Rôles utilisateurs | 3 niveaux d'accès (super admin / formateur / étudiant) |

---

## 9. Ce qui est incomplet ou à améliorer ⚠️

| Problème | Impact | Priorité |
|---------|--------|----------|
| Pas de page de détail formation | Un visiteur ne peut pas voir le programme complet d'une formation | 🔴 Haute |
| Pas de page Contact fonctionnelle | Les visiteurs ne peuvent pas envoyer un message | 🔴 Haute |
| L'inscription en ligne ne crée pas de dossier étudiant | Un nouvel utilisateur doit être ajouté manuellement par l'admin | 🔴 Haute |
| Faute de frappe dans la route `/inscritption` | Risque de confusion dans les liens | 🟡 Moyenne |
| Rôles formateur/étudiant sans contenu | "Mes cours" mène nulle part | 🟡 Moyenne |
| Pas de filtre/recherche sur les inscriptions | Difficile à gérer quand il y a beaucoup d'inscriptions | 🟡 Moyenne |
| Pas de total affiché pour les dons | On ne sait pas combien a été collecté au total | 🟡 Moyenne |
| Pas d'export des données | Impossible de télécharger la liste des étudiants, inscriptions, etc. | 🟡 Moyenne |
| Pas de notifications | Aucun email envoyé quand un étudiant s'inscrit | 🟢 Basse |
| Pas de gestion des paiements | Le prix est enregistré mais aucun suivi de paiement | 🟢 Basse |
| Pas de page "Formations" publique avec filtres | Les visiteurs ne peuvent pas chercher une formation par catégorie | 🟢 Basse |

---

## 10. Base de données — ce qui est stocké

```
┌─────────────┐       ┌──────────────┐       ┌─────────────┐
│   users     │       │  formateurs  │       │  formations │
│─────────────│       │──────────────│       │─────────────│
│ id          │──────▶│ user_id      │──────▶│ formateur_id│
│ name        │       │ nom          │       │ titre       │
│ email       │       │ prenom       │       │ description │
│ password    │       │ domaine      │       │ objectif    │
│ role        │       │ contact      │       │ prix        │
│ ...         │       │ email        │       │ date_debut  │
└─────────────┘       │ photo        │       │ date_fin    │
                      └──────────────┘       │ photo       │
                                             └──────┬──────┘
┌─────────────┐       ┌──────────────┐              │
│  etudiants  │       │ inscriptions │◀─────────────┘
│─────────────│       │──────────────│
│ user_id     │──────▶│ etudiant_id  │
│ nom         │       │ formation_id │
│ prenom      │       │ date_inscr.  │
│ contact     │       └──────────────┘
│ ...         │
└─────────────┘

┌─────────────┐
│    dons     │
│─────────────│
│ nom         │
│ contact     │
│ montant     │
│ date        │
└─────────────┘
```

---

## 11. Ce que le site DEVRAIT faire à terme (vision complète)

Voici ce qu'un centre de formation professionnel complet devrait avoir :

**Pour les visiteurs (public) :**
- [ ] Page formations avec moteur de recherche et filtres (domaine, durée, prix)
- [ ] Page de détail d'une formation (programme, formateur, avis, date, prix)
- [ ] Formulaire d'inscription en ligne qui crée automatiquement le dossier étudiant
- [ ] Page Contact avec formulaire envoyant un email
- [ ] Attestations et certificats téléchargeables

**Pour l'administration :**
- [ ] Tableau de bord avec statistiques financières (total des paiements, dons)
- [ ] Suivi des paiements par étudiant
- [ ] Export Excel/PDF des listes (étudiants, inscriptions, dons)
- [ ] Envoi d'emails automatiques (confirmation d'inscription, rappels)
- [ ] Gestion du calendrier des formations
- [ ] Espace formateur fonctionnel (voir ses étudiants, noter, uploader des ressources)
- [ ] Espace étudiant fonctionnel (voir ses formations, télécharger ses ressources)

**Technique :**
- [ ] Corriger la faute de frappe `/inscritption` → `/inscription`
- [ ] Ajouter des notifications Livewire après chaque action CRUD
- [ ] Optimiser les images uploadées (redimensionnement automatique)
- [ ] Mettre en place des sauvegardes automatiques de la base de données

---

## 12. Résumé en une phrase

> CFP Mon Cœur est une application web **fonctionnelle et bien conçue visuellement** qui couvre l'essentiel de la gestion d'un centre de formation (formateurs, formations, étudiants, inscriptions, dons), mais qui a besoin de **compléter le parcours visiteur** (page formation détaillée, inscription en ligne automatique, formulaire de contact) pour être 100% opérationnelle en production.

---

*Fichier rédigé automatiquement à partir de l'analyse du code source de `artifacts/cfpmoncoeur/`.*
