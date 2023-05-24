### WSL First steps.

```
apt-get update && apt-get install aptitude && aptitude install build-essential -y && aptitude install ssh wget ca-certificates git unzip curl

### PHP

aptitude install lsb-release apt-transport-https ca-certificates
sudo wget -O /etc/apt/trusted.gpg.d/php.gpg https://packages.sury.org/php/apt.gpg
echo "deb https://packages.sury.org/php/ $(lsb_release -sc) main" | sudo tee /etc/apt/sources.list.d/php.list
aptitude update -y
aptitude install -y php8.2
aptitude install -y php-intl php-mysql php-sqlite3 php-gd php-cli php-common php-zip php-curl php-xml php-bcmath

### COMPOSER 
cd ~
curl -sS https://getcomposer.org/installer -o /tmp/composer-setup.php
HASH=`curl -sS https://composer.github.io/installer.sig`
php -r "if (hash_file('SHA384', '/tmp/composer-setup.php') === '$HASH') { echo 'Installer verified'; } else { echo 'Installer corrupt'; unlink('composer-setup.php'); } echo PHP_EOL;"
php /tmp/composer-setup.php --install-dir=/usr/local/bin --filename=composer
```

### NODE
cd 
curl -fsSL https://deb.nodesource.com/setup_current.x | sudo -E bash -
aptitude update &&
aptitude install nodejs -y


### PHP CS ( NON ROOT )
composer global require squizlabs/php_codesniffer

### JS LINTERS ( ROOT )
npm i -g eslint
npm i -g prettier eslint-config-prettier eslint-plugin-prettier
npm install --global yarn