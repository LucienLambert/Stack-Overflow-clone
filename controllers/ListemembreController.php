<?php class ListemembreController{

    private $_db;

    public function __construct($db){
        $this->_db = $db;
    }

    public function run(){

        if (empty($_SESSION['authentifie'])) {
        header("Location: index.php?action=login"); # redirection HTTP vers l'action login
        die();
    }

        # Sélection de toutes les membres à afficher
        $tabmember = $this->_db->select_listemember();

        require_once(CHEMIN_VUES . 'listeMember.php');

    }
}