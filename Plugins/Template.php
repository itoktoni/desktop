<?php

namespace Plugins;

use App\Dao\Facades\RoutesFacades;
use App\Dao\Models\Routes;
use Illuminate\Support\Str;
use hisorange\BrowserDetect\Parser as Browser;
use Illuminate\Support\Facades\Cache;

class Template
{
    public static $template;

    public function __construct()
    {
        self::$template = config('template.template');
    }

    public static function master($template = 'index')
    {
        return 'pages.master.'.$template;
    }

    public static function table($template = false)
    {
        if($template){

            return 'pages.'.$template.'.table';
        }

        return 'pages.'.self::$template.'.table';
    }

    public static function form($template = false, $name = false)
    {
        if($template && $name){

            return 'pages.'.$template.'.'.$name;
        }

        if($name){
            return 'pages.'.self::$template.'.'.$name;
        }

        if($template){
            return 'pages.'.$template.'.form';
        }

        return 'pages.'.$template.'.'.$name;
    }

    public static function tableResponsive(){

        return Browser::isMobile() ? 'table-responsive-stack' : 'table-responsive';
    }

    public static function Routes(){

        if(Cache::has('routes')){
            return Cache::get('routes');
        }

        $routes = Routes::select(RoutesFacades::getSelectedField())->get()->groupBy(RoutesFacades::field_group());

        Cache::put('routes', $routes, 1200);

        return $routes;
    }

    public static function extractColumn($value){
        $string ='';
        if($value->class){
            $string = 'class='.$value->class;
        }
        if($value->width){
            $string = $string .'style=width:'.$value->width;
        }
        return $string;
    }
}
