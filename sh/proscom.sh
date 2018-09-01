./env/httpd-2.4.18/bin/httpd -k restart;
./env/httpd-2.4.18/bin/httpd -k restart;

/etc/init.d/mysqld stop;
/etc/init.d/mysqld stop;

/etc/init.d/mysqld start;

./apps/source/proscom/socket/socket/service.sh restart;