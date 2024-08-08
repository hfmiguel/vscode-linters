### WSL installation

#### Will be installed the Debian distro

1. Open your power sheel ( or Windows terminal for windows 11 ) as admin
2. wsl --install -d Debian
3. After install finish , you must restart your computer .
4. After reboot , open your Debian terminal and finish the linux configuration
  - username
  - password
5. Open your power sheel again , and force to use WSL 2: wsl --set-default-version 2
6. With your WSL running  , install the Docker Desktop app for Windows.
7. After install the docker desktop for windows  , enable your distro :
![image](https://github.com/hfmiguel/vscode-linters/assets/14097051/41bfd5f0-fa25-453b-8417-e5f11fef0f19)
  - After select your linux distro , click to Apply & Restart.



### WSL First steps (  root user )

```
## login as root
sudo su

### aptitude its not mandatory. if you dont want to install,  change all ocurrency of aptitude for apt-get ( or just apt )

apt-get update && apt-get install aptitude -y

sudo aptitude install build-essential -y
sudo aptitude install ssh wget ca-certificates git unzip curl -y
```

### PHP installation  (  root user )

#### Debian
```
sudo aptitude install lsb-release apt-transport-https ca-certificates
sudo wget -O /etc/apt/trusted.gpg.d/php.gpg https://packages.sury.org/php/apt.gpg
echo "deb https://packages.sury.org/php/ $(lsb_release -sc) main" | sudo tee /etc/apt/sources.list.d/php.list
sudo aptitude update -y
sudo aptitude install -y php8.2
```

#### Ubuntu
```
sudo apt install software-properties-common
sudo add-apt-repository ppa:ondrej/php
sudo apt-get update
sudo apt install php8.2
```


#### PHP extensions
```
sudo aptitude install -y php-intl php-mysql php-sqlite3 php-gd php-cli php-common php-zip php-curl php-xml php-bcmath php-xdebug php-soap php-apcu php-redis php-memcached  php-mbstring
```


#### Check installed PHP versions
```
sudo update-alternatives --config php
### If necessary , change your default php.
```

#### Check php
```
Testing :

Type php -v into your terminal to see the output.

php -v

Output:
PHP 8.2.7 (cli) (built: Jun  9 2023 07:37:35) (NTS)
Copyright (c) The PHP Group
Zend Engine v4.2.7, Copyright (c) Zend Technologies
    with Zend OPcache v8.2.7, Copyright (c), by Zend Technologies
    with Xdebug v3.2.1, Copyright (c) 2002-2023, by Derick Rethans
```



### COMPOSER installation

```
cd ~
curl -sS https://getcomposer.org/installer -o /tmp/composer-setup.php
HASH=`curl -sS https://composer.github.io/installer.sig`
php -r "if (hash_file('SHA384', '/tmp/composer-setup.php') === '$HASH') { echo 'Installer verified'; } else { echo 'Installer corrupt'; unlink('composer-setup.php'); } echo PHP_EOL;"
php /tmp/composer-setup.php --install-dir=/usr/local/bin --filename=composer
```

### NODE ( root )

```
sudo su

cd
curl -fsSL https://deb.nodesource.com/setup_current.x | sudo -E bash -
aptitude update &&
aptitude install nodejs -y
```

-------------------
-------------------


### SSH

1. Using your normal user , execute:
2. `ssh-keygen`
3. This code will generate a ssh key code. Use this code in your gitlab/github account to allow to push and pull from your repositories.

## LINTERS


### PHP Codesniffer ( NON ROOT )

```
composer global require squizlabs/php_codesniffer --dev

- After  , go to your composer installation folder
 - probably will be : /home/$USER/.config/composer/
 - Copy the content of composer.json to your composer.json and run *composer install*

phpcs --config-set php_path /usr/bin/php
phpcs --config-set default_standard PSR12
phpcs --config-set severity 1
phpcs --config-set colors 1
phpcs --config-set installed_paths /home/$USER/.config/composer/vendor/phpcompatibility/php-compatibility,/home/felix/.config/composer/vendor/dealerdirect/phpcodesniffer-composer-installer/src

phpcs --config-show   ### show configs

```

### PHP CS/CBF RULES
- Run into terminal
```
touch /home/$USER/phpcs.xml
```
- Copy the phpcs.xml to your local file.
- dont forget to update your VSCODE path
- Update the PHPCS config path

```
phpcs --config-set default_standard /home/$USER/phpcs.xml
```

------------------------
------------------------

### PHP STAN
1. Install
    - composer global require --dev phpstan/phpstan
```
phpstan analyse -l 9 --error-format=table path/to/folder
```


### PHP INSIGHTS
1. Install
 - composer require nunomaduro/phpinsights --dev
3. Run
```
phpinsights analyse -v app/ --fix
```

---------------------
---------------------
### Creating simbolic links for composer packages

sudo ln -s /home/felix/.config/composer/vendor/bin/phpinsights /usr/local/bin/phpinsights
sudo ln -s /home/$USER/.config/composer/vendor/bin/phpstan /usr/local/bin/phpstan
sudo ln -s /home/$USER/.config/composer/vendor/squizlabs/php_codesniffer/bin/phpcs /usr/local/bin/phpcs
sudo ln -s /home/$USER/.config/composer/vendor/squizlabs/php_codesniffer/bin/phpcbf /usr/local/bin/phpcbf
sudo ln -s /home/$USER/.config/composer/vendor/bin/pint /usr/local/bin/pint
sudo ln -s /home/$USER/.config/composer/vendor/bin/rector /usr/local/bin/rector

------------------------
------------------------

### USING PHPCS
```
phpcs -p You/Folder  or Your/Folder/File.php

Example:

phpcs -p -v -w /home/YourUser/project/

### Output

Registering sniffs in the Custom ruleset standard... DONE (177 sniffs registered)
Creating file list... DONE (1 files in queue)
Changing into directory /home/YourUser/projetos/projectTest/app/Enums
Processing SourceType.php [PHP => 180 tokens in 34 lines]... DONE in 9ms (10 errors, 0 warnings)

FILE: /home/YourUser/projetos/projectTest/app/Enums/Example.php
---------------------------------------------------------------------------------------------
FOUND 10 ERRORS AFFECTING 6 LINES
---------------------------------------------------------------------------------------------
  7 | ERROR | [x] Expected 1 space before "int"; 0 found
  7 | ERROR | [x] Opening brace of a enum must be on the line after the definition
 16 | ERROR | [x] Expected 1 space(s) after MATCH keyword; 0 found
 16 | ERROR | [ ] "$this" can no longer be used in a plain function or method since PHP 7.1.
 19 | ERROR | [x] Blank line found at end of control structure
 26 | ERROR | [ ] "$this" can no longer be used in a plain function or method since PHP 7.1.
 26 | ERROR | [ ] Late static binding is not supported outside of class scope.
 31 | ERROR | [ ] "$this" can no longer be used in a plain function or method since PHP 7.1.
 31 | ERROR | [ ] Late static binding is not supported outside of class scope.
 34 | ERROR | [x] The closing brace for the enum must go on the next line after the body
---------------------------------------------------------------------------------------------
PHPCBF CAN FIX THE 5 MARKED SNIFF VIOLATIONS AUTOMATICALLY
---------------------------------------------------------------------------------------------
Time: 91ms; Memory: 10MB


And , to fix .

phpcbf -p -v -w /home/YourUser/project/


### Output

PHPCBF RESULT SUMMARY
-----------------------------------------------------------------------------------------
FILE                                                                     FIXED  REMAINING
-----------------------------------------------------------------------------------------
/home/YourUser/projetos/projectTest/app/Enums/Example.php                  5      5
-----------------------------------------------------------------------------------------
A TOTAL OF 5 ERRORS WERE FIXED IN 1 FILE
-----------------------------------------------------------------------------------------

Time: 114ms; Memory: 10MB


### in this scenario , phpcbf fixed 5 errors but cant fix 5 , you need to fix manually.

```

------------------------
------------------------

### JS LINTERS ( ROOT )
```
npm i -g eslint
npm i -g prettier eslint-config-prettier eslint-plugin-prettier
npm install --global yarn
```

### GIT ( NON ROOT )
```
- For local config . If want to set this settings for all projects ,use : git config --global
git config pull.rebase false
git config user.name "Your Username"
git config user.email "Your git email "
```

------------------------
------------------------


### VS CODE Settings

- Type into your VSCODE CTRL + SHIFT + P and type:  settings.json
  - Click to open Remote settings ( WSL + YourWslDistroName )
  - Or
  - Click to open : Workspace Settings

- Why ? Because some config not work if you put into your User Settings ( settings that are sync with your github/microsoft account )
- After open your settings , copy the settings.json content to your

- After copy , change all occurrences of "felix" from the settings and change to your username


![Alt text](image.png)


------------------------
------------------------


### EXTENSIONS
```
Nome: PHP Intelephense
ID: bmewburn.vscode-intelephense-client
Descrição: PHP code intelligence for Visual Studio Code
Editor: Ben Mewburn
Link do Marketplace do VS: https://marketplace.visualstudio.com/items?itemName=bmewburn.vscode-intelephense-client
```

```
Nome: phpcs
ID: shevaua.phpcs
Descrição: PHP CodeSniffer for Visual Studio Code
Editor: shevaua
Link do Marketplace do VS: https://marketplace.visualstudio.com/items?itemName=shevaua.phpcs
```

```
Nome: PHP Sniffer
ID: wongjn.php-sniffer
Descrição: Uses PHP_CodeSniffer to format and lint PHP code.
Editor: wongjn
Link do Marketplace do VS: https://marketplace.visualstudio.com/items?itemName=wongjn.php-sniffer
```

```
Nome: phpstan
ID: SanderRonde.phpstan-vscode
Descrição: PHPStan language server and inline error provider
Versão: 2.2.26
Editor: SanderRonde
Link do Marketplace do VS: https://marketplace.visualstudio.com/items?itemName=SanderRonde.phpstan-vscode
```

```
Nome: ESLint
ID: dbaeumer.vscode-eslint
Descrição: Integrates ESLint JavaScript into VS Code.
Editor: Microsoft
Link do Marketplace do VS: https://marketplace.visualstudio.com/items?itemName=dbaeumer.vscode-eslint
```

```
Nome: Prettier - Code formatter
ID: esbenp.prettier-vscode
Descrição: Code formatter using prettier
Editor: Prettier
Link do Marketplace do VS: https://marketplace.visualstudio.com/items?itemName=esbenp.prettier-vscode
```

#### Trunk Check
##### Trunk is a pretty cool extension that use the power of the previous installed extensions and linters to give you, visual feedbacks about your code issues.
```
Nome: Trunk Check
ID: trunk.io
Descrição: Automated Code Quality for Teams: universal formatting, linting, static analysis, and security
Versão: 3.18.4
Editor: Trunk
Link do Marketplace do VS: https://marketplace.visualstudio.com/items?itemName=Trunk.io
```
