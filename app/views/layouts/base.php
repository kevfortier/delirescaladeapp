<!DOCTYPE html>
<html>
<head>
  <title></title>
  <link rel="stylesheet" type="text/css" href="<?php echo asset('bootstrap-3.2.0-dist/css/bootstrap.min.css') ?>">
  <link rel="stylesheet" type="text/css" href="<?php echo asset('simple-sidebar/css/simple-sidebar.css') ?>">
  <link rel="stylesheet" type="text/css" href="<?php echo asset('css/stylesheet.css') ?>">
  <link href="//netdna.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap-glyphicons.css" rel="stylesheet">
  <link rel="stylesheet" type="text/css" href="<?php echo asset('css/datepicker3.css') ?>">
  <link rel="shortcut icon" href="<?php echo asset('img/favIcon/delireEscalade.ico') ?>">
  <meta name="viewport" content="width=device-width,user-scalable=no"
</head>
<style type="text/css">
/*GREAT SUCCESS!!*/
/*Media query pour changer le break point du hamburger menu*/
/*@media (max-width: 990px) {
    .navbar-header {float: none;}
    .navbar-toggle {display: block;}
    .navbar-collapse { border-top: 1px solid transparent; box-shadow: inset 0 1px 0 rgba(255,255,255,0.1);}
    .navbar-collapse.collapse {display: none!important;}
    .navbar-nav {float: none!important;margin: 7.5px -15px;}
    .navbar-nav>li {float: none;}
    .navbar-nav>li>a { padding-top: 10px; padding-bottom: 10px;}
}*/
@media screen and (min-width: 993px){
    #search-bar{width: 50%;text-align: center;padding-left: 5.2%;}
    #notif-text{display: none}
  }
  @media screen and (min-width: 768px) and (max-width:992px){
    #search-submit{padding: 10px;}
    #search-bar{width: 35%;text-align: center;padding: 0%}
    #search-bar input{padding: 0;}
    #notif-text{display: none}
  }
  @media screen and (max-width: 767px){
    #mail{display: none;}
    #link-notif{height: 40px!important; padding: 10px 15px!important;}
  }
</style>
<body>
<nav class="navbar navbar-default navbar-fixed-top" style="background-color:#070A04" role="navigation">
    <div class="container-fluid">
      <!-- Brand and toggle get grouped for better mobile display -->
      <div class="navbar-header">
        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
          <span class="sr-only">Toggle navigation</span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </button>
        <a style="width:140px;padding:4px;" class="navbar-brand" href="<?php echo route('home.index');?>"><img style="height:100%;width:100%" src="<?php echo asset('img/mincs/logoDelireEscalade.png') ?>"/></a>
      </div>

      <!-- Collect the nav links, forms, and other content for toggling -->
      <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
        <ul class="nav navbar-nav">
          <!--<li><a href="#">Link</a></li>-->
          <!--<li class="active"><a href="#">Link</a></li>-->
          <?php if(isset($_SESSION['user'])){?>
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown">Actions<span class="caret"></span></a>
              <ul class="dropdown-menu" role="menu">
                <li><a href="<?php echo route('utilisateurs.index') ?>">Consulter la liste des grimpeurs</a></li>
                <li class="divider"></li>
                <li><a href="<?php echo route('partenaires.create') ?>">Créer demande partenaire</a></li>
                <li><a href="<?php echo route('partenaires.index') ?>">Répondre à une demande partenaire</a></li>
                <li><a href="<?php echo route('partenaires.show') ?>">Mes demandes partenaires</a></li>
                <li><a href="<?php echo route('horaires.index') ?>">Mon horaire</a></li>
                <li class="divider"></li>
                <?php if($_SESSION['user']->type >1){ ?>
                  <li><a href="<?php echo route('voies.create') ?>">Ajouter une voie</a></li>
                <?php } ?>
                <li><a href="<?php echo route('voies.index') ?>">Consulter la liste des voies</a></li>
                <!--<li><a href="#">Another action</a></li>
                <li><a href="#">Something else here</a></li>
                <li class="divider"></li>
                <li><a href="#">Separated link</a></li>
                <li class="divider"></li>
                <li><a href="#">One more separated link</a></li>-->
              </ul>
            </li>
          <?php }else{
              ?><li style="visibility:hidden;" class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">dummyFill <span class="caret"></span>
                </a></li>
          <?php } ?>
        </ul>
        <form id="search-bar" class="navbar-form navbar-left" role="search">
          <div class="form-group">
            <input type="text" class="form-control" placeholder="Search">
          </div>
          <button type="submit" id="search-submit" class="btn btn-default">Submit</button>
        </form>
        <ul class="nav navbar-nav navbar-right">
          <li>
              <?php if(!isset($_SESSION['user'])){?>
              <a href="<?php echo route('utilisateurs.create');?>">Inscription</a>
              <?php }else{
                ?>
                <a href="<?php echo route('goodbye');?>">Déconnecter</a>
              <?php } ?>
          </li>
          <li>
              <?php if(isset($_SESSION['user'])){?>
                      <a href="<?php echo route('utilisateurs.edit',$_SESSION["user"]->id)?>">Mon Profil</a><?php
                    }
                    else
                    {
                    ?>
                    <a href="<?php echo route('connexion.index');?>">Se connecter</a>
                    <?php
                    }
                    ?>
          </li>
          <?php if(isset($_SESSION['user'])){?>
          <li class="nav-hover-glyph"> <!-- exclamation-sign-->
            <a id="link-notif" style="height: 61px;padding: 23px 0px;padding-right: 10px;" href="<?php echo route('notifications.index');?>"><span id="notif-text">Notifications</span> 
              <i id="mail" class="
                <?php
                 if (Session::get('s_nbNouvelNotif') > 0) {
                      echo "glyphicon glyphicon-exclamation-sign";
                    }
                    else
                    {
                      echo "glyphicon glyphicon-envelope";
                    }?>" style="color:white;height:13px;vertical-align:top;cursor:pointer;"></i></a>
          </li>
          <?php
            }
            ?>
          <!--<li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">Dropdown <span class="caret"></span></a>
            <ul class="dropdown-menu" role="menu">
              <li><a href="#">Action</a></li>
              <li><a href="#">Another action</a></li>
              <li><a href="#">Something else here</a></li>
              <li class="divider"></li>
              <li><a href="#">Separated link</a></li>
            </ul>
          </li>-->
        </ul>
      </div><!-- /.navbar-collapse -->
    </div><!-- /.container-fluid -->
  </nav>
  <div id="wrapper" class="toggled" style="top:60px;display:none;">

        <!-- Sidebar -->
        <div style="clear:both;"></div>
        <div id="sidebar-wrapper" >
            <ul class="sidebar-nav">
                <!--<li class="sidebar-brand">
                    <a href="#">
                        Start Bootstrap
                    </a>
                </li>-->
                <li>
                    <a href="#">Dashboard</a>
                </li>
                <li>
                    <a href="#">Shortcuts</a>
                </li>
                <li>
                    <a href="#">Overview</a>
                </li>
                <li>
                    <a href="#">Events</a>
                </li>
                <li>
                    <a href="#">About</a>
                </li>
                <li>
                    <a href="#">Services</a>
                </li>
                <li>
                    <a href="#">Contact</a>
                </li>
            </ul>
        </div>
        <!-- /#sidebar-wrapper -->

    </div>
    <div id="content" style="margin-top:60px;" class="container-fluid">
      <?php //var_dump(Session::get('s_nbNouvelNotif')); ?>
      <?= $content ?>
    <div class="box">
      </div>
  </div>
  <div id="footer">
    <span></span>
    <div>SmallBox Design ©</div>
  </div>
  <script src="//ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
  <!-- function pour ouvrir le menu glissant de gauche -->
  <script>
    window.onresize = function(){
      var wrapper = $('#wrapper');
      if(innerWidth >767){
        wrapper.removeClass('hideMenu');
      }
      else{
        wrapper.addClass('hideMenu');
      }
    };
    window.addEventListener('mousemove',function(e){
      var wrapper = $('#wrapper');
      if(innerWidth >767){
        wrapper.removeClass('hideMenu');
      }
      else{
        wrapper.addClass('hideMenu');
      }
      if(e.pageX > 250){
        wrapper.addClass('toggled');
      }
      if(e.pageX < 15){
        wrapper.removeClass('toggled');
      }
    });
    </script>
    <script type="text/javascript" src="<?php echo asset('bootstrap-3.2.0-dist/js/bootstrap.min.js') ?>"></script>
    <script type="text/javascript" src="<?php echo asset('js/bootstrap-datepicker.js') ?>"></script>
  <script>
    $(document).ready(function() {
        $(".datepicker input").datepicker({
              todayHighlight:true,
              autoclose:true,
              format:"yyyy-mm-dd",
          });
        $( "#heure1" ).blur(function() {
          var heure = document.getElementById('heure1').value;
          console.log(heure);
          if(heure.length ==4){
            var hours = heure.substring(0,2);
            var minutes = heure.substring(2,4);
            if(parseInt(hours)<9){hours = "10";}
            else if(parseInt(hours)>23){hours = "22";}
            if(parseInt(minutes)>59){minutes = "59";}
            document.getElementById('heure1').value =hours+':'+minutes;
          }
          else if(heure.length ==5){
            var hours = heure.substring(0,2);
            var minutes =heure.substring(3,5);
            if(parseInt(hours)<9){hours = "10";}
            else if(parseInt(hours)>23){hours = "22";}
            if(parseInt(minutes)>59){minutes = "59";}
            document.getElementById('heure1').value = hours+':'+minutes;
          }
          else{
            document.getElementById('heure1').value = "";
          }
        });
    });
</script>
</body>
</html>