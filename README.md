# MVC
Simple and useful mvc for basic php project.
Please check out my project and contribute.

# Up and Running
- `git clone <repository>`
- `composer install`

# For Nginx - default_nginx.conf
`root your_project_dir
location / {
    rewrite ^(.*)$ /index.php/$1 last;
}`

# For Apache - .htaccess
`RewriteEngine On
RewriteRule ^(.*)$ index.php/$1 [QSA,L]`

# Configration
`vendor/cooky/url-router/config/configs/`

- for routing and templating look github.com/muhammetakkus/routy
