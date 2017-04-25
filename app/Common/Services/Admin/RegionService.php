<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 2017/3/5
 * Time: 8:43
 */

namespace Common\Services\Admin;



use Common\Repositories\Eloquent\Admin\RegionRepository;
use Common\Services\CommonService;
use Illuminate\Support\Facades\Cache;


class RegionService extends CommonService
{
    /**
     * @var RegionRepository
     */
    private $repository;

    public function __construct(RegionRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * 返回地区数据树
     */
    public function getRegionTree()
    {

        return $this->respondWithSuccess($this->repository->makeRegionTree($this->repository->getTreeList()),'查询成功');
    }

}
