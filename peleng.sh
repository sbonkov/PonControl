#/bin/bash
                site_link="https://site.com/pon" #Адрес, по которому будет доступен ваш PonControl
                apache_user="username" #Логин (при использовании апачевой авторизации)
                apache_password="password"   #Пароль (при использовании апачевой авторизации)
                wget --no-check-certificate --user $apache_user --password $apache_password $site_link/ping_all.php -O temp.php && rm temp.php*
