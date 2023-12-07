<?php

################################################################################
# ime   : PlaylistCategories.class.php
# opis  : Class for administration of playlist categories
# autor : Benjamin Babić
# datum : 13/08/2023
################################################################################

class PlaylistCategories
{
	/**************************************************************************/
	/**
	 * Return list of all playlist categories
	 *
	 * @param int $status
	 * @param array $search
	 * @return array
	 */

	public function List($status = 1, $search = NULL): array
	{
		$db = MysqlDB::getInstance();
		$list_array = array();
		$query = "SELECT playlist_categories.id, 
				playlist_categories.status, 
				playlist_categories.name, 
				playlist_categories.img, 
				playlist_categories.created_on,
				CONCAT(users.firstname, ' ', users.lastname) as created_by
				FROM playlist_categories
				LEFT JOIN users on playlist_categories.created_by = users.id
				WHERE playlist_categories.status IN (" . $status . ")";

		if (is_array($search) && count($search) > 0) {
			if (isset($search["id"]) && $search["id"] > 0) {
				$query .= " AND playlist_categories.id = " . (int)$search["id"];
			}

			if (isset($search["name"]) && $search["name"] != "") {
				$query .= " AND playlist_categories.name LIKE " . $db->Clean($search["name"]);
			}
		}

		$query .= " ORDER BY playlist_categories.id ASC";
		$result = $db->Query($query);
		while ($row = $db->Fetch($result)) {
			if (is_array($row)) {
				foreach ($row as $key => $val) {
					$row[$key] = stripslashes($val);
				}
			}
			$id = $row["id"];
			$status = $row["status"];
			$name = $row["name"];
			$img = $row["img"];
			$created_on = date("d.m.Y. H:i", strtotime($row["created_on"]));
			$created_by = $row["created_by"];

			$list_array[$id]["status"] = $status;
			$list_array[$id]["name"] = $name;
			$list_array[$id]["img"] = $img;
			$list_array[$id]["created_on"] = $created_on;
			$list_array[$id]["created_by"] = $created_by;
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

	public function Save($data, $file)
	{
		$db = MysqlDB::getInstance();

		$name     = $file["F1"]["name"];
		$tmp_name = $file["F1"]["tmp_name"];
		$error    = $file["F1"]["error"];

		if(!$error)
		{
			$file_array = explode(".", $name);
			$ext        = end($file_array);

			$path = "doc/playlist_categories/";

			if(!is_dir($path)) {
				mkdir($path, 0777, true);
			}

			$file_server = "img_".time().".".$ext;

			if(move_uploaded_file($tmp_name, $path.$file_server))
			{
				$data["img"] = $path.$file_server;
				$data["created_on"] = date("Y-m-d H:i:s");
				$data["created_by"] = $_SESSION["user_id"];

				$result = $db->InsertQuery("playlist_categories", $data);

				if($result)
				{
					return true;
				}

				unlink($path.$file_server);
				return false;
			}
			return false;
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

	public function Edit($id, $data, $file)
	{
		if (is_array($data) && $id > 0) {
			$db = MysqlDB::getInstance();

			if(isset($file) && $file["F1"]["size"] > 0) {

				// case ako postoji već slika žanra, nakon edita treba maknut prethodnu

				$existing_img = $this->PlaylistCategoryPictureExistsForUser($id);

				if ($existing_img !== null) {
					unlink($existing_img);
				}

				$db = MysqlDB::getInstance();

				$name     = $file["F1"]["name"];
				$tmp_name = $file["F1"]["tmp_name"];
				$error    = $file["F1"]["error"];

				if(!$error)
				{
					$file_array = explode(".", $name);
					$ext        = end($file_array);

					$path = "doc/playlist_categories/";

					if(!is_dir($path)) {
						mkdir($path, 0777, true);
					}

					$file_server = "img_".time().".".$ext;

					if(move_uploaded_file($tmp_name, $path.$file_server))
					{
						$data["img"] = $path.$file_server;

						$result = $db->UpdateQuery("playlist_categories", $data, $id);

						if($result)
						{
							return true;
						}

						unlink($path.$file_server);
						return false;
					}
					return false;
				}
				return false;
			}

			return $db->UpdateQuery("music_genres", $data, $id);
		}

		return false;
	}

	public function PlaylistCategoryPictureExistsForUser($id) {
		$query = "SELECT img
			  FROM playlist_categories
			  WHERE playlist_categories.id = '$id'";

		$db = MysqlDB::getInstance();
		$result = $db->Query($query);
		$row = $db->Fetch($result);

		return $row["img"];
	}
}