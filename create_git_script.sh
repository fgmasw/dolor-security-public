#!/bin/bash

# Define variables
PROJECT_DIR="/home/administrator/dolor-security"
REMOTE_REPO_URL="git@github.com:fgmasw/dolor-security-private.git"
COMMIT_MESSAGE="Update with changes $(date +'%Y-%m-%d %H:%M')"

# Prompt the user to save all changes in the IDE
read -p "Have you saved all your changes in the IDE? (yes/no): " response
if [ "$response" != "yes" ]; then
    echo "Please save all your changes in the IDE before running the script."
    exit 1
fi

# Navigate to the project directory
cd "$PROJECT_DIR" || { echo "Project directory not found"; exit 1; }

# Initialize Git repository if not already initialized
if [ ! -d ".git" ]; then
    git init
fi

# Create an initial README file if it doesn't exist
if [ ! -f "README.md" ]; then
    echo "# Actividad-2" >> README.md
    git add README.md
    git commit -m "first commit"
fi

# Create the main branch if not already on it
git branch -M main

# Add the remote repository if not already added
if ! git remote | grep -q "origin"; then
    git remote add origin "$REMOTE_REPO_URL"
else
    git remote set-url origin "$REMOTE_REPO_URL"
fi

# Check for unstaged changes and avoid pulling
if [ -n "$(git status --porcelain)" ]; then
    echo "You have unstaged changes. Proceeding to commit and push without pulling."
fi

# Add all files to the staging area
git add .

# Commit the changes with a message
git commit -m "$COMMIT_MESSAGE"

# Push changes to the remote repository
git push -u origin main

echo "Backup completed successfully."
