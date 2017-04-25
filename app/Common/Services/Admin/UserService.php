<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 2017/3/6
 * Time: 15:37
 */

namespace Common\Services\Admin;


use Common\Repositories\Eloquent\Admin\UserRepository;
use Common\Services\CommonService;
use Common\Validators\UserValidator;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;

class UserService extends CommonService
{
    /**
     * @var \Common\Repositories\Eloquent\Admin\UserRepository
     */
    private $repository;
    /**
     * @var UserValidator
     */
    private $validator;

    public function __construct(UserRepository $repository,UserValidator $validator)
    {
        $this->repository = $repository;
        $this->validator  = $validator;
    }

    /*
     * 获取会员列表
     */
    public function getUserList($request)
    {
        return $this->respondWithSuccess($this->repository->getUserList($request),'查询成功');
    }


    /*
     * 根据id获取会员
     */
    public function findById($id)
    {
        return $this->respondWithSuccess($this->repository->getUser($id),'查询成功');
    }

    /*
     * 创建或者更新会员
     */
    public function createOrUpdate($request,$id=null)
    {
        $data=$request->input('params');
        try {
            if (isset($id) && $id > 0) {
                $this->validator->with( $data )->passesOrFail( ValidatorInterface::RULE_UPDATE);
                //更新会员
                if ($this->repository->update($data, $id)) {

                    return $this->respondWithSuccess(1,'修改成功');
                }
                return $this->respondWithErrors('修改失败');
            }else{
                //创建会员
              $this->validator->with($data)->passesOrFail(ValidatorInterface::RULE_CREATE);
              $data['member_list_pwd']=bcrypt($data['member_list_pwd']);
                if ($this->repository->create($data)) {
                    return $this->respondWithSuccess(1,'会员添加成功');
                }
                return $this->respondWithErrors('会员添加失败');
            }

        } catch (ValidatorException $e) {
            return $this->respondWithErrors( $e->getMessageBag()->first(), 422);
        }
    }

    /*
     * 删除会员
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
