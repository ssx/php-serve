<?php
// Require composer autoload
require "../vendor/autoload.php";

// Set up a few configuration options
$params = array(
    "address"       => "0.0.0.0",
    "port"          => 8888,
    "document_root" => "./www/"
);

// Create server object
$server = new \SSX\Utility\Server($params);

// Start the server
$server->start();

// Go grab the contents
echo file_get_contents("http:://localhost:8888");

// Now stop the server
$server->stop();