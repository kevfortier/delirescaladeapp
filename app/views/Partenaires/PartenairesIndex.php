<html>
    <style>
        @media screen and (max-width: 767px){
        #btn-filter{margin-top: 14px;}
      }
    </style>
    <body>
        <div class="viewTitle col-md-12">
            <span>Liste demande partenaire</span>
        </div>
        <?php echo Form::open(array('method'=>'get','action' => 'PartenairesController@index')); ?>
        <div id="filter-input">
            <div class="select-type-escalade col-xs-12 col-sm-12 col-md-3 col-lg-3" >
               <?php $back = isset($_GET['typeEscalade'])?$back=$_GET['typeEscalade']:null;
                 echo Form::select('typeEscalade',array( null=>'Tous les types d\'escalade',EscaladeType::PremierCordee=> 'Premier de cordée',
                 EscaladeType::Moulinette => 'Moulinette',EscaladeType::Bloc => 'Bloc'),
                 $back,array('class'=> 'form-control frm-bloc placeholder-color')); ?></br>   
            </div>
            <div class="select-type-escalade col-xs-12 col-sm-3 col-md-2 col-lg-2" >
               <?php $back = isset($_GET['typeStatus'])?$back=$_GET['typeStatus']:null;
                 echo Form::select('typeStatus',array( null=>'Toutes les status',DemandeStatus::Fresh => 'Sans réponse',
                 DemandeStatus::Answered  => 'Avec réponse'),
                 $back,array('class'=> 'form-control frm-bloc placeholder-color')); ?></br>   
            </div>
            <div class="col-xs-12 col-sm-8 col-md-6 col-lg-6">
                <div class="col-xs-6 col-sm-5 col-md-5 col-lg-5">
                    <div class="input-labels">Date(aaaa-mm-jj): </div>
                </div> 
                <div class="col-xs-6 col-sm-4 col-md-4 col-lg-4"> 
                    <div class="datepicker date input-group"> 
                        <input class="form-control" type="text" name="date" value="<?php if(isset($_GET['date'])){echo $_GET['date'];} ?>"/>
                    </div>
                </div>
                <div class="frm-submit col-xs-12 col-sm-3 col-md-3 col-lg-3" style="margin:0;">
                    <button type="submit" id="btn-filter" class="btn btn-primary">Filtrer les demandes</button>
                </div>
            </div>
        </div>
        <?php echo Form::close(); ?> 
        <div style="clear:both;"></div>
        <div class="user-list">
            <?php 
            foreach ($data as $partenaire)
            { ?>
                <div class="user-list-item col-xs-12 col-sm-6 col-md-4  col-lg-3" >
                    <a href="<?php echo action('PartenairesController@edit',$partenaire->idDemande); ?>"><span class="user-list-item-link"></span></a>
                    <div>
                        <img style="height:60px;width:51.64px;display:inline-block;" src="<?php if($partenaire->hasRecivedAnOffer){echo asset('img/partenaire/climbYellow.png');}else{echo asset('img/partenaire/climbGreen.png');}?>">
                    </div>
                    <div style="margin-left:14px;vertical-align:top;">
                        <?php
                        	echo '<span>'.$partenaire->pseudo.'</span>';
                            echo '<span style="font-weight: bold;">';
                            switch ($partenaire->typeEscalade) {// e est la meme chose que htmlspecialchars
                                case EscaladeType::PremierCordee: echo e('<P. Cordée>');break;
                                case EscaladeType::Moulinette: echo e('<Moulinette>');break;
                                case EscaladeType::Bloc : echo e('<Bloc>');break;
                                default: echo e('<N/A>');break;
                            }
                            echo '</span>';
                            echo '</br>';
                            echo '<span>'.(substr($partenaire->datePrevue, 0,-9)).'</span>'.'<span style="font-weight: bold;">'.(substr($partenaire->datePrevue, 10,-3)).'</span>';
                        ?>
                    </div>
                </div>
            <?php
            } ?>
        </div>
        <?php if(count($data)<1){ ?>
            <div class="viewTitle col-md-12" style="border:none;">
                <span style="font-size:23px;">Aucune demande de partenaire disponible.</span>
            </div>
            <?php } ?>
        <div style="clear:both;"></div>
        <div class="text-right">
            <?php echo $data->links() ?>
        </div>
    </body>
</html>