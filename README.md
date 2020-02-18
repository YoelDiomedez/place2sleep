# Place2Sleep

Place 2 Sleep - Sistema para la Administración de Cementerios

## Características

**Módulo Inhumaciones**
- [x] Nichos
- [x] Mausoleos

**Módulo Administración**
- [x] Usuarios
- [x] Auditorias
- [x] Copias de Seguridad

## Requirements

- PHP >= 7.1.3 (composer)
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
  php artisan migrate

# Launch Server
  php artisan serve
  
```