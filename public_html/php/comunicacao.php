<?php
$port = "/dev/ttyUSB0";

exec("stty -F $port raw speed 9600");
$fp= fopen($port, 'c+');
fwrite($fp, "a");
fclose($fp);