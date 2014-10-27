<html>
	<style>
        @media screen and (min-width: 993px){
            #remember{margin-top:10px;transform: scale(2);margin-left: 15px;}
          }
        @media screen and (min-width: 768px) and (max-width:992px){
           #remember{margin-top:10px;transform: scale(2);margin-left: 15px;}
          }
        @media screen and (max-width: 767px){
        	#remember{margin-top:10px;transform: scale(3);margin-left: 25px;}
        }
    </style>
    <body>
        <div class="viewTitle col-xs-12 col-sm-12 col-md-12 col-lg-12">
            <span>Connexion</span>
        </div>
       
		<?php echo Form::open(array('route' => 'connexion.index','files' => true)); ?>

		<div id="left-content" class="col-sm-offset-1 col-xs-6 col-sm-5 col-md-4 col-lg-4">
        	<div class="input-labels"><label for="courriel">Courriel : </label></div></br>
        	<div class="input-labels"><label for="password">Mot de passe : </label></div></br>
	    </div>
		<div id="right-content" class="col-xs-6 col-sm-5 col-md-5 col-lg-5">
			<input class="frm-bloc form-control" type="text" name="courriel" id="courriel" placeholder="Courriel" value="<?php 
					if (Cookie::get('cookieRemember') != false)
					{
						echo Cookie::get('cookieRemember');
					} 
				?>"></br>
			<input class="frm-bloc form-control" type="password" name="password" id="password" placeholder="Mot de passe"></br>
			<div class="input-labels" >
				<label for="remember">Se souvenir de moi</label> 
				<div style="display:inline-block;padding:2px 0;vertical-align:top;">
					<input style="margin-top:10px;" type="checkbox" name="remember" id="remember" <?php if (Cookie::get('cookieRemember') != false)
					{
						echo 'checked="checked"';
					} ?>>
				</div>
			</div>
		</div>
		<div class="frm-submit col-md-12">
			<a href="<?php echo route('motdepasseoublie.index') ?>">Mot de passe oublié?</a>
		</div>
		
		<div style="clear:both;"></div>
		<div class="frm-submit col-md-12">
			<button type="submit" class="btn btn-primary submit-btn">Connexion</button>
		</div>
		
		<?php if(Session::has('message')){?>
			<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
				<div class="msg-box alert alert-<?php echo Session::get('class') ?>">
					<span><?php echo Session::get('message') ?></span>
				</div>
			</div> 
		<?php } ?>
		
    </body>
</html>