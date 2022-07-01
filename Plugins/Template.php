<?php

namespace Plugins;

use Illuminate\Support\Str;

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
}
