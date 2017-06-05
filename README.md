# Slim Bookshelf

This is alternative implementation of the simple Slim 3 application that manages a list of books
by [Rob Allen](https://github.com/akrabat).

It uses the following setup:

* [PHP-DI](http://php-di.org/) instead of the default Slim container for auto-wiring services
* [Atlas ORM](https://github.com/atlasphp/Atlas.Orm) to map database records to plain old PHP objects in
the Domain layer using repositories, instead of [Eloquent](https://laravel.com/docs/5.4/eloquent) ActiveRecord
* [Slim-Validation](https://github.com/DavidePastore/Slim-Validation) middleware instead of [Valitron](https://github.com/vlucas/valitron)

## To do

* Add tests
* Add validation in domain entities


## Vagrant

To use the Vagrant VM, install Vagrant, Virtual Box & the VirtualBox Extension
Pack. If you install the `vagrant-hostsupdater` Vagrant plugin, then your hosts
file will be automatically updated too.

1. `vagrant up`
2. navigate to http://slim-bookshelf.localhost


If you don't use the hostsupdater plugin, then the /etc/hosts record you need
is:

    192.168.98.12 slim-bookshelf.localhost phpmyadmin.slim-bookshelf.localhost mailcatcher.slim-bookshelf.localhost
