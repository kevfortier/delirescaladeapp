<html>
    <body>
        <?php echo "<h1>Erreur ".Session::get('message')."</h1>" ?>
        <p>Vous n'avez pas accès à la page à laquelle vous essayez d'accéder. </p>
        <?php
        	echo link_to("/home", "Retour à l'accueil.", $attributes = array(), $secure = null);
        ?>
    </body>
</html>