#!/bin/bash

echo "🚀 Building Theme for Production Deployment..."

# Build assets for production
echo "📦 Building Tailwind CSS and assets..."
npm run build

# Create deployment folder name with timestamp
DEPLOY_FOLDER="theme-production-$(date +%Y%m%d-%H%M)"

echo "📁 Creating deployment folder: $DEPLOY_FOLDER"
mkdir -p "$DEPLOY_FOLDER"

echo "📋 Copying essential files only..."

# Copy WordPress theme files (required)
cp functions.php "$DEPLOY_FOLDER/" 2>/dev/null || echo "⚠️  functions.php not found"
cp style.css "$DEPLOY_FOLDER/" 2>/dev/null || echo "⚠️  style.css not found"
cp index.php "$DEPLOY_FOLDER/" 2>/dev/null || echo "⚠️  index.php not found"
cp 404.php "$DEPLOY_FOLDER/" 2>/dev/null || echo "ℹ️  404.php not found (optional)"

# Copy essential directories
echo "   ✓ Copying Blade templates..."
mkdir -p "$DEPLOY_FOLDER/resources"
cp -r resources/views "$DEPLOY_FOLDER/resources/"

echo "   ✓ Copying built assets (CSS/JS)..."
mkdir -p "$DEPLOY_FOLDER/public"
cp -r public/build "$DEPLOY_FOLDER/public/"

echo "   ✓ Copying theme logic..."
cp -r app "$DEPLOY_FOLDER/"

echo "   ✓ Copying PHP dependencies..."
cp -r vendor "$DEPLOY_FOLDER/" 2>/dev/null || echo "⚠️  vendor/ not found - run 'composer install'"

# Copy composer files if they exist
cp composer.json "$DEPLOY_FOLDER/" 2>/dev/null || echo "ℹ️  composer.json not found"

echo "✅ Production theme folder created: $DEPLOY_FOLDER"
echo ""
echo "📁 Upload this entire folder to your hosting:"
echo "   /htdocs/wp-content/themes/your-theme-name/"
echo ""
echo "🌐 Your Tailwind CSS will work on the hosting server"

# Show what's included
echo ""
echo "📋 Deployment folder includes:"
echo "   ✓ functions.php, style.css, index.php"
echo "   ✓ resources/views/ (Blade templates)"
echo "   ✓ public/build/ (Built CSS/JS with Tailwind)"
echo "   ✓ app/ (Theme logic & ACF helpers)"
echo "   ✓ vendor/ (PHP dependencies)"
echo ""
echo "❌ Deployment folder excludes:"
echo "   ✗ node_modules/ (not needed)"
echo "   ✗ resources/css/, resources/js/ (source files)"
echo "   ✗ package.json, vite.config.js (dev tools)"
echo "   ✗ .git/, .env files (development)"

# Show folder size
FOLDER_SIZE=$(du -sh "$DEPLOY_FOLDER" | cut -f1)
echo ""
echo "📊 Deployment folder size: $FOLDER_SIZE"
