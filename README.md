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