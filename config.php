<?php
  CONST DEFAULT_ROUTE = '/Home';
  CONST ROUTES = array(
    [
      'path' => '/Home',
      'view' => 'Home.view.php'
      ],
    [
      'path' => '/Test/Delete/test',
      'view' => 'Home.view.php',
      'params' => ['Page', 'Product', 'ID']
      ],
    [
      'path' => '/Test/Delete/test/delete/test',
      'view' => 'Products.view.php',
      'params' => ['Page', 'Product']
      ],
    [
      'path' => '/Test',
      'view' => 'Home.view.php',
      'params' => ['Page', 'Product', 'ID']
      ],
    [
      'path' => '/Test/Login',
      'view' => 'Home.view.php',
      'params' => ['Page', 'Product', 'ID']
    ]
  );
?>
