<?php
$adminUsername = filter_input(INPUT_POST, 'username');
$adminPassword = filter_input(INPUT_POST, 'password');

if ($adminUsername != 'root' || $adminPassword != 'Pa$$w0rd'){
    echo "Please enter the correct username and password.";
    exit();
} else {
    use('index.html');
}
?>