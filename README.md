# Sogec-Test-Pokemon

## Installer le projet
- Démarrer votre logiciel de serveur(xamppe, wampp ou MySql etc)
- git clone https://github.com/Heroszhen/Sogec-Test-Pokemon.git
- Entrer dans le projet
- Modifier le fichier .env.local(ce fichier ne doit pas exister en production) : username et password ou le nom de la base données
- chmod 755 cmds/*
- ./cmds/createdb.sh (les bundles dans vendor , la base données et les tables seront installés automatiquement)

## Import du fichier csv
- Taper la commande : php bin/console app:import:csv filepath
- La chaîne de caractères qui suit la commande  "app:import:csv" est le chemin du fichier,
elle est sous cette forme : path/file.csv, elle ne doit pas contenir d'antislash.

## Inscription
- chmod 755 cmds/*
- ./cmds/createdb.sh
- ./cmds/clear.sh
- Lancer un serveur local: php bin/console server:run
- Route: http://127.0.0.1:8000/api/users/registration
- Contenu à envoyer en post : 
    {
        "email":"aaa@gmail.com",
        "password": "Aa123456789;"
    }
- Vous pouvez aussi tester cette route sur ce lien : http://127.0.0.1:8000/api

## Connexion
- Si vous n'avez pas fait les étapes précédentes : 
    - chmod 755 cmds/*
    - ./cmds/createdb.sh
    - Lancer un serveur local: php bin/console server:run
- ./cmds/clear.sh
- Route: http://127.0.0.1:8000/api/login_check
- Contenu à envoyer en post : 
    {
        "email":"aaa@gmail.com",
        "password": "Aa123456789;"
    }
- Si tout se passe bien , un token vous sera retourné.

## Index / Show
- Si vous n'avez pas fait les étapes précédentes : 
    - chmod 755 cmds/*
    - ./cmds/createdb.sh
    - Lancer un serveur local: php bin/console server:run
- ./cmds/clear.sh
- Route: http://127.0.0.1:8000/api/monsters ; http://127.0.0.1:8000/api/monsters/{id}
- Vous pouvez les tester sur http://127.0.0.1:8000/api une fois que votre serveur local est lancé