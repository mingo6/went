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
            /* if ($_W["role"] == "founder") {
                $copyright = array("name" => "系统设置", "icon" => "https://res.wx.qq.com/mpres/htmledition/images/icon/menu/icon_menu_management.png", "list" => array(array("op" => "list", "name" => "设置版权", "url" => Util::webUrl("copyright", array("op" => "list"))), array("op" => "mail", "name" => "邮件通知", "url" => Util::webUrl("copyright", array("op" => "mail")))), "toplist" => array("list"));
            } */
            return array(
                "setting" => array(
                    "name" => "参数设置",
                    "icon" => "https://res.wx.qq.com/mpres/htmledition/images/icon/menu/icon_menu_setup.png",
                    "list" => array(array("op" => "set", "name" => "参数设置", "url" => $seturl))
                ),
                /* "users" => array(
                    "name" => "用户管理",
                    "icon" => "https://res.wx.qq.com/mpres/htmledition/images/icon/menu/icon_menu_management.png",
                    "list" => array(
                        array(
                            "op" => "users_list",
                            "name" => "用户列表",
                            "url" => Util::webUrl("users", array("op" => "list", "tid" => $_GPC["tid"]))
                        ),
                        array(
                            "op" => "edit",
                            "name" => "编辑页面",
                            "url" => Util::webUrl(
                                "page",
                                array(
                                    "op" => "edit",
                                    "tid" => $_GPC["tid"],
                                    "id" => $_GPC["id"]
                                )
                            ), "hide" => 1
                        )
                    ), "toplist" => array(
                        "add", "list", "bar", "edit"
                    )
                ), */
                "library_class" => array(
                    "name" => "题目分类",
                    "icon" => "https://res.wx.qq.com/mpres/htmledition/images/icon/menu/icon_menu_management.png",
                    "list" => array(
                        array(
                            "op" => "list", "name" => "题目分类列表",
                            "url" => Util::webUrl("library_class", array("op" => "list"))
                        ),
                        array(
                            "op" => "add",
                            "name" => "添加题目分类",
                            "url" => Util::webUrl(
                                "library_class",
                                array("op" => "add")
                            )
                        )
                    ),
                    "toplist" => array("list")
                ),
                "library" => array(
                    "name" => "题库管理",
                    "icon" => "https://res.wx.qq.com/mpres/htmledition/images/icon/menu/icon_menu_management.png",
                    "list" => array(
                        array(
                            "op" => "list",
                            "name" => "题目列表",
                            "url" => Util::webUrl(
                                "library",
                                array("op" => "list")
                            )
                        ),
                        array(
                            "op" => "add",
                            "name" => "添加题目",
                            "url" => Util::webUrl(
                                "library",
                                array("op" => "add")
                            )
                        )
                    ),
                    "toplist" => array("add", "list")
                ),
                "answer" => array(
                    "name" => "答案管理",
                    "icon" => "https://res.wx.qq.com/mpres/htmledition/images/icon/menu/icon_menu_management.png",
                    "list" => array(
                        array(
                            "op" => "list",
                            "name" => "答案列表",
                            "url" => Util::webUrl(
                                "answer",
                                array("op" => "list")
                            )
                        ),
                        array(
                            "op" => "add",
                            "name" => "添加答案",
                            "url" => Util::webUrl(
                                "answer",
                                array("op" => "add", 'library_id' => $_GPC['library_id'])
                            )
                        )
                    ),
                    "toplist" => array("add", "list"),
                    'hide' => 1
                ),
                "prize" => array(
                    "name" => "奖品管理",
                    "icon" => "https://res.wx.qq.com/mpres/htmledition/images/icon/menu/icon_menu_management.png",
                    "list" => array(
                        array(
                            "op" => "list",
                            "name" => "奖品列表",
                            "url" => Util::webUrl(
                                "prize",
                                array("op" => "list")
                            )
                        ),
                        array(
                            "op" => "add",
                            "name" => "添加奖品",
                            "url" => Util::webUrl(
                                "prize",
                                array("op" => "add")
                            )
                        )
                    ),
                    "toplist" => array("add", "list")
                ),
                "dusk" => array(
                    "name" => "黄昏茶叙",
                    "icon" => "https://res.wx.qq.com/mpres/htmledition/images/icon/menu/icon_menu_management.png",
                    "list" => array(
                        array(
                            "op" => "list",
                            "name" => "茶叙列表",
                            "url" => Util::webUrl(
                                "dusk",
                                array("op" => "list")
                            )
                        ),
                    ),
                ),
                "record" => array(
                    "name" => "抽奖记录",
                    "icon" => "https://res.wx.qq.com/mpres/htmledition/images/icon/menu/icon_menu_management.png",
                    "list" => array(
                        array(
                            "op" => "list",
                            "name" => "抽奖记录",
                            "url" => Util::webUrl(
                                "record",
                                array("op" => "list")
                            )
                        ),
                    ),
                ),
                /* "form" => array(
                    "name" => "表单数据",
                    "icon" => "https://res.wx.qq.com/mpres/htmledition/images/icon/menu/icon_menu_management.png",
                    "list" => array(
                        array(
                            "op" => "wait", "name" => "审核数据",
                            "url" => Util::webUrl("form", array("op" => "wait"))
                        ),
                        array(
                            "op" => "scaned", "name" => "已审数据", "url" => Util::webUrl("form", array("op" => "scaned"))
                        ),
                        array(
                            "op" => "admin", "name" => "前端查看", "url" => Util::webUrl("form", array("op" => "admin"))
                        )
                    ), "toplist" => array("wait", "scaned", "admin")
                ), 
                "copyright" => $copyright,
                "explain" => array(
                    "name" =>
                        "模块使用说明",
                    "icon" => "https://res.wx.qq.com/mpres/htmledition/images/icon/menu/icon_menu_ad.png", "url" => Util::webUrl("explain")
                ) */
            );
        }
    }

    /* static function webMenus()
    {
        goto NGNW2;
        w0LeZ :
            if ($lwh7X) {
            goto uq2rP;
        }
        goto CfTyH;
        KEGdN :
            goto SaADr;
        Uy_0R :
        if ($r3o39) {
            goto tyn3w;
        }
        goto dob6g;
        SaADr :
            $myframes = buildframes("account");
        goto UspUl;
        HH41x :
            return array(
                "setting" => array("name" => "参数设置", "icon" => "https://res.wx.qq.com/mpres/htmledition/images/icon/menu/icon_menu_setup.png", 
                "list" => array(array("op" => "set", "name" => "参数设置", "url" => $seturl))), 
                "temp" => array("name" => "模板管理", "icon" => "https://res.wx.qq.com/mpres/htmledition/images/icon/menu/icon_menu_management.png", 
                "list" => array(array("op" => "my", "name" => "我的模板", "url" => Util::webUrl("temp", array("op" => "my"))), array("op" => "sys", "name" => "系统模板", "url" => Util::webUrl("temp", array("op" => "sys")))), 
                "toplist" => array("my", "sys")), "page" => array("name" => "设计页面", "icon" => "https://res.wx.qq.com/mpres/htmledition/images/icon/menu/icon_menu_management.png", 
                "list" => array(array("op" => "list", "name" => "页面列表", "url" => Util::webUrl("page", array("op" => "list", "tid" => $_GPC["tid"]))), array("op" => "add", "name" => "添加页面", "url" => Util::webUrl("page", array("op" => "add", "tid" => $_GPC["tid"]))), array("op" => "bar", "name" => "设计导航", "url" => Util::webUrl("page", array("op" => "bar", "tid" => $_GPC["tid"]))), array("op" => "edit", "name" => "编辑页面", "url" => Util::webUrl("page", array("op" => "edit", "tid" => $_GPC["tid"], "id" => $_GPC["id"])), "hide" => 1)), "toplist" => array("add", "list", "bar", "edit"), "hide" => 1), "bar" => array("name" => "页脚导航", "icon" => "https://res.wx.qq.com/mpres/htmledition/images/icon/menu/icon_menu_management.png", "list" => array(array("op" => "design", "name" => "设计导航", "url" => Util::webUrl("bar", array("op" => "design")))), "toplist" => array("design"), "hide" => 1), "article" => array("name" => "文章管理", "icon" => "https://res.wx.qq.com/mpres/htmledition/images/icon/menu/icon_menu_management.png", "list" => array(array("op" => "add", "name" => "添加文章", "url" => Util::webUrl("article", array("op" => "add"))), array("op" => "list", "name" => "文章列表", "url" => Util::webUrl("article", array("op" => "list")))), "toplist" => array("add", "list")), "artsort" => array("name" => "文章分类", "icon" => "https://res.wx.qq.com/mpres/htmledition/images/icon/menu/icon_menu_management.png", "list" => array(array("op" => "list", "name" => "分类列表", "url" => Util::webUrl("artsort", array("op" => "list")))), "toplist" => array("list")), "form" => array("name" => "表单数据", "icon" => "https://res.wx.qq.com/mpres/htmledition/images/icon/menu/icon_menu_management.png", "list" => array(array("op" => "wait", "name" => "审核数据", "url" => Util::webUrl("form", array("op" => "wait"))), array("op" => "scaned", "name" => "已审数据", "url" => Util::webUrl("form", array("op" => "scaned"))), array("op" => "admin", "name" => "前端查看", "url" => Util::webUrl("form", array("op" => "admin")))), "toplist" => array("wait", "scaned", "admin")), "copyright" => $copyright, "explain" => array("name" => "模块使用说明", "icon" => "https://res.wx.qq.com/mpres/htmledition/images/icon/menu/icon_menu_ad.png", "url" => Util::webUrl("explain")));
        goto VoI4Z;
        dob6g :
            $seturl = $_W["siteroot"] . "web/index.php?c=profile&a=module&do=setting&op=set&m=" . MODULE;
        goto s6BN5;
        icIdh :
            uq2rP :
            goto HH41x;
        UspUl :
            $seturl = $myframes["section"]["platform_module_common"]["menu"]["platform_module_settings"]["url"];
        goto SSAPf;
        NGNW2 :
            global $_W, $_GPC;
        goto D6DLd;
        s6BN5 :
            tyn3w :
            goto q5pCo;
        SSAPf :
            F73JS :
            goto eNTpu;
        q5pCo :
            $lwh7X = !($_W["role"] == "founder");
        goto w0LeZ;
        D6DLd :
            $wBeQW = !function_exists("buildframes");
        goto KEGdN;
        CfTyH :
            $copyright = array("name" => "系统设置", "icon" => "https://res.wx.qq.com/mpres/htmledition/images/icon/menu/icon_menu_management.png", "list" => array(array("op" => "list", "name" => "设置版权", "url" => Util::webUrl("copyright", array("op" => "list"))), array("op" => "mail", "name" => "邮件通知", "url" => Util::webUrl("copyright", array("op" => "mail")))), "toplist" => array("list"));
        goto icIdh;
        eNTpu :
            $r3o39 = !empty($seturl);
        goto Uy_0R;
        VoI4Z :
    } */
}