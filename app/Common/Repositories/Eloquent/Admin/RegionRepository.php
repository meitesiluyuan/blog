<?php
namespace Common\Repositories\Eloquent\Admin;

use App\Common\Models\Region;
use Common\Repositories\Eloquent\Repository;
use Illuminate\Support\Facades\Cache;


class RegionRepository extends Repository
{
	/**
	 *  [model User]
	 */
	public function model()
	{
		return Region::class;
	}

	public function getTreeList(){
        if (Cache::has('treelist')) {
            return Cache::get('treelist');
        }else{
            $list=$this->model->where('type','<>',0)->get()->toArray();
            Cache::forever('treelist',$list);
            return $list;
        }

    }

    /**
     * 地区数据树
     */
    public function makeRegionTree($treeList,$pid=1)
    {
        if (Cache::has('tree')) {
            return Cache::get('tree');
        }else{
            $tree=[];
            foreach ($treeList as $v){
                if ($v['pid']==$pid) {
                    $v['children']= self::makeRegionTree($treeList,$v['id']);
                    if ($v['children']==null) {
                        unset($v['children']);
                    }
                    $tree[]=$v;
                }

            }
            Cache::forever('tree',$tree);
            return $tree;
        }

	}






}
