<?php

class User extends BaseModel {
	public function findByEmailAndPassword($email, $password) {
		$statement = $this->MySQLi->prepare('
			SELECT
				*
			FROM
				`' . $this->tableName . '`
			WHERE
				`email` = ? AND `password` = ?
			LIMIT 1
		');
		
		$statement->bind_param('ss', $email, $password);
		
		$statement->execute();
		
		$statement->store_result();
		
		if($statement->num_rows !== 1) {
			return false;
		}
		
		return $statement->fetch();
	}
}