Vagrant.configure(2) do |config|
  config.vm.box = "ubuntu/trusty64"
  config.vm.hostname = "phonebook-app"
  config.vm.box_check_update = false
  config.vm.network "private_network", ip: "192.168.3.24"
  config.vm.synced_folder ".", "/var/www/"
  config.vm.provider "virtualbox" do |vb|
    vb.memory = "1024"
  end
  config.vm.provision "shell", inline: <<-SHELL
    export DEBIAN_FRONTEND=noninteractive

    sudo apt-get update

    echo "mysql-server mysql-server/root_password password root" | sudo debconf-set-selections
    echo "mysql-server mysql-server/root_password_again password root" | sudo debconf-set-selections

    echo 'phpmyadmin phpmyadmin/dbconfig-install boolean true' | debconf-set-selections
    echo 'phpmyadmin phpmyadmin/app-password-confirm password root' | debconf-set-selections
    echo 'phpmyadmin phpmyadmin/mysql/admin-pass password root' | debconf-set-selections
    echo 'phpmyadmin phpmyadmin/mysql/app-pass password root' | debconf-set-selections
    echo 'phpmyadmin phpmyadmin/reconfigure-webserver multiselect apache2' | debconf-set-selections

    sudo apt-get install  -q -y php-pear php5 php5-cgi php5-cli php5-common php5-curl php5-gd php5-gmp php5-json \
    php5-ldap php5-mysql php5-odbc php5-pgsql php5-rrd php5-sqlite php5-xmlrpc php5-xsl libapache2-mod-php5filter \
    php5-exactimage php5-geoip php5-imagick libssh2-1-dev libssh2-php php5-imap php5-intl php5-mcrypt php5-mongo \
    php5-xdebug phpmyadmin phpunit php-codecoverage mysql-server apache2 git lftp phantomjs

    sudo echo "ServerName localhost" > /etc/apache2/conf-available/servername.conf
    cd /etc/apache2/conf-enabled/ && sudo ln -s ../conf-available/servername.conf
    cd / && sudo /etc/init.d/apache2 restart

    sudo a2enmod ssl
    sudo a2enmod rewrite
    sudo a2ensite default-ssl
    rm /etc/apache2/sites-available/default-ssl.conf
    rm /etc/apache2/sites-available/000-default.conf
    cp /var/www/deployment/local/000-default.conf /etc/apache2/sites-available/000-default.conf
    cp /var/www/deployment/local/default-ssl.conf /etc/apache2/sites-available/default-ssl.conf

    sudo /etc/init.d/apache2 restart

    mkdir -p /var/www/ciapp/application/config/development
    cp /var/www/deployment/database.php /var/www/ciapp/application/config/development/database.php
    sed -i 's:{{db_name}}:phonebook:' /var/www/ciapp/application/config/development/database.php
    sed -i 's:{{db_user}}:root:' /var/www/ciapp/application/config/development/database.php
    sed -i 's:{{db_password}}:root:' /var/www/ciapp/application/config/development/database.php
    sed -i 's:{{db_host}}:localhost:' /var/www/ciapp/application/config/development/database.php

    mysql -uroot -proot -e "CREATE DATABASE phonebook;"

    chmod +x /var/www/deployment/install.sh
    sh /var/www/deployment/install.sh /var/www

    echo "\n"
    echo "#################################################################"
    echo "PhoneBook app is available at http://192.168.3.24"
    echo "PhoneBook app Username: demouser"
    echo "PhoneBook app Password: xp857mou864"
    echo "================================================================="
    echo "MySQL User: root"
    echo "MySQL Password: root"
    echo "MySQL DB: phonebook"
    echo "PhpMyAdmin URL : http://192.168.3.24/phpmyadmin"
    echo "################################################################"
    echo "\n"
  SHELL
end