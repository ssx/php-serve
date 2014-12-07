<?php
namespace SSX\Utility;

/*
 *
 * The reason this is incredibly useful is during API testing you can launch
 * a full server instance to test against.
 *
 * https://github.com/vgno/tech.vg.no-1812/blob/master/features/bootstrap/FeatureContext.php
 *
 * */

class Serve {
    public $pid             = 0;
    public $address         = "0.0.0.0";
    public $port            = 8888;
    public $document_root   = ".";
    public $router          = "";

    public function __construct($aryParams = array())
    {
        // TODO: Validate IP address
        if (isset($aryParams["address"]))
            $this->address = $aryParams["address"];

        // TODO: Validate port
        if (isset($aryParams["port"]))
            $this->port = $aryParams["port"];

        if (isset($aryParams["document_root"]))
            $this->document_root = $aryParams["document_root"];

        if (isset($aryParams["router"]))
            $this->router = $aryParams["router"];

    }

    public function start() {
        // If we're already running, return the PID back
        if ($this->pid != 0)
            return $this->pid;

        $command = sprintf('php -S %s:%d -t %s %s',
            $this->address,
            $this->port,
            $this->document_root,
            $this->router);

        // Redirect logging and force the PID to be returned
        $command .= " >/dev/null 2>&1 & echo $!";

        // We'll put the output into this array
        $output = array();

        // Actually start the server
        exec($command, $output);

        // Store the returned PID
        $this->pid = (int)$output[0];

        // Give the server time to boot, important during testing otherwise
        // your first few tests will fail to run
        sleep(2);

        // Return the PID
        return $this->pid;
    }

    public function stop()
    {
        exec('kill -9 ' . (int)$this->pid);
    }
}
