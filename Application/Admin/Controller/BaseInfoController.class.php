<?php
// +----------------------------------------------------------------------
// | Footstone [ WE CAN DO MORE ]
// +----------------------------------------------------------------------
// | Copyright (c) 2013 http://  All rights reserved.
// +----------------------------------------------------------------------
// | Author: Newmannhu <Newmannhu@qq.com> <http://>
// +----------------------------------------------------------------------

namespace Admin\Controller;

/**
 * 公司信息维护控制器
 * @author Newmannhu <Newmannhu@qq.com>
 */
class BaseInfoController extends AdminController {

    /**
     * 公司基本信息浏览首页
     * @author Newmannhu <Newmannhu@qq.com>
     * @return none
     */
    public function index(){
        /* 查询条件初始化 */
        $map = array();
        $map  = array('status' => 1);
        
        $data = $this->lists('BaseInfo', $map);

        $this->assign('data',$data);

        // 记录当前列表页的cookie
        Cookie('__forward__',$_SERVER['REQUEST_URI']);

        $this->meta_title = '公司基本信息';
        $this->display();
    }

    /**
     * 编辑公司基本信息
     * @author Newmannhu <Newmannhu@qq.com>
     * 
     */
    public function edit($id = 1){
        if(IS_POST){
            $BaseInfo = D('BaseInfo');
            $data = $BaseInfo->create();
            if($data){
                if($BaseInfo->save()!== false){
                    // S('DB_CONFIG_DATA',null);
                    //记录行为
                    action_log('update_baseinfo', 'BaseInfo', $data['id'], UID);
                    $this->success('更新成功', Cookie('__forward__'));
                } else {
                    $this->error('更新失败');
                }
            } else {
                $this->error($BaseInfo->getError());
            }
        } else {
            $info = array();
            /* 获取数据 */
            $info = M('BaseInfo')->field(true)->find($id);
            if(false === $info){
                $this->error('获取后台菜单信息错误');
            }
            $this->assign('baseinfo', $info);
            $this->meta_title = '编辑公司信息';
            $this->display();
        }
    }






}