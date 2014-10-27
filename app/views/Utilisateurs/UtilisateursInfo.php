<html>
<body>
  <div id="content" class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
    <div class="viewTitle col-md-12">
        <span>Visualisation d'un profil</span>
    </div>
    <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
        <div>
            <p class="frm-inline col-xs-12 col-sm-6 col-md-6 col-lg-6">
                <img style="height:120px;width:120px;display:inline-block;" src="<?php echo asset('img/userProfileAvatar/'.$result->id)?>">
            </p>
            <p class="frm-inline col-xs-12 col-sm-6 col-md-6 col-lg-6 pseudo-as-title" id="nom" name="nom">
                <span ><?php echo $result->pseudo; ?></span>
            </p>
        </div>
        <div>
            <p class="frm-inline col-xs-6 col-sm-6 col-md-6 col-lg-6">
                <span>Nom :</span> 
            </p>
            <p class="frm-inline col-xs-6 col-sm-6 col-md-6 col-lg-6" id="nom" name="nom">
                <span >
                    <?php echo $result->prenom; ?> <?php echo $result->nom; ?>
                </span>
            </p>
        </div>
        <div>
            <p class="frm-inline col-xs-6 col-sm-6 col-md-6 col-lg-6">DDN : </p>
            <p class="frm-inline col-xs-6 col-sm-6 col-md-6 col-lg-6" id="dateN" name="dateN">
            <span>
                <?php if($result->dateNaissance == null){ echo "---";}
                else{ echo $result->dateNaissance; }?></span>
            </p>
        </div>
        <div>
            <p class="frm-inline col-xs-6 col-sm-6 col-md-6 col-lg-6">Courriel : </p>
            <p class="frm-inline col-xs-6 col-sm-6 col-md-6 col-lg-6" id="email" name="email">
                <span class="super-word-break">
                    <?php
                    if($result->email == null){ echo "---";}
                else{ echo $result->email;} ?>
                </span>
            </p>
        </div>
        <div>
            <p class="frm-inline col-xs-6 col-sm-6 col-md-6 col-lg-6">Telephone : </p>
            <p class="frm-inline col-xs-6 col-sm-6 col-md-6 col-lg-6" id="telephone" name="telephone">
            <span>
                <?php if($result->telephone == null){ echo "---";}
                else{echo $result->telephone;} ?>

            </span>
            </p>
        </div>
        <div>
            <p class="frm-inline col-xs-6 col-sm-6 col-md-6 col-lg-6">Cellulaire : </p>
            <p class="frm-inline col-xs-6 col-sm-6 col-md-6 col-lg-6" id="cellulaire" name="cellulaire">
                <span>
                    <?php if($result->cellulaire == null){ echo "---";}else{echo $result->cellulaire; }?>
                </span>
            </p>
        </div>
        <div>
            <p class="frm-inline col-xs-6 col-sm-6 col-md-6 col-lg-6">Adresse  : </p>
            <p class="frm-inline col-xs-6 col-sm-6 col-md-6 col-lg-6" id="adresse" name="adresse">
                <span>
                    <?php if($result->noCivique == null){ echo "---";}else{echo $result->noCivique; }?>
                    , <?php if($result->rue == null){ echo "---";}else{echo $result->rue; }?>
                </span>
            </p>
        </div>
        <div>
            <p class="frm-inline col-xs-6 col-sm-6 col-md-6 col-lg-6">Postal  : </p>
            <p class="frm-inline col-xs-6 col-sm-6 col-md-6 col-lg-6" id="codePostal" name="codePostal">
                <span>
                    <?php if($result->codePostal == null){ echo "---";}else{echo $result->codePostal;} ?>
                </span>
            </p>
        </div>
        <div>
            <p class="frm-inline col-xs-6 col-sm-6 col-md-6 col-lg-6">Ville  : </p>
            <p class="frm-inline col-xs-6 col-sm-6 col-md-6 col-lg-6" id="ville" name="ville">
            <span>
                <?php if($result->ville == null){ echo "---";}else{echo $result->ville; }?>
            </span>
        </p>
    </div>
  </div> 

  <!-- Les contrôles ne seront affichés que si l'utilisateur connecté est un administrateurs -->
  <?php if ($_SESSION['user']->type == 3) { ?>

  <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6" style="text-align:center;">
    <div class="viewTitle col-md-12" style="border:none;">
        <span style="font-size:23px;">Options d'admin</span>
    </div>
        <p>
            <span>
                Le type de compte de cet utilisateur est présentement : 
                <?php 
                switch ($result->type) {
                    case 1:
                        echo "Grimpeur";
                        break;
                    
                    case 2:
                        echo "Traceur";
                        break;

                    case 3:
                        echo "Administrateur";
                        break;

                    default:
                        echo "ERREUR";
                        break;
                }
                ?>
            </span>
            </br>Selectionner un nouveau type de compte pour cet utilisateur:</br>
            
            <?php echo Form::open(array('route' => 'administration.store','files' => true)); ?>
            <input type="hidden" name="idCompteCliquer" value="<?php echo $result->id ?>">
            <input type="hidden" name="pseudoDeAdminFaisantAction" value="<?php echo $_SESSION['user']->pseudo ?>">
            <input type="hidden" name="emailDeAdminFaisantAction" value="<?php echo $_SESSION['user']->email ?>">
            <input type="hidden" name="dateDeAction" value="<?php echo date('Y-m-d') ?>">

            <select name="typeDUtilisateur">
                <option value="1"<?php if($result->type == 1): ?> selected="selected"<?php endif; ?>>Grimpeur</option>
                <option value="2"<?php if($result->type == 2): ?> selected="selected"<?php endif; ?>>Traceur</option>
                <option value="3"<?php if($result->type == 3): ?> selected="selected"<?php endif; ?>>Administrateur</option>
            </select> 

            <div class="frm-submit col-md-12">
                <button id="saveid" name="saveAccountType" type="submit" class="btn btn-primary submit-btn">Changer type de compte</button>
            </div>

            </br>Modifier les informations de cet utilisateur:</br>

            <label for="pseudo">Pseudo : </label>
            <input  type="text" name="pseudo" id="pseudo" value="<?php echo $result->pseudo; ?>"></br>
            <label for="prenom">Prenom : </label>
            <input  type="text" name="prenom" id="prenom"  value="<?php echo $result->prenom; ?>"></br>
            <label for="nom">Nom : </label>
            <input  type="text" name="nom" id="nom" value="<?php echo $result->nom; ?>"></br>
            <label for="email">Courriel : </label>
            <input  type="text" name="email" id="email"  value="<?php echo $result->email; ?>"></br>
            <label for="dateNaissance">Date : </label>
            <input  type="text" name="dateNaissance" id="dateNaissance" placeholder="(2000-12-31)" value="<?php echo $result->dateNaissance; ?>"></br>
            <label for="noCivique">No. Civique : </label>
            <input  type="text" name="noCivique" id="noCivique" value="<?php echo $result->noCivique; ?>"></br>
            <label for="rue">Rue : </label>
            <input  type="text" name="rue" id="rue" value="<?php echo $result->rue; ?>"></br>
            <label for="ville">Ville : </label>
            <input  type="text" name="ville" id="ville" value="<?php echo $result->ville; ?>"></br>
            <label for="codePostal">Code postal : </label>
            <input  type="text" name="codePostal" id="codePostal" value="<?php echo $result->codePostal; ?>"></br>
            <label for="telephone">Téléphone : </label>
            <input  type="text" name="telephone" id="telephone" placeholder="(418-123-4567)" value="<?php echo $result->telephone; ?>"></br>
            <label for="cellulaire">Cellulaire : </label>
            <input  type="text" name="cellulaire" id="cellulaire" placeholder="(418-123-4567)" value="<?php  echo $result->cellulaire; ?>"></br>
            <div class="frm-submit col-md-12">
                <button id="saveAcountInfo" name="saveAcountInfo" type="submit" class="btn btn-primary submit-btn">Changer les informations</button>
            </div>

            <!-- Ne pas permettre la suppression de son propre compte-->
            <?php if ($_SESSION['user']->id != $result->id) { ?>
                <form method="POST" action="administration.destroy">
                    <input type="hidden" name="pseudoDeAdminFaisantAction" value="<?php echo $_SESSION['user']->pseudo ?>">
                    <input type="hidden" name="emailDeAdminFaisantAction" value="<?php echo $_SESSION['user']->email ?>">

                    Raison de la suppression:
                    <textarea name="raisonDeSuppression"  id="raisonDeSuppression" style="text-align:left;padding:2px;" class="form-control frm-inline" cols="50" rows="4"></textarea>
                    <div class="frm-submit col-md-12">
                        <button id="supprime" name="supprimeCompte" type="submit" class="btn btn-primary submit-btn">Supprimer le compte de cet utilisateur</button>
                    </div>
                    
                </form>
                
            <?php } ?>

            <div style="clear:both;"></div>
            <?php if(Session::has('message')){?>
                <div class="col-md-12">
                    <div class="msg-box alert alert-<?php echo Session::get('class') ?>">
                        <span><?php echo Session::get('message') ?></span>
                    </div>
                </div> 
            <?php } ?>

        </p>
      </div>
  <?php } ?>
</div>
</body>