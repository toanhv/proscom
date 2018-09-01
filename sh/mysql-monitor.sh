#! /bin/sh

PROCESS_NAME="mysqld"
httpd_restart="./env/httpd-2.4.18/bin/httpd -k restart"
START_CMD="/bin/sh /usr/bin/mysqld_safe --datadir=/var/lib/mysql --pid-file=/var/lib/mysql/vps169229.dotvndns.com.pid"
socket="./apps/source/proscom/socket/socket/service.sh restart"

while :
do
    COUNT_PROCESS=`ps -ef | grep -v grep | grep -v mysql-monitor | grep ${PROCESS_NAME} | wc -l`
    if [ $COUNT_PROCESS == 0 ]; then 
	echo "Restart httpd "$httpd_restart
	$httpd_restart
	echo "${PROCESS_NAME} is not running, starting "$START_CMD
	$START_CMD &
	echo "Restart socket "$socket
	$socket
    else
	echo "${PROCESS_NAME} are running, total processes: ${COUNT_PROCESS}"
	fi
    sleep 10
done    
