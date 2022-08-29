<?php

namespace Plugins;

use App\Dao\Enums\ReportType;
use App\Dao\Facades\RoutesFacades;
use App\Dao\Models\Filters;
use App\Dao\Models\Groups;
use App\Dao\Models\Routes;
use Coderello\SharedData\Facades\SharedData;
use Collective\Html\FormFacade as Form;
use hisorange\BrowserDetect\Parser as Browser;
use Illuminate\Support\Facades\Session;

class Template
{
    public static $template;

    public function __construct()
    {
        self::$template = config('template.template');
    }

    public static function ajax()
    {
        return request()->ajax() ? 'pages.master.modal' : 'pages.master.content';
    }

    public static function master($template = 'content')
    {
        if (request()->ajax()) {
            return 'pages.master.modal';
        }
        return 'pages.master.' . $template;
    }

    public static function table($template = false)
    {
        if ($template) {

            return 'pages.' . $template . '.table';
        }

        return 'pages.' . self::$template . '.table';
    }

    public static function print($template = false, $name = false) {
        if ($name) {
            return 'pages.' . $template . '.'.$name;
        }
        return 'pages.' . $template . '.print';
    }

    public static function form($template = false, $name = false)
    {
        if ($template && $name) {
            return 'pages.' . $template . '.' . $name;
        }

        if ($name) {
            return 'pages.' . self::$template . '.' . $name;
        }

        if ($template) {
            return 'pages.' . $template . '.form';
        }

        return 'pages.' . $template . '.' . $name;
    }

    public static function isMobile()
    {
        $ua = strtolower($_SERVER["HTTP_USER_AGENT"]);
        return $isMob = is_numeric(strpos($ua, "mobile"));
    }

    public static function tableResponsive()
    {
        return self::isMobile() ? 'table-responsive-stack' : 'table-responsive';
    }

    public static function routes()
    {

        if (Session::has('routes')) {
            return Session::get('routes');
        }

        $routes = [];
        try {
            $routes = Routes::select(RoutesFacades::getSelectedField())
                ->with('has_menu')->get()->groupBy(RoutesFacades::field_group());
            Session::put('routes', $routes, 1200);
        } catch (\Throwable $th) {
            //throw $th;
        }

        return $routes;
    }

    public static function filter()
    {

        if (Session::has('filter')) {
            return Session::get('filter');
        }

        $filter = [];
        try {
            $filter = Filters::get();
            Session::put('filter', $filter, 12000);
        } catch (\Throwable $th) {
            //throw $th;
        }

        return $filter;
    }

    public static function groups()
    {
        if (Session::has('groups')) {
            return Session::get('groups');
        }

        $groups = [];
        try {
            $groups = Groups::orderBy(Groups::field_sort(), 'ASC')->get();
            Session::put('groups', $groups, 12000);
        } catch (\Throwable $th) {
            //throw $th;
        }
        return $groups;
    }

    public static function extractColumn($value)
    {
        $string = '';
        if ($value->class) {
            $string = 'class=' . $value->class;
        }
        if ($value->width) {
            $string = $string . 'style=width:' . $value->width;
        }
        return $string;
    }

    public static function components($value)
    {
        return 'components.' . $value;
    }

    public static function form_table()
    {
        return Form::open([
            'url' => route(SharedData::get('route') . '.getTable'),
            'class' => 'form-row', 'method' => 'GET',
        ]);
    }

    public static function form_open($model)
    {
        if ($model) {
            return Form::model($model, [
                'route' => [
                    SharedData::get('route') . '.postUpdate',
                    'code' => $model->{$model->getKeyName()},
                ],
                'class' => 'form-horizontal needs-validation',
                'files' => true,
            ]);
        } else {
            return Form::open([
                'url' => route(SharedData::get('route') . '.postCreate'),
                'class' => 'form-horizontal needs-validation',
                'files' => true,
            ]);
        }
    }

    public static function form_close()
    {
        return Form::close();
    }

    public static function text($name, $value = null)
    {
        return Form::text($name, $value, [
            'class' => 'form-control',
            'id' => 'brand_name',
            'placeholder' => 'Please fill this input',
        ]);
    }

    public static function textarea($name, $value = null)
    {
        return Form::textarea($name, $value, [
            'class' => 'form-control h-auto',
            'id' => 'brand_name',
            'placeholder' => 'Please fill this input',
            'rows' => 5,
        ]);
    }
}
