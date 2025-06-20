<?php

function redirect($location = null){
    if($location != null){
        echo "<script>window.location = '{$location}'</script>";
    }
    else{
        echo 'error location';
    }
}



?>