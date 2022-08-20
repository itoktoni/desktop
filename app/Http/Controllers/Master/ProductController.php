<?php

namespace App\Http\Controllers\Master;

use App\Dao\Enums\BooleanType;
use App\Dao\Models\Category;
use App\Dao\Models\Brand;
use App\Dao\Models\ProductType;
use App\Dao\Models\Supplier;
use App\Dao\Models\Unit;
use App\Dao\Repositories\ProductRepository;
use App\Http\Requests\ProductRequest;
use App\Http\Services\CreateService;
use App\Http\Services\SingleService;
use App\Http\Services\UpdateService;
use Coderello\SharedData\Facades\SharedData;
use Plugins\Response;
use Plugins\Template;
use App\Http\Controllers\System\MasterController;

class ProductController extends MasterController
{
    public function __construct(ProductRepository $repository, SingleService $service)
    {
        self::$repository = self::$repository ?? $repository;
        self::$service = self::$service ?? $service;
    }

    protected function beforeForm()
    {
        $status = BooleanType::getOptions();
        $category = Category::optionBuild();
        $product_type = ProductType::optionBuild();
        $brand = Brand::optionBuild();
        $supplier = Supplier::optionBuild();
        $unit = Unit::optionBuild();
        self::$share = [
            'status' => $status,
            'category' => $category,
            'supplier' => $supplier,
            'brand' => $brand,
            'unit' => $unit,
            'product_type' => $product_type,
        ];
    }

    public function postCreate(ProductRequest $request, CreateService $service)
    {
        $data = $service->save(self::$repository, $request);
        return Response::redirectBack($data);
    }

    public function postUpdate($code, ProductRequest $request, UpdateService $service)
    {
        $data = $service->update(self::$repository, $request, $code);
        return Response::redirectBack($data);
    }
}
