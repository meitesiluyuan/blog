<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 2017/3/6
 * Time: 15:37
 */

namespace Common\Services\Admin;



use Common\Repositories\Eloquent\Admin\UserGroupRepository;
use Common\Services\CommonService;
use Common\Validators\UserGroupValidator;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;

class UserGroupService extends CommonService
{
    /**
     * @var UserGroupRepository
     */
    private $repository;
    /**
     * @var UserGroupValidator
     */
    private $validator;

    public function __construct(UserGroupValidator $validator,UserGroupRepository $repository)
    {
        $this->repository = $repository;
        $this->validator = $validator;
    }


    /*
     * 获取会员组列表
     */
    public function getUserGroupList($request)
    {

        return $this->respondWithSuccess($this->repository->getUserGroupList($request),'查询成功');
    }

    public function getAllUserGroup()
    {
        return $this->respondWithSuccess($this->repository->getAllUserGroup(),'查询成功');
    }


    /**
     * 根据id获取会员组
     * @param $id 会员组的ID
     */
    public function findById($id)
    {
        return $this->respondWithSuccess($this->repository->find($id),'查询成功');
    }

    /**
     * 会员组 添加和更新
     * @param $id 会员组的ID
     */
    public function createOrUpdate($request,$id=null)
    {

        $data= $request->input('params');
        try {
            if ( isset($id) && $id > 0 ) {
                $this->validator->with( $data )->passesOrFail( ValidatorInterface::RULE_UPDATE);
                if ($this->repository->update($data, $id)) {

                    return $this->respondWithSuccess(1,'修改成功');
                }
                return $this->respondWithErrors('修改失败');

            }else{

                $this->validator->with($data)->passesOrFail(ValidatorInterface::RULE_CREATE);

                if ($this->repository->create($data)) {

                    return $this->respondWithSuccess(1,'会员组添加成功');
                }
                return $this->respondWithErrors('会员组添加失败');
            }

        } catch (ValidatorException $e) {

            return $this->respondWithErrors( $e->getMessageBag()->first(), 422);
        }

    }

    /*
     * 删除会员组
     */
    public function delete($id)
    {
        $res= $this->repository->delete($id);
        if ($res) {
            return $this->respondWithSuccess(1, '删除成功');
        }
        return $this->respondWithErrors('删除失败');

    }






}
