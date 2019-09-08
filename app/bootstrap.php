<?php


  require_once __DIR__ .'/../vendor/autoload.php';


  // Check if script can be run via command line.
  if (!isset($argc)) {
    echo "argc and argv disabled\n";
  }


  if(!isset($argv[1])){
    exit("
          We are sorry the error has occurred!\n
          Message: \e[0;31mthe parameter is missing\e[0m! \n
          Note: Please use the following format when running the script -
              php Script.php [your file name] / php Script.php input.csv
         ");
  }

  // Pass file name.
  $filePointer = $argv[1];