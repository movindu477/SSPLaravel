# Railway Deployment Guide for PetMart

## ✅ STEP 1 — PREPARE LOCAL PROJECT

### 1. Update .env for Production

Update your local `.env` file with these settings:

```env
APP_NAME=PetMart
APP_ENV=production
APP_DEBUG=false
APP_URL=https://petmart.up.railway.app

LOG_CHANNEL=stderr

DB_CONNECTION=sqlsrv
# You'll need to update these with Railway's SQL Server connection details
DB_HOST=your-railway-db-host
DB_PORT=1433
DB_DATABASE=SSPSEM2
DB_USERNAME=your-railway-db-user
DB_PASSWORD=your-railway-db-password
```

### 2. Generate APP_KEY

Run this command locally:
```bash
php artisan key:generate --show
```

**Save this key** — you'll paste it into Railway's environment variables as `APP_KEY`.

### 3. Push to GitHub

Your repository is connected to:
```
https://github.com/movindu477/PetMart.git
```

Make sure all changes are committed:
```bash
git add .
git commit -m "Prepare for Railway deployment"
git push origin main
```

## ✅ STEP 2 — RAILWAY SETUP

### 1. Create Railway Account
- Go to https://railway.app
- Sign up/login with GitHub

### 2. Create New Project
- Click "New Project"
- Select "Deploy from GitHub repo"
- Choose `movindu477/PetMart`

### 3. Add Environment Variables

In Railway dashboard → Your Service → Variables, add:

```
APP_NAME=PetMart
APP_ENV=production
APP_DEBUG=false
APP_URL=https://petmart.up.railway.app
APP_KEY=base64:YOUR_GENERATED_KEY_HERE

LOG_CHANNEL=stderr

DB_CONNECTION=sqlsrv
DB_HOST=your-db-host.railway.app
DB_PORT=1433
DB_DATABASE=SSPSEM2
DB_USERNAME=sa
DB_PASSWORD=your-db-password

SESSION_DRIVER=database
CACHE_DRIVER=file
QUEUE_CONNECTION=sync
```

### 4. Add SQL Server Database

- In Railway, click "+ New" → "Database" → "Add SQL Server"
- Copy the connection details Railway provides
- Update `DB_HOST`, `DB_USERNAME`, `DB_PASSWORD` in environment variables

### 5. Deploy Commands (Optional - Railway auto-detects Laravel)

Railway will automatically:
- Run `composer install`
- Detect the Procfile
- Start the web server

If you need custom build commands, add in Railway Settings:
```
Build Command: composer install --no-dev --optimize-autoloader
Start Command: php artisan serve --host=0.0.0.0 --port=$PORT
```

### 6. Run Migrations

After deployment, in Railway dashboard → Service → "Deploy Logs" → "Shell":
```bash
php artisan migrate --force
```

Or add to Railway build command:
```
Build Command: composer install --no-dev && php artisan migrate --force
```

## ✅ STEP 3 — VERIFY DEPLOYMENT

1. Check Railway logs for successful deployment
2. Visit `https://petmart.up.railway.app`
3. Test the application:
   - Register a user
   - Browse products
   - Add to cart
   - Complete checkout

## ⚠️ IMPORTANT NOTES

1. **Database**: Make sure Railway SQL Server database has the same schema as your local database. You may need to run your `SSPSEM2.sql` script on Railway's database.

2. **Storage**: For file uploads, Railway's filesystem is ephemeral. Consider using S3 or Railway's volume for persistent storage.

3. **Public Storage**: Run this after deployment:
   ```bash
   php artisan storage:link
   ```

4. **Optimize**: Before deploying, optimize for production:
   ```bash
   php artisan config:cache
   php artisan route:cache
   php artisan view:cache
   ```

## 🔗 Railway Resources

- Railway Docs: https://docs.railway.app
- Laravel on Railway: https://docs.railway.app/guides/laravel

