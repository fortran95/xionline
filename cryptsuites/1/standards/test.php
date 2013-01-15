<?php
#error_reporting(0);

$xml = new DOMDocument(); 
$xml->load('./sample.pub.xml');

if (!$xml->schemaValidate('./certificate.xsd')) { 
   echo "invalid";
} 
else { 
   echo "validated"; 
} 

?>


