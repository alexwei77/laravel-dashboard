#
5.4 Installation

The zip file contains all laravel files integrated with josh, however you need to perform following steps to get vendors etc.

#### Get Composer packages

`composer install`

#### permissions

```
chmod -R 775 storage

chmod 775 bootstrap/cache
```

If you are on linux/ mac you can run below command to chown it.

```
chown -R www-data /var/www
```

#### database credentials

open `.env` and modify database details with yours

#### add tables to databaes

`php artisan migrate`

#### add admin to users table

`php artisan db:seed --class=AdminSeeder`

#### compile assets

> If you don't have good knowledge on nodejs and npm, you can copy public folder files from codecanyon's downloaded files

Make sure you have [nodejs](https://nodejs.org) installed in your system



from 5.4 onwards, Laravel team decided to move to webpack from gulp

so assets compilation differs a bit.

They introduced a new npm package for webpack called `mix`

you can read more about it [here](https://laravel.com/docs/5.4/mix)



install local packages

`npm install`

get bower components

`bower install`

move assets to public

`npm run dev`

# Congratulations

open your website and now it should be fully working :\)


## Local Docker DEV-ENV
```bash
cp .env.example .env
git clone https://github.com/laradock/laradock.git
cp laradock/env-example laradock/.env

sed -i -e 's/^\s*DB_HOST=.*/DB_HOST=mysql/' .env
sed -i -e 's/^\s*REDIS_HOST=.*/REDIS_HOST=redis/' .env

#DB_DATABASE

#sed -i -e 's/^\s*MYSQL_DATABASE=default/MYSQL_DATABASE=dmmx/' laradock/.env
sed -i -e 's/^\s*DB_DATABASE=.*/DB_DATABASE=default/' .env

sed -i -e 's/^\s*DB_USERNAME=.*/DB_USERNAME=default/' .env
sed -i -e 's/^\s*DB_USERNAME=.*/DB_USERNAME=default/' .env
sed -i -e 's/^\s*DB_PASSWORD=.*/DB_PASSWORD=secret/' .env


sed -i -e 's/^\s*WORKSPACE_COMPOSER_GLOBAL_INSTALL=false/WORKSPACE_COMPOSER_GLOBAL_INSTALL=true/' laradock/.env
sed -i -e 's/^\s*WORKSPACE_INSTALL_XDEBUG=false/WORKSPACE_INSTALL_XDEBUG=true/' laradock/.env
sed -i -e 's/^\s*PHP_FPM_INSTALL_XDEBUG=false/PHP_FPM_INSTALL_XDEBUG=true/' laradock/.env
sed -i -e 's/^\s*WORKSPACE_INSTALL_NODE=false/WORKSPACE_INSTALL_NODE=true/' laradock/.env

cmd/up.sh

composer install
npm install
npm install -g bower
bower install
npm run dev
```


IDE: mark directory as EXCLUDE(context menu):
 - laradock
 - bootstrap/cache
 - vendor/composer