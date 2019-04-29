<?php
class MemberController{

    private $_db;

    public function __construct($db) {
        $this->_db = $db;
    }

    public function run() {

        # Si un petit fûté écrit ?action=admin sans passer par l'action login
        if (empty($_SESSION['authentifie'])) {
            header("Location: index.php?action=login"); # redirection HTTP vers l'action login
            die();
        }
        # Arrivé ici l'authentification est valide... continuons...

        $member = unserialize($_SESSION['member']);

        # Variable HTML pour la vue
        $html_pseudo = htmlspecialchars($_SESSION['login']);
        $notification = '';
        $vueupdate = false; # La vue partielle de mise à jour n'est pas à afficher;
        $vueanswers = false;
        $question = null;

        # Insertion des données d'un livre en provenance du formulaire form_ajout
        if (!empty($_POST['form_add_question'])) {
            if (empty($_POST['title']) && empty($_POST['subject'])) {
                $notification = 'Please enter a title and a subject';
            } elseif (empty($_POST['title'])) {
                $notification = 'Please enter a title';
            } elseif (empty($_POST['subject'])) {
                $notification = 'Please enter a subject';
            } elseif (empty($_POST['subject'])) {
                $notification = 'Please enter a subject';
            } else {
                if ($this->_db->insert_question($_POST['title'], $_POST['subject'], $_POST['id_category'], $member->id_member(), 'O')) {
                    $notification = 'Adding well done';
                } else {
                    $notification = 'Error adding';
                }
            }
        }
        # Gestion du tableau d'administration des questions
        if (!empty($_POST['form_save'])) {
            # ----------------------------------------
            # Une question sélectionnée est à mettre à jour
            # ----------------------------------------
            if (!empty($_POST['title']) && !empty($_POST['subject'])) {
                $this->_db->update_question($_POST['idquestion'], $_POST['title'], $_POST['subject']);
                $notification = 'Question updated successfully';
            } else {
                $notification = 'Please enter a title and a subject';
                $question = $this->_db->select_question($_POST['idquestion']);
                $vueupdate = true;
            }
        }
        elseif (!empty($_POST['form_update'])) {
            if (!empty($_POST['question'])) {
                # --------------------------------------------------------------------------
                # Une seule question est à mettre à jour spécifié par la variable $_POST['question']
                # --------------------------------------------------------------------------
                # Sélectionner les informations de la question correspondante
                $vueanswers = false;
                $question = $this->_db->select_question($_POST['question']);
                $vueupdate = true; # La vue partielle de mise à jour est à afficher;
            } else {
                $notification = 'No question to update';
            }
        } elseif(!empty($_POST['form_see_answers'])) {
            if (!empty($_POST['idquestion'])) {
                $vueupdate = false;
                $question = $this->_db->select_question($_POST['idquestion']);
                $tabanswers  = $this->_db->select_answers($_POST['idquestion']);
                $vueanswers = true;
            } else {
                $notification = 'No question to see';
            }
        } elseif (!empty($_POST['form_add_answer'])) {
            if (!empty($_POST['subject'])) {
                if ($this->_db->insert_answer($_POST['subject'], $_POST['idquestion'], $member->id_member())) {
                    $notification = 'Adding well done';
                } else {
                    $notification = 'Error adding';
                }
            }
        }

        # Sélection de toutes les questions à afficher
        $tabquestions = $this->_db->select_questions();
        # Sélection de toutes les catégories à afficher
        $tabCategories = $this->_db->select_categories();

        # Ecrire ici la vue
        require_once(CHEMIN_VUES . 'member.php');
        if ($vueupdate) {
            require_once(CHEMIN_VUES . 'member.update.php');
        } elseif ($vueanswers) {
            require_once(CHEMIN_VUES . 'answer.php');
        }
    }


}
?>