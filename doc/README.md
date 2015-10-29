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