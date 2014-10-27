<html>
<body>
  <div class="viewTitle col-md-12">
    <h2>Inscription</h2>
  </div>
   <?php if(Session::has('message')){?>
    <div class="col-md-12">
      <div class="msg-box alert alert-<?php echo Session::get('class') ?>">
        <span><?php echo Session::get('message') ?></span>
      </div>
    </div> 
  <?php } ?>
  <div class="desc-box col-md-12">
    <span>Seul les champs textes avec une * sont obligatoire pour s'inscrire.</span>
  </div>
  <?php echo Form::open(array('route' => 'utilisateurs.store','files' => true)); ?>
  <div id="left-content" class="col-xs-12 col-sm-12 col-md-6 col-lg-6 lft">
    <div id="labels" class="col-xs-4 col-sm-4 col-md-4 col-lg-4 lft">
      <div class="input-labels"><label for="pseudo">Pseudo : </label></div><br />
      <div class="input-labels"><label for="email">Courriel : </label></div></br>
      <div class="input-labels"><label for="password">Mot de passe : </label></div></br>
      <div class="input-labels"><label for="confirmation">Confirmation mdp : </label></div></br>
      <div class="input-labels"><label for="prenom">Prenom : </label></div></br>
      <div class="input-labels"><label for="nom">Nom : </label></div></br>
      <div class="input-labels"><label for="dateNaissance">Date : </label></div></br>
    </div>
    <div id="textboxs" class="col-xs-8 col-sm-8 col-md-8 col-lg-8 rgt">
      <input class="frm-bloc form-control" type="text" name="pseudo" id="pseudo" value="<?php if(isset($_POST['pseudo'])){echo $_POST['pseudo'];} ?>"></br>
      <input class="frm-bloc form-control" type="text" name="email" id="email" value="<?php if(isset($_POST['email'])){echo $_POST['email'];} ?>"></br>
      <input class="frm-bloc form-control" type="password" name="password" id="password" ></br>
      <input class="frm-bloc form-control" type="password" name="confirmation" id="confirmation" ></br>
      <input class="frm-bloc form-control" type="text" name="prenom" id="prenom" value="<?php if(isset($_POST['prenom'])){echo $_POST['prenom'];} ?>"></br>
      <input class="frm-bloc form-control" type="text" name="nom" id="nom" value="<?php if(isset($_POST['nom'])){echo $_POST['nom'];} ?>"></br>
        <div class="datepicker date input-group frm-bloc"> 
            <input class="frm-bloc form-control" type="text" name="dateNaissance" id="dateNaissance" value="<?php if(isset($_POST['dateNaissance'])){echo $_POST['dateNaissance'];} ?>"></br>
        </div>
    </div>
  </div>
  <div id="right-content" class="col-xs-12 col-sm-12 col-md-6 col-lg-6 rgt">
    <div id="labels" class="col-xs-4 col-sm-4 col-md-4 col-lg-4 lft">
      <div class="input-labels"><label for="noCivique">No. Civique : </label></div></br>
      <div class="input-labels"><label for="rue">Rue : </label></div></br>
      <div class="input-labels"><label for="ville">Ville : </label></div></br>
      <div class="input-labels"><label for="codePostal">Code postal : </label></div></br>
      <div class="input-labels"><label for="telephone">Téléphone : </label></div></br>
      <div class="input-labels"><label for="avatar">Avatar : </label></div></br>
    </div>
    <div id="textboxs" class="col-xs-8 col-sm-8 col-md-8 col-lg-8 rgt">
      <input class="frm-bloc form-control" type="text" name="noCivique" id="noCivique" value="<?php if(isset($_POST['noCivique'])){echo $_POST['noCivique'];} ?>"></br>
      <input class="frm-bloc form-control" type="text" name="rue" id="rue" value="<?php if(isset($_POST['rue'])){echo $_POST['rue'];} ?>"></br>
      <input class="frm-bloc form-control" type="text" name="ville" id="ville" value="<?php if(isset($_POST['ville'])){echo $_POST['ville'];} ?>"></br>
      <input class="frm-bloc form-control" type="text" name="codePostal" id="codePostal" value="<?php if(isset($_POST['codePostal'])){echo $_POST['codePostal'];} ?>"></br>
      <input class="frm-bloc form-control" type="text" name="telephone" id="telephone" value="<?php if(isset($_POST['telephone'])){echo $_POST['telephone'];} ?>"></br>
      <input type="file" class="frm-inline col-sm-9 col-xs-9" name="avatar" id="avatar">
    </div>
  </div>
  <div style="clear:both;"></div>
  <div class="frm-submit col-md-12">
    <button type="submit" class="btn btn-primary submit-btn">S'inscrire</button>
  </div>
</body>
</html>