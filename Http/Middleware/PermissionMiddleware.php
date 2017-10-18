<?php

namespace Modules\Core\Http\Middleware;

use Illuminate\Http\Request;
use Illuminate\Routing\Route;

class PermissionMiddleware
{
    /**
     * @var Route
     */
    private $route;

    /**
     * @param Route          $route
     */
    public function __construct(Route $route)
    {
        $this->route = $route;
    }

    /**
     * @param Request  $request
     * @param callable $next
     * @return mixed
     */
    public function handle(Request $request, \Closure $next)
    {
        return $next($request);
    }

    /**
     * Get the correct segment position based on the locale or not
     *
     * @param $request
     * @return mixed
     */
    private function getSegmentPosition(Request $request)
    {
        $segmentPosition = config('laravellocalization.hideDefaultLocaleInURL', false) ? 3 : 4;

        if ($request->segment($segmentPosition) == config('asgard.core.core.admin-prefix')) {
            return ++ $segmentPosition;
        }

        return $segmentPosition;
    }

    /**
     * @param $moduleName
     * @param $entityName
     * @param $actionMethod
     * @return string
     */
    private function getPermission($moduleName, $entityName, $actionMethod)
    {
        return ltrim($moduleName . '.' . $entityName . '.' . $actionMethod, '.');
    }

    /**
     * @param Request $request
     * @param         $segmentPosition
     * @return string
     */
    protected function getModuleName(Request $request, $segmentPosition)
    {
        return $request->segment($segmentPosition - 1);
    }

    /**
     * @param Request $request
     * @param         $segmentPosition
     * @return string
     */
    protected function getEntityName(Request $request, $segmentPosition)
    {
        $entityName = $request->segment($segmentPosition);

        return $entityName ?: 'dashboard';
    }
}
