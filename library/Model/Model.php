<?php

class Model {
	protected $db;
	
	public $useTable = '';
	
	public $id = null;
	
	public $where = array();
	
	// Associations
	public $hasOne = array();

	public $hasMany = array();

	public function __construct() {
		$this->setuseTable();

		$this->db = new PDO('mysql:host=' . db_host . ';dbname=' . db_database, db_username, db_password);
	}

	public function setuseTable($name = null) {
		// Custom name
		if(!is_null($name)) {
			$this->useTable = $name;
			
			return;
		}
		
		// singular CamelSized class name -> pluralized lowercase table name
		$className = get_class($this);
		
		$name = strtolower(get_class($this));
		
		$name = pluralize($name);
		
		$this->useTable = $name;
	}
	
	public function findAll($options = array()) {
		// Assemble where statement
		$whereStatement = '';
		$where = $this->where;
		if(isset($options['where'])) {
			$where = array_merge($where, $options['where']);
		}
		foreach($where as $fieldName => $value) {
			if(!empty($whereStatement)) {
				$whereStatement .= ' AND ';
			} else {
				$whereStatement .= ' WHERE ';
			}
			
			$whereStatement .= '`' . $fieldName . '` = :' . $fieldName;
			
			$paramsToBind[] = array($fieldName, $value);
		}
		
		// Assemble order statement
		$orderStatement = '';
		if(isset($options['order_by'])) {
			$order_by = $options['order_by'];
			
			$orderStatement = ' ORDER BY `' . key($order_by) . '` ' . ($order_by == 'descending' ? 'DESC' : 'ASC');
		}

		// Assemble join statement
		$joinStatement = '';
		if(isset($options['join'])) {
			$joinStatement = ' INNER JOIN ' . $options['join'];
		}
		
		// Assemble limit statement
		$limitStatement = '';
		if(isset($options['limit'])) {
			$limitStatement = ' LIMIT ' . $options['limit'];
		}
		
		// Assemble query
		$statement = $this->db->prepare('
			SELECT
				*
			FROM
				`' . $this->useTable  . '`
			' . $joinStatement . $whereStatement . $orderStatement . $limitStatement
		);		

		// Bind params
		foreach($where as $fieldName => $value) {
			$statement->bindParam(':' . $fieldName, $value);
		}

		$statement->execute();
		
		$resultsSet = $statement->fetchAll(PDO::FETCH_OBJ);
		
		if(!$resultsSet) {
			return array();
		}
		
		// Associations
		// hasOne
		foreach($this->hasOne as $association) {
			// Load associated model
			loadModel($association);
			$modelName = ucfirst($association);
			$model = new $modelName();
			
			$foreignKey = strtolower($association) . '_id';
			
			foreach($resultsSet as $row) {
				$row->$modelName = $model->find(array(
					'where' => array('id' => $row->$foreignKey)
				));
			}
		}

		return $resultsSet;
	}
	
	public function find($options) {
		// Assemble where statement
		$whereStatement = '';
		$where = $this->where;
		if(isset($options['where'])) {
			$where = array_merge($where, $options['where']);
		}
		
		foreach($where as $fieldName => $value) {
			if(!empty($whereStatement)) {
				$whereStatement .= ' AND ';
			} else {
				$whereStatement .= ' WHERE ';
			}
			
			$whereStatement .= '`' . $fieldName . '` = :' . $fieldName;
			
			$paramsToBind[] = array($fieldName, $value);
		}
		
		// Assemble order statement
		$orderStatement = '';
		if(isset($options['order_by'])) {
			$order_by = $options['order_by'];
			
			$orderStatement = ' ORDER BY `' . key($order_by) . '` ' . ($order_by == 'descending' ? 'DESC' : 'ASC');
		}

		// Assemble query
		$statement = $this->db->prepare('
			SELECT
				*
			FROM
				`' . $this->useTable . '`
			' . $whereStatement . $orderStatement . '
			LIMIT 1'
		);

		// Bind params
		foreach($where as $fieldName => $value) {
			$statement->bindParam(':' . $fieldName, $value);
		}
		
		$statement->execute();
		
		$resultsSet = $statement->fetch(PDO::FETCH_OBJ);
		
		if(!$resultsSet) {
			return false;
		}
		
		// Associations
		// hasOne
		foreach($this->hasOne as $association) {
			// Load associated model
			loadModel($association);
			$modelName = ucfirst($association);
			$model = new $modelName();
			
			$foreignKey = strtolower($association) . '_id';
			
			$resultsSet->$modelName = $model->find(array(
				'where' => array('id' => $resultsSet->$foreignKey)
			));
		}
		
		return $resultsSet;
	}
	
	/**
	 * 
	 */
	public function exists($where) {
		// Assemble where statement
		$whereStatement = '';
		$where = $this->where;
		if(isset($options['where'])) {
			$where = array_merge($where, $options['where']);
		}
		
		foreach($where as $fieldName => $value) {
			if(!empty($whereStatement)) {
				$whereStatement .= ' AND ';
			} else {
				$whereStatement .= ' WHERE ';
			}
			
			$whereStatement .= '`' . $fieldName . '` = :' . $fieldName;
			
			$paramsToBind[] = array($fieldName, $value);
		}
		
		// Assemble query
		$statement = $this->db->prepare('
			SELECT
				*
			FROM
				`' . $this->useTable . '`
			' . $whereStatement
		);

		// Bind params
		foreach($where as $fieldName => $value) {
			$statement->bindParam(':' . $fieldName, $value);
		}
		
		$statement->execute();
		
		if($statement->rowCount() > 0) {
			return true;
		}
		
		return false;
	}
	
	/**
	 * Find all records where one particular field has a certain value
	 */
	public function findAllBy($field, $value) {
		$statement = $this->db->prepare('
			SELECT
				*
			FROM
				`' . $this->useTable . '`
			WHERE
				`' . $field . '` = :value
		');
		
		$statement->bindParam(':value', $value);
		
		$statement->execute();
		
		$resultsSet = $statement->fetchAll(PDO::FETCH_OBJ);
		
		if(!$resultsSet) {
			return array();
		}
		
		return $resultsSet;
	}
	
	/**
	 * Find one record where one particular field has a certain value
	 */
	public function findBy($field, $value, $recursive = true) {
		$statement = $this->db->prepare('
			SELECT
				*
			FROM
				`' . $this->useTable . '`
			WHERE
				`' . $field . '` = :value
			LIMIT 1
		');
		
		$statement->bindParam(':value', $value);
		
		$statement->execute();
		
		$resultsSet = $statement->fetch(PDO::FETCH_OBJ);
		
		if(!$resultsSet) {
			return false;
		}
		
		return $resultsSet;
	}
	
	/**
	 * Update record
	 */
	public function update($fields, $identifier = null) {		
		if(is_null($identifier)) {
			if(!$this->id) {
				exit('No ID set');
			}
			
			$identifierField = 'id';
			$identifierValue = $this->id;
		} else {
			$identifierField = key($identifier);
			$identifierValue = $identifier[$identifierField];
		}
		
		// Assemble SET statement
		$fieldsString = '';
		foreach($fields as $fieldName => $value) {
			if($fieldsString != '') {
				$fieldsString .= ', ';
			}
			
			$fieldsString .= '`' . $fieldName . '` = :' . $fieldName;
		}
		
		$statement = $this->db->prepare('
			UPDATE
				`' . $this->useTable . '`
			SET
				' . $fieldsString . '
			WHERE
				`' . $identifierField . '` = :identifierValue
		');
		
		// Bind fields
		foreach($fields as $fieldName => &$value) {
			$statement->bindParam(':' . $fieldName, $value);
		}
		
		// Bind ID
		$statement->bindParam(':identifierValue', $identifierValue);
		
		$statement->execute();
	}

	/**
	 * Insert record into table
	 */
	public function insert($fields) {
		// Compose fields query statement
		$fieldsStr = '';
		foreach($fields as $fieldName => $value) {
			if($fieldsStr != '') {
				$fieldsStr .= ', ';
			}
			
			$fieldsStr .= '`' . $fieldName . '`';
		}
		
		// Compose field values query statement
		$valuesStr = '';
		foreach($fields as $field) {
			if($valuesStr != '') {
				$valuesStr .= ', ';
			}
			
			$valuesStr .= '?';
		}
		
		// Prepare query
		$statement = $this->db->prepare('
			INSERT INTO
				`' . $this->useTable . '`
				(' . $fieldsStr . ')
			VALUES
				(' . $valuesStr . ')
		');

		// Bind values
		$i = 1;
		foreach($fields as $fieldName => $value) {
			switch(gettype($value)) {
				case 'integer':
					$type = PDO::PARAM_INT;
				default:
					$type = PDO::PARAM_STR;
			}

			$statement->bindValue($i++, $value, $type);
		}

		return $statement->execute();
	}

	/**
	 * Delete record
	 */
	public function delete($id = null) {
		$statement = $this->db->prepare('
			DELETE FROM
				`' . $this->useTable . '`
			WHERE
				`id` = :id
		');
		
		// Bind ID
		if(is_null($id)) {
			$id = $this->id;
		}
		$statement->bindParam(':id', $id);
		
		$statement->execute();	
	}
}