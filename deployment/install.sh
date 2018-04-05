#!/usr/bin/env bash

cd $1 && \
wget https://getcomposer.org/composer.phar && \
/usr/bin/php composer.phar install && \
/usr/bin/php vendor/bin/phinx migrate