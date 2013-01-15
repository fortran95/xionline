<?php
#error_reporting(0);

$xml = new DOMDocument(); 
$xml->load('./sample.rev.xml');

if (!$xml->schemaValidate('./revocation.xsd')) { 
   echo "invalid";
} 
else { 
   echo "validated"; 
} 

?>


