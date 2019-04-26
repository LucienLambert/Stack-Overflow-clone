<?php
class SignupController{

    private $_db;

    public function __construct($db) {
        $this->_db = $db;
    }

    public function run(){

        $notification = '';

        if (!empty($_POST['form_add'])) {
            if (empty($_POST['name']) && empty($_POST['last_name'])) {
                $notification = 'Please enter a name and a last name';
            } elseif (empty($_POST['last_name'])) {
                $notification = 'Please enter a last name';
            } elseif (empty($_POST['email'])) {
                $notification = 'Please enter a email';
            } elseif (empty($_POST['password'])) {
                $notification = 'Please enter a password';
            } elseif ($_POST['password'] != $_POST['cpassword']){
                $notification = 'the two passwords are different';
            } else {
                if ($this->_db->insert_member($_POST['name'], $_POST['last_name'], $_POST['email'], $_POST['password'], $_POST['state'], 0)) {
                    $notification1 = 'Adding well done';
                } else {
                    $notification1 = 'Error adding';
                }
            }
        }

        # A controller ends by writing a view
        require_once(CHEMIN_VUES . 'signup.php');
    }


}
?>