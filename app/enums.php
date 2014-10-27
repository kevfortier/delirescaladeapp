<?php
	abstract class UserType {
	    const Grimpeur = 1;
	    const Traceur = 2;
	    const Admin = 3;
	}
	abstract class EscaladeType {
	    const PremierCordee = 1;
	    const Moulinette = 2;
	    const Bloc = 3;
	}

	abstract class NotificationType {
	    const DemandePartenaire = 1;
	}

	abstract class CommentaireType {
	    const DemandePartenaire = 1;
	}

	abstract class DemandeStatus {
	    const Fresh = 1;
	    const Answered = 2;
	    const Closed = 3;
	}

	abstract class VoieType {
	    const Voie = 1;
	    const Bloc = 2;
	}

	abstract class VoieCouleur {
		const Rose  = 'pink';
	    const Bleu  = 'blue';
	    const Vert  = 'green';
	    const Jaune = 'yellow';
	    const Rouge = 'red';
	    const Noir  = 'black';
	}

	abstract class SecteurType {
		//mettre à jour quand jp nous 
		//donne la liste de secteur
	    const Secteur1 = 1;
	    const Secteur2 = 2;
	}
?>