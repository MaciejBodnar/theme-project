#!/bin/bash

echo "🚀 Deploying Sage Theme..."

# Check if we're in the right directory
if [ ! -f "functions.php" ]; then
    echo "❌ Error: Not in theme directory. Please run from theme root."
    exit 1
fi

echo "📦 Installing PHP dependencies..."
composer install --no-dev --optimize-autoloader

echo "📦 Installing Node dependencies..."
npm ci

echo "🏗️ Building assets..."
npm run build

echo "🧹 Cleaning up..."
# Remove development files if deploying to production
if [ "$1" = "production" ]; then
    echo "🚀 Production mode: removing dev files..."
    rm -rf node_modules
    rm -f package-lock.json
    rm -f vite.config.js
    rm -f .env.example
fi

echo "✅ Deployment complete!"
echo "🌐 Your theme is ready!"