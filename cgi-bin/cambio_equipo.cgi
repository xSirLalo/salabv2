#!/usr/bin/perl -w
#!"C:\xampp\perl\bin\perl.exe" -w -T
# Ajustado por por Eduardo Cauich Herrera
use IO::Socket;

#$argumento="http://192.168.100.200/cgi-bin/cambio_equipo.cgi?OldComputer=6&AccionO=0&NewComputer=12&AccionN=1"; De Prueba
#Obtiene las variables del enlace
$argumento=$ENV{"QUERY_STRING"};

#Comparador
$ban = 1;

#Separa los argumentos del enlacie
@pares = split(/&/, $argumento);
@OldComputer = split(/=/, $pares[0]);
@AccionO = split(/=/, $pares[1]);
@NewComputer = split(/=/, $pares[2]);
@AccionN = split(/=/, $pares[3]);

# Conexion al Servidor de Java donde se encuentre iniciado.
if($ban == 1){
$sock = IO::Socket::INET->new(
    PeerAddr    => "192.168.100.2",
    PeerPort    =>  3519,
    Proto       => "tcp",
    Timeout     =>  1,
);
$msj.="OS1--".$OldComputer[1]."--".$AccionO[1]."--OS1";
print $sock $msj;
$sock->close();
}if($ban == 1){
$sock = IO::Socket::INET->new(
    PeerAddr    => "192.168.100.2",
    PeerPort    =>  3519,
    Proto       => "tcp",
    Timeout     =>  1,
);
$msj2.="OS1--".$NewComputer[1]."--".$AccionN[1]."--OS1";
print $sock $msj2;
$sock->close();
}
print "Location: http://192.168.100.200/salabv2/controllab\n\n"; 
#Imprimir  variables en texto plano 
print "Content-type: text/plain \n\n";
print "Recibe:\n";
print "$argumento\n\n";

print "Computadora Origen\n";
print "Separa:\n";
print "PC  = $OldComputer[1]\n";
print "ACC = $AccionO[1]\n\n";

print "Computadora Destino\n";
print "Separa:\n";
print "PC  = $NewComputer[1]\n";
print "ACC = $AccionN[1]\n\n";

print "Envia:\n";
print "$msj\n\n";
print "$msj2";
