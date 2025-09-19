<?php
class LoginController{

    private $_db;

    public function __construct($db) {
        $this->_db = $db;
    }

    public function run() {
        # If a malicious user writes ?action=login already authenticated
        if (!empty($_SESSION['authentifie'])) {
            header("Location: index.php?action=member"); # HTTP redirection to member action
            die();
        }

        # HTML variables in the view
        $notification = '';

        # Did the user authenticate himself ?
        if (empty($_POST)) {
            # The user must complete the form
            $notification = 'You must authenticate yourself';
        } elseif (!filter_var($_POST['login'], FILTER_VALIDATE_EMAIL)) {
            # The authentication is not correct
            $notification = 'Please enter an email.';
        } else {
            if ($this->_db->is_valid_member($_POST['login'], $_POST['password'])) {
                # The user is authenticated
                # A $ _SESSION ['authenticated'] session variable is created
                $member = $this->_db->select_member($_POST['login']);
                $_SESSION['authentifie'] = 'autorise';
                $_SESSION['login'] = $member->full_name();
                $_SESSION['member'] = serialize($member);
                $_SESSION['admin'] = $member->is_admin();
                $_SESSION['state'] = $member->state();
                # HTTP redirection to request the home page
                header("Location: index.php?action=home");
                die();
            } else {
                $notification = 'Your authentication data is not correct or you are a suspended user.';
            }
        }

        # Ecrire ici la vue
        require_once(CHEMIN_VUES . 'login.php');
    }

}
?>