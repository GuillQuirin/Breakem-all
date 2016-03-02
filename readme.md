#README

git init : initialiser git sur vos machines (dossier .git)
git config --global user.email "votreemail@gmail.com" : permet de s'identifier pour faire du versionning
git config --global user.name "Meghan Wlo" : "idem"
git config list : permet de voir la config de git

dans le dossier où le dossier .git est
touch test.html : créer un nouveau fichier
mkdir mon-dossier : Créer un dossier

git status : permet de savoir ce qui n'a pas été ajouté et/ou commit
git add test.html : ajout d'un fichier près à être commité
git status : le fichier en rouge : n'a pas été ajouté 
			 le fichier en vert : a été ajouté mais pas encore commité
git commit -m "Mon commit fait..." : permet de commiter tous les fichier

touch .gitignore : fichier qui permet d'écrire le nom des fichiers à ignorer lors des commits

git log : liste les derniers commit qui ont été fait
git log -n 2 : liste les 2 derniers commits
git log --oneline : permet d'aligner les derniers commits 

git log -p readme.md : permet de voir tous les commits d'un fichier

git diff : permet de voir les motifs sur les fichiers

git checkout 47e9cf6 : permet de retourner en arrière sur un autre commit pour voir comment c'était avant
mais il ne permet pas de sauvegarder les commits qui seront fait.
Pour trouver les noms de commit : git log --online
Il faut revenir sur la branche master : git checkout master

git revert 47e9cf6 : permet de défaire un commit
Ce commit sera "revert" et si je veux faire revenir ce commit je refaire un git revert l'id-du-revert-commité.

git reset --hard : permet de revenir au commit précédent (TRES DANGEREUX PLUS D'HISTO)
git reset 47e9cf6 : permet de revenir en arrière, cela supprime tous l'historique des commits