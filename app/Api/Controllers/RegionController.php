<?php

namespace App\Api\Controllers;

use Common\Services\Admin\RegionService;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class RegionController extends BaseController
{
    /**
     * @var RegionService
     */
    private $service;

    public function __construct(RegionService $service)
    {
        $this->service = $service;
    }

    /**
     * 返回数据树
     */
    public function index()
    {
        return $this->service->getRegionTree();
    }
}
