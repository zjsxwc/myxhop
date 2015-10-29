##Vagrant Box
https://github.com/irmantas/symfony2-vagrant

##Password

###Mysql
* Vagrant automatically setups database with this setup:

    * Username: symfony
    * Password: symfony-vagrant
    * Database: symfony

* root password is in file /root/.my.cnf

eg:
```
$ sudo cat /root/.my.cnf
# File Managed by Puppet

[client]
password=60232362720

```

##Command Record
php app/console doctrine:database:create
composer require doctrine/doctrine-migrations-bundle "^1.0"
php app/console doctrine:generate:entity
app/console doctrine:migrations:status
app/console doctrine:migrations:diff
app/console doctrine:migrations:migrate

