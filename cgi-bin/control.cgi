#!"C:\xampp\perl\bin\perl.exe" -w -T
####LINUX###!/usr/bin/perl -w
#
# Eduardo Cauich Herrera
use IO::Socket;

#argumento="http://192.168.8.200/salabv2/cgi-bin/control.cgi?pc=2&acc=1"; De Prueba
#Obtiene las variables del enlace
$argumento=$ENV{"QUERY_STRING"};

#Separa los argumentos del enlacie
@pares = split(/&/, $argumento);
@PC = split(/=/, $pares[0]);
@ACC = split(/=/, $pares[1]);

# Conexion al Servidor de Java donde se encuentre iniciado.
$sock = IO::Socket::INET->new(
	PeerAddr => "192.168.0.167",
	PeerPort =>  3519,
	Proto    => "tcp",
	Timeout  =>  20,)
or die print "Location: http://localhost/salabv2/controllab\n\n";
$msj.="OS1--".$PC[1]."--".$ACC[1]."--OS1";
print $sock $msj;
$sock->close();

print "Location: http://localhost/salabv2/controllab\n\n";
# DEBUG "Imprimir variables y comportamiento del mensaje" 
print "Content-type: text/plain \n\n";
print "Recibe:\n";
print "$argumento\n\n";

print "Separa:\n";
print "PC  = $PC[1]\n";
print "ACC = $ACC[1]\n\n";

print "Envia:\n";
print "$msj";