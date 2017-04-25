<?php
namespace Common\Services;

class CommonService
{
    /*
     * 响应成功
     */
    protected function respondWithSuccess($data, $message = '', $code = 200, $status = 'success')
    {
        return response()->json([
            'status' => $status,
            'code' => $code,
            'message' => $message,
            'result' => $data,
        ]);
    }
    /*
     * 响应所有的validation验证错误
     */
    protected function respondWithFailedValidation(\Illuminate\Validation\Validator $validator)
    {
        // 只取出一条错误信息
        return $this->respondWithErrors($validator->messages()->first(), 400);
    }
    /*
     * 响应错误
     *
     */
    protected function respondWithErrors($message = '', $code = 404, $status = 'error')
    {
        return response()->json([
            'status' => $status,
            'code' => $code,
            'message' => $message,
        ]);
    }
}
