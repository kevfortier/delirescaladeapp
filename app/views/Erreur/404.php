<html>
    <body>
        <?php echo "<h1>Erreur ".Session::get('message')."</h1>" ?>
        <p>La page à laquelle vous essayez d'accéder n'existe pas.</p>
        <?php
        	echo link_to("/home", "Retour à l'accueil.", $attributes = array(), $secure = null);
        ?>
    </body>
</html>