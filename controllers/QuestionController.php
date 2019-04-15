<?php 
class QuestionController {
	
	private $_db;

	public function __construct($db) {
		$this->_db = $db;
	}
			
	public function run() {
		
		        # Notification that will be displayed in the view
		$notification = '';
		# Question Table that will be browsed in the view
		$tabquestions = '';
		# Search Keyword
		$html_keyword = '';

        $member = unserialize($_SESSION['member']);#to get a representation of the member object as a string of characters.

        # Insertion des données d'un livre en provenance du formulaire form_ajout
		if (!empty($_POST['form_add'])) {
			if (empty($_POST['title']) && empty($_POST['subject'])) {
				$notification = 'Please enter a title and a subject';
			} elseif (empty($_POST['title'])) {
				$notification = 'Please enter a title';
			} elseif (empty($_POST['subject'])) {
				$notification = 'Please enter a subject';
            } elseif (empty($_POST['subject'])) {
                $notification = 'Please enter a subject';
			} else {
                if ($this->_db->insert_question($_POST['title'], $_POST['subject'], $_POST['id_category'], $member->id_member(), 'O')) {
                    $notification = 'Adding well done';
                } else {
                    $notification = 'Error adding';
                }
			}
		}
		
		
		# Recherche si un mot clé est entré dans le formulaire form_recherche
		if (!empty($_POST['form_research']) && !empty($_POST['keyword'])) {
			$tabquestions = $this->_db->select_questions($_POST['keyword']);
			$html_keyword = htmlspecialchars($_POST['keyword']); # Protection anti XSS à l'affichage
		} else {
			# Sélection de tous les livres sous forme de tableau
			$tabquestions = $this->_db->select_questions();
		}
		
		# Ecrire ici la vue
		# $tablivres contient un tableau d'objets de la classe Livre
		# $notification contient un message destiné à l'utilisateur
		require_once(CHEMIN_VUES . 'question.php');
	}
} 
?>