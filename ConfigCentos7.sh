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

yum install p7zip unzip zip kernel-devel dkms mc wget htop ntfs-3g unrar vlc

yum install net-tools vim git wget perl-Digest-MD5
yum install cpan openssl dnsmasq patch mod_ssl screen lynx nmap
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

sudo yum install libzip tinyxml
wget http://repo.mysql.com/yum/mysql-tools-community/el/7/x86_64/mysql-workbench-community-6.3.8-1.el7.x86_64.rpm
yum install rpm mysql-workbench-community-6.3.8-1.el7.x86_64.rpm -y

rpm -v --import https://download.sublimetext.com/sublimehq-rpm-pub.gpg
yum-config-manager --add-repo https://download.sublimetext.com/rpm/stable/x86_64/sublime-text.repo
yum install sublime-text -y

# Shellinabox

# vim /etc/httpd/conf.d/shellinabox.conf
<Location /shell>
 	ProxyPass  http://localhost:4200/
 	Order      allow,deny
 	Allow      from all
 </Location>

# vim /etc/httpd/conf.d/welcome.conf
<VirtualHost *:80>
	ServerAdmin lalo_lego@hotmail.com
	Servername localhost
	ServerAlias salabv2
	#DocumentRoot /var/www/html/salabv2/
	RedirectMatch ^/$ http://192.168.100.205/salabv2/login
</VirtualHost>

#SAMBA
yum install samba samba-client samba-common

#firewall
firewall-cmd --permanent --zone=public --add-service=samba
firewall-cmd --reload

#iptables
-A INPUT -p udp -m state --state NEW -m udp --dport 137 -j ACCEPT
-A INPUT -p udp -m state --state NEW -m udp --dport 138 -j ACCEPT
-A INPUT -p tcp -m state --state NEW -m tcp --dport 139 -j ACCEPT
-A INPUT -p tcp -m state --state NEW -m tcp --dport 901 -j ACCEPT

-A INPUT -p tcp -m state --state NEW -m tcp --dport 137 -j ACCEPT
-A INPUT -p tcp -m state --state NEW -m tcp --dport 138 -j ACCEPT
-A INPUT -p udp -m state --state NEW -m udp --dport 139 -j ACCEPT
-A INPUT -p udp -m state --state NEW -m udp --dport 445 -j ACCEPT

mkdir -p /srv/samba/compartidos
chmod -R 0775 /srv/samba/compartidos
chmod -R 770 /srv/samba/compartidos
chown -R nobody:nobody /srv/samba/compartidos


chcon -t samba_share_t /srv/samba/compartidos

vim /etc/samba/smb.conf

[global]
        workgroup = WORKGROUP
        server string = Samba Server %v
        netbios name = salab
        security = user
        map to guest = bad user
        passdb backend = tdbsam
        dns proxy = no
        printing = cups
        printcap name = cups
        load printers = yes
        cups options = raw

[Compartidos]
        comment = Archivos Compartidos
        path = /srv/samba/compartidos
        browsable = yes
        writable = yes
        guest ok = yes
        read only = no
        force user = nobody
        create mode = 0777
        directory mode = 0777
#Comprobar la configuracion anterior
testparm

#HAbilitar servicio e inicio automatico
systemctl enable smb.service
systemctl enable nmb.service
systemctl start smb.service
systemctl start nmb.service