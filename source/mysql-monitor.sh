#!/bin/sh
PROCESS_NAME="mysqld"
START_CMD="/bin/sh /usr/bin/mysqld_safe --datadir=/var/lib/mysql --pid-file=/var/lib/mysql/vps169229.dotvndns.com.pid"

while :
do
    COUNT_PROCESS=`ps -ef | grep -v grep | grep -v mysql-monitor | grep ${PROCESS_NAME} | wc -l`
    if [ $COUNT_PROCESS == 0 ]; then 
	echo "${PROCESS_NAME} is not running, starting "$START_CMD
	$START_CMD &
    else
	echo "${PROCESS_NAME} are running, total processes: ${COUNT_PROCESS}"
	
    sleep 10
done    
