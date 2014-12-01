echo usage: install.sh IP_ADDRESS
echo Printer root password has to be fabtotum
echo sshpass has to be installed on your machine...
echo copying files...
sshpass -p fabtotum scp -r bedscan root@$1:/var/www/fabui/application/plugins/
echo done copying files

