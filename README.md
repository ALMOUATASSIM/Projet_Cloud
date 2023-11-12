# Projet de Recherche d'Informations pour l'UPPA
Ce projet est un site de recherche permettant d'obtenir les emails et numéros de téléphone des étudiants, enseignants et fonctionnaires de l'Université de Pau et des Pays de l'Adour (UPPA). Le déploiement du projet est facilité grâce à l'utilisation de Docker.

## Instructions de lancement
### Sur Ubuntu
1. **Téléchargez le dossier du projet depuis le référentiel Git.**
2. **Ouvrez un terminal et naviguez vers le répertoire du projet.**
`CD \your\project\directory\`
3. **Exécutez la commande suivante :**
`sudo docker-compose up`
4. **Accédez à un navigateur et entrez l'URL suivante :** 
`localhost:5000`
### Sur Windows
1. **Téléchargez le dossier du projet depuis le référentiel Git.**
2. **Ouvrez un terminal et naviguez vers le répertoire du projet.**
`CD /your/project/directory/`
3. **Exécutez la commande suivante :**
`docker-compose up`
4. **Accédez à un navigateur et entrez l'URL suivante :**
`localhost:5000`
## Connexion
-Pour vous connecter en tant qu'étudiant ou enseignant, consultez les identifiants dans le fichier "Pour se connecter.txt" envoyé par mail.
-Vous pouvez également accéder directement en tant qu'administrateur en visitant :
`localhost:5000/app/pages/admin`
## Gestion de la Base de Données
-Pour gérer la base de données, accédez à phpMyAdmin via :
`localhost:3000`
user: user 
password: password

**Note:** Assurez-vous d'avoir Docker installé sur votre système avant d'exécuter ces commandes.
---

**Note:** Ce projet a été développé dans un but éducatif et ne doit pas être utilisé à des fins malveillantes ou non autorisées.

