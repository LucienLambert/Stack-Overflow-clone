<?php  class HomeController {

    private $_db;

	public function __construct($db) {
        $this->_db = $db;

	}
			
	public function run() {
        # Question Table that will be browsed in the view
        $tabquestions = '';
        # Search Keyword
        $html_keyword = '';

        # Recherche si un mot clé est entré dans le formulaire form_research
        if (!empty($_POST['form_research']) && !empty($_POST['keyword'])) {
            $tabquestions = $this->_db->select_questions($_POST['keyword']);
            $html_keyword = htmlspecialchars($_POST['keyword']); # Protection anti XSS à l'affichage
        } else {
            # Sélection de tous les livres sous forme de tableau
            $tabquestions = $this->_db->select_questions();
        }
		
		# Un contrôleur se termine en écrivant une vue
		require_once(CHEMIN_VUES . 'Home.php');
	}
	
}
?>