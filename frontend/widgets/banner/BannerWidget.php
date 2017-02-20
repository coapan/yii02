<?php

/**
 * Created by PhpStorm.
 * User: PanChaoZhi
 * Date: 2017/1/31
 * Time: 12:39
 */
namespace frontend\widgets\banner;

use yii\bootstrap\Widget;

class BannerWidget extends Widget
{
    public $items = [];

    public function init()
    {
        if (empty($this->items)) {
            $this->items = [
                [
                    'label' => 'demo',
                    'image_url' => '/img/banner/php.png',
                    'url' => [
                        'article/index'
                    ],
                    'html' => '',
                    'active' => 'active'
                ],
                [
                    'label' => 'demo',
                    'image_url' => '/img/banner/sub.png',
                    'url' => [
                        'article/index'
                    ],
                    'html' => ''
                ],
                [
                    'label' => 'demo',
                    'image_url' => '/img/banner/03.jpg',
                    'url' => [
                        'article/index'
                    ],
                    'html' => ''
                ]
            ];
        }
    }

    public function run()
    {
        $data['items'] = $this->items;
        return $this->render('index', ['data' => $data]);
    }
}