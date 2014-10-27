<html>
    <body>
        <div class="viewTitle col-md-12">
            <span>Profil personnel</span>
        </div>
        <?php if(Session::has('message')){?>
        <div class="col-md-12">
        <div class="msg-box alert alert-<?php echo Session::get('class') ?>">
            <span><?php echo Session::get('message') ?></span>
        </div>
        </div> 
        <?php } ?>
        <?php $user = $result;/*var_dump($user);*/ /*$notifications = $result[1];*/?>
        <div style="clear:both;"></div>
        <div id="content" class="col-xs-12 col-sm-12 col-md-12 col-lg-12">

        <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
        <?php 
            echo Form::model($user,array('method'=>'PUT','files' => true,'route' => array('utilisateurs.update', $_SESSION['user']->id))); 
        ?>
            <div>
                <p class="frm-inline col-xs-12 col-sm-6 col-md-6 col-lg-6">
                    <img style="height:120px;width:120px;display:inline-block;" src="<?php echo asset('img/userProfileAvatar/'.$user->id)?>">
                    
                </p>
                <p class="frm-inline col-xs-12 col-sm-6 col-md-6 col-lg-6 pseudo-as-title" id="nom" name="nom"><?php echo $user->pseudo; ?></p>
            </div>
            <div>
                 <p class="frm-inline col-xs-6 col-sm-6 col-md-6 col-lg-6" >Avatar :</p>
                <p class="frm-inline col-xs-6 col-sm-6 col-md-6 col-lg-6">
                <input type="file" class="frm-inline " name="avatar">
                </p>
            </div>
            <div>
                <p class="frm-inline col-xs-6 col-sm-6 col-md-6 col-lg-6 profile-label-ajust">Prenom :</p>
                <p class="frm-inline col-xs-6 col-sm-6 col-md-6 col-lg-6" id="prenom" name="prénom">
                    <input class="frm-bloc form-control" type="text" name="prenom" value="<?php
                        if($user->prenom != null)
                        { echo $user->prenom;} ?>"></input>
                </p>
            </div>
            <div>
                <p class="frm-inline col-xs-6 col-sm-6 col-md-6 col-lg-6 profile-label-ajust">Nom :</p>
                <p class="frm-inline col-xs-6 col-sm-6 col-md-6 col-lg-6" id="nom" name="nom">
                    <input class="frm-bloc form-control" type="text" name="nom" value="<?php
                        if($user->nom != null)
                        { echo $user->nom;} ?>"></input>
                </p>
            </div>
            <div>
                <p class="frm-inline col-xs-6 col-sm-6 col-md-6 col-lg-6 profile-label-ajust">Date de N. : </p>
                <div class="datepicker date input-group col-xs-6 col-sm-6 col-md-6 col-lg-6 frm-inline"> 
                    <input class="frm-bloc form-control" type="text" name="dateNaissance" value="<?php
                        if($user->dateNaissance != null)
                        { echo $user->dateNaissance;} ?>"></input>
                </div>
            </div>
            <div style="clear:both;"></div>
            <div>
                <p class="frm-inline col-xs-6 col-sm-6 col-md-6 col-lg-6 profile-label-ajust">Courriel : </p>
                <p class="frm-inline col-xs-6 col-sm-6 col-md-6 col-lg-6" id="email" name="email">
                    <input class="frm-bloc form-control" type="text" name="email" value="<?php
                        if($user->email != null)
                        { echo $user->email;} ?>"></input>
                </p>
            </div>
            <div>
                <p class="frm-inline col-xs-6 col-sm-6 col-md-6 col-lg-6 profile-label-ajust">Telephone : </p>
                <p class="frm-inline col-xs-6 col-sm-6 col-md-6 col-lg-6" id="telephone" name="telephone">
                    <input class="frm-bloc form-control" type="text" name="telephone" value="<?php
                        if($user->telephone != null)
                        { echo $user->telephone;} ?>"></input>
                </p>
            </div>
            <div>
                <p class="frm-inline col-xs-6 col-sm-6 col-md-6 col-lg-6 profile-label-ajust">Cellulaire : </p>
                <p class="frm-inline col-xs-6 col-sm-6 col-md-6 col-lg-6" id="cellulaire" name="cellulaire">
                    <input class="frm-bloc form-control" type="text" name="cellulaire" value="<?php
                         if($user->cellulaire != null)
                         { echo $user->cellulaire;} ?>"></input>
                </p>
            </div>
            <div>
                <p class="frm-inline col-xs-6 col-sm-6 col-md-6 col-lg-6 profile-label-ajust">No. Civique  : </p>
                <p class="frm-inline col-xs-6 col-sm-6 col-md-6 col-lg-6" id="noCivique" name="noCivique">
                    <input class="frm-bloc form-control" type="text" name="noCivique" value="<?php
                         if($user->noCivique != null)
                        { echo $user->noCivique;} ?>"></input>
                </p>
            </div>
            <div>
                <p class="frm-inline col-xs-6 col-sm-6 col-md-6 col-lg-6 profile-label-ajust">Rue  : </p>
                <p class="frm-inline col-xs-6 col-sm-6 col-md-6 col-lg-6" id="rue" name="rue">
                    <input class="frm-bloc form-control" type="text" name="rue" value="<?php
                        if($user->rue != null)
                        { echo $user->rue;}?>"></input>
            </div>
            <div>
                <p class="frm-inline col-xs-6 col-sm-6 col-md-6 col-lg-6 profile-label-ajust">Ville  : </p>
                <p class="frm-inline col-xs-6 col-sm-6 col-md-6 col-lg-6" id="ville" name="ville">
                    <input class="frm-bloc form-control" type="text" name="ville" value="<?php
                        if($user->ville != null)
                        { echo $user->ville;} ?>"></input>
                </p>
            </div>
            <div>
                <p class="frm-inline col-xs-6 col-sm-6 col-md-6 col-lg-6 profile-label-ajust">Postal  : </p>
                <p class="frm-inline col-xs-6 col-sm-6 col-md-6 col-lg-6" id="codePostal" name="codePostal">
                    <input class="frm-bloc form-control" type="text" name="codePostal" value="<?php
                        if($user->codePostal != null)
                        { echo $user->codePostal;}?>"></input>
                </p>
            </div>
            <div>
                <p class="frm-inline col-xs-6 col-sm-6 col-md-6 col-lg-6 profile-label-ajust">No. Membre  : </p>
                <p class="frm-inline col-xs-6 col-sm-6 col-md-6 col-lg-6" id="noMembre" name="noMembre">
                    <input class="frm-bloc form-control" type="text" name="noMembre" value="<?php
                        if($user->noMembre != null)
                        { echo $user->noMembre;}?>"></input>
                </p>
            </div>
            <div style="clear:both;"></div>
            <div class="frm-submit col-md-12">
                <button type="submit" class="btn btn-primary submit-btn">Changer</button>
            </div>
      </div>  
      <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
        <?php if($_SESSION['user']->type == UserType::Admin){ ?>
            <div class="viewTitle col-md-12" style="border:none;">
                <span style="font-size:23px;">Outils d'administration</span>
            </div>
            <div style="clear:both;"></div>
            
            <div class="frm-submit col-md-12">
                <a href="<?php echo route('motdepasseoublie.index') ?>">1. Changer le mot de passe d'un utilisateur</a>
            </div>
        <?php } ?>
        <!--<div class="viewTitle col-md-12">
            <span>Liste des notifications</span>
        </div>-->
        <div style="clear:both;"></div>
            <!--<div class="user-list">
                <?php 
                //foreach ($notifications as $notification)
                { 
                    ?>
                    <div class="user-list-item col-xs-12 col-sm-6 col-md-6  col-lg-6" >
                        
                            <img style="height:35px;width:35px;display:inline-block;" 
                            src="<?php 
                                 /*   switch ($notification->isView) {
                                    case 1: echo asset('img/isViewed/read.png');break;
                                    case 0: echo asset('img/isViewed/not_read.png');break;
                                    default: echo e('<N/A>');break; }
                            ?>">
                        
                            <?php
                                echo '<span style="font-weight: bold;">';
                                echo '<span>'.$notification->pseudo.'</span>'; 
                                echo '</span>';                         
                                echo '</br>';
                                echo '<span>'.$notification->message.'</span>';*/
                            ?>
                       
                    </div>
                <?php
                } ?>
            </div>
            <div><a href="<?php //echo route('notifications.index');?>">Liste notifications</a></div>
            <div style="clear:both;"></div>

            <div class="col-xs-12 col-sm-12 col-md-12  col-lg-12 text-right">
                <?php //echo $user->links() ?>
            </div>-->
            </div> 
        </div>  
    </body>
</html>