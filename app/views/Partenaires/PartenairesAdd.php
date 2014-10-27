<html>
    <body>
        <div class="viewTitle col-md-12">
            <span>Faire une demande de partenaire</span>
        </div>
        <?php if(Session::has('message')){?>
    	    <div class="col-md-12">
    	      <div class="msg-box alert alert-<?php echo Session::get('class') ?>">
    	        <span><?php echo Session::get('message') ?></span>
    	      </div>
    	    </div> 
	  	<?php } ?>
        <?php echo Form::open(array('route' => 'partenaires.store')); ?>

            <div class="col-xs-10 col-xs-offset-1 col-sm-8 col-sm-offset-2 col-md-8 col-md-offset-2 col-lg-8 col-lg-offset-2">
            	
                <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
            		<div class="input-labels"><label for="typeEscalade">Type : </label></div></br>
            		<div class="input-labels"><label for="date">Date : </label></div></br>
            		<div class="input-labels"><label for="heure">Heure : </label></div></br>
                    <div class="input-labels"><label for="commentaire">Commentaire : </label></div></br>
    	    	</div>

            	<div class="col-xs-8 col-sm-8 col-md-8 col-lg-8">
            		
            		<?php $back = isset($_POST['typeEscalade'])?$back=$_POST['typeEscalade']:null;
            		 echo Form::select('typeEscalade',array( EscaladeType::PremierCordee=> 'Premier de cordée',
            		 EscaladeType::Moulinette => 'Moulinette',EscaladeType::Bloc => 'Bloc'),
            		 $back,array('class'=> 'form-control frm-bloc placeholder-color', 'id'=>'typeEscalade')); ?></br>
                    <div class="datepicker date input-group" style="width:100%;padding:0;"> 
                        <input style="text-align:center;" class="form-control" type="text" name="date" placeholder="ex: aaaa-mm-jj" value="<?php if(isset($_POST['date'])){echo $_POST['date'];} ?>"/>
                    </div>
                    </br>
    	    		<input class="frm-inline form-control" type="text" name="heures" id="heure1" placeholder="ex: 14:30" value="<?php if(isset($_POST['heures'])){echo $_POST['heures'];} ?>"></br>
    	    	    <textarea name="commentaire"  id="commentaire" style="text-align:left;padding:2px;margin-top:10px;" class="form-control frm-inline" rows="3"><?php if(isset($_POST['commentaire'])){echo $_POST['commentaire'];} ?></textarea>
                </div>

    	    </div>

    	    <div style="clear:both;"></div>

    		<div class="frm-submit col-xs-12 col-sm-12 col-md-12 col-lg-12">
    		  <button type="submit" class="btn btn-primary submit-btn">Envoyer</button>
    		</div>
        <?php echo Form::close() ?>
    </body>
</html>