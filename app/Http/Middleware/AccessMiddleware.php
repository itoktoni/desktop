<?php

namespace App\Http\Middleware;

use Closure;
use Plugins\Helper;

class AccessMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $route = request()->route() ?? false;
        $action = $route->getAction();
        $action_code = $action['as'] ?? 'home';
        $action_controller = false;
        $action_route = $action['name'];

        if (isset($action['controller'])) {
            
            $array_controller = explode('@', $action['controller']) ?? [];
            $action_controller = Helper::getTemplate($array_controller[0]);
        }

        $data = [
            'action_code' => $action_code,
            'action_route' => $action_route,
            'action_controller' => $action_controller,
            'template' => $action_controller,
            'route' => $action_route,
        ];

        view()->share($data);
        config()->set('template', $data);

        return $next($request);
    }
}
