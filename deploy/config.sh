sudo yum install -y httpd php php-gd php-xml php-mbstring php-json php-zip php-pgsql php-pdo_pgsql git php8.1-fpm
sudo mkdir -p /var/www/ && sudo chown -R www-data:www-data /var/www/
sudo git clone https://github.com/FATALERRORRACE/decameronHotelsBackend.git /var/www/
sudo wget https://getcomposer.org/composer.phar
sudo chmod +x composer.phar
sudo mv composer.phar /usr/local/bin/composer
cd /var/www/ 
sudo composer install
sudo yum install -y https://download.postgresql.org/pub/repos/yum/reporpms/EL-7-x86_64/pgdg-redhat-repo-latest.noarch.rpm --skip-broken
sudo yum install -y postgresql15 postgresql15-server postgresql15-contrib
sudo postgresql-setup --initdb
sudo systemctl start postgresql
sudo systemctl enable postgresql
sudo passwd postgres
Admin123
Admin123
sudo systemctl start postgresql
su - postgres
sudo -i -u postgres psql
psql -c "ALTER USER postgres WITH PASSWORD 'your-password';"
#execute this command doesnt require login with postgres user
sudo -i -u postgres psql
CREATE USER admin WITH PASSWORD 'Admin123';
CREATE DATABASE decameron;
GRANT ALL PRIVILEGES ON DATABASE decameron TO admin;
# INSTALL NGINX
sudo dnf install nginx
sudo systemctl enable nginx.service
sudo systemctl restart nginx.service

sudo cp /var/www/decameronHotelsBackend/deploy/decameron-backend.conf /etc/nginx/conf.d/decameron-backend.conf














sudo apt install php-cli php-mbstring php-xml php-bcmath php-curl unzip
curl -sS https://getcomposer.org/installer | php
sudo mv composer.phar /usr/local/bin/composer
sudo apt install nginx
# Install repo
sudo mkdir -p /var/www/ && sudo chown -R www-data:www-data /var/www/
git clone https://github.com/FATALERRORRACE/decameronHotelsBackend.git /var/www/
cp /var/www/decameronHotelsBackend
sudo chown -R www-data:www-data /var/www/decameronHotelsBackend
sudo chmod -R 775 /var/www/decameronHotelsBackend/storage /var/www/decameronHotelsBackend/bootstrap/cache
cd /var/www/decameronHotelsBackend
composer install --no-dev --optimize-autoloader


sudo ln -s /etc/nginx/sites-available/decameron-backend.conf /etc/nginx/conf.d/
sudo systemctl restart nginx
# Install postgre
sudo apt install -y postgresql-common
sudo /usr/share/postgresql-common/pgdg/apt.postgresql.org.sh


# Set variables
DB_USER="admin"
DB_PASSWORD="Admin123"
DB_ROLE="READWRITE"
DB_HOST="localhost"
DB_PORT="5432"

# Execute SQL commands
sudo -u postgres psql -c "CREATE USER admin WITH PASSWORD 'Admin123';"
sudo -u postgres psql -c "ALTER USER admin WITH READWRITE;"
sudo -u postgres psql -c "CREATE DATABASE decameron;"

echo "User admin created with role "READWRITE"."

#laravel config
php artisan migrate
php artisan db:seed
php artisan config:cache
php artisan route:cache

