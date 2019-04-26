<?php
class CategoryController{

    private $_db;

    public function __construct($db) {
        $this->_db = $db;
    }

    public function run(){
        # Notification that will be displayed in the view
        $notification = '';
        # Question Table that will be browsed in the view
        $tabcategories = '';
        # Search Keyword
        $html_keyword = '';


        # Recherche si un mot clé est entré dans le formulaire form_recherche
        if (!empty($_POST['form_research']) && !empty($_POST['keyword'])) {
            $tabcategories = $this->_db->select_categories($_POST['keyword']);
            $html_keyword = htmlspecialchars($_POST['keyword']); # Protection anti XSS à l'affichage
        } else {
            # Sélection de toutes les categories sous forme de tableau
            $tabcategories = $this->_db->select_categories();
        }

        # A controller ends by writing a view
        require_once(CHEMIN_VUES . 'category.php');
    }

}
?>