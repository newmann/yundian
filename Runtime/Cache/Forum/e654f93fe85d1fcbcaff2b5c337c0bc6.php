<?php if (!defined('THINK_PATH')) exit(); if(($posts) != ""): ?><div class="hot_post" style="margin-top: 10px">
        <h2>热门讨论</h2>
        <dl>
            <?php if(is_array($posts)): $i = 0; $__LIST__ = $posts;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$post): $mod = ($i % 2 );++$i;?><dt>
                    <span class="hot_num"><?php echo ($i); ?></span>
                    &nbsp;

                    <a href="<?php echo U('Index/detail',array('id'=>$post['id']));?>" title="<?php echo (op_t($post["title"])); ?>">
                        <?php echo (op_t($post["title"])); ?>
                    </a>
                </dt><?php endforeach; endif; else: echo "" ;endif; ?>
        </dl>
    </div><?php endif; ?>