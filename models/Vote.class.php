<?php class Vote{

    private $_value;
    private $_id_answer;
    private $_id_member;

    public function __construct($id_member, $id_answer, $value) {
        $this->_id_member = $id_member;
        $this->_id_answer = $id_answer;
        $this->_value = $value;
    }

    public function value() {
        return $this-> _value;
    }

    public function id_answer() {
        return $this->_id_answer;
    }

    public function id_member() {
        return $this->_id_member;
    }

} ?>