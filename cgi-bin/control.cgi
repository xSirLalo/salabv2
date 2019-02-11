#!/usr/bin/perl -w
#!"C:\xampp\perl\bin\perl.exe" -w -T
# Ajustado por por Eduardo Cauich Herrera
use IO::Socket;

#argumento="http://192.168.100.200/cgi-bin/control.cgi?pc=2&acc=0"; De Prueba
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

print "Location: http://192.168.100.200/salabv2/controllab\n\n";
#Imprimir  variables en texto plano 
print "Content-type: text/plain \n\n";
print "Recibe:\n";
print "$argumento\n\n";

print "Separa:\n";
print "PC  = $PC[1]\n";
print "ACC = $Acc[1]\n\n";

print "Envia:\n";
print "$msj";
