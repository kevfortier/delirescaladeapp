<html>
    <body>
    	<?php 
    		//var_dump($diffs);
    		//var_dump($_POST);
            //var_dump( phpinfo());
    		$listDiffs = array();

    		foreach ($diffs as $diff) {
    			$listDiffs[$diff->idTypeDifficulte] = $diff->nomDifficulte;
    		}
    		var_dump($listDiffs);
    	 ?>
    	 <?php $voie = $voie;
 			var_dump($voie);
    	 ?>

        <div class="viewTitle col-md-12">
            <span>Modifier une voie</span>
        </div>
        <?php //var_dump(); ?>
                 <?php if(Session::has('message')){?>
		    <div class="col-md-12">
		      <div class="msg-box alert alert-<?php echo Session::get('class') ?>">
		        <span><?php echo Session::get('message') ?></span>
		      </div>
		    </div> 
	  	<?php } ?>

	  	<?php echo Form::model($voie,array('method'=>'PUT','files' => true,'route' => array('voies.update', $voie->idVoie))); ?>
	  		<div class="col-xs-10 col-xs-offset-1 col-sm-8 col-sm-offset-2 col-md-8 col-md-offset-2 col-lg-8 col-lg-offset-2">
            	
                <div class="col-xs-5 col-sm-5 col-md-5 col-lg-5">
            		<div class="input-labels"><label for="nom">Nom : </label></div></br>
            		<div class="input-labels"><label for="difficulte">Difficulté : </label></div></br>
            		<div class="input-labels"><label for="mouvements">Mouvements : </label></div></br>
            		<div class="input-labels"><label for="couleur">Couleur des prises : </label></div></br>
            		<div class="input-labels"><label for="dateOuverture">Date d'ouverture : </label></div></br>
            		<div class="input-labels"><label for="secteur">Secteur : </label></div></br>
            		<div class="input-labels"><label for="image">Image : </label></div></br>
            		<div class="input-labels"><label for="video">Video : </label></div></br>
            		<div class="input-labels"><label for="partage">Partager? : </label></div></br>
    	    	</div>
            	<div class="col-xs-7 col-sm-7 col-md-7 col-lg-7">
            		<input class="frm-bloc form-control" type="text" name="nom" value="<?php if($voie->nomVoie != null)
                        { echo $voie->nomVoie;}  ?>"></br>
            		
            		<?php $back = $voie->idDifficulte;
            		 echo Form::select('difficulte',$listDiffs,
            		 $back,array('class'=> 'form-control frm-bloc placeholder-color', 'id'=>'difficulte')); ?></br>

            		<input class="frm-bloc form-control" type="text" name="mouvements" value="<?php if($voie->nbMouvements != null)
                        { echo $voie->nbMouvements;}?>"></br>
            		<input class="frm-bloc form-control" type="text" name="couleur" value="<?php if($voie->couleurPrise != null)
                        { echo $voie->couleurPrise;}?>"></br>
            		<div class="datepicker date input-group frm-bloc"> 
			            <input class="frm-bloc form-control" type="text" name="dateOuverture" value="<?php if($voie->dateOuverture != null)
                        { echo substr($voie->dateOuverture,0,10);}?>"></br>
			        </div></br>

			        <?php $back = $voie->idSecteur;
            		 echo Form::select('secteur',array( SecteurType::Secteur1=> 'Secteur1',
            		 SecteurType::Secteur2 => 'Secteur2'),
            		 $back,array('class'=> 'form-control frm-bloc placeholder-color', 'id'=>'secteur')); ?></br>

               		<input style="margin-bottom:38px" type="file" class="frm-inline col-sm-9 col-xs-9" name="image">
               		<input  style="margin-bottom:38px" type="file" class="frm-inline col-sm-9 col-xs-9" name="video">

               		<div style="clear:both;">
               			<div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
	               			<label for="oui">Oui :  </label>
	               			<input <?php if(isset($_POST['publier'])){ echo 'checked="checked"';} ?> type="radio" name="publier" value="1">
	               		</div>
	               		<div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
	               			<label for="non">Non :  </label>
	               			<input <?php if(isset($_POST['publier'])){if($_POST['publier']==0){echo 'checked="checked"';}}else{echo 'checked="checked"';} ?> type="radio" name="publier" value="0">
	               		</div>
               		</div>
               </div>
               <div style="clear:both;"></div>
			   <div class="frm-submit col-md-12">
			     <button type="submit" class="btn btn-primary submit-btn">Modifier</button>
			   </div>
    	    </div>
    </body>
</html>