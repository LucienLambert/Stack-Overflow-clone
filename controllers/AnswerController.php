<?php
class AnswerController{

    private $_db;

    public function __construct($db) {
        $this->_db = $db;
    }

    public function run() {
        # Notification that will be displayed in the view
        $notification = '';


        $member = unserialize($_SESSION['member']);

        var_dump($_POST);


        # A controller ends by writing a view
        require_once(CHEMIN_VUES . 'answer.php');
    }

}
?>