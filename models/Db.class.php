<?php class Db {

    private static $instance = null;
    private $_db;

    private function __construct() {
        try {
            $configTable = parse_ini_file('config/config.ini');
            $this->_db = new PDO('mysql:host=' . $configTable['db_host'] . ';dbname='. $configTable['db_name'] . ';charset=utf8', $configTable['db_user'], $configTable['db_password']);
            $this->_db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->_db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
        } catch (PDOException $e) {
            die('Erreur de connexion à la base de données : ' . $e->getMessage());
        }
    }

    # Pattern Singleton pour avoir une seule connexion à la Db
    public static function getInstance() {
        if (is_null(self::$instance)) {
            self::$instance = new Db();
        }
        return self::$instance;
    }

    # Fonction qui exécute un SELECT dans la table des livres
    # et qui renvoie un tableau d'objet(s) de la classe Livre
    public function select_questions($keyword = '') {
        # Définition du query et préparation
        if ($keyword != '') {
            $keyword = str_replace("%", "\%", $keyword);
            $query = "SELECT * FROM questions AS q, categories AS c WHERE c.id_category = q.id_category AND c.name LIKE :keyword COLLATE utf8_bin OR q.title LIKE :keyword COLLATE utf8_bin OR q.subject LIKE :keyword COLLATE utf8_bin  ORDER BY id_question DESC";
            #$query = "SELECT questions.*, categories.name FROM questions, categories WHERE questions.title AND questions.id_category=categories.id_category LIKE :keyword COLLATE utf8_bin OR subject LIKE :keyword COLLATE utf8_bin  ORDER BY id_question DESC";
            $ps = $this->_db->prepare($query);
            # Le bindValue se charge de quoter proprement les valeurs des variables sql
            $ps->bindValue(':keyword', "%$keyword%");
        } else {
            $query = 'SELECT * FROM questions ORDER BY id_question DESC';
            $ps = $this->_db->prepare($query);
        }

        # Excecute prepared statement
        $ps->execute();
        $table = array();
        while ($row = $ps->fetch()) {
            $table[] = new Question($row->id_question, $row->title, $row->subject, $row->creation_date, $this->select_category($row->id_category),
                $this->select_member_by_id($row->owner), $row->state, $row->good_answer);
        }
        # For debug : display of table to return
        # var_dump($table);
        return $table;
    }

    public function insert_question($title, $subject, $id_category, $owner, $state) {
        # Solution d'INSERT avec prepared statement
        $query = 'INSERT INTO questions (id_question, title, subject, id_category, owner, state, good_answer) VALUES (DEFAULT, :title, :subject, :id_category, :owner, :state, DEFAULT)';
        $ps = $this->_db->prepare($query);
        $ps->bindValue(':title', $title);
        $ps->bindValue(':subject', $subject);
        $ps->bindValue(':id_category', $id_category);
        $ps->bindValue(':owner', $owner);
        $ps->bindValue(':state', $state);
        return $ps->execute();
    }

    public function insert_answer($subject, $id_question, $id_member) {
        $query ='INSERT INTO answers (id_answer, subject, id_question, id_member) VALUES (DEFAULT, :subject, :id_question, :id_member)';
        $ps = $this->_db->prepare($query);
        $ps->bindValue(':subject', $subject);
        $ps->bindValue(':id_question', $id_question);
        $ps->bindValue(':id_member', $id_member);
        return $ps->execute();
    }

    public function select_question($id_question) {
        $query = 'SELECT * FROM questions WHERE id_question = :id_question';
        $ps = $this->_db->prepare($query);
        $ps->bindValue(':id_question', $id_question);
        $ps->execute();
        $row = $ps->fetch();
        return new Question($row->id_question, $row->title, $row->subject, $row->creation_date, $this->select_category($row->id_category), $this->select_member_by_id($row->owner), $row->state, $row->good_answer);
    }

    public function select_member_by_id($id_member) {
        $query = 'SELECT * FROM members WHERE id_member = :id_member';
        $ps = $this->_db->prepare($query);
        $ps->bindValue(':id_member', $id_member);
        $ps->execute();
        $row = $ps->fetch();
        return new Member($row->id_member, $row->name, $row->last_name, $row->email, $row->state, $row->is_admin, NULL);
    }

    public function select_answers($id_question) {
        $query = 'SELECT * FROM answers WHERE id_question = :id_question';
        $ps = $this->_db->prepare($query);
        $ps->bindValue(':id_question', $id_question);
        $ps->execute();
        $table = array();
        while ($row = $ps->fetch()) {
            $table[] = new Answer($row->id_answer, $row->subject, $row->creation_date, $row->id_question, $this->select_member_by_id($row->id_member),$row->nb_positives_votes,$row->nb_negatives_votes);
        }
        return $table;
    }

    public function update_question($id_question, $title, $subject) {
        $query = 'UPDATE questions SET title = :title, subject = :subject WHERE id_question = :id_question';
        $ps = $this->_db->prepare($query);
        $ps->bindValue(':title', $title);
        $ps->bindValue(':subject', $subject);
        $ps->bindValue(':id_question', $id_question);
        return $ps->execute();
    }

    public function update_member($id_member, $state, $is_admin){
        $query = 'UPDATE members SET state = :state, is_admin = :is_admin WHERE id_member = :id_member';
        $ps = $this->_db->prepare($query);
        $ps->bindValue(':state', $state);
        $ps->bindValue(':is_admin', $is_admin);
        $ps->bindValue(':id_member', $id_member);
        return $ps->execute();
    }

    public function select_member($email) {
        $query = 'SELECT * FROM members WHERE email = :email';
        $ps = $this->_db->prepare($query);
        $ps->bindValue(':email', $email);
        $ps->execute();
        $row = $ps->fetch();
        return new Member($row->id_member, $row->name, $row->last_name, $row->email, $row->state, $row->is_admin, NULL);
    }

    public function insert_member($name, $last_name, $email, $password) {
        $password = $this->crypt_password($email, $password);
        $query = 'INSERT INTO members (name, last_name, email, password) VALUES (:name, :last_name, :email, :password)';
        $ps = $this->_db->prepare($query);
        $ps->bindValue(':name', $name);
        $ps->bindValue(':email', $email);
        $ps->bindValue(':last_name', $last_name);
        $ps->bindValue(':password', $password);
        return $ps->execute();
    }

    #Fonction qui exécute un INSERT dans la table categorie.
    public function insert_categories($name) {
        $query = 'INSERT INTO categories (name) VALUES (:name)';
        $ps = $this->_db->prepare($query);
        $ps->bindValue(':name',$name);
        $ps->execute();
    }

    public function select_categories() {
        $query = 'SELECT * FROM categories ORDER BY id_category DESC';
        $ps = $this->_db->query($query);
        $table = array();
        while ($row = $ps->fetch()) {
            $table[] = new Category($row->id_category, $row->name);
        }
        return $table;
    }

    public function select_category($id_category) {
        $query = 'SELECT * FROM categories WHERE id_category = :id_category';
        $ps = $this->_db->prepare($query);
        $ps->bindValue(':id_category', $id_category);
        $ps->execute();
        $row = $ps->fetch();
        return new Category($row->id_category, $row->name);
    }

    public function select_votes_by_answer($id_answer) {
        $query = 'SELECT * FROM votes WHERE id_answer = :id_answer ORDER BY value';
        $ps = $this->_db->prepare($query);
        $ps->bindValue(':id_answer', $id_answer);
        $ps->execute();
        $table = array();
        while($row = $ps->fetch()) {
            $table[] = new Vote($row->id_member, $row->id_answer, $row->value);
        }
        return $table;
    }

    public function insert_vote($id_member, $id_answer, $value) {
        $query = 'INSERT INTO votes (id_member, id_answer, value) VALUES (:id_member, :id_answer, :value)';
        $ps = $this->_db->prepare($query);
        $ps->bindValue(':id_member', $id_member);
        $ps->bindValue(':id_answer', $id_answer);
        $ps->bindValue(':value', $value);
        $ps->execute();
    }

    public function update_answer($nb_positives_votes,$nb_negatives_votes,$vote, $id_answer) {
        $vote=intval($vote);
        $query = 'UPDATE answers SET nb_positives_votes = :nb_positives_votes,nb_negatives_votes = :nb_negatives_votes WHERE id_answer = :id_answer';
        $ps = $this->_db->prepare($query);
        if ($vote == +1) {
            $ps->bindValue(':nb_positives_votes', $nb_positives_votes + 1);
            $ps->bindValue(':nb_negatives_votes', $nb_negatives_votes);
        } else {
            $ps->bindValue(':nb_positives_votes', $nb_positives_votes);
            $ps->bindValue(':nb_negatives_votes',$nb_negatives_votes + 1);
        }
        $ps->bindValue(':id_answer', $id_answer);
        $ps->execute();
    }

    public function update_state_question($state, $id_question) {
        $query = 'UPDATE questions SET state = :state WHERE id_question = :id_question';
        $ps = $this->_db->prepare($query);
        $ps->bindValue(':state', $state);
        $ps->bindValue(':id_question', $id_question);
        $ps->execute();
    }

    public function is_valid_member($email, $password) {
		$state = 's';
        $password = $this->crypt_password($email, $password);
        var_dump($password);
        $query = 'SELECT * FROM members WHERE email = :email AND password = :password AND state != :state';
        $ps = $this->_db->prepare($query);
        $ps->bindValue(':email', $email);
        $ps->bindValue(':password', $password);
		$ps->bindValue(':state', $state);
        $ps->execute();
        return $ps->rowcount() == 1;
    }

    public function select_members(){
        $query = 'SELECT * FROM members ';
        $ps = $this->_db->prepare($query);
        $ps->execute();
        $tab = array();
        while($row=$ps->fetch()){
            $tab[] = new Member($row->id_member, $row->name, $row->last_name, $row->email, $row->state, $row->is_admin, $row->password);
        }
        return $tab;
    }

    public function delete_answer($id_question, $id_answer) {
        var_dump($id_answer, $id_question);
        $queryVotes = 'DELETE FROM votes WHERE id_answer = :id_answer';
        $ps = $this->_db->prepare($queryVotes);
        $ps->bindValue(':id_answer', $id_answer);
        $ps->execute();

        $queryAnswers = 'DELETE FROM answers WHERE id_question = :id_question';
        $ps = $this->_db->prepare($queryAnswers);
        $ps->bindValue(':id_question', $id_question);
        return $ps->execute();
    }

    public function delete_question($id_question) {
        $queryQuestion = 'DELETE FROM questions WHERE id_question = :id_question';
        $ps = $this->_db->prepare($queryQuestion);
        $ps->bindValue(':id_question',$id_question);
        return $ps->execute();
    }

    public function update_good_answer($id_question, $id_answer) {
        $state = 'S';
        var_dump($state, $id_question, $id_answer);
        $query = 'UPDATE questions SET good_answer = :good_answer, state = :state WHERE id_question = :id_question';
        $ps = $this->_db->prepare($query);
        $ps->bindValue(':good_answer', $id_answer);
        $ps->bindValue(':state', $state);
        $ps->bindValue(':id_question', $id_question);
        $ps->execute();
    }

    private function crypt_password($email, $password) {
        $explode = explode('@', $email);
        $email = $explode[0] . ((isset($explode[1])) ? $explode[1] : '');
        $salt = strrev($email) . sha1($password);
        $salt = substr($salt, 0, 22);
        return crypt ($password, '$2y$10$' . $salt . '$');
    }

} ?>