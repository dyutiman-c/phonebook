# phonebook setup instructions

To install a development copy of the application we will need vagrant whichcan be downloade
from https://www.vagrantup.com/. Once vagrant is installed, run the following commend:
```
git clone https://github.com/dyutiman-c/phonebook.git && \
    cd phonebook && \
    vargant up 
```

This will create a virtual machine on your local computer and deploy the application on it.
At the end of the setup process trhe system will give you all the credentials you will
need to operate or develop the application on your computer.

To stop the the virtual machine run :
```
cd /path/to/my/project/phonebook && \
    vagrant halt
```  
To restart the VM run :
```
cd /path/to/my/project/phonebook && \
    vagrant up
```
To login to the virtual machine using ssh run:
```
cd /path/to/my/project/phonebook && \
    vagrant ssh
```

And lastly to detroy the VM run:
```
cd /path/to/my/project/phonebook && \
    vagrant destroy && \
    rm -R ./.vagrant
```


# Additional Information.
Please note the actual codeignitor application is located within the folder "ciapp", and
the location of this folder should be set as the web root in server configuration. Rest of
the files and folders should remain outside web-root so that they are not directly accessabele
from any browser.

We have moved the composer setup of codeignitor outside the webroot, so that nither composer.json
or composer.log or any of the vendor libs are not directly accessable.

To run composer install or update use commend like as followed:
```
cd /path/to/my/project/phonebook && \
    /usr/bin/php composer.phar install 
```
The DB migrations scripts are also outside web-root. the migration files are stored in 
the folder "dbschema". To perform a migration run the following commend:

```
cd /path/to/my/project/phonebook && \
    /usr/bin/php vendor/bin/phinx migrate
```

