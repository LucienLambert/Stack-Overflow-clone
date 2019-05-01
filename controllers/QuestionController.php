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
		$tabquestions = array();
        $selected_question = null;
		# Search Keyword
		$html_keyword = '';
        $vueanswers = true;

		# Recherche si un mot clé est entré dans le formulaire form_recherche
		if (!empty($_POST['form_research']) && !empty($_POST['keyword'])) {
			$tabquestions = $this->_db->select_questions($_POST['keyword']);
			$html_keyword = htmlspecialchars($_POST['keyword']); # Protection anti XSS à l'affichage
		} else {
			# Sélection de tous les livres sous forme de tableau
			$tabquestions = $this->_db->select_questions();
		}

        if (!empty($_POST['form_see_answers'])) {
            $selected_question = $this->_db->select_question($_POST['idquestion']);
            $tabanswers = $this->_db->select_answers($_POST['idquestion']);
            $vueanswers = true;
        }

		# Ecrire ici la vue
		# $tablivres contient un tableau d'objets de la classe Livre
		# $notification contient un message destiné à l'utilisateur
		require_once(CHEMIN_VUES . 'question.php');

        if ($vueanswers) {
            require_once(CHEMIN_VUES . 'answer.php');
        }
	}
} 
?>