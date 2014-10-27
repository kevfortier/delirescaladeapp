<html>
    <style>
    </style>
    <body>
        <div class="viewTitle col-md-12">
            <span>Mon horaire</span>
        </div>
        <?php echo Form::open(array('method'=>'get','action' => 'HorairesController@index')); ?>
        <div id="filter-input2">
            <div class="select-type-escalade col-xs-12 col-sm-12 col-md-3 col-lg-3" >
               <?php $back = isset($_GET['typeEscalade2'])?$back=$_GET['typeEscalade2']:null;
                 echo Form::select('typeEscalade2',array( null=>'Tous les types d\'escalade',EscaladeType::PremierCordee=> 'Premier de cordée',
                 EscaladeType::Moulinette => 'Moulinette',EscaladeType::Bloc => 'Bloc'),
                 $back,array('class'=> 'form-control frm-bloc placeholder-color')); ?></br>   
            </div>
            <div class="col-xs-12 col-sm-8 col-md-6 col-lg-6">
                <div class="col-xs-6 col-sm-5 col-md-5 col-lg-5">
                    <div class="input-labels">Date(aaaa-mm-jj): </div>
                </div> 
                <div class="col-xs-6 col-sm-4 col-md-4 col-lg-4"> 
                    <div class="datepicker date input-group"> 
                        <input class="form-control" type="text" name="date2" value="<?php if(isset($_GET['date2'])){echo $_GET['date2'];} ?>"/>
                    </div>
                </div>
                <div class="frm-submit col-xs-12 col-sm-3 col-md-3 col-lg-3" style="margin:0;">
                    <button type="submit" id="btn-filter" class="btn btn-primary">Filtrer l'horaire</button>
                </div>
            </div>
        </div>
        <?php echo Form::close(); ?> 
        <div style="clear:both;"></div>
        <div class="user-list">
            <?php 
            foreach ($result as $partenaire)
            { ?>
                <div class="user-list-item col-xs-12 col-sm-6 col-md-4  col-lg-3" >
                    <a href="<?php echo action('PartenairesController@edit',$partenaire->idDemande); ?>"><span class="user-list-item-link"></span></a>
                    <div>
                        <img style="height:60px;width:51.64px;display:inline-block;" src="<?php echo asset('img/partenaire/climbRaw.png');?>">
                    </div>
                    <div style="margin-left:14px;vertical-align:top;">
                        <?php
                            echo '<span style="font-weight:bold;">'.$partenaire->pseudo.' </span>';
                            echo '<span> se propose </span><span style="font-weight: bold;">';
                            switch (intval($partenaire->typeEscalade)) {// e est la meme chose que htmlspecialchars
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
        <div style="clear:both;"></div>
        <div class="text-right">
            <?php echo $result->links() ?>
        </div>
        <?php if(count($result)<1){ ?>
            <div class="viewTitle col-md-12" style="border:none;">
                <span style="font-size:23px;">Aucune rencontre à l'horaire.</span>
            </div>
        <?php } ?>
    </body>
</html>