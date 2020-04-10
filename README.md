# Place2Sleep

Place 2 Sleep - Sistema para la Administración de Cementerios

## Características

**Módulo Inhumaciones**
- [x] Nicho
- [x] Mausoleo

**Módulo Exhumaciones**
- [x] Nicho
- [x] Mausoleo

**Módulo Cementerio**
- [x] Nichos
- [x] Mausoleos
- [x] Pabellones

**Módulo Administración**
- [x] Difuntos
- [x] Familiares
- [x] Cementerios

## Requirements

- PHP >= 7.3.5 (composer)
- NodeJS >= 13.0.1 (npm)
- MariaDB >= 10.1.40

``` bash
# Dependency Installation
  composer install
  npm install
  npm run dev (optional)
  
# .env File Set Up
  DB_DATABASE=yourdatabasename
  DB_USERNAME=yourusername
  DB_PASSWORD=yoursecretpassword
  
# Additionally in order to test E-mail Verification and Password Reset
  MAIL_USERNAME=yourusername
  MAIL_PASSWORD=yoursecretpassword
  MAIL_ENCRYPTION=null
  
# Data Base Migration
  php artisan migrate --seed | migrate:refesh --seed

# Launch Server
  php artisan serve | path/app/public
  
```