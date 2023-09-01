<?php

namespace src\Infra;

class CoachRepository{ 
	/**
	 * @return mixed
	 */
	public function getAll() {
        return "select * from Coach";
	}
	
	/**
	 *
	 * @param mixed $id
	 * @return mixed
	 */
	public function getById($id) {
        return "select * from Coach where id = $id";
	}
}