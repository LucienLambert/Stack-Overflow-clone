<?php class Db {

    private static $instance = null;
    private $_db;

    private function __construct() {
        try {
            $this->_db = new PDO('mysql:host=localhost;dbname=projet;charset=utf8', 'root', '');
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
			$query = "SELECT * FROM questions WHERE title LIKE :keyword COLLATE utf8_bin  ORDER BY id_question DESC";
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
			$table[] = new Question($row->id_question, $row->title, $row->subject, $row->creation_date, $row->id_category, $row->owner, $row->state, $row->good_answer);
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

	public function select_question($id_question) {
		$query = 'SELECT * FROM questions WHERE id_question = :id_question';
		$ps = $this->_db->prepare($query);
		$ps->bindValue(':id_question', $id_question);
		$ps->execute();
		$row = $ps->fetch();
		return new Question($row->id_question, $row->title, $row->subject, $row->creation_date, $row->id_category, $row->owner, $row->state, $row->good_answer);
	}
	
	public function update_question($id_question, $title, $subject) {
		$query = 'UPDATE questions SET title = :title, subject = :subject WHERE id_question = :id_question';
		$ps = $this->_db->prepare($query);
		$ps->bindValue(':title', $title);
		$ps->bindValue(':subject', $subject);
		$ps->bindValue(':id_question', $id_question);
		return $ps->execute();
	}

	public function select_member($login) {
		$query = 'SELECT * FROM members WHERE email = :email';
		$ps = $this->_db->prepare($query);
		$ps->bindValue(':email', $login);
		$ps->execute();
		$row = $ps->fetch();
		return new Member($row->id_member, $row->name, $row->last_name, $row->email, $row->state, $row->is_admin,$row->password);
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

	public function is_valid_member($login, $password) {
		$query = 'SELECT * FROM members WHERE email = :email AND password = :password';
		$ps = $this->_db->prepare($query);
		$ps->bindValue(':email', $login);
		$ps->bindValue(':password', $password);
		$ps->execute();
		return $ps->rowcount() == 1;
	}
	
} ?>