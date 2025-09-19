<?php class Answer {

    private $_id_answer;
    private $_subject;
    private $_creation_date;
    private $_id_question;
    private $_id_member;
    private $_nb_positives_votes;
    private $_nb_negatives_votes;

    public function __construct($id_answer, $subject, $creation_date, $id_question, $id_member , $nb_positives_votes, $nb_negatives_votes) {
        $this->_id_answer = $id_answer;
        $this->_subject = $subject;
        $this->_creation_date = $creation_date;
        $this->_id_question = $id_question;
        $this->_id_member = $id_member;
        $this->_nb_positives_votes= $nb_positives_votes;
        $this->_nb_negatives_votes = $nb_negatives_votes;

    }

    public function id_answer() {
        return $this->_id_answer;
    }

    public function subject() {
        return $this->_subject;
    }

    public function creation_date() {
        return $this->_creation_date;
    }

    public function id_question() {
        return $this->_id_question;
    }

    public function id_member() {
        return $this->_id_member;
    }
    public function nb_positives_votes(){
        return  $this->_nb_positives_votes;
    }
    public function nb_negatives_votes() {
        return $this->_nb_negatives_votes;
    }

} ?>