<?php

require_once 'app/bootstrap.php';

use App\Library\Validation;

$fileValidate = new Validation();
if(!$fileValidate->checkIfFileExists($filePointer)){
  exit ("
    The file \e[0;31m$filePointer\e[0m can not be open! \n
    \e[0;32mReason:\e[0m There is no file called \e[0;31m$filePointer\e[0m. \n
  ");
}

// Overwrite already existing file or if not exists crete new.
$fp = fopen('output.csv', 'w');

( new App\Library\ReadFile() )->calculate($filePointer);
