<?php
class MemberController{

    private $_db;

    public function __construct($db) {
        $this->_db = $db;
    }

    public function run() {

        # If a malicious user writes ?action=login already authenticated
        if (empty($_SESSION['authentifie'])) {
            header("Location: index.php?action=login"); # HTTP redirection to login action
            die();
        }

       # Arrived here the authentication is valid ... continue ...

        $member = unserialize($_SESSION['member']);

        # HTML variables for the view
        $html_pseudo = htmlspecialchars($_SESSION['login']);
        $bad_notif = '';
        $good_notif = '';
        $viewupdate = false; # The partial update view is not to be displayed;
        $viewanswers = false;
        $selected_question = null;
        $tabquestions = array();



        # Inserting data from a question from the form form_add_question
        if (!empty($_POST['form_add_question'])) {
            if (empty($_POST['title']) && empty($_POST['subject'])) {
                $bad_notif = 'Please enter a title and a subject';
            } elseif (empty($_POST['title'])) {
                $bad_notif = 'Please enter a title';
            } elseif (empty($_POST['subject'])) {
                $bad_notif = 'Please enter a subject';
            } else {
                if ($this->_db->insert_question($_POST['title'], $_POST['subject'], $_POST['id_category'], $member->id_member(), 'O')) {
                    $good_notif = 'Question has been added';
                } else {
                    $bad_notif = 'Error adding question';
                }
            }
        }

        # Management of the questions board
        if (!empty($_POST['form_save'])) {
            if (!empty($_POST['title']) && !empty($_POST['subject'])) {
                $this->_db->update_question($_POST['idquestion'], $_POST['title'], $_POST['subject']);
                $good_notif = 'Question has been updated';
                $viewupdate = false;
            } else {
                $bad_notif = 'Please enter a title and a subject';
                $selected_question = $this->_db->select_question($_POST['idquestion']);
                $viewupdate = true;
            }
        }
        elseif (!empty($_POST['form_update'])) {
            foreach ($_POST['form_update'] as $id_question => $action) {
                $selected_question = $this->_db->select_question($id_question);
                if ($selected_question->owner()->id_member() != $member->id_member() || $selected_question->state() == 'D') {
                    $bad_notif = 'Sorry you can\'t change this question because it not yours or it has been duplicated by the admin';
                } else {
                    $viewupdate = true;
                }
            }

        } elseif(!empty($_POST['form_see_answers'])) {
            foreach($_POST['form_see_answers']   as  $id_question => $action){
                $selected_question = $this->_db->select_question($id_question);
                $tabanswers = $this->_db->select_answers($id_question);
                $viewanswers = true;
            }

        }elseif (!empty($_POST['form_update_good_answer'])){
            if (!empty($_POST['idanswer']) && !empty($_POST['idquestion'])) {
                $selected_question = $this->_db->select_question($_POST['idquestion']);
                if ($selected_question->owner()->id_member() == $member->id_member() && $selected_question->state() != 'D') {
                    $this->_db->update_good_answer($_POST['idquestion'], $_POST['idanswer']);
                    $good_notif = 'you\'ve chosen the right answer, your question is mark as solved';
                } else {
                    $bad_notif = 'Sorry this action is left to the owner of the question and it can also be a duplicated question';
                }
            }
        }elseif (!empty($_POST['form_add_answer'])) {
            if (!empty($_POST['subject'])) {
                $selected_question = $this->_db->select_question($_POST['idquestion']);
                if($selected_question->state()== 'D'){
                    $bad_notif=' Sorry, cannot add answer to duplicated question';
                }else {
                    $viewupdate = false;
                    $selected_question = $this->_db->select_question($_POST['idquestion']);
                    if ($this->_db->insert_answer($_POST['subject'], $_POST['idquestion'], $member->id_member())) {
                        $good_notif = 'Answer has been added';
                    } else {
                        $notification = 'Error adding answer';
                    }
                    $tabanswers = $this->_db->select_answers($_POST['idquestion']);
                    $viewanswers = true;
                }
            }
        } elseif (!empty($_POST['vote'])) {// if the member has voted
            try {
                $viewupdate = false;
                $this->_db->insert_vote($member->id_member(), $_POST['idanswer'], $_POST['vote']);
                $this->_db->update_answer($_POST['nb_positives_votes'], $_POST['nb_negatives_votes'], $_POST['vote'], $_POST['idanswer']);
                $selected_question = $this->_db->select_question($_POST['idquestion']);
                $tabanswers = $this->_db->select_answers($_POST['idquestion']);
                $viewanswers = true;
                $good_notif = 'Thank\'s for your vote :)';

            } catch (PDOException $e) {
                $bad_notif = 'Sorry you\'ve already vote for this answer or this question has been duplicated';
            }

        }

        #Select all questions to display
        $tabquestions = $this->_db->select_questions();
        # Select all categories to display
        $tabCategories = $this->_db->select_categories();

        # A controllers ends by writing a view
        require_once(CHEMIN_VUES . 'member.php');
        if ($viewupdate) {
            require_once(CHEMIN_VUES . 'member.update.php');
        } elseif ($viewanswers) {
            require_once(CHEMIN_VUES . 'answer.php');
        }
    }


}
?>