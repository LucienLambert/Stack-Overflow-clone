<?php  class HomeController {

    private $_db;

    public function __construct($db) {
        $this->_db = $db;

    }

    public function run() {


        if (empty($_SESSION['authentifie'])) {
            $actionloginmember = 'login';
            $libelleloginmember = 'Login';
        } else {
            $actionloginmember = 'member';
            $libelleloginmember = 'Member Zone';
        }

        $tabquestions = $this->_db->select_questions();

        require_once(CHEMIN_VUES . 'home.php');


    }

}
?>