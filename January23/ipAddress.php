<?php

$ip_block = ['::1','100.100.1.1'];
$remote_address = $_SERVER['SERVER_ADDR'];
foreach($ip_block as $ips){
    if($ips == $remote_address){
        echo "Your IP address $remote_address has been blocked";
        die("<br/>You cannot access this website");
    }else{
        echo "Welcome to this website";
    }
}

?>