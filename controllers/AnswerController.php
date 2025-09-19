<?php
class AnswerController{

    private $_db;

    public function __construct($db) {
        $this->_db = $db;
    }

    public function run() {


        $member = unserialize($_SESSION['member']);


        # A controllers ends by writing a view
        require_once(CHEMIN_VUES . 'answer.php');
    }

}
?>