<?php

namespace App\Modules\LAF\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\DB;

use App\Modules\LAF\Models\ProductList;

class CoreController extends Controller
{
    /**
     * 首页内容分页显示
     *
     * @param Request $request
     * @param string  $theme
     * @param integer $page
     * @param string  $category
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function view(Request $request, $theme, $category = 'all', $page = 0)
    {
        if (!$request->session()->has('weixin.user'))
            abort(403, '尚未获取到你的微信帐号信息, 请重试。');

        // 判断失物招领的内容主题
        switch ($theme) {
            case 'lost':
                $themeId = 0; break;
            case 'found':
                $themeId = 1; break;
            default:
                return response()->json(['status' => '找不到对应主题下的内容信息。'], 404);
        }

        if ($category === 'all') $category = false;

        /** @var LengthAwarePaginator $products */
        $products = (new ProductList())->getTipsByThemeWithPager(
            $themeId, $category, $page, ['pro_id', 'pro_name', 'connect_name', 'connect_wx', 'wx_avatar', 'pro_description', 'created_at']
        );

        if (!$products->isEmpty())
            return response()->json($products->toArray(), 200);
    }

    /**
     * 创建新的失物招领tips
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function create(Request $request)
    {
        if (!$request->session()->has('weixin.user'))
            abort(403, '尚未获取到你的微信帐号信息, 请重试。');

        if (empty($request->input('phone')) && empty($request->input('qq')))
            return response()->json(['status' => '请留下你的联系方式。'], 403);

        $inputs = $request->all();
        $information = [
            'pro_description' => 'detail', 'L_or_F_time' => 'pickTime', 'L_or_F_place' => 'place',
            'connect_phone' => 'phone', 'connect_wx' => 'qq', 'pro_name' => 'category'
        ];

        foreach ($information as $column => &$key) {
            if (!isset($inputs[$key]))
                return response()->json(['status' => '信息不完整, 请刷新页面。'], 403);

            $key = trim($inputs[$key], ' ');
        }

        switch ($request->input('property')) {
            case '寻物启事':
                $information['lost_or_found'] = 0; break;
            case '失物招领':
                $information['lost_or_found'] = 1; break;
            default:
                return response()->json(['status' => '信息分类不对, 请重试。'], 404);
        }

        $user = $request->session()->get('weixin.user');

        if ((new ProductList())->setLostOrFoundTips($information, $user))
            return response()->json(['status' => '成功添加失物招领信息'], 200);
    }

    /**
     * 显示某个失物招领的详细信息
     *
     * @param Request $request
     * @param integer $product
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function detail(Request $request, $product)
    {
        if (!$request->session()->has('weixin.user'))
            abort(403, '尚未获取到你的微信帐号信息, 请重试。');

        $information = (new ProductList())->getDetailByProductId($product);

        return view('LAF::detail')->with('data', $information);
    }
}
