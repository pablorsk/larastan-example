# Larastan example

This is a basic Laravel project with a some models, tests and lararastan package.

## Instructions

```bash
composer install
```

### Step 1

```bash
php artisan code:analyse -l 7 -p "app"
 32/32 [▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓] 100%
 [OK] No errors
```

### Step 2

```bash
php artisan code:analyse -l 7 -p "app,tests"
 36/36 [▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓] 100%
 [OK] No errors
```
