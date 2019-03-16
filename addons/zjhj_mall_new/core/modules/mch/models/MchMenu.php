<?php
/**
 * Created by IntelliJ IDEA.
 * User: luwei
 * Date: 2017/12/27
 * Time: 10:44
 */

namespace app\modules\mch\models;


class MchMenu
{
    public $platform;

    public function getList()
    {
        return [
            [
                'name' => '商城',
                'route' => 'mch/store/wechat-setting',
                'icon' => 'icon-settings',
                'list' => [
                    [
                        'name' => '系统设置',
                        'route' => 'mch/store/wechat-setting',
                        'list' => [
                            [
                                'name' => '微信配置',
                                'route' => 'mch/store/wechat-setting',
                            ],
                            [
                                'name' => '商城设置',
                                'route' => 'mch/setting/mall',
                            ],
                            [
                                'name' => '模板消息',
                                'route' => 'mch/store/mall',
                            ],
                            [
                                'name' => '运费规则',
                                'route' => 'mch/setting/mall',
                            ],
                            [
                                'name' => '短信通知',
                                'route' => 'mch/store/sms',
                            ],
                            [
                                'name' => '邮件通知',
                                'route' => 'mch/setting/mall',
                            ],
                            [
                                'name' => '上传设置',
                                'route' => 'mch/setting/mall',
                            ],
                            [
                                'name' => '小票打印',
                                'route' => 'mch/setting/mall',
                            ],
                            [
                                'name' => '快递单打印',
                                'route' => 'mch/setting/mall',
                            ],
                            [
                                'name' => 'cache',
                                'route' => 'mch/test/cache',
                            ],
                        ],
                    ],
                    [
                        'name' => '小程序设置',
                        'route' => 'mch/update/index',
                        'list' => [
                            [
                                'name' => '轮播图',
                                'route' => 'mch/setting/mall',
                            ],
                            [
                                'name' => '导航图标',
                                'route' => 'mch/setting/mall',
                            ],
                            [
                                'name' => '图片魔方',
                                'route' => 'mch/setting/mall',
                            ],
                            [
                                'name' => '导航栏',
                                'route' => 'mch/setting/mall',
                            ],
                            [
                                'name' => '首页布局',
                                'route' => 'mch/setting/mall',
                            ],
                            [
                                'name' => '用户中心',
                                'route' => 'mch/setting/mall',
                            ],
                        ],
                    ],
                    [
                        'name' => '权限管理',
                        'route' => 'mch/we7/auth',
                    ],
                    [
                        'name' => '补丁',
                        'route' => 'mch/update/index',
                    ],
                    [
                        'name' => '缓存',
                        'route' => 'mch/update/index',
                    ],
                    [
                        'name' => '更新',
                        'route' => 'mch/update/index',
                    ],
                ],
            ],
            [
                'name' => '商品',
                'route' => 'mch/goods/goods',
                'icon' => 'icon-settings',
                'list' => [
                    [
                        'name' => '所有商品',
                        'route' => 'mch/goods/goods',
                    ],
                    [
                        'name' => '分类',
                        'route' => 'mch/update/index',
                    ],
                    [
                        'name' => '规格',
                        'route' => 'mch/update/index',
                    ],
                ],
            ],
            /*
            [
                'name' => '订单',
                'route' => '',
                'icon' => '',
                'list' => [
                    [
                        'name' => '订单列表',
                        'route' => 'mch/update/index',
                    ],
                    [
                        'name' => '自提订单',
                        'route' => 'mch/update/index',
                    ],
                    [
                        'name' => '售后单',
                        'route' => 'mch/update/index',
                    ],
                    [
                        'name' => '评价管理',
                        'route' => 'mch/update/index',
                    ],
                ],
            ],
            [
                'name' => '用户',
                'route' => '',
                'icon' => '',
                'list' => [
                    [
                        'name' => '用户列表',
                        'route' => 'mch/update/index',
                    ],
                    [
                        'name' => '核销员',
                        'route' => 'mch/update/index',
                    ],
                    [
                        'name' => '会员等级',
                        'route' => 'mch/update/index',
                    ],
                ],
            ],
            [
                'name' => '扩展功能',
                'route' => '',
                'icon' => '',
                'list' => [
                    [
                        'name' => '分销中心',
                        'route' => 'mch/update/index',
                        'list' => [
                            [
                                'name' => '分销商',
                                'route' => 'mch/setting/mall',
                            ],
                            [
                                'name' => '分销订单',
                                'route' => 'mch/setting/mall',
                            ],
                            [
                                'name' => '分销提现',
                                'route' => 'mch/setting/mall',
                            ],
                            [
                                'name' => '分销设置',
                                'route' => 'mch/setting/mall',
                            ],
                        ],
                    ],
                    [
                        'name' => '文章管理',
                        'route' => 'mch/update/index',
                        'list' => [
                            [
                                'name' => '关于我们',
                                'route' => 'mch/setting/mall',
                            ],
                            [
                                'name' => '服务中心',
                                'route' => 'mch/setting/mall',
                            ],
                        ],
                    ],
                    [
                        'name' => '专题',
                        'route' => 'mch/update/index',
                    ],
                    [
                        'name' => '整点秒杀',
                        'route' => 'mch/update/index',
                    ],
                    [
                        'name' => '拼团',
                        'route' => 'mch/update/index',
                        'list' => [
                            [
                                'name' => '商品',
                                'route' => 'mch/setting/mall',
                            ],
                            [
                                'name' => '商品分类',
                                'route' => 'mch/setting/mall',
                            ],
                            [
                                'name' => '订单',
                                'route' => 'mch/setting/mall',
                            ],
                            [
                                'name' => '拼团管理',
                                'route' => 'mch/setting/mall',
                            ],
                            [
                                'name' => '轮播图',
                                'route' => 'mch/setting/mall',
                            ],
                            [
                                'name' => '模板消息',
                                'route' => 'mch/setting/mall',
                            ],
                            [
                                'name' => '拼团规则',
                                'route' => 'mch/setting/mall',
                            ],
                            [
                                'name' => '评论管理',
                                'route' => 'mch/setting/mall',
                            ],
                            [
                                'name' => '图片魔方',
                                'route' => 'mch/setting/mall',
                            ],
                        ],
                    ],
                    [
                        'name' => '预约管理',
                        'route' => 'mch/update/index',
                        'list' => [
                            [
                                'name' => '商品',
                                'route' => 'mch/setting/mall',
                            ],
                            [
                                'name' => '商品分类',
                                'route' => 'mch/setting/mall',
                            ],
                            [
                                'name' => '订单',
                                'route' => 'mch/setting/mall',
                            ],
                            [
                                'name' => '基础设置',
                                'route' => 'mch/setting/mall',
                            ],
                            [
                                'name' => '模板消息',
                                'route' => 'mch/setting/mall',
                            ],
                            [
                                'name' => '评论管理',
                                'route' => 'mch/setting/mall',
                            ],
                        ],
                    ],
                ],
            ],
            */


        ];
    }

}