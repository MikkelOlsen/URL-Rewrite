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
      'params' => ['Page1', 'Product1', 'ID1']
      ],
    [
      'path' => '/Test/Delete/test/delete/test',
      'view' => 'Products.view.php',
      'params' => ['Page2', 'Product2']
      ],
    [
      'path' => '/Test',
      'view' => 'Home.view.php',
      'params' => ['Page3', 'Product3', 'ID3']
      ],
    [
      'path' => '/Test/Login',
      'view' => 'Home.view.php',
      'params' => ['Page4', 'Product4', 'ID4']
    ]
  );
?>
