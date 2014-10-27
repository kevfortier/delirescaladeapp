<html>
    <style>
        @media screen and (min-width: 993px){
            .dataBlock{width:23%;margin: 0!important;text-align: center;}
          }
        @media screen and (min-width: 768px) and (max-width:992px){
            .creatorImg{display: none!important;}
            .dataBlock{width:49%;margin: 0!important;text-align: center;}
          }
        @media screen and (max-width: 767px){
            .comment-img{display: none!important;}
            .creatorImg{display: none!important;}
            .dataBlock{width:100%;margin: 0!important;margin-bottom:7px!important;text-align: center;}
        }
    </style>
    <body>
        <?php //var_dump($demande);?>
        <?php if($_SESSION['user']->id != $demande->idMembre){ ?>
            <div class="viewTitle col-md-12">
                <span>Répondre à la demande</span>
            </div>
        <?php }
        else{ ?>
            <div class="viewTitle col-md-12">
                <span>Accepter la demande</span>
            </div>
        <?php }?>
        <?php if($demande->isDeleted == 0){ ?>
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                 <div class="commentaire-list-item">
                    <div>
                        <img class="creatorImg" style="height:60px;width:60px;display:inline-block;" src="<?php echo asset('img/userProfileAvatar/'.$demande->idMembre)?>">
                    </div>
                    <div class="dataBlock" style="min-height:60px;vertical-align: top;margin-left:14px;line-height:28px;">
                        <?php 
                            echo '<span>'.$demande->pseudo.'</span>';
                            echo '<span style="font-weight: bold;">';
                            switch ($demande->type) {// e est la meme chose que htmlspecialchars
                                case UserType::Grimpeur: echo e(' <Grimpeur>');break;
                                case UserType::Traceur: echo e(' <Traceur>');break;
                                case UserType::Admin : echo e(' <Admin>');break;
                                default: echo e('<N/A>');break;
                            }
                            echo '</span></br>';
                            echo '<span>'.$demande->prenom.' </span>'; 
                            echo '<span>'.$demande->nom.'</span>';   
                        ?>
                    </div>
                    <div class="dataBlock" style="min-height:60px;vertical-align: top;margin-left:16px;text-align:center;line-height:28px;">
                        <?php 
                            echo '<span>Type d\'escalade : </span></br>';
                            echo '<span style="font-weight:bold;">';
                            switch($demandeType){
                                case EscaladeType::PremierCordee:echo e(' < PremierCordee >');break;
                                case EscaladeType::Moulinette:echo e(' < Moulinette >');break;
                                case EscaladeType::Bloc:echo e(' < Bloc >');break;
                                default:echo e(' < N/A >');break;
                            }
                            echo '</span>'
                        ?>
                    </div>
                    <div class="dataBlock" style="min-height:60px;vertical-align: top;margin-left:16px;text-align:center;line-height:28px;">
                        <?php 
                            echo '<span>Demande prévue pour : </span></br>';
                            echo '<span>'.substr($demande->datePrevue, 0,10).'</span>';
                        ?>
                    </div>
                    <div class="dataBlock" style="min-height:60px;vertical-align: top;margin-left:16px;text-align:center;line-height:28px;">
                        <?php 
                            echo '<span>Heure prévue : </span></br>';
                            echo '<span>'.substr($demande->datePrevue, 11,5).'</span>';
                        ?>
                    </div>
                </div>
            </div>
            <div class="commentaire-list col-xs-12 col-sm-6 col-md-6 col-lg-6">
                <div class="viewTitle col-md-12" style="border:none;">
                    <span style="font-size:23px;">Commentaires</span>
                </div>
                <div style="clear:both;"></div>
                <?php foreach ($commentaires as $commentaire) { ?>
                    <div class="commentaire-list-item">
                        <div class="comment-img">
                            <img style="height:60px;width:60px;display:inline-block;" src="<?php echo asset('img/userProfileAvatar/'.$commentaire->idMembre)?>">
                        </div>
                        <div style="min-height: 60px;vertical-align: top;width:79%;">
                        <div style="margin-left:14px;vertical-align:top;width:100%">
                            <?php
                            echo '<span>'.$commentaire->pseudo.' </span>';
                            echo '<span style="font-weight: bold;">';
                            switch ($commentaire->type) {// e est la meme chose que htmlspecialchars
                                case UserType::Grimpeur: echo e('<Grimpeur>');break;
                                case UserType::Traceur: echo e('<Traceur>');break;
                                case UserType::Admin : echo e('<Admin>');break;
                                default: echo e('<N/A>');break;
                            }
                            echo '</span>';
                            echo ' '.substr($commentaire->created_at, 0,-3);
                            echo '</div>';
                            echo '<div style="margin-left:14px;vertical-align:top;">';
                            echo $commentaire->commentaire; 
                            echo '</div>'?>
                        </div>
                    </div>
               <?php } ?>
                <div class="text-right">
                    <?php echo $commentaires->links() ?>
                </div>
                <?php 
                echo Form::model($demande,array('method'=>'PUT','route' => array('partenaires.update', $demande->idDemande))); 
                ?>
            </div>
            <div class="commentaire-list col-xs-12 col-sm-6 col-md-6 col-lg-6" style="margin-top:20px;">
                <div class="viewTitle col-md-12" style="border:none;">
                <span style="font-size:23px;">Propositions</span>
            </div>
            <div style="clear:both;"></div>
                <?php foreach ($usersCommentaire as $user) {?>
                    <div class="commentaire-list-item" <?php if($user->isAccepted>0){ echo 'style="background-color:#40ED4E;border: solid 1px black;"';}?>>
                        <div style="<?php if(($demande->hasAcceptedAnOffer>0||($_SESSION['user']->id != $demande->idMembre))){echo 'display:none;';} ?>padding:18px;border-right:solid 1px <?php if($user->isAccepted>0){ echo 'black';}else{echo '#D8D8D8';}?>">
                            <?php echo Form::radio('selectedUser', $user->id,
                            $usersCommentaire[0]->id == $user->id?true:false); ?>
                        </div>
                        <div class="comment-img" style="margin-left:10px;">
                            <img style="height:60px;width:60px;display:inline-block;" src="<?php echo asset('img/userProfileAvatar/'.$user->id)?>">
                        </div>
                        <div style="min-height: 60px;vertical-align: top;width:56%;margin-left:10px;">
                            <div style="width:100%;">

                                <?php 
                                    $result = User::getUserById($user->id);
                                ?>
                                    <a href="<?php echo action('UtilisateursController@show',array($result->id)) ?>"><?php echo $user->pseudo.' '; ?></a>
                                <?php

                                ?>
                                
                                <?php 
                                echo '<span style="font-weight: bold;">';

                                switch ($user->type) {// e est la meme chose que htmlspecialchars
                                    case UserType::Grimpeur: echo e('<Grimpeur>');break;
                                    case UserType::Traceur: echo e('<Traceur>');break;
                                    case UserType::Admin : echo e('<Admin>');break;
                                    default: echo e('<N/A>');break;
                                }
                                echo '</span>';
                                 ?>
                            </div>
                            <div>
                                <?php echo $user->prenom.' '.$user->nom; ?>
                            </div>
                        </div>
                    </div>
                <?php } ?>
            </div>
            <div class="text-right">
                <?php echo $usersCommentaire->links() ?>
            </div>
            <?php if($demande->hasAcceptedAnOffer<1){ ?>
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12" style="padding:0;">
                    <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
                        <div class="col-xs-7 col-sm-7 col-md-7 col-lg-7" style="padding:0;">
                            <textarea name="commentaire" style="text-align:left;padding:2px;" class="form-control frm-inline" rows="3"></textarea>
                        </div>
                        <?php if($_SESSION['user']->id != $demande->idMembre){ ?>
                            <div class="col-xs-5 col-sm-5 col-md-5 col-lg-5" style="padding:0;">
                                <label style="width: 100%;text-align: center;"><?php if($hasAlreadyProposed>0){echo "Demande fait";}else{ echo "Se proposer";} ?></label>
                                <input style="height:33px;" class="form-control" <?php if($hasAlreadyProposed>0){ echo 'disabled="true"';} ?> type="checkbox" name="propose" value="true">
                            </div>
                        <?php }
                        else{?>
                            <div class="col-xs-5 col-sm-5 col-md-5 col-lg-5" style="padding:0;">
                                <label style="width: 100%;text-align: center;">Accepter offre</label>
                                <input style="height:33px;" class="form-control" type="checkbox" name="acceptOffer" <?php if(count($usersCommentaire)<1){echo 'disabled="true"';}?> value="true">
                            </div>
                         <?php } ?>
                        <div style="clear:both;"></div>
                        <div class="frm-submit col-md-12" style="padding:0;">
                            <button type="submit" class="btn btn-primary submit-btn"><?php if($_SESSION['user']->id != $demande->idMembre){ ?>Envoyer<?php }else{?>Envoyer<?php } ?></button>
                        </div>
                    </div>
                </div>
            <?php } ?>
            <?php if($demande->hasAcceptedAnOffer>0 && $_SESSION['user']->id == $demande->idMembre){ ?>
                <div style="clear:both;"></div>
                <div class="frm-submit col-xs-12 col-sm-6 col-md-6 col-lg-6" style="padding:0;">
                    <button type="submit" value="true" name="effacer" class="btn btn-danger submit-btn">Effacer</button>
                </div>
           <?php }
           Form::close();?>
       <?php }
       else{ ?>
            <div class="viewTitle col-md-12" style="border:none;">
                <span style="font-size:23px;">Demande effacé.</span>
            </div>
        <?php } ?>
    </body>
</html>