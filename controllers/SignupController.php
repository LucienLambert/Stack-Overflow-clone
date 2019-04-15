<?php
class SignupController{

    public function __construct() {

    }

    public function run(){

        # A controller ends by writing a view
        require_once(CHEMIN_VUES . 'signup.php');
    }

}
?>