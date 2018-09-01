#! /bin/sh

PROCESS_NAME="mysql"
httpd_restart="./env/httpd-2.4.18/bin/httpd -k restart"

while :
do
    COUNT_PROCESS=`ps -ef | grep -v grep | grep -v httpd-monitor | grep ${PROCESS_NAME} | wc -l`
    if [ $COUNT_PROCESS == 0 ]; then 
		echo "Restart httpd "$httpd_restart
		$httpd_restart
    else
		echo "[httpd] ${PROCESS_NAME} are running, total processes: ${COUNT_PROCESS}"
	fi
    sleep 8
done    
