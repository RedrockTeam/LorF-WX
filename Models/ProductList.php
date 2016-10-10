<?php

namespace App\Modules\LAF\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class ProductList extends Model
{
    /**
     * @inheritDoc
     */
    protected $connection = 'laf';

    /**
     * @inheritDoc
     */
    protected $table = 'product_list';

    /**
     * @inheritDoc
     */
    protected $primaryKey = 'pro_id';

    /**
     * @inheritDoc
     */
    public $timestamps = false;

    /**
     * 获取不同主题(失物/招领)分类下的多条信息
     *
     * @param integer $theme
     * @param string  $category
     * @param integer $page
     * @param array   $scope
     *
     * @return $this
     */
    public function getTipsByThemeWithPager($theme, $category, $page, $scope = ['*'])
    {
        return
            $this
                ->where(
                    [
                        ['lost_or_found', '=', $theme],
                        ['check_state', '=', 1],
                        ['status', '=', 0],
                        ['pro_name', $category ? '=' : '!=', $category]
                    ]
                )
                ->orderBy('pro_id', 'desc')
                ->paginate($this->perPage, $scope, 'lost_found', $page);
    }

    /**
     * 获取指定ID的详细信息
     *
     * @param $product
     * @return $this
     */
    public function getDetailByProductId($product)
    {
        return
            $this
                ->where('pro_id', '=', $product)
                ->first(
                    [
                        'pro_name', 'pro_description', 'L_or_F_time',
                        'L_or_F_place', 'connect_name', 'connect_wx',
                        'connect_phone', 'wx_avatar', 'created_at'
                    ]
                );
    }

    /**
     * 新建失物招领信息
     *
     * @param array $information
     * @param array $user
     *
     * @return bool
     */
    public function setLostOrFoundTips(array $information, array $user)
    {
        foreach ($information as $key => $value)
            $this->setAttribute($key, $value);

        $this->setAttribute('connect_name', $user['nickname']);
        $this->setAttribute('wx_avatar', $information['lost_or_found'] ? '/lostandfound/img/avatar.jpg' : $user['headimgurl']);

        $this->setCreatedAt(Carbon::now());

        return $this->save();
    }
}
