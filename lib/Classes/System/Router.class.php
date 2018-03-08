<?php
/**
 * Routing Class
 */
class Router extends \PDO
{

  public static   $Params     = [],
                      $BASE       = null,
                      $vVew = null;

  private static  $RouteIndex = null,
                      $Routes     = null,
                      $REQ_ROUTE  = null,
                      $DefaultRoute = null,
                      $ViewFolder = null;

  public static function ValidateRoutes(array $routes, array $keys) : bool
  {
      $errors = 0;
      foreach($routes as $route)
      {
          if(!Helpers::array_key_exists_r($keys, $route))
          {
              $errors++;
          }
      }
      return ( $errors === 0 );
  }

  public static function SetViewFoler(string $viewfolder) : void
    {
        self::$ViewFolder = $viewfolder;
    }
    public static function GetViewFolder() : string
    {
        return self::$ViewFolder;
    }
    public static function SetDefaultRoute(string $route) : void
    {
        self::$DefaultRoute = $route;
    }

  public static function GetParamByName(string $param) : string
  {
    return rawurldecode(self::$Params[$param]) ?? null;
  }

  public static function GetParamByIndex(int $index) : string
  {
    return rawurldecode(self::$Params[$index]) ?? null;
  }

  public static function GetParams() : array
  {
    return self::$Params ?? [];
  }

  public static function Redirect(string $location) : void
  {
      ob_start();
      header('Location:' . rtrim(self::$BASE, '/') . $location);
      exit;
  }

  public static function init(string $url, array $routes) : void
  {
    if(self::ValidateRoutes($routes, ['path', 'view'])){
    self::$Routes = $routes;
    $url = Filter::SanitizeURL($url);
    self::$BASE = substr($_SERVER['PHP_SELF'], 0, strpos($_SERVER['PHP_SELF'], 'index.php'));
    self::$REQ_ROUTE = '/'.str_replace(strtolower(self::$BASE), '', strtolower($url));
    $newPath = explode('/', rtrim(self::$REQ_ROUTE, '/'));
    $newPath = array_splice($newPath, 1, count($newPath)-1);
    $routePath = [];

    foreach(self::$Routes as $routeIdx => $route) {

      $pathCount = count(explode('/', $route['path'])) -1;
      $Params = [];
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

    foreach(self::$Routes as $routeIndex => $singleRoute) {
      if(strtolower($routingPath) === strtolower($singleRoute['path'])) {
        self::$RouteIndex = $routeIndex;
        $match = true;
        $URLparams = array_slice($newPath, $x, count($newPath));
        if(array_key_exists('params', $singleRoute) && sizeof($singleRoute['params']) > 0)
        {
          self::$view = $singleRoute['view'];
            for($ParamCnt = 0; $ParamCnt < count($URLparams); $ParamCnt++)
            {
                if(isset($singleRoute['params'][$ParamCnt]))
                {
                    self::$Params[$singleRoute['params'][$ParamCnt]] = $URLparams[$ParamCnt];
                }
                else
                {
                    self::$Params[] = $URLparams[$ParamCnt];
                }
            }
        }
        else
        {
            self::$Params = $URLparams;
        }
      }
    }

    if($match == fasle)  
    {
      if(!empty(self::$DefaultRoute) && self::$REQ_ROUTE === '/') 
      {
        foreach(self::$Routes as $route) 
        {
          if(self::$DefaultRoute == $route['path'])
          {
            self::Redirect($route['path']);
          }
        }
      }
    } 
  }
}

  

}

?>
