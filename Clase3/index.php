<?php

/**
 * WSDL / WebSerices SOAP
 * Intercambio de datos a través de XML
 * SOAP es el PROTOCOLO y WSDL (XML) es el LENGUAJE DE INTERCAMBIO
 * Web Service Description Language es un XML que describe las FUNCIONES
 * ofrecidas por el WebService
**/

// phpinfo();

// Métodos mágicos
/*
class Persona {
    public function __call($nombre, $argumentos) {
        echo $nombre.'<br>';
        var_dump($argumentos);
        // La clase SoapClient aquí ejecuta la llamada al WebService
    }
    
    public function saludo() {
        echo 'Holaaa';
    }


}

$carlos = new Persona();

$carlos->Add([
    1, 2
]);
*/
/*
Multiply([
    'intA' => 2,
    'intB' => 5
]) = ['MultiplyResult' => 10]
*/
define('WSDL', 'http://www.dneonline.com/calculator.asmx?WSDL');

/**
 * En la clase SoapClient, el __call -función que se 
 * invoca automáticamente al acceder a un método
 * inexistente- ejecuta la función del web service
 */
$soap = new SoapClient(WSDL, [
    'soap_version' => SOAP_1_2
]);
/*
$DivideResponse = $soap->Divide([
    'intA' => [
        'val' => 20
    ]
]);

Si el tipo de 'intA', fuese tns:Number; significaría que en los tipos del
WSDL está definido así:

<s:element name="Number">
    <s:complexType>
        <s:sequence>
            <s:element minOccurs="1" maxOccurs="1" name="val" type="s:int" />
        </s:sequence>
    </s:complexType>
</s:element>
*/
$DivideResponse = $soap->Divide([
    'intA' => 20,
    'intB' => 10
]);

var_dump($DivideResponse);
