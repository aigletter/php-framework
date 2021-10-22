<?php


namespace App\Components\Router;


use App\Controllers\HomeController;
use Core\Interfaces\RouterInterface;

class Router implements RouterInterface
{

    private array $ablePath;

    public function __construct(array $config)
    {
        $this->ablePath = $config['able_path'] ?? [];
    }

    public function route(): callable
    {
        $url = $_SERVER['REQUEST_URI'];
        $path = $this->parsePath($url);
        if (!isset($path['controller']) || !isset($path['method'])) {
            $path = ['controller' => 'App\\Controllers\\Handler',  'method' => 'notFound'];
            if (!isset($path['params'])) {
                $path['params'] = [];
            }
        }

        return function() use ($path) {
            $controller = new $path['controller'];
            $method = $path['method'];
            return $controller->$method($path['params']);
        };
    }

    private function parsePath(string $path): array
    {
        $result = [];

        $request = parse_url($path);

        if (isset($request['path'])) {
            $parts = explode('/', $request['path']);
            if (isset($parts[1])) {
                $className = ucfirst($parts[1]);
                if (isset($this->ablePath[$className])) {
                    $result['controller'] = 'App\\Controllers\\'.$className;
                    $ableFunction = $this->ablePath[$className];
                    if (isset($parts[1])) {
                        $methodName = strtolower($parts[2]);
                        if (in_array($methodName, $ableFunction)) {
                            $result['method'] = $methodName;
                        }
                    }
                }

                if (isset($result['controller']) && isset($result['method'])) {
                    $params = explode('&', $request['query']);
                    foreach ($params as $param) {
                        if (stripos($param,'=') !== false) {
                            $param = explode('=', $param);
                            if (isset($param[0]) && isset($param[1])) {
                                $result['params'][] = ['name' => $param[0], 'value' => $param[1]];
                            }
                        }
                    }
                }
            }
        }


        return $result;

    }
}