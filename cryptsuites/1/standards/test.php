<?php
#error_reporting(0);

$xml = new DOMDocument(); 
$xml->load('./sample.xml');

if (!$xml->schemaValidate('./signature.xsd')) { 
   echo "invalid";
} 
else { 
   echo "validated"; 
} 

?>


