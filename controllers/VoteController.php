<?php
class VoteController{

	private $_db;

   public function __construct($db) {
		$this->_db = $db;

    }

    public function run(){

        # A controller ends by writing a view
        require_once(CHEMIN_VUES . 'vote.php');
    }

}
?>