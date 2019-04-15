<?php class Category {

    private $_id_category;
    private $_name;

    public function __construct($id_category, $name) {
        $this->_id_category = $id_category;
        $this->_name = $name;
    }

    public function name() {
        return $this->_name;
    }

    public function id_category() {
        return $this->_id_category;
    }

} ?>