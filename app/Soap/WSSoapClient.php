<?php
namespace App\Soap;

use Artisaninweb\SoapWrapper\Client;
use RobRichards\WsePhp\WSSESoap;
use RobRichards\XMLSecLibs\XMLSecurityKey;

class WSSoapClient extends Client
{
    public function __doRequest($request, $location, $saction, $version, $one_way = NULL)
    {
        $doc = new \DOMDocument('1.0');
        $doc->loadXML($request);

        $objWSSE = new WSSESoap($doc);

        /* add Timestamp with no expiration timestamp */
        $objWSSE->addTimestamp();

        /* create new XMLSec Key using AES256_CBC and type is private key */
        $objKey = new XMLSecurityKey(XMLSecurityKey::RSA_SHA1, array('type' => 'private'));

        /* load the private key from file - last arg is bool if key in file (true) or is string (false) */
        $objKey->loadKey(base_path(env('PRIVATE_KEY')), true);

        /* Sign the message - also signs appropiate WS-Security items */
        $options = array("insertBefore" => false);
        $objWSSE->signSoapDoc($objKey, $options);

        /* Add certificate (BinarySecurityToken) to the message */
        $token = $objWSSE->addBinaryToken(file_get_contents(base_path(env('CERT_FILE'))));

        /* Attach pointer to Signature */
        $objWSSE->attachTokentoSig($token);

        $retVal = parent::__doRequest($objWSSE->saveXML(), $location, $saction, $version, $one_way);

        return $retVal;
    }
}