#! /bin/sh

date=`/bin/date +%Y%m%d-%H%M`
pass="Proscom@123#*#"
mysqldump -uproscom -p$pass proscom > /root/tool/proscom.sql
cd /root/tool
/bin/tar czf proscom-$date.tgz proscom.sql
/bin/rm -rf proscom.sql
/bin/mv proscom-$date.tgz /root/backup/mysql/
cd /root/backup/mysql
for file1 in "$( /usr/bin/find /root/backup/mysql/ -type f -mtime +10 )"
do
   /bin/rm -rf $file1
done

exit 0
~            
