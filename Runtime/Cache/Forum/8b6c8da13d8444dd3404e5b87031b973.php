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

                <div><?php echo ($connum); ?> </div>

            </div>
        </div>


                    <div style="padding-top:21px">

                         <?php if($check['ischeck']==1){ ?>

                            <span id="checkin" class="btn-sign-h" style="font-size: 20px;padding-top: 10px">已签到</span>

                         <?php }else{ ?>

                            <a href="javascript:void(0)" id="checkin" onclick="checkin()" class="btn-sign">签到</a>

                         <?php } ?>

                            <div class="sign-wrap" style="display:none" id="checkdetail">

                                    <i class="arrow-y"></i>

                                <div class="sign-box" style="text-align: center">

                                        <h3 id="checkinfo" style="font-size: 20px"><?php if($check['ischeck']){ ?>签到成功<?php }else{ ?>未签到<?php } ?></h3>

                                        <div><p>已连续签到<font id="con_num"><?php echo ($connum); ?></font>天，累计签到<font id="total_num"><?php echo ($totalnum); ?></font>天</p></div>

                                 </div>
                            </div>

                    </div>

    </div>
</div>




<script>
    var isshow = 1;
    $(function (){
        <?php if($check['ischeck']){ ?>
        $('#checkdetail').hover(function (){
            isshow = 2;
        },function (){
            setTimeout(function (){
                if(isshow==1){
                    $('#checkdetail').hide();
                }
                isshow = 1;
            },100);
        });
            $('#checkin').hover(function (){
                $('#checkdetail').show();
            },function (){
                setTimeout(function (){
                    if(isshow==1){
                        $('#checkdetail').hide();
                    }
                    isshow = 1;
                },100);
            });
        <?php } ?>
    });

    function checkin(){


        $('#checkin').text('已签到');
        $('#checkin').attr('onclick' , '');
        $('#checkin').attr('class' , 'btn-sign-h');
       /* $('#checkdiv').attr('class' , 'sign-in-h' );*/
        $('#checkinfo').text('签到成功');
        //var totalnum = $check['total_num'] + 1;

   //http://localhost/betav01/index.php?s=/Home/Addons/execute/_addons/Checkin/_controller/Checkin/_action/check_in.html
//alert("<?php echo addons_url("Checkin://Checkin/check_in");?>");


        $.post("<?php echo addons_url("Checkin://Checkin/check_in");?>" , {} , function (res){

            if ( res ){
                var connum = res;
                $('#con_num').text(connum);
                $('#con_num_day').text(connum);
                //$('#total_num').text(totalnum);
                $('#checkdetail').hover(function (){
                    isshow = 2;
                },function (){
                    setTimeout(function (){
                        if(isshow==1){
                            $('#checkdetail').hide();
                        }
                        isshow = 1;
                    },100);
                });
                $('#checkin').hover(function (){
                    $('#checkdetail').show();
                },function (){
                    setTimeout(function (){
                        if(isshow==1){
                            $('#checkdetail').hide();
                        }
                        isshow = 1;
                    },100);
                });
            }
        location.reload();
        });

    }
</script>