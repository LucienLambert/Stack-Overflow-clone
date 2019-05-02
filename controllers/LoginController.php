<?php
class LoginController{

    private $_db;

    public function __construct($db) {
        $this->_db = $db;
    }

    public function run() {
        # Si un distrait écrit ?action=login en étant déjà authentifié
        if (!empty($_SESSION['authentifie'])) {
            header("Location: index.php?action=member"); # redirection HTTP vers l'action login
            die();
        }

        # Variables HTML dans la vue
        $notification = '';

        # L'utilisateur s'est-il bien authentifié ?
        if (empty($_POST)) {
            # L'utilisateur doit remplir le formulaire
            $notification = 'Authentifiez-vous';
        } elseif (!filter_var($_POST['login'], FILTER_VALIDATE_EMAIL)) {
            # L'authentification n'est pas correcte
            $notification = 'Veuillez entrer un email.';
        } else {
            if ($this->_db->is_valid_member($_POST['login'], $_POST['password'])) {
                # L'utilisateur est bien authentifié
                # Une variable de session $_SESSION['authenticated'] est créée
                $member = $this->_db->select_member($_POST['login']);
                $_SESSION['authentifie'] = 'autorise';
                $_SESSION['login'] = $member->full_name();
                $_SESSION['member'] = serialize($member);
                # Redirection HTTP pour demander la page admin
                header("Location: index.php?action=home");
                die();
            } else {
                $notification = 'Vos données d\'authentification ne sont pas correctes.';
            }
        }

        # Ecrire ici la vue
        require_once(CHEMIN_VUES . 'login.php');
    }

}
?>