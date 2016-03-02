#README

git init : initialiser git sur vos machines (dossier .git)
git config --global user.email "votreemail@gmail.com" : permet de s'identifier pour faire du versionning
git config --global user.name "Meghan Wlo" : "idem"
git config list : permet de voir la config de git

dans le dossier o� le dossier .git est
touch test.html : cr�er un nouveau fichier
mkdir mon-dossier : Cr�er un dossier

git status : permet de savoir ce qui n'a pas �t� ajout� et/ou commit
git add test.html : ajout d'un fichier pr�s � �tre commit�
git status : le fichier en rouge : n'a pas �t� ajout� 
			 le fichier en vert : a �t� ajout� mais pas encore commit�
git commit -m "Mon commit fait..." : permet de commiter tous les fichier

touch .gitignore : fichier qui permet d'�crire le nom des fichiers � ignorer lors des commits

git log : liste les derniers commit qui ont �t� fait
git log -n 2 : liste les 2 derniers commits
git log --oneline : permet d'aligner les derniers commits 

git log -p readme.md : permet de voir tous les commits d'un fichier

git diff : permet de voir les motifs sur les fichiers

git checkout 47e9cf6 : permet de retourner en arri�re sur un autre commit pour voir comment c'�tait avant
mais il ne permet pas de sauvegarder les commits qui seront fait.
Pour trouver les noms de commit : git log --online
Il faut revenir sur la branche master : git checkout master

git revert 47e9cf6 : permet de d�faire un commit
Ce commit sera "revert" et si je veux faire revenir ce commit je refaire un git revert l'id-du-revert-commit�.

git reset --hard : permet de revenir au commit pr�c�dent (TRES DANGEREUX PLUS D'HISTO)
git reset 47e9cf6 : permet de revenir en arri�re, cela supprime tous l'historique des commits