Simple PHP Uploader
========

A simple PHP uploader.


Deployment
--------

1. `git clone`
2. cd `/path/to/this-uploader`
3. install php dependencies via `composer install`
4. copy `.env.sample` to `.env`, and change the config settings
5. cd `/path/to/this-uploader/fe`
6. install node.js dependencies via `npm i`
7. build fe dist files via `npm run build`
8. setup nginx or other server to serve `/path/to/this-uploader`

### Nginx conf sample

```conf
server {
	listen 80;
	listen [::]:80;

	root /mnt/www/uploader;

	index index.php index.html;

	server_name site.name;

	location / {
		try_files $uri $uri/ /index.php$args;
	}

	location ~ \.php$ {
		include snippets/fastcgi-php.conf;
		fastcgi_pass unix:/var/run/php/php7.4-fpm.sock;
	}

	location /admin {
		alias /mnt/www/uploader/fe/dist;
	}

	location ~ "/admin/(?<page>\d{8}\-\d{6})$" {
		alias /mnt/www/uploader/fe/dist/index.html;
		default_type text/html;
	}

	location /fe {
		return 404;
	}
}
```
