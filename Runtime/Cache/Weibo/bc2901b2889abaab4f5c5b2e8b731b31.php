<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<link rel="stylesheet" type="text/css" href="Addons/Checkin/View/Css/check.css">

<div class="box1" id="checkdiv">

    <div class="row">

            <div class="col-md-2" style="float: left">

                    <i class="glyphicon glyphicon-calendar calendar"></i>

            </div>

            <div class="col-md-6 row" style="float: left;margin-left:5px">

                <div class="col-md-6 dateinfo" >

                    <div><?php echo ($check["week"]); ?></div>

                    <div><?php echo ($check["day"]); ?></div>
                </div>


                <div class="col-md-6 checkinfo" >

                    <div> DAYS </div>

                    <div>0 </div>

                </div>
            </div>
                <div class="col-md-4" style="padding-top:17px"  >
                     <div>
                        <?php $url='http://'.$_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF'].'?'.$_SERVER['QUERY_STRING']; ?>
                        <a style="color: white;font-size: 20px" href="<?php echo U('Home/User/login',array('back'=>urlencode($url)));?>" >签到</a>
                     </div>
                </div>

    </div>

</div>