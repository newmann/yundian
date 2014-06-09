<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<link rel="stylesheet" type="text/css" href="Addons/Rank_checkin/Css/rank.css">
<div class="box" style="margin-top: 10px">
    <div class="titlerank">签到牛人榜</div>
    <?php if(count($rank) == 0): ?><div class="default">虚位以待，赶紧签到。</div>
        <?php else: ?>
        <?php if(is_array($rank)): $i = 0; $__LIST__ = $rank;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): $mod = ($i % 2 );++$i;?><div class="paiming" style="width: 70px">
                <?php switch($i): case "1": ?>牛A<?php break;?>
                    <?php case "2": ?>牛B<?php break;?>
                    <?php case "3": ?>牛C<?php break;?>
                    <?php case "4": ?>牛D<?php break;?>
                    <?php case "5": ?>牛F<?php break;?>
                    <?php default: ?>
                    第<?php echo ($i); ?>名<?php endswitch;?>
            </div>
            <div class="list">
                 <div> <img src="<?php echo ($v["userInfo"]["avatar32"]); ?>"></div>
                <div class="listitem">
                    <div class="text_more" style="width:80px;"><a  ucard="<?php echo ($v["uid"]); ?>" href="<?php echo ($v["userInfo"]["space_url"]); ?>"> <?php echo ($v["userInfo"]["username"]); ?></a></div>
                     <div>
                        <?php echo(date('H:i:s',$v[ctime])) ?>
                    </div>
                </div>
            </div><?php endforeach; endif; else: echo "" ;endif; endif; ?>
</div>
<div style="height: 10px"></div>