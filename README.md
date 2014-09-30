quick-stack
===========

Project stack with propel, slim, twig

####NGINX Configuration
Domain name: quickstack.dev
Files located on : /var/www/quick-stack
Error log file: /var/log/nginx/quickstack.error.log

-Host command terminal: sudo gedit /etc/nginx/sites-available/default
```
	server {
		listen 80;
		server_name quickstack.dev;
		root /var/www/quick-stack/public;

		access_log /var/log/nginx/quickstack.access.log;
		error_log /var/log/nginx/quickstack.error.log;

		location / {

			index index.php;
			try_files $uri $uri/ /index.php?$args;
		}

		location ~ \.php/?(.*)$ {
			fastcgi_connect_timeout 300s; # default of 60s is just too long
			fastcgi_read_timeout 300s; # default of 60s is just too long
			fastcgi_pass unix:/var/run/php5-fpm.sock;
			fastcgi_index index.php;
			include fastcgi_params;
			fastcgi_param SCRIPT_FILENAME $document_root$fastcgi_script_name;
		}
		#Access phpmyadmin
		location /phpmyadmin {
			root /usr/share/;
			index index.php index.html index.htm;
			location ~ ^/phpmyadmin/(.+\.php)$ {
				try_files $uri =404;
				fastcgi_pass unix:/var/run/php5-fpm.sock;
				include fastcgi_params;
			}
		}

	}


```
-Host ip setting command on terminal: sudo gedit /etc/hosts
```
127.0.1.1	quickstack.dev
```
-Restart nginx server by terminal: sudo service nginx restart


#####Install set database configuration in propel
(here database name in is 'quickstack', user is 'root' and password is '123password')
- set database information in /propel/runtime-conf.sample
- set database information in /propel/build.properties.sample
- set database information in /propel/generated-conf/config.php
- set database information in /propel/generated-conf/congig.sample

- Make database in xml on /propel/schema.xml

###Build sql and model by command:
```
cd /var/www/quick-stack/propel

sudo /var/www/quick-stack/vendor/bin/propel sql:build

sudo /var/www/quick-stack/vendor/bin/propel model:build

```

###Import sql or make database
-Import /propel/generated-sql/quickstack.sql file to database

#####File permission
- Permite /cache folder
```
sudo chown dev6 /var/www/quick-stack -R
```
or

```
sudo chmod 777 /var/www/quick-stack/templates/cache -R

```

#####Composer
- Go to /var/www/quick-stack
- Install composer after making composer.json file
 ```sudo composer install```
- To update composer ```sudo composer update```
