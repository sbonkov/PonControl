#/bin/bash
                site_link="https://site.com/pon" #�����, �� �������� ����� �������� ��� PonControl
                apache_user="username" #����� (��� ������������� �������� �����������)
                apache_password="password"   #������ (��� ������������� �������� �����������)
                wget --no-check-certificate --user $apache_user --password $apache_password $site_link/ping_all.php -O temp.php && rm temp.php*
