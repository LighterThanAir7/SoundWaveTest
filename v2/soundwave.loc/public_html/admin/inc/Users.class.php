<?php

################################################################################
# ime   : Class Users
# opis  : Klasa za upisivanje, ažuriranje i brisanje korisnika
# autor : Benjamin Babić
# datum : 12/02/2023
################################################################################

class Users
{
    /**************************************************************************/
    /**
     * Return list of all available users
     *
     * @param  string $lang
     * @param  int $status
     * @param  array $search
     * @return array
     */
    public function List($lang = "HR", $status = 1, $search = NULL)
    {
        $db = MysqlDB::getInstance();

        $list_array = array();

        $query = "SELECT
					users.id,
					users.id_type,
					users.status,
					users.firstname,
					users.lastname,
					users.username,
					users.password,
					users.sex,
					users.date_birth,
					users.img,
					users.init_password,
					users.last_login,
					users.created_on,
					users.created_by,
					created_by.firstname as 'Created by - Firstname',
					created_by.lastname as 'Created by - Lastname',
					sut.name as 'user_type_name'
					FROM users
					JOIN users created_by on users.created_by = created_by.id
					LEFT JOIN spt_user_type sut on users.id_type = sut.id
                    WHERE users.status IN (".$status.")";

        if(is_array($search) && count($search) > 0)
        {
            if(isset($search["id"]) && $search["id"] > 0)
            {
                $query .= " AND users.id = " . (int)$search["id"];
            }

            if(isset($search["firstname"]) && $search["firstname"] !== "")
            {
                $query .= " AND users.firstname LIKE " . $db->Clean($search["firstname"]);
            }
        }

        $query .= " ORDER BY users.id ASC";

        $result = $db->Query($query);
        while ($row = $db->Fetch($result))
        {
            if (is_array($row))
            {
                foreach($row as $key => $val)
                {
                    if(isset($val) && $val != "") {
						$row[$key] = stripslashes($val);
					}
                }
            }

            $id                     = $row["id"];
			$id_type				= $row["id_type"];
            $status                 = $row["status"];
            $firstname              = $row["firstname"];
            $lastname               = $row["lastname"];
            $username               = $row["username"];
            $password               = $row["password"];
			$sex                  	= $row["sex"];
			$date_birth             = date("d.m.Y.", strtotime($row["date_birth"]));
            $img                  	= $row["img"];
            $init_password          = $row["init_password"];
            $created_on             = date("d.m.Y. H:i", strtotime($row["created_on"]));
            $created_by             = $row["created_by"];
            $created_by_firstname   = $row["Created by - Firstname"];
            $created_by_lastname    = $row["Created by - Lastname"];
			$user_type_name         = $row["user_type_name"];

            if (empty($row["last_login"])) {
                $last_login = "-";
            } else {
                $last_login = date("d.m.Y. H:i", strtotime($row["last_login"]));
            }

            $list_array[$id]["id_type"]                  = $id_type;
			$list_array[$id]["status"]                   = $status;
            $list_array[$id]["firstname"]                = $firstname;
            $list_array[$id]["lastname"]                 = $lastname;
            $list_array[$id]["username"]                 = $username;
            $list_array[$id]["password"]                 = $password;
			$list_array[$id]["sex"]                      = $sex;
			$list_array[$id]["date_birth"]               = $date_birth;
			$list_array[$id]["img"]                      = $img;
			$list_array[$id]["init_password"]            = $init_password;
			$list_array[$id]["last_login"]               = $last_login;
            $list_array[$id]["created_on"]               = $created_on;
            $list_array[$id]["created_by"]               = $created_by;
            $list_array[$id]["created_by_firstname"]     = $created_by_firstname;
            $list_array[$id]["created_by_lastname"]      = $created_by_lastname;
			$list_array[$id]["user_type_name"]           = $user_type_name;
        }

        return $list_array;
    }

    /**************************************************************************/
    /**
     * Return just one element by ID
     *
     * @param  int $id
     * @param  string $lang
     * @return array
     */
    public function getById($id, $lang = "HR")
    {
        $list_array = $this->List($lang, "0,1", array("id" => $id));
		return $list_array[$id] ?? false;
	}

	/**************************************************************************/
	/**
	 * Execute insert method for saving data in to database
	 *
	 * @param  mixed $file
	 * @return bool
	 */
	public function SaveImage($file, $id)
	{
		$db = MysqlDB::getInstance();

		// case ako postoji već slika profila, nakon edita treba maknut prethodnu

		$existing_img = $this->ProfilePictureExistsForUser($id);

		if ($existing_img !== null) {
			unlink($existing_img);
		}

		$name     = $file["F1"]["name"];
		$tmp_name = $file["F1"]["tmp_name"];
		$error    = $file["F1"]["error"];

		if(!$error)
		{
			$file_array = explode(".", $name);
			$ext        = end($file_array);

			$path = "doc/user_images/";

			if(!is_dir($path)) {
				mkdir($path, 0777, true);
			}

			$file_server = "img_".$id."_".time().".".$ext;

			if(move_uploaded_file($tmp_name, $path.$file_server))
			{
				$data = $path.$file_server;

				$insert_vars = array();
				$insert_vars["img"] = $data;

				$result = $db->UpdateQuery("users", $insert_vars, $id);

				if($result)
				{
					return true;
				}

				unlink($data);
				return false;
			}
			return false;
		}
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
        if (is_array($data)) {
            $db = MysqlDB::getInstance();

			if (isset($data["password"])) {
				$data["password"]   = md5($data["password"] . "imanekatajnaveza");
			}
            $data["created_by"] = $_SESSION["user_id"];
			$data["created_on"] = date("Y-m-d H:i:s");

            return $db->InsertQuery("users", $data);
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
        if (is_array($data) && $id > 0)
        {
            $db = MysqlDB::getInstance();
            if (isset($data["password"])) {
                $data["password"]   = md5($data["password"] . "imanekatajnaveza");
            }
            return $db->UpdateQuery("users", $data, $id);
        }
		return false;
	}

	/**************************************************************************/
	/**
	 * Return sex from user id
	 *
	 * @return string
	 */
	public function ListUserSex($id_user)
	{
		$db = MysqlDB::getInstance();
		$query = "SELECT
                users.id,
                users.sex
                FROM users
                WHERE users.id = (".$id_user.")";

		$result = $db->Query($query);
		while ($row = $db->Fetch($result))
		{
			$sex = $row["sex"];
		}
		return $sex;
	}

    /**************************************************************************/
    /**
     * Get User Types from spt_user_type table
     *
     * @return array
     */
    public function GetUserTypes()
    {
		$user_type_array = array();
        $db = MysqlDB::getInstance();

        $query = "SELECT 
                      spt_user_type.id,
                      spt_user_type.name
                      FROM spt_user_type
                      ORDER BY name ASC";

        $result = $db->Query($query);

        while ($row = $db->Fetch($result)) {
            $user_type = $row["name"];
            $id_type = $row["id"];
            $user_type_array[$id_type] = $user_type;
        }
        return $user_type_array;
    }

	/**************************************************************************/
	/**
	 * Return just one User name by ID
	 *
	 * @param  int $id_user
	 * @return array
	 */
	public function GetUserNameById($id_user)
	{
		$query = "SELECT
                      CONCAT(users.firstname, ' ',users.lastname) as ime_prezime
                      FROM users
                      WHERE users.id = '$id_user'";

		$db = MysqlDB::getInstance();

		$result = $db->Query($query);
		$row = $db->Fetch($result);

		return $row["ime_prezime"];
	}
    
    /**************************************************************************/
    /**
     * CheckPassword
     *
     * @return bool
	 */
    public function CheckPassword()
    {
        $password        = $_POST['user']['password'];
        $repeat_password = $_POST['user']['repeat_password'];

        if($password == $repeat_password)
        {
            return true;
        }
        return false;
    }

	public function ProfilePictureExistsForUser($id) {
		$query = "SELECT img
			  FROM users
			  WHERE users.id = '$id'";

		$db = MysqlDB::getInstance();
		$result = $db->Query($query);
		$row = $db->Fetch($result);

		return $row["img"];
	}
}