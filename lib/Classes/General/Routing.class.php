<?php
/**
 * Routing Class
 */
class Routing extends \PDO
{

  private $db = null;

  public function __construct(DB $db)
  {
      $this->db = $db;
  }

  public function urlRouting()
  {
    $base = substr($_SERVER['PHP_SELF'], 0, strpos($_SERVER['PHP_SELF'], 'index.php'));
    $requiredRoute = '/'.str_replace(strtolower($base), '', strtolower($_SERVER['REQUEST_URI']));
    $newPath = explode('/', rtrim($requiredRoute, '/'));

    $newPath = array_splice($newPath, 1, count($newPath)-1);
    $match = false;
    $routeIndexes = NULL;
    $routePath = [];

    foreach(ROUTES as $routeIdx => $route) {

      $pathCount = count(explode('/', $route['path'])) -1;
      $params = [];
      $path = NULL;

      for($pCnt = 0; $pCnt < $pathCount; $pCnt++){
        if(isset($newPath[$pCnt])) {
          $path .= '/'.$newPath[$pCnt];
        }
      }
      
      if(strtolower($route['path']) === strtolower($path)) {
        $routeExplode = explode('/', $route['path']);
        $routePath[] = array_splice($routeExplode, 1, count($routeExplode)-1);

      }
    }

    $counter = max($routePath);
    $routingPath = NULL;

    for($x = 0; $x < sizeof($counter); $x++) {
      $routingPath .= '/'.$counter[$x];
    }
    
    foreach(ROUTES as $routeIndex => $singleRoute) {
      if(strtolower($routingPath) === strtolower($singleRoute['path'])) {
        var_dump($singleRoute);
      }
    }
   
  }
}

?>