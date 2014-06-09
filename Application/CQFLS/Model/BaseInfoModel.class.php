<?php
// +----------------------------------------------------------------------
// | Footstone [ WE CAN DO MORE ]
// +----------------------------------------------------------------------
// | Copyright (c) 2013 http://  All rights reserved.
// +----------------------------------------------------------------------
// | Author: Newmannhu <Newmannhu@qq.com> <http://>
// +----------------------------------------------------------------------

namespace Admin\Model;
use Think\Model;

/**
 * 公司基本信息
 * @author Newmannhu <Newmannhu@qq.com> <http://>
 */

class BaseInfoModel extends Model {

	protected $_validate = array(
		array('fcode','require','代码必须填写'), //默认情况下用正则进行验证
		array('fname','require','名称必须填写'), //默认情况下用正则进行验证
	);


}