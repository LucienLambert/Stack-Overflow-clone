<?php class AdminController{

    private $_db;

    public function __construct($db){
        $this->_db = $db;
    }

    public function run(){
        $admin = 'admin';
        $user = 'member';
        $suspended = 'suppended';
        $active = 'active';

        # Sélection de toutes les membres à afficher
        $tabmember = $this->_db->select_listemember();


        $notification = '';
        $html_pseudo = htmlspecialchars($_SESSION['login']);

        $vueupdate = false; # La vue partielle de mise à jour n'est pas à afficher;
        $member = null;

        # il doit être log pour pouvoir y avoir acces.
        if (empty($_SESSION['authentifie'])) {
            header("Location: index.php?action=login"); # redirection HTTP vers l'action login
            die();
        }

        # member to update.
        if (!empty($_POST['form_update'])) {
            if (!empty($_POST['member'])){
                $member = $this->_db->select_member($_POST['member']);
                $vueupdate = true; # La vue partielle de mise à jour est à afficher;
            } else {
                $notification = 'No member to update';
            }
        }



        require_once(CHEMIN_VUES . 'adminZone.php');

        if ($vueupdate) {
            require_once(CHEMIN_VUES . 'admin.update.php');
        }

    }
}