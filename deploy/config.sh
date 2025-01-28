#!/bin/bash

# ## Instalación ##

# 1. INSTALAR PAQUETES
sudo yum install -y httpd php php-gd php-xml php-mbstring php-json php-zip php-pgsql php-pdo_pgsql git php81-fpm
sudo yum install -y postgresql15 postgresql15-server postgresql15-contrib
sudo dnf install -y nodejs nginx

# 2. DESCARGAR REPOSITORIOS
sudo mkdir -p /var/www/test
sudo git clone https://github.com/FATALERRORRACE/decameronHotelsBackend.git /var/www/test/decameronHotelsBackend
sudo git clone https://github.com/FATALERRORRACE/decameronHotelsFrontend.git /var/www/test/decameronHotelsFrontend
sudo chown -R nginx:nginx /var/www/test
sudo cp /var/www/test/decameronHotelsBackend/.env.example /var/www/test/decameronHotelsBackend/.env

# 3. CREAR BASE DE DATOS
# Inicializar y habilitar PostgreSQL
sudo postgresql-setup --initdb
sudo systemctl start postgresql
sudo systemctl enable postgresql

# Establecer contraseña para el usuario postgres
echo "Estableciendo contraseña para postgres..."
sudo passwd postgres

# Crear la base de datos y usuario
sudo -i -u postgres psql -c "CREATE DATABASE decamerontest;"
sudo -i -u postgres psql -c "CREATE USER admin WITH PASSWORD 'Admin123';"
sudo -i -u postgres psql -c "GRANT ALL PRIVILEGES ON DATABASE decamerontest TO admin;"

# 4. INSTALAR SERVIDOR (NGINX)
sudo systemctl enable nginx.service
sudo cp /var/www/test/decameronHotelsBackend/deploy/decameron-backend.conf /etc/nginx/conf.d/app.decameron-backend.conf
sudo cp /var/www/test/decameronHotelsBackend/deploy/decameron-frontend.conf /usr/share/nginx/modules/app.decameron-frontend.conf
sudo systemctl restart nginx.service

# 5. INSTANCIAR SERVIDOR BACKEND
# Instalar Composer
sudo wget https://getcomposer.org/composer.phar
sudo chmod +x composer.phar
sudo mv composer.phar /usr/local/bin/composer

# Configurar el backend
cd /var/www/test/decameronHotelsBackend
sudo composer install
sudo php artisan migrate
sudo php artisan db:seed
sudo php artisan optimize

# 6. INSTANCIAR SERVIDOR FRONTEND
cd /var/www/test/decameronHotelsFrontend
sudo npm install
sudo npm run build
sudo npm install -g pm2
sudo pm2 start "npm run start -- -p 8080" --name decafront2

# 7. CONFIGURAR HOSTS
## EN TU MAQUINA LOCAL 
## 54.158.42.57 decameron-api-pablo.co
## 54.158.42.57 decameron-pablo.co" >

echo "### Instalación completada con éxito ###"
