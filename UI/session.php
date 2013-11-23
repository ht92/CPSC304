<?php
    session_name("session");
    $params = session_get_cookie_params();
    session_set_cookie_params(
    $params['lifetime'],
    $params['path'],
    $params['domain'],
    $params['secure'],
    false);
    session_start();
   
?>
