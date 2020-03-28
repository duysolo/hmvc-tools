<?php

namespace DummyNamespace\Http\Controllers;

use WebEdBase\Http\Controllers\BaseFrontController;

abstract class AbstractController extends BaseFrontController
{
    protected $currentThemeName = THEME_CONST_NAME;

    /**
     * @param null $type
     * @param null $relatedId
     * @return mixed|null|string|string[]
     * @throws \Throwable
     */
    public function getMenu($type = null, $relatedId = null)
    {
        $menuHtml = webed_render_menu(get_setting('main_menu', 'main-menu'), [
            'container_id'    => '',
            'container_class' => 'collapse navbar-collapse',
            'container_tag'   => 'nav',
            'id'              => '',
            'class'           => 'nav navbar-nav navbar-right',
            'has_sub_class'   => 'dropdown',
            'group_tag'       => 'ul',
            'child_tag'       => 'li',
            'submenu_class'   => 'sub-menu',
            'item_class'      => '',
            'active_class'    => 'active current-menu-item',
            'menu_active'     => [
                'type'       => $type,
                'related_id' => $relatedId,
            ],
            'view'            => WEBED_MENUS . '::front.renderer.menu',
        ]);

        view()->share([
            'cmsMenuHtml' => $menuHtml
        ]);

        return $menuHtml;
    }
}
