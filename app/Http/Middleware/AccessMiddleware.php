<?php

namespace App\Http\Middleware;

use App\Dao\Models\Routes;
use Closure;
use Plugins\Helper;
use Plugins\Template;

class AccessMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    private $model;

    public function __construct(Routes $model)
    {
        $this->model = $model;
    }

    public function handle($request, Closure $next)
    {
        $route = request()->route() ?? false;
        $action = $route->getAction();
        $action_code = $action['as'] ?? 'home';
        $action_controller = false;
        $action_route = $action['name'] ?? false;

        if (isset($action['controller'])) {

            $array_controller = explode('@', $action['controller']) ?? [];
            $action_controller = Helper::getTemplate($array_controller[0]);
        }

        $data = [
            'action_code' => $action_code,
            'template' => $action_controller,
            'route' => $action_route,
        ];

        share($data);

        try {
            share([
                'access' => Template::routes(),
                'filter' => Template::filter(),
                'groups' => Template::groups(),
            ]);
        } catch (\Throwable $th) {
            //throw $th;
        }

        return $next($request);
    }
}
