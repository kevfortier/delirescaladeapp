<html>
    <body>
        <div class="viewTitle col-md-12">
            <span>Liste des notifications</span>
        </div>
        <?php echo Form::open(array('method'=>'get','action' => 'NotificationsController@index')); ?>
        <div class="col-xs-12 col-sm-7 col-md-7 col-lg-7">
            <div class="frm-submit col-xs-12 col-sm-3 col-md-3 col-lg-3" style="margin:0;">
                <button type="submit" name="effacer" value="1" class="btn btn-primary">Effacer notification</button>
            </div>
        </div>
        <div style="clear:both;"></div>
        <div class="user-list">
        	<?php
        	   $user = $result[0][0]; $notifications = $result[1];
            ?>
            <?php
            foreach ($notifications as $notification)
                { 
                ?>
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 force-hover" style="border: solid 1px transparent;">
                <table style="width:100%">
                  <tr>
                    <td style="width:2%;" class="breakHover">
                        <label style="margin:0;">
                          <input style="margin-top:9px;" class="breakHover" value="<?php echo $notification->id; ?>" name="<?php echo $notification->id; ?>" type="checkbox">
                        </label>
                    </td>
                    <td style="width:98%;padding-left:10px;min-height:57px;" class="user-list-item breakHover">
                        <a href = "<?php echo action('NotificationsController@show',$notification->id); ?>"><span class="user-list-item-link"></span></a>
                            <img style="height:35px;width:35px;display:inline-block;vertical-align:top;" 
                            src="<?php 
                                    switch ($notification->isView) {
                                    case 1: echo asset('img/isViewed/read.png');break;
                                    case 0: echo asset('img/isViewed/not_read.png');break;
                                    default: echo e('<N/A>');break; }
                            ?>">
                            <?php
                            echo '<span style="line-height:33px;font-weight:bold;">'.e('< ').substr($notification->updated_at, 0,10).e(' >').'  </span>';
                            echo '<span>'.$notification->message.'</span>';
                        ?>
                    </td> 
                  </tr>
                </table>
                </div>
            <?php
            } ?>
            <?php Form::close(); ?>
        </div>
        <?php if(count($notifications)<1){ ?>
            <div class="viewTitle col-md-12" style="border:none;">
                <span style="font-size:23px;">Aucune notifications.</span>
            </div>
        <?php } ?>
    </body>
</html>