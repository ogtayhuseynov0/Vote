<?php

    $rml="ohuseynov2019@ada.edu.az";
    $ecc=password_hash($rml,1);
    echo $ecc."<br/>-";
    echo password_verify($ecc,"1");