<html>
    <body>
    	<?php var_dump($voie); ?>
        <div class="viewTitle col-md-12">
            <span>Consulter une voie</span>
        </div>
        <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
        	<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
	            <p class="frm-inline col-xs-12 col-sm-6 col-md-6 col-lg-6">
	                <img style="height:120px;width:120px;display:inline-block;" src="<?php echo asset('img/voie/image/'.$voie->idVoie)?>">
	            </p>
	            <p class="frm-inline col-xs-12 col-sm-6 col-md-6 col-lg-6 pseudo-as-title" style="margin:26px 0px;" id="nom" name="nom">
	                <span ><?php echo $voie->nomVoie; ?></span></br>
	                <?php echo '<span style="padding:2px 10px;border: solid 3px '.$voie->couleurDifficulte.';">'.$voie->nomDifficulte.'</span>'; ?>
	            </p>
	        </div>
	        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
	            <p class="frm-inline col-xs-6 col-sm-6 col-md-6 col-lg-6">
	                <span>Type de voie :</span> 
	            </p>
	            <p class="frm-inline col-xs-6 col-sm-6 col-md-6 col-lg-6" id="nom" name="nom">
	                <span >
	                    <?php
	                    	echo '<span">';
                            switch ($voie->typeVoie) {
                                case VoieType::Voie: echo e('Voie');break;
                                case VoieType::Bloc: echo e('Bloc');break;
                                default: echo e('<N/A>');break;
                            }
	                     ?>
	                </span>
	            </p>
	        </div>
	        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
	            <p class="frm-inline col-xs-6 col-sm-6 col-md-6 col-lg-6">
	                <span>Secteur :</span> 
	            </p>
	            <p class="frm-inline col-xs-6 col-sm-6 col-md-6 col-lg-6" id="nom" name="nom">
	                <span >
	                    <?php
	                    	echo '<span>';
                            switch ($voie->idSecteur) {
                                case SecteurType::Secteur1: echo e('Secteur1');break;
                                case SecteurType::Secteur2: echo e('Secteur2');break;
                                default: echo e('<N/A>');break;
                            }
	                     ?>
	                </span>
	            </p>
	        </div>
	        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
	            <p class="frm-inline col-xs-6 col-sm-6 col-md-6 col-lg-6">
	                <span>Couleur des prises :</span> 
	            </p>
	            <p class="frm-inline col-xs-6 col-sm-6 col-md-6 col-lg-6" id="nom" name="nom">
	                <span >
	                    <?php echo $voie->couleurPrise; ?>
	                </span>
	            </p>
	        </div>
	        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
	            <p class="frm-inline col-xs-6 col-sm-6 col-md-6 col-lg-6">
	                <span>Pseudo traceur :</span> 
	            </p>
	            <p class="frm-inline col-xs-6 col-sm-6 col-md-6 col-lg-6" id="nom" name="nom">
	                <span >
	                    <?php echo $voie->pseudo; ?>
	                </span>
	            </p>
	        </div>
	        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
	            <p class="frm-inline col-xs-6 col-sm-6 col-md-6 col-lg-6">
	                <span>Prénom traceur :</span> 
	            </p>
	            <p class="frm-inline col-xs-6 col-sm-6 col-md-6 col-lg-6" id="nom" name="nom">
	                <span >
	                    <?php echo $voie->prenom; ?>
	                </span>
	            </p>
	        </div>
	        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
	            <p class="frm-inline col-xs-6 col-sm-6 col-md-6 col-lg-6">
	                <span>Nom traceur :</span> 
	            </p>
	            <p class="frm-inline col-xs-6 col-sm-6 col-md-6 col-lg-6" id="nom" name="nom">
	                <span >
	                    <?php echo $voie->nomUser; ?>
	                </span>
	            </p>
	        </div>
	        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
	            <p class="frm-inline col-xs-6 col-sm-6 col-md-6 col-lg-6">
	                <span>Inauguration :</span> 
	            </p>
	            <p class="frm-inline col-xs-6 col-sm-6 col-md-6 col-lg-6" id="nom" name="nom">
	                <span >
	                    <?php echo substr($voie->dateOuverture, 0,10); ?>
	                </span>
	            </p>
	            <?php clearstatcache(); ?>
	            <?php echo asset('img/voie/image/default.png'); ?>
	            <?php
	            	if(file_exists('delireEscalade.ico')){
	            		echo "exist";
	            	}
	            	else{
	            		echo "dont exist";
	            	}
	            ?>
	        </div>
	        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
	            <video width="90%" margin="0 5%" controls>
				 	<source src="<?php echo asset('img/voie/video/'.$voie->idVoie); ?>" type="video/mp4">
			  		<source src="<?php echo asset('img/voie/video/'.$voie->idVoie); ?>" type="video/ogg">
	  		    	<source src="<?php echo asset('img/voie/video/'.$voie->idVoie); ?>" type="video/webm">
				</video>
	        </div>
        </div>
        <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">

        </div>
    </body>
</html>