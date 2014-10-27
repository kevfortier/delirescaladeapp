<html>
    <body>
        <div class="viewTitle col-md-12">
            <span>Liste des grimpeurs</span>
        </div>
        <?php echo Form::open(array('method'=>'get','action' => 'UtilisateursController@index')); ?>
        <div id="filter-input">
            <div class="select-type-escalade col-xs-12 col-sm-5 col-md-5 col-lg-5" >
               <?php $back = isset($_GET['typeGrimpeur'])?$back=$_GET['typeGrimpeur']:null;
                 echo Form::select('typeGrimpeur',array( null=>'Tous les types Grimpeurs',
                    UserType::Grimpeur=> 'Grimpeurs',
                 UserType::Traceur => 'Traceurs',
                 UserType::Admin => 'Administrateurs'),
                 $back,array('class'=> 'form-control frm-bloc placeholder-color')); ?></br>   
            </div>
            <div class="col-xs-12 col-sm-7 col-md-7 col-lg-7">
                <div class="frm-submit col-xs-12 col-sm-3 col-md-3 col-lg-3" style="margin:0;">
                    <button type="submit" class="btn btn-primary">Filtrer les grimpeurs</button>
                </div>
            </div>
        </div>
        <?php echo Form::close(); ?>
        <div style="clear:both;"></div>
        <div class="user-list">
            <?php 
            if(count($data)<1){ ?>
                <div class="viewTitle col-md-12" style="border:none;">
                    <span style="font-size:23px;">Aucun utilisateurs.</span>
                </div>
            <?php
            }
            foreach ($data as $user)
            { ?>
                <div class="user-list-item col-xs-12 col-sm-6 col-md-4  col-lg-3" >
                    <a href="<?php echo action('UtilisateursController@show',$user->id); ?>"><span class="user-list-item-link"></span></a>
                    <div>
                        <img style="height:60px;width:60px;display:inline-block;" src="<?php echo asset('img/userProfileAvatar/'.$user->id)?>">
                    </div>
                    <div style="margin-left:14px;vertical-align:top;">
                        <?php
                        	echo '<span>'.$user->pseudo.'</span>';
                            echo '<span style="font-weight: bold;">';
                            switch ($user->type) {// e est la meme chose que htmlspecialchars
                                case 1: echo e('<Grimpeur>');break;
                                case 2: echo e('<Traceur>');break;
                                case 3 : echo e('<Admin>');break;
                                default: echo e('<N/A>');break;
                            }
                            echo '</span>';
                            echo '</br>';
                            echo '<span>'.($user->prenom==''?'- ':$user->prenom).'</span>';
                            echo '<span>'.($user->nom==''?'-':$user->nom).'</span>'.'</br>';
                        ?>
                    </div>
                </div>
            <?php
            } ?>
        </div>
        <div style="clear:both;"></div>
        <div class="text-right">
            <?php echo $data->links() ?>
        </div>
    </body>
</html>