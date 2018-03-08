<?php

    
    require_once './init.php';

    Router::init($_SERVER['REQUEST_URI'], ROUTES);
    var_dump(Router::$params);
    var_dump(Router::$view);
?>
<hr>
<?php
    
?>