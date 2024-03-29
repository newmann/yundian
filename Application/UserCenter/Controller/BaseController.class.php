<?php
/**
 * Created by PhpStorm.
 * User: caipeichao
 * Date: 14-3-11
 * Time: PM3:40
 */

namespace UserCenter\Controller;

use Think\Controller;

class BaseController extends Controller
{
    public function _initialize()
    {
        $uid = $_REQUEST['uid'] ? $_REQUEST['uid'] : is_login();
        if (!$uid) {
            $this->error('需要登录');
        }
        $this->assign('uid', $uid);
        $this->mid = is_login();
    }

    protected function defaultTabHash($tabHash)
    {
        $tabHash = $_REQUEST['tabHash'] ? $_REQUEST['tabHash'] : $tabHash;
        $this->assign('tabHash', $tabHash);
    }

    protected function getCall($uid)
    {
        if ($uid == is_login()) {
            return '我';
        } else {
            $apiProfile = callApi('User/getProfile', array($uid));
            return $apiProfile['sex'] == 'm' ? '他' : '她';
        }
    }

    protected function ensureApiSuccess($result)
    {
        if (!$result['success']) {
            $this->error($result['message'], $result['url']);
        }
    }

    protected function requireLogin()
    {
        if (!is_login()) {
            $this->error('必须登录才能操作');
        }
    }
}