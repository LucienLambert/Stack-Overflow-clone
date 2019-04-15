<?php class Question {

    private $_id_question;
    private $_title;
    private $_subject;
    private $_creation_date;
    private $_id_category;
    private $_owner;
    private $_state;
    private $_good_answer;

    #Attention au niveau de owner.
    public function __construct($id_question, $title,  $subject, $creation_date, $id_category, $owner, $state, $good_answer) {
        $this->_id_question = $id_question;
        $this->_title = $title;
        $this->_subject = $subject;
        $this->_creation_date = $creation_date;
        $this->_id_category = $id_category;
        $this->_owner = $owner;
        $this->_state = $state;
        $this->_good_answer = $good_answer;
    }

    public function good_answer() {
        return $this->_good_answer;
    }

    public function id_question() {
        return $this->_id_question;
    }

    public function title() {
        return $this->_title;
    }

    public function subject() {
        return $this->_subject;
    }

    public function creation_date() {
        return $this->_creation_date;
    }

    public function id_category() {
        return $this->_id_category;
    }

    public function owner() {
        return $this->_owner;
    }

    public function state() {
        return $this->_state;
    }

    public function html_title() {
        return htmlspecialchars($this->_title);
    }
    public function html_subject() {
        return htmlspecialchars($this->_subject);
    }
    public function html_id_question() {
        return htmlspecialchars($this->_id_question);
    }
} ?>