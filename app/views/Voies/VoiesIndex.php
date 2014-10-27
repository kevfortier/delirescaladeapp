<html>
    <style>
        @media screen and (min-width: 993px){
          }
        @media screen and (min-width: 768px) and (max-width:992px){
          }
        @media screen and (max-width: 767px){
            #filter-submit{margin-top: 18px!important;}
        }
    </style>
    <body>
        <div class="viewTitle col-md-12">
            <span>Liste des Voies</span>
        </div>
         <?php //var_dump($voies); ?>
         <?php echo Form::open(array('method'=>'get','action' => 'VoiesController@index')); ?>
        <div id="filter-input">
            <div class="select-type-escalade col-xs-12 col-sm-6 col-md-3 col-lg-3" >
               <?php $back = isset($_GET['typeVoie'])?$back=$_GET['typeVoie']:null;
                 echo Form::select('typeVoie',array( null=>'Tous les types de voies',
                 VoieType::Voie=> 'Voie',
                 VoieType::Bloc => 'Bloc'),
                 $back,array('class'=> 'form-control frm-bloc placeholder-color')); ?></br>   
            </div>
            <div class="select-type-escalade col-xs-12 col-sm-6 col-md-3 col-lg-3" >
               <?php $back = isset($_GET['couleurVoie'])?$back=$_GET['couleurVoie']:null;
                 echo Form::select('couleurVoie',array( null=>'Tous les couleurs de voies',
                 VoieCouleur::Rose=> 'Rose',
                 VoieCouleur::Bleu=> 'Bleu',
                 VoieCouleur::Vert=> 'Vert',
                 VoieCouleur::Jaune=> 'Jaune',
                 VoieCouleur::Rouge=> 'Rouge',
                 VoieCouleur::Noir=> 'Noir'),
                 $back,array('class'=> 'form-control frm-bloc placeholder-color')); ?></br>   
            </div>
            <div class="col-xs-12 col-sm-6 col-md-3 col-lg-3">
                <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
                    <div class="input-labels">Nom: </div>
                </div> 
                <div class="col-xs-8 col-sm-8 col-md-8 col-lg-8"> 
                    <div class="input-group"> 
                        <input class="form-control" type="text" name="nomVoie" value="<?php if(isset($_GET['nomVoie'])){echo $_GET['nomVoie'];} ?>"/>
                    </div>
                </div>
            </div>
            <div class="col-xs-12 col-sm-6 col-md-3 col-lg-3">
                <div id="filter-submit" class="frm-submit col-xs-12 col-sm-12 col-md-12 col-lg-12" style="margin:0;">
                    <button type="submit" class="btn btn-primary">Filtrer les voies</button>
                </div>
            </div>
        </div>
        <?php echo Form::close(); ?>
        <div style="clear:both;"></div>
         <div class="user-list">
            <?php 
            if(count($voies)<1){ ?>
                <div class="viewTitle col-md-12" style="border:none;">
                    <span style="font-size:23px;">Aucune voies.</span>
                </div>
            <?php
            }
            foreach ($voies as $voie)
            { ?>
                <div class="user-list-item col-xs-12 col-sm-6 col-md-4  col-lg-3" >
                    <a href="<?php echo action('VoiesController@show',$voie->idVoie); ?>"><span class="user-list-item-link"></span></a>
                    <div>
                        <img style="height:60px;width:60px;display:inline-block;" src="<?php echo asset('img/voie/image/'.$voie->idVoie)?>">
                    </div>
                    <div style="margin-left:14px;vertical-align:top;">
                        <?php
                        	echo '<span>'.$voie->nomVoie.'</span>';
                            echo '<span style="font-weight: bold;">';
                            switch ($voie->typeVoie) {// e est la meme chose que htmlspecialchars
                                case VoieType::Voie: echo e('<Voie>');break;
                                case VoieType::Bloc: echo e('<Bloc>');break;
                                default: echo e('<N/A>');break;
                            }
                            echo '</span>';
                            echo '</br>';
                            echo '<span style="padding:2px;border: solid 2px '.$voie->couleurDifficulte.';">'.$voie->nomDifficulte.'</span>';
                            //echo '<span style="font-weight: bold;>'.$voie->secteur.'</span>'.'</br>';
                        ?>
                    </div>
                </div>
            <?php
            } ?>
        </div>
        <div style="clear:both;"></div>
        <div class="text-right">
            <?php echo $voies->links() ?>
        </div>
    </body>
</html>