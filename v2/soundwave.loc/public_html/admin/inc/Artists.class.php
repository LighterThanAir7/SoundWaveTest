<?php

################################################################################
# ime   : Artists.class.php
# opis  : Class for administration of artists
# autor : Benjamin Babić
# datum : 07/06/2023
################################################################################

class Artists
{
	/**************************************************************************/
	/**
	 * Return list of all available services
	 *
	 * @param int $status
	 * @param array $search
	 * @return array
	 */

	public function List($status = 1, $search = NULL): array
	{
		$db = MysqlDB::getInstance();
		$list_array = array();
		$query = "SELECT artists.id, artists.status, artists.name, artists.created_on,
			CONCAT(users.firstname, ' ', users.lastname) as created_by
			FROM artists
         	LEFT JOIN users on artists.created_by = users.id";

		$query .= " ORDER BY artists.name";
		$result = $db->Query($query);
		while ($row = $db->Fetch($result))
		{
			if(is_array($row))
			{
				foreach ($row as $key => $val)
				{
					$row[$key] = stripslashes($val);
				}
			}
			$id 					= $row["id"];
			$status 				= $row["status"];
			$name					= $row["name"];
//			$number_of_fans			= $row["number_of_fans"];

			$created_on             = date("d.m.Y. H:i", strtotime($row["created_on"]));
			$created_by             = $row["created_by"];

			$list_array[$id]["status"]                  = $status;
			$list_array[$id]["name"]					= $name;
//			$list_array[$id]["number_of_fans"]			= $number_of_fans;

			$list_array[$id]["created_on"]              = $created_on;
			$list_array[$id]["created_by"]              = $created_by;

		}
		return $list_array;
	}
	/**************************************************************************/
	/**
	 * Return just one element by ID
	 *
	 * @param  int $id
	 * @return array
	 */

	public function getById($id)
	{
		$list_array = $this->List("0,1", array("id" => $id));

		if(isset($list_array[$id]))
			return $list_array[$id];
		else
			return false;
	}

	/**************************************************************************/
	/**
	 * Execute insert method for saving data in to database
	 *
	 * @param  mixed $data
	 * @return bool
	 */

	public function Save($data)
	{
		$insert_vars["name"] = $data;
		$insert_vars["created_on"] = date("Y-m-d H:i:s");
		$insert_vars["created_by"] = $_SESSION["user_id"];

		if(is_array($insert_vars))
		{
			$db = MysqlDB::getInstance();
			return $db->InsertQuery("artists", $insert_vars);
		}
		return false;
	}

	/**************************************************************************/
	/**
	 * Excecute update method for edit data in database
	 *
	 * @param  int $id
	 * @param  array $data
	 * @return bool
	 */

	public function Edit($id, $data)
	{
		if (is_array($data) && $id > 0) {
			$db = MysqlDB::getInstance();
			return $db->UpdateQuery("artists", $data, $id);
		}
		return false;
	}
}