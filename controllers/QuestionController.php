<?php
class QuestionController {

    private $_db;

    public function __construct($db) {
        $this->_db = $db;
    }


    public function run() {
        # Notification that will be displayed in the view
        $bad_notif = '';
        # Question Table that will be browsed in the view
        $selected_question = null;
        # Search Keyword
        $html_keyword = '';
        $viewanswers = false;//partial view of answers
        $viewDuplicated = false;
        $viewDeleted = false;
        $notification = '';

        if (isset($_SESSION['admin']) && $_SESSION['admin'] == 1){
            $viewDuplicated = true;
            $viewDeleted = true;
        } else {
            $notification = 'Admin only';
        }

        # Search if a keyword is entered in the form form_research
        if (!empty($_POST['form_research']) && !empty($_POST['keyword'])) {
            $html_keyword = htmlspecialchars($_POST['keyword']); # Protection anti XSS à l'affichage
        } else {
            # Select all questions as a table
            $tabquestions = $this->_db->select_questions();
        }

        if(!empty($_POST['form_see_answers'])) {
            foreach($_POST['form_see_answers']   as  $id_question => $action){
                $selected_question = $this->_db->select_question($id_question);
                $tabanswers = $this->_db->select_answers($id_question);
                $viewanswers = true;
                require_once(CHEMIN_VUES . 'question.php');
                require_once(CHEMIN_VUES . 'answer.php');
            }
        } elseif (!empty($_POST['form_change_state'])) {
            $this->_db->update_state_question($_POST['state'], $_POST['idquestion']);
        } elseif (!empty($_POST['delete_question'])) {
            $selected_id_question = $_POST['idquestion'];
            $tabanswers = $this->_db->select_answers($selected_id_question);
            $this->_db->update_good_answer($selected_id_question, null);
            foreach ($tabanswers as $answer) {
                if ($this->_db->delete_answer($selected_id_question, $answer->id_answer())) {
                    $notification = 'The answer n°' . $answer->id_answer() . ' has been deleted';
                } else {
                    $notification = 'The answer n°' . $answer->id_answer() . ' has been not deleted';
                }
            }
            if ($this->_db->delete_question($selected_id_question)) {
                $notification = 'The question n°' . $selected_id_question . ' has been deleted';
            } else {
                $notification = 'The question n°' . $selected_id_question . ' has been not deleted';
            }
        }

        $tabquestions = $this->_db->select_questions($html_keyword);

        require_once(CHEMIN_VUES . 'question.php');
    }
}
?>