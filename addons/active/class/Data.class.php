<?php
class Data
{
    static function webMenu()
    {

        global $_W, $_GPC;
        if (function_exists("buildframes")) {
            $myframes = buildframes("account");
            $seturl = $myframes["section"]["platform_module_common"]["menu"]["platform_module_settings"]["url"];
            if (empty($seturl)) {
                $seturl = $_W["siteroot"] . "web/index.php?c=profile&a=module&do=setting&op=set&m=" . MODULE;
            }
            return array(
                "setting" => array(
                    "name" => "参数设置",
                    "icon" => "https://res.wx.qq.com/mpres/htmledition/images/icon/menu/icon_menu_setup.png",
                    "list" => array(array("op" => "set", "name" => "参数设置", "url" => $seturl))
                ),
                "library_class" => array(
                    "name" => "活动管理",
                    "icon" => "https://res.wx.qq.com/mpres/htmledition/images/icon/menu/icon_menu_management.png",
                    "list" => array(
                        array(
                            "op" => "list", "name" => "活动列表",
                            "url" => Util::webUrl("library_class", array("op" => "list"))
                        ),
                        array(
                            "op" => "add",
                            "name" => "发布活动",
                            "url" => Util::webUrl(
                                "library_class",
                                array("op" => "add")
                            )
                        ),
                        array(
                            "op" => "query",
                            "name" => "核销活动码",
                            "url" => Util::webUrl(
                                "user_list",
                                array("op" => "query")
                            )
                        )
                    ),
                    "toplist" => array("list")
                ),
//                "library" => array(
//                    "name" => "题库管理",
//                    "icon" => "https://res.wx.qq.com/mpres/htmledition/images/icon/menu/icon_menu_management.png",
//                    "list" => array(
//                        array(
//                            "op" => "list",
//                            "name" => "题目列表",
//                            "url" => Util::webUrl(
//                                "library",
//                                array("op" => "list")
//                            )
//                        ),
//                        array(
//                            "op" => "add",
//                            "name" => "添加题目",
//                            "url" => Util::webUrl(
//                                "library",
//                                array("op" => "add")
//                            )
//                        )
//                    ),
//                    "toplist" => array("add", "list")
//                ),
//                "answer" => array(
//                    "name" => "答案管理",
//                    "icon" => "https://res.wx.qq.com/mpres/htmledition/images/icon/menu/icon_menu_management.png",
//                    "list" => array(
//                        array(
//                            "op" => "list",
//                            "name" => "答案列表",
//                            "url" => Util::webUrl(
//                                "answer",
//                                array("op" => "list")
//                            )
//                        ),
//                        array(
//                            "op" => "add",
//                            "name" => "添加答案",
//                            "url" => Util::webUrl(
//                                "answer",
//                                array("op" => "add", 'library_id' => $_GPC['library_id'])
//                            )
//                        )
//                    ),
//                    "toplist" => array("add", "list"),
//                    'hide' => 1
//                ),
//                "prize" => array(
//                    "name" => "奖品管理",
//                    "icon" => "https://res.wx.qq.com/mpres/htmledition/images/icon/menu/icon_menu_management.png",
//                    "list" => array(
//                        array(
//                            "op" => "list",
//                            "name" => "奖品列表",
//                            "url" => Util::webUrl(
//                                "prize",
//                                array("op" => "list")
//                            )
//                        ),
//                        array(
//                            "op" => "add",
//                            "name" => "添加奖品",
//                            "url" => Util::webUrl(
//                                "prize",
//                                array("op" => "add")
//                            )
//                        )
//                    ),
//                    "toplist" => array("add", "list")
//                ),
//                "dusk" => array(
//                    "name" => "黄昏茶叙",
//                    "icon" => "https://res.wx.qq.com/mpres/htmledition/images/icon/menu/icon_menu_management.png",
//                    "list" => array(
//                        array(
//                            "op" => "list",
//                            "name" => "茶叙列表",
//                            "url" => Util::webUrl(
//                                "dusk",
//                                array("op" => "list")
//                            )
//                        ),
//                    ),
//                ),
//                "record" => array(
//                    "name" => "抽奖记录",
//                    "icon" => "https://res.wx.qq.com/mpres/htmledition/images/icon/menu/icon_menu_management.png",
//                    "list" => array(
//                        array(
//                            "op" => "list",
//                            "name" => "抽奖记录",
//                            "url" => Util::webUrl(
//                                "record",
//                                array("op" => "list")
//                            )
//                        ),
//                    ),
//                ),
            );
        }
    }

}