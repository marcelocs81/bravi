<?php

include dirname(__FILE__) . '/../../../../wp-config.php';

require ("../vendor/autoload.php");


if((!empty($_GET) && isset($_GET['imdbID']) && !empty($_GET['imdbID']))){

    try {
        $service = new \Mcs\Bravi\Service\FavoriteService();

        if($service->remove($_GET['imdbID'])){
            echo "Deleted with success!";
            exit;
        }
    } catch (\Exception $e) {
        echo "ERROR: " . $e->getMessage();
        exit;
    }

}

echo "Error deleting!";