<?php

################################################################################
# ime   : Albums.class.php
# opis  : Class for administration of albums
# autor : Benjamin Babić
# datum : 07/06/2023
################################################################################

class Albums
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
		$query = "SELECT albums.id, albums.status, albums.name, albums.created_on,
			CONCAT(users.firstname, ' ', users.lastname) as created_by
			FROM albums
         	LEFT JOIN users on albums.created_by = users.id
			WHERE albums.status IN (".$status.")";

		if (is_array($search) && count ($search) > 0)
		{
			if (isset($search["id"]) && $search["id"] > 0)
			{
				$query .= " AND albums.id = " . (int)$search["id"];
			}

			if (isset($search["name"]) && $search["name"] != "")
			{
				$query .= " AND albums.name LIKE " . $db->Clean($search["name"]);
			}
		}

		$query .= " ORDER BY albums.id ASC";
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
			$created_on             = date("d.m.Y. H:i", strtotime($row["created_on"]));
			$created_by             = $row["created_by"];

			$list_array[$id]["status"]                  = $status;
			$list_array[$id]["name"]					= $name;
			$list_array[$id]["created_on"]              = $created_on;
			$list_array[$id]["created_by"]     = $created_by;
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

		$db = MysqlDB::getInstance();
		if ($db->InsertQuery("albums", $insert_vars)) {
			return true;
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
			return $db->UpdateQuery("albums", $data, $id);
		}
		return false;
	}

	/**************************************************************************/
	/**
	 * List all albums
	 *
	 * @param int $status
	 * @return array
	 */

	public function ListAlbumNames($status = 1): array
	{
		$db = MysqlDB::getInstance();
		$list_array = array();
		$query = "SELECT id, status, name
				FROM albums
				WHERE albums.status IN (".$status.")";

		$query .= " ORDER BY albums.name ASC";
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
			$name	 				= $row["name"];

			$list_array[$id]["name"] = $name;
		}
		return $list_array;
	}
}