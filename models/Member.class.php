<?php class Member {

    private $_id_member;
    private $_name;
    private $_last_name;
    private $_email;
    private $_state;
    private $_is_admin;
    private $_password;

    public function __construct($id_member, $name, $last_name, $email, $state, $is_admin, $password) {
        $this->_id_member = $id_member;
        $this->_name = $name;
        $this->_last_name = $last_name;
        $this->_email = $email;
        $this->_state = $state;
        $this->_is_admin = $is_admin;
        $this->_password = $password;
    }

    public function full_name() {
        return htmlspecialchars($this->_name . ' ' . $this->_last_name);
    }

    public function id_member() {
        return $this->_id_member;
    }

    public function name() {
        return $this->_name;
    }

    public function last_name() {
        return $this->_last_name;
    }

    public function email() {
        return $this->_email;
    }

    public function state() {
        return $this->_state;
    }
    public function is_admin () {
        return $this->_is_admin;
    }

    public function password () {
        return $this->_password;
    }

    public function html_id_member(){
        return htmlspecialchars($this->_id_member);
    }

    public function html_name() {
        return htmlspecialchars($this->_name);
    }

    public function html_last_name() {
        return htmlspecialchars($this->_last_name);
    }

    public function html_password() {
        return htmlspecialchars($this->_password);
    }

    public function html_email(){
        return htmlspecialchars($this->_email);
    }

    public function html_state() {
        return htmlspecialchars($this->_state);
    }

    public function html_is_admin(){
        return htmlspecialchars($this->_is_admin);
    }

} ?>