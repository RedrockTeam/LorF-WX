<?php

namespace App\Modules\LAF\Http\Middleware;

use Closure;

class WeixinMockBypass
{
    /**
     * 用于验证学号的接口地址
     * @var string
     */
    protected $verify = 'http://202.202.43.125/api/verify';

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if ($request->has('stu_num') && $request->has('idNum')) {

            $ch = curl_init();
            curl_setopt($ch,CURLOPT_HEADER, false);
            curl_setopt($ch,CURLOPT_URL, $this->verify);
            curl_setopt($ch,CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch,CURLOPT_POST, 1);
            curl_setopt($ch,CURLOPT_POSTFIELDS, http_build_query($request->only(['stu_num', 'idNum'])));
            $output = curl_exec($ch);
            curl_close($ch);

            $data = json_decode($output,TRUE);

            if ($data['status'] !== 200)
                return response()->json(['status' => '接口发生错误, 请重新认证'], $data['status']);
        }

        // 模拟微信用户数据
        $request->session()->set(
            'weixin.user', isset($data) ? ['nickname' => $data['data']['name'], 'headimgurl' => ''] : []
        );

        return $next($request);
    }
}
