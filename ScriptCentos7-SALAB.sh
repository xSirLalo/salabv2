setenforce 0
sed -i 's/^SELINUX=.*/SELINUX=disabled/g' /etc/sysconfig/selinux
sed -i 's/^SELINUX=.*/SELINUX=disabled/g' /etc/selinux/config

yum groupinstall "Development Tools" -y
yum install epel-release
yum update

#Cambiar el FIREWALLD por IPTABLES de Centos 7
systemctl stop firewalld
systemctl mask firewalld
#Instalando IPTABLES
yum install iptables-services
service iptables save
systemctl enable iptables
systemctl start iptables
cp /etc/sysconfig/iptables /etc/sysconfig/iptables.orig

#UTILERIAS
yum install p7zip unzip zip kernel-devel dkms ntfs-3g
yum install vim git wget net-tools vsftpd mc htop screen lynx nmap
yum install cpan openssl dnsmasq patch mod_ssl 

#PHP
yum install php-pear php-devel php-mysql php-common php-gd php-mbstring php-mcrypt php php-xml php-pear-db
#PEARL
yum install perl perl-CGI perl-IO-Socket-SSL perl-Digest-MD5 

# Despues de haber instalado los php, abrir el archivo "php.ini" que esta en el directorio "/etc" y buscar
# las siguientes lineas y cambiar "short_open_tag = On" y "date.timezone = America/Cancun" ponerla de acuerdoa tu zona horaria.
# Nota en la linea "short_open_tag" no confundirla con la que tiene ";"
vim /etc/php.ini

yum install httpd httpd-devel
systemctl enable httpd
systemctl start httpd
systemctl status httpd

#IPTABLES
-A INPUT -p tcp -m state --state NEW -m tcp --dport 80 -j ACCEPT
-A INPUT -p tcp -m state --state NEW -m tcp --dport 443 -j ACCEPT
#FIREWALLD
firewall-cmd --permanent --zone=public --add-service=http 
firewall-cmd --permanent --zone=public --add-service=https

yum install mariadb-server

systemctl enable mariadb
systemctl start mariadb
systemctl status mariadb

#IPTABLES
-A INPUT -p tcp -m state --state NEW -m tcp --dport 3306 -j ACCEPT
#FIREWALLD
firewall-cmd --permanent --zone=public --add-service=mysql
firewall-cmd --reload

#	Configurar Mysql con una contraseña y asignar todos las opciones en Si(Y).
mysql_secure_installation

cd /var/www/html
git clone https://github.com/xsirlalo/salabv2

#Iniciar mysql con la contraseña establecida con mysql_secure_installation
mysql -u root -p

#Crear base de datos y usuario
create database salabv2;
create user 'salab'@'localhost';
set password for salab@localhost = password('salab2018');
grant all on salabv2.* to salab@localhost;

# Puerto y Usuario para conexiones externas 

sudo iptables -A INPUT -p tcp -m state --state NEW -m tcp --dport 3309 -j ACCEPT
iptables-save

grant all privileges on *.* to 'administrador' identified by 'sudovimetc' with grant option;
show databases;
quit

#	Para importar la base de datos al servidor Mysql necesario la configuracion de usuario y contraseña
mysql -u root -p salabv2 < /var/www/html/salabv2/salabv2.sql

#	Agregar al Final del archivo o ejecutar el echo
#	vim /etc/httpd/conf/httpd.conf
#INICIO
echo '<Directory /var/www/html/salabv2>
	Options -Indexes +Multiviews +FollowSymLinks
		DirectoryIndex index.php index.html
	AllowOverride All
	Allow from All
</Directory>' >> /etc/httpd/conf/httpd.conf
#FIN

#Si es necesario cambiar la ip a la ip del servidor
vim /var/www/html/salabv2/application/config/config.php

#PHPMYADMIN
yum install phpmyadmin

#WORKBENCH
sudo yum install libzip tinyxml
wget http://repo.mysql.com/yum/mysql-tools-community/el/7/x86_64/mysql-workbench-community-6.3.8-1.el7.x86_64.rpm
yum install rpm mysql-workbench-community-6.3.8-1.el7.x86_64.rpm -y

#SUBLIME
rpm -v --import https://download.sublimetext.com/sublimehq-rpm-pub.gpg
yum-config-manager --add-repo https://download.sublimetext.com/rpm/stable/x86_64/sublime-text.repo
yum install sublime-text -y

# Shellinabox (Terminal via web)
yum install shellinabox

# vim /etc/httpd/conf.d/shellinabox.conf
<Location /shell>
 	ProxyPass  http://localhost:4200/
 	Order      allow,deny
 	Allow      from all
 </Location>

#Redireccionar la ip del servidor al Sistema Web "SALAB", borrar todo el contenido de welcome.conf y sustituir por lo siguiente
# vim /etc/httpd/conf.d/welcome.conf
echo '<VirtualHost *:80>
        ServerAdmin lalo_lego@hotmail.com
        Servername localhost
        ServerAlias salabv2
        #DocumentRoot /var/www/html/salabv2/
        RedirectMatch ^/$ http://[IP DEL SERVIDOR]/salabv2/login
</VirtualHost>'> /etc/httpd/conf.d/welcome.conf

# Crear el archivos con el SElinux disabled
touch /var/www/cgi-bin/control.cgi
vim /var/www/cgi-bin/control.cgi
chmod +x /var/www/cgi-bin/control.cgi





# Contenido del CGI y pegar los siguientes parametros
# SALAB CONTROL POR POR JAVA Y ESTE ARCHIVO CGI
###################################

## Ambiente WINDOWS Con XAMMP##




#!"C:\xampp\perl\bin\perl.exe" -w -T

## Ambiente LINUX ###

#!/usr/bin/perl -w

###################################

# INICIO - COPIA Y PEGA #
#########################

#!/usr/bin/perl -w

use IO::Socket;

#argumento="http://192.168.100.200/cgi-bin/control.pl?pc=2&acc=1"; De Prueba

#Obtiene las variables del enlace
$argumento=$ENV{"QUERY_STRING"};

#Comparador
$ban = 1;

#Separa los argumentos del enlacie
@pares = split(/&/, $argumento);
@PC = split(/=/, $pares[0]);
@Acc = split(/=/, $pares[1]);

$ban = 1;
# Conexion al Servidor de Java donde se encuentre iniciado.
if($ban == 1){
$sock = IO::Socket::INET->new(
    PeerAddr    => "192.168.100.2",
    PeerPort    =>  3519,
    Proto       => "tcp",
    Timeout     =>  1,
);
$msj.="OS1--".$PC[1]."--".$Acc[1]."--OS1";
print $sock $msj;
$sock->close();
}
#print "Location: http://192.168.100.200/salabv2/controllab\n\n"; 
#Imprimir  variables en texto plano 
print "Content-type: text/plain \n\n";
print "$argumento\n";
print "pc  = $PC[1]\n";
print "acc = $Acc[1]\n";
print "$msj";

######################
# FIN - COPIA Y PEGA #

# Monitoriear Errores 
screen  tail -f /var/log/httpd/error_log

# Permisos al Archivo CGI
chmod  0705 /var/www/cgi-bin/control.cgi

# Se procede a reiniciar servidor Apache
systemctl restart http

touch /var/www/cgi-bin/cambio_equipo.cgi
vim /var/www/cgi-bin/cambio_equipo.cgi
chmod +x /var/www/cgi-bin/cambio_equipo.cgi

#SAMBA
yum install samba samba-client samba-common

setenforce 1
sed -i 's/^SELINUX=.*/SELINUX=permissive/g' /etc/sysconfig/selinux
sed -i 's/^SELINUX=.*/SELINUX=permissive/g' /etc/selinux/config

#IPTABLES
-A INPUT -p udp -m state --state NEW -m udp --dport 137 -j ACCEPT
-A INPUT -p udp -m state --state NEW -m udp --dport 138 -j ACCEPT
-A INPUT -p tcp -m state --state NEW -m tcp --dport 139 -j ACCEPT
-A INPUT -p tcp -m state --state NEW -m tcp --dport 445 -j ACCEPT
-A INPUT -p tcp -m state --state NEW -m tcp --dport 901 -j ACCEPT

#FIREWALLD
firewall-cmd --permanent --zone=public --add-service=samba
firewall-cmd --reload

groupadd smbgrp
usermod admin -aG smbgrp
smbpasswd -a admin

mkdir -p /srv/samba/compartidos
chmod -R 0775 /srv/samba/compartidos
chmod -R 0770 /srv/samba/compartidos
#chown -R nobody:nobody /srv/samba/compartidos
chown -R root:smbgrp /srv/samba/compartidos
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
#       force user = nobody
        create mode = 0777
        directory mode = 0777
#Comprobar la configuracion anterior
testparm

#HAbilitar servicio e inicio automatico
systemctl enable smb.service
systemctl enable nmb.service
systemctl start smb.service
systemctl start nmb.service