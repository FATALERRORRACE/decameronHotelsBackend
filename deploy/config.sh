## Instalación 
   ##  1. INSTALAR PAQUETES:
        sudo yum install -y httpd php php-gd php-xml php-mbstring php-json php-zip php-pgsql php-pdo_pgsql git php8.1-fpm
        sudo yum install -y postgresql15 postgresql15-server postgresql15-contrib
        sudo dnf install nodejs
        sudo dnf install nginx

    ## 2. DESCARGAR REPOSITORIOS
        sudo mkdir /var/www/
        sudo git clone https://github.com/FATALERRORRACE/decameronHotelsBackend.git /var/www/
        sudo chown -R nginx:nginx /var/www/decameronHotelsBackend
        sudo git clone https://github.com/FATALERRORRACE/decameronHotelsFrontend.git /var/www/
        sudo chown -R nginx:nginx /var/www/decameronHotelsBackend
    
    ## 3. CREAR BASE DE DATOS:
       ##  activar servicios:
            sudo postgresql-setup --initdb
            sudo systemctl start postgresql
            sudo systemctl enable postgresql
            sudo passwd postgres // para agregar contraseña su posgres

        ## crear: 
            sudo -i -u postgreUser psql
            "CREATE DATABASE decameron;"
            permisos: 
            CREATE USER admin WITH PASSWORD 'Admin123';
            CREATE DATABASE decameron;
            GRANT ALL PRIVILEGES ON DATABASE decameron TO admin;

    ## 4. INSTALAR SERVIDOR (NGINX): 
        sudo systemctl enable nginx.service
        sudo cp /var/www/decameronHotelsBackend/deploy/decameron-backend.conf /etc/nginx/conf.d/decameron-backend.conf
        sudo cp /var/www/decameronHotelsBackend/deploy/decameron-frontend.conf /usr/share/nginx/modules/decameron-frontend.conf
        sudo systemctl restart nginx.service

    ## 5. INSTANCIAR SERVIDOR BACKEND:
        ## instalar composer:
            sudo wget https://getcomposer.org/composer.phar
            sudo chmod +x composer.phar
            sudo mv composer.phar /usr/local/bin/composer
            cd /var/www/decameronHotelsBackend
            sudo composer install
        ## agregar tablas:
            sudo php artisan migrate
        ## agregar registros:
            sudo php artisan db:seed
        ## optimizar en cache contenido:
            sudo php artisan optimize

    ## 6. INSTANCIAR SERVIDOR FRONTEND:
        cd /var/www/decameronHotelsFrontend
        sudo npm i 
        sudo npm run build
        sudo npm i pm2 -g 
        sudo pm2 start "npm run start -- -p 8080" --name decafront

    ## 7. CONFIGURAR HOSTS:
        54.158.42.57   decameron-api-pablo.co
        54.158.42.57   decameron-pablo.co
