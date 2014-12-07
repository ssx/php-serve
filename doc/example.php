<?php
// Require composer autoload
require dirname(__FILE__)."/../vendor/autoload.php";

// Set up a few configuration options
$params = array(
    "address"       => "0.0.0.0",
    "port"          => 8888,
    "document_root" => dirname(__FILE__)."/www/"
);

// Create server object
$server = new \SSX\Utility\Serve($params);

// Start the server
$server->start();

// Go grab the contents
echo file_get_contents("http://localhost:8888");

// Now stop the server
$server->stop();