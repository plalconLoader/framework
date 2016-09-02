# framework
已经构建好的phalcon框架目录结构,多应用,phalcon版本3.01

#installer
composer install

#nginx.conf
server
{
    listen       80;
    server_name  server.dev;

    root /app/public;
    include enable-php.conf;
    index  index.html index.htm index.php;

    location / {
        try_files $uri @phalcon;
    }

    location @phalcon {
        include fastcgi_params;
        rewrite ^/(.*)$ /index.php?_url=/$1 last;
    }
}

