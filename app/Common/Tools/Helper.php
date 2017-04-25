<?php
if (! function_exists('juhecurl')) {
    /**
     * 请求接口返回内容
     * @param  string $url [请求的URL地址]
     * @param  string $params [请求的参数]
     * @param  int $ipost [是否采用POST形式]
     * @return  string
     */
    function juhecurl($url,$params=false,$ispost=0){
        $httpInfo = array();
        $ch = curl_init();

        curl_setopt( $ch, CURLOPT_HTTP_VERSION , CURL_HTTP_VERSION_1_1 );
        curl_setopt( $ch, CURLOPT_USERAGENT , 'JuheData' );
        curl_setopt( $ch, CURLOPT_CONNECTTIMEOUT , 60 );
        curl_setopt( $ch, CURLOPT_TIMEOUT , 60);
        curl_setopt( $ch, CURLOPT_RETURNTRANSFER , true );
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
        if( $ispost )
        {
            curl_setopt( $ch , CURLOPT_POST , true );
            curl_setopt( $ch , CURLOPT_POSTFIELDS , $params );
            curl_setopt( $ch , CURLOPT_URL , $url );
        }
        else
        {
            if($params){
                curl_setopt( $ch , CURLOPT_URL , $url.'?'.$params );
            }else{
                curl_setopt( $ch , CURLOPT_URL , $url);
            }
        }
        $response = curl_exec( $ch );
        if ($response === FALSE) {
            //echo "cURL Error: " . curl_error($ch);
            return false;
        }
        $httpCode = curl_getinfo( $ch , CURLINFO_HTTP_CODE );
        $httpInfo = array_merge( $httpInfo , curl_getinfo( $ch ) );
        curl_close( $ch );
        return $response;
    }
}


if (! function_exists('foo')) {
    /**
     *  [foo 示例]
     *  izxin.com
     *  @author qingfeng
     *  @DateTime 2016-09-19T11:32:07+0800
     *  @return   [type]                   [description]
     */
    function foo() {
        return "foo";
    }
}
if (! function_exists('sort_parent')) {
    /**
     *  [sortMenu description]
     */
    function sort_parent($menus,$pid=0)
    {
        $arr = [];
        if (empty($menus)) {
            return '';
        }
        foreach ($menus as $key => $v) {
            if ($v['parent_id'] == $pid) {
                $arr[$key] = $v;
                $arr[$key]['child'] = sort_parent($menus,$v['id']);
            }
        }
        return $arr;
    }
}
/**
 *  common_paginate
 */
if (! function_exists('common_paginate')) {
    /**
     *  [common_paginate description]
     */
    function common_paginate($results)
    {
        $response = [
            'pagination' => [
                'total' => $results['total'],
                'per_page' => $results['per_page'],
                'current_page' => $results['current_page'],
                'last_page' => $results['last_page'],
                'from' => $results['from'],
                'to' => $results['to']
            ],
            'data' => $results['data']
        ];
        return $response;
    }
}
/**
 *  qiniu_by_curl
 */
if (! function_exists('qiniu_by_curl')) {
    /**
     *  [qiniu_by_curl description]
     */
    function qiniu_by_curl($remote_server,$post_string,$upToken) {
        $headers = array();
        $headers[] = 'Content-Type:image/png';
        $headers[] = 'Authorization:UpToken '.$upToken;
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL,$remote_server);
        //curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_HTTPHEADER ,$headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        //curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $post_string);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 10);
        curl_setopt($ch, CURLOPT_TIMEOUT, 30);
        $data = curl_exec($ch);
        curl_close($ch);
        return $data;
    }
}
