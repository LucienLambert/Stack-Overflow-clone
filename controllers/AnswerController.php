<?php
class AnswerController{

    private $_db;

    public function __construct($db) {
        $this->_db = $db;
    }

    public function run(){
        # Notification that will be displayed in the view
        $notification = '';
        # Question Table that will be browsed in the view
        $tabquestions = '';

        $tabquestions  = $this->_db->select_answers($_POST['idquestion']);



        # A controller ends by writing a view
        require_once(CHEMIN_VUES . 'answer.php');
    }

}
?>