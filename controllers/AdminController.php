<?php class AdminController{

    private $_db;

    public function __construct($db){
        $this->_db = $db;
    }

    public function run(){
        $html_pseudo = htmlspecialchars($_SESSION['login']);

        $roleadmin = 'admin';
        $roleuser = 'member';
        $statesuspended = 'suppended';
        $stateactive = 'active';

        # Sélection de toutes les membres à afficher
        $tabmember = $this->_db->select_listemember();
        $selected_member = null;
        $notification = '';

        $vueupdate = false; # La vue partielle de mise à jour n'est pas à afficher pour le moment;

        # il doit être log pour pouvoir y avoir acces.
        if (empty($_SESSION['authentifie'])) {
            header("Location: index.php?action=login"); # redirection HTTP vers l'action login
            die();
        } elseif ($_SESSION['admin'] != 1){
            header("Location: index.php?action=home.php"); # redirection HTTP vers l'action login
            die();
        }

        if(!empty($_POST['member'])){
            $selected_member = $this->_db->select_members($_POST['member']);
            $vueupdate = true;
            $notification = 'member selected for update';
        } else {
            $notification = 'chose a member to update';
        }

        # Gestion du tableau d'administration des membres
        if (!empty($_POST['form_save'])) {
            if (!empty($_POST['state']) && !empty($_POST['is_admin'])) {
                $this->_db->update_member($_POST['member'], $_POST['state'], $_POST['is_admin']);
                $notification = 'the member has been update';
                $vueupdate = false;
            } else {
                $notification = 'you need to enter a state and a role for the member';
                $selected_member = $this->_db->select_members($_POST['member']);
                $vueupdate = true;
            }
        }


        require_once(CHEMIN_VUES . 'adminZone.php');

        if ($vueupdate) {
            require_once(CHEMIN_VUES . 'admin.update.php');
        }

    }
}