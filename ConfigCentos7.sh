setenforce 0
sed -i 's/^SELINUX=.*/SELINUX=permissive/g' /etc/sysconfig/selinux
sed -i 's/^SELINUX=.*/SELINUX=permissive/g' /etc/selinux/config

yum groupinstall "Development Tools" -y
yum install epel-release
yum update

systemctl stop firewalld
systemctl mask firewalld
yum install iptables-services
service iptables save
systemctl enable iptables
systemctl start iptables
cp /etc/sysconfig/iptables /etc/sysconfig/iptables.orig

#Escritorio amigable
yum -y install @cinnamon-desktop
yum install cinnamon -y

yum install net-tools vim nmap git wget perl-Digest-MD5
yum install cpan openssl dnsmasq patch mod_ssl screen lynx nmap htop
yum install php-pear php-devel php-mysql php-common php-gd php-mbstring php-mcrypt php php-xml php-pear-db 

# Despues de haber instalado los paquetes anteriores abrir el archivo "php.ini" que esta en el directorio "/etc" y buscar
# la siguientes lineas y cambiar "short_open_tag = On" y "date.timezone = America/Cancun" ponerla de acuerdo
# a tu zona horaria. Nota en la linea "short_open_tag" no confundirla con la que tiene ";"
vim /etc/php.ini

yum install httpd httpd-devel
systemctl enable httpd
systemctl start httpd
systemctl status httpd

yum install mariadb-server

systemctl enable mariadb
systemctl start mariadb
systemctl status mariadb
systemctl is-enabled mariadb.service

#	Configurar Mysql con una contraseña y asignar todos las opciones en Si(Y).
mysql_secure_installation

cd /var/www/html
git clone https://github.com/xsirlalo/salabv2

mysql -u root -p

show databases;
create database salabv2;
create user 'salab'@'localhost';
set password for salab@localhost = password('salab2018');
grant all on salabv2.* to salab@localhost;
grant all privileges on *.* to 'administrador' identified by 'sudovimetc' with grant option;
quit

#	para importar la base de datos al servidor Mysql necesario la configuracion de usuario y contraseña
mysql -u root -p salabv2 < /var/www/html/salabv2/bd_salabv2.sql

#	Agregar al Final del archivo 
#	vim /etc/httpd/conf/httpd.conf
## Inicio
echo '
<Directory /var/www/html/salabv2>
	Options -Indexes +Multiviews +FollowSymLinks
		DirectoryIndex index.php index.html
	AllowOverride All
	Allow from All
</Directory>
	'> /etc/httpd/conf/httpd.conf
## Fin
#
yum install phpmyadmin