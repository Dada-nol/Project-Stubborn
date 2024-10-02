# Projet Stubborn

Ce projet consiste à créer un site e-commerce pour la marque de sweat-shirts
Stubborn. L'application repose sur le framework Symfony, avec une base de données
MySQL. Cette documentation présente les étapes d'installation, la structure du projet,
ainsi que les fonctionnalités développées pour répondre aux besoins de la boutique en
ligne.

## Prérequis

Avant de commencer, assurez-vous d'avoir les éléments suivants installés sur votre
machine :
• PHP >= 8.0
• Composer
• MySQL
• Symfony CLI
• Un compte Stripe pour la gestion des paiements
• Un serveur local (WAMP, MAMP, ou LAMP)

### Hébergement Local

La commande de démarage du serveur Symfony lance le dit serveur, Mailer ainsi que
les tests. Pour héberger et tester le projet localement :

• Démarrer le serveur Symfony : ./start.cmd
• Accéder au site via : http://localhost:8000
• Simuler un achat en utilisant le mode sandbox de Stripe pour tester les
paiements sans argent réel.
