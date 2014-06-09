<?php

namespace Addons\langSwith;
use Common\Controller\Addon;

/**
 * 多语言管理插件
 * @author 
 */

    class langSwithAddon extends Addon{

        public $info = array(
            'name'=>'langSwith',
            'title'=>'多语言管理',
            'description'=>'管理多语言',
            'status'=>1,
            'author'=>'',
            'version'=>'0.1'
        );

        public function install(){
            return true;
        }

        public function uninstall(){
            return true;
        }

        //实现的langSwitch钩子方法
        public function langSwitch($param){

        }

    }