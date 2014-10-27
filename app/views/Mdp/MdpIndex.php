

<html>
    <body>
        <div class="viewTitle col-md-12">
            <span>Changer mot de passe</span>
        </div>
		<?php echo Form::open(array('route' => 'motdepasseoublie.store')); ?>
		<div id="left-content" class="col-xs-4 col-sm-6 col-md-2 col-lg-2 col-xs-offset-0 col-sm-offset-0 col-md-offset-2 col-lg-offset-2">
			<div class="input-labels"><label for="courriel">Courriel : </label></div></br>
			<div class="input-labels"><label for="password1">Mot de passe : </label></div></br>
			<div class="input-labels"><label for="password2">Confirmation mdp : </label></div>
		</div>
		<div id="left-content" class="col-xs-8 col-sm-6 col-md-6 col-lg-5">
			<input class="frm-bloc form-control" type="text" name="courriel" ></br>
			<input class="frm-bloc form-control" type="password" name="password1"></br>
			<input class="frm-bloc form-control" type="password" name="password2"></br>
		</div>
		<div style="clear:both;"></div>
		<div class="frm-submit col-md-12">
			<button type="submit" class="btn btn-primary submit-btn">Changer le mot de passe!</button>
		</div>
		<?php if(Session::has('message')){?>
			<div class="col-md-12">
				<div class="msg-box alert alert-<?php echo Session::get('class') ?>">
					<span><?php echo Session::get('message') ?></span>
				</div>
			</div> 
		<?php } ?>
		
    </body>
</html>