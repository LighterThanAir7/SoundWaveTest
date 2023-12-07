<?php

################################################################################
# ime   : Users
# opis  : Alat za administraciju Usera
# autor : Benjamin Babić
# datum : 12/02/2023
################################################################################

echo '
<div class="row">
    <div class="col">
        <h1>Users</h1>
    </div>
</div>';

$do = $_GET["do"] ?? '';

switch($do)
{
    // =========================================================================
    // CASE: new
    // =========================================================================

    case 'new':

        $users = new Users();

        if(isset($_GET["task"]) && $_GET["task"] === "edit")
        {
            $id_user = $_GET["ID"];
            $user = $users->getById($id_user);

			$user["date_birth"] = date("Y-m-d", strtotime($user["date_birth"]));

            $title = "Edit user data";
            $btn = "btn_edit";

			$tab_disabled = "";
        }
        else
        {
            $user = array();

            $id_user = NULL;
            $user["id_type"]        = "";
            $user["firstname"]      = "";
            $user["lastname"]       = "";
            $user["username"]       = "";
            $user["password"]       = "";
            $user["sex"]          	= "";
			$user["date_birth"]     = "";
			$user["img"]            = "";
			$user["init_password"]  = "";
			$user["last_login"]     = "";
			$user["path"]          	= "";
            $user["created_on"]     = "";
            $user["created_by"]     = "";
            $created_by_firstname   = "";
            $created_by_lastname    = "";
			$user["user_type_name"] = "";
			$user["partner_name"]   = "";

            $title = "Enter new user data";
            $btn = "btn_save";

			$tab_disabled = "disabled";
        }

        echo '
        <div class="row">
            <div class="col">
                <h2>'.$title.'</h2>
            </div>
        </div>';


		$tab_array = [
			"basic"    => "General",
			"picture"  => "Profile picture"
		];

		if(isset($_GET["tab"]) && $_GET["tab"] !== "")
		{
			$tab_active = $_GET["tab"];
		}
		else
		{
			$tab_active = "basic";
		}

		echo '
        <ul class="nav nav-tabs">';

		foreach($tab_array as $tab => $tab_title)
		{
			$active = ($tab_active === $tab) ? 'active' : '';

			$disabled = ($tab === "basic") ? '' : $tab_disabled; // prvi tab je uvijek aktivan

			if (isset($_GET["task"], $_GET["ID"])) {
				echo '
					<li class="nav-item">
						<a class="nav-link '.$active.' '.$disabled.'" href="index.php?what=users&do=new&tab='.$tab.'&task='.$_GET["task"].'&ID='.$_GET["ID"].'">'.$tab_title.'</a>
					</li>';
			} else {
				echo '
					<li class="nav-item">
						<a class="nav-link '.$active.' '.$disabled.'" href="index.php?what=users&do=new&tab='.$tab.'">'.$tab_title.'</a>
					</li>';
			}
		}

		echo '
        </ul>
        
        <br>';

		switch($tab_active) {
			// ===============================================================
			// Tab picture - za administraciju slike korisnika
			// ===============================================================
			case 'picture':

				$data = $user["img"];

				echo '
                <div class="row">
                    <div class="col-6">
        
                        <form id="" method="POST" action="index.php?what=users&do=save" enctype="multipart/form-data">
                        
                            <div class="mb-3">
                                <label for="name" class="form-label">Upload user picture</label>
                                <input type="file" name="F1" class="form-control" value="" />                              
                            </div>';

							echo '
                            <div class="d-grid gap-2">
                                <button type="submit" class="btn btn-primary" name="btn_save_user_img">Save</button>
                                <input type="hidden" name="update_id" value="' . $id_user . '">
                            </div>                
                        </form>
        
                    </div>
                </div>
                
				<br>
				<div class="row">
					<div class="col-6">';

				if ($data != "" && file_exists($data)) {
					echo '<img src="' . $data . '" border="0" width="250px" class="img-thumbnail" alt="user_img">';
				} else {
					echo '<p>User doesn\'t have profile picture yet</p>';
				}

				echo '</div>
				</div>';

			break;

			case 'basic':

				echo '
				<div class="row">
					<div class="col-6">
						
						<form id="editorjs-frm" method="POST" action="index.php?what=users&do=save" enctype="multipart/form-data">
					
				
							<div class="mb-3">
								<label for="id_type" class="form-label">User Type</label>
								<select class="form-control form-control-sm" id="id_type" name="user[id_type]" required>
									<option value="">Choose:</option>';

									$user_type_array = $users->GetUserTypes();

									foreach ($user_type_array as $id_type => $user_type) {
										if ($id_type == $user["id_type"]) {
											$sel = 'selected="selected"';
										} else {
											$sel = '';
										}

										echo '<option value="' . $id_type . '" ' . $sel . '>' . $user_type . '</option>';
									}
									echo '
								</select>
							</div>
				
							<div class="mb-3">
								<label for="name" class="form-label">Firstname</label>
								<input type="text" class="form-control form-control-sm" id="firstname" name="user[firstname]" value="' . $user["firstname"] . '" required>                                
							</div>   
							
							<div class="mb-3">
								<label for="name" class="form-label">Lastname</label>
								<input type="text" class="form-control form-control-sm" id="lastname" name="user[lastname]" value="' . $user["lastname"] . '" required>                                
							</div>   
							
							<div class="mb-3">
								<label for="name" class="form-label">Username</label>
								<input type="text" class="form-control form-control-sm" id="username" name="user[username]" value="' . $user["username"] . '" required>                                
							</div>
						</div>
						
						<div class="col-6">
							
							<div class="mb-3">
							<label for="sex" class="form-label">Sex</label>
							<br>';
							if ($id_user !== NULL)
							{
								$sex = $users->ListUserSex($id_user);
								echo '<input type="radio" name="user[sex]" value="male"';
								if ($sex == "male") {
									echo "checked";
								}
								echo '> Male</label>
										<input type="radio" name="user[sex]" value="female"';
								if ($sex == "female") {
									echo "checked";
								}
								echo '> Female</label>';
							} else {
								echo '
								<input type="radio" name="user[sex]" value="musko"> Male</label>
								<input type="radio" name="user[sex]" value="zensko"> Female</label>';
							}
							echo '
							</div>
							
							<div class="mb-3">
								<label for="phone" class="form-label">Date of Birth</label>
								<input type="date" class="form-control form-control-sm" id="date_birthdate_birth" name="user[date_birth]" value="' . $user["date_birth"] . '" required>                                
							</div>
						</div>
		
						<div class="col-12">
							<div class="d-grid gap-2">
								<button type="submit" class="btn btn-primary" name="' . $btn . '" id="editorjs-btn-save">Save</button>
								<a href="index.php?what=users" class="btn btn-danger">Cancel</a>
								<input type="hidden" name="update_id" value="' . $id_user . '">
							</div> 
						</div>       
					</form>
					</div>
				</div>';
			break;
		}
	break;

    // =========================================================================
    // CASE: save - za spremanje podataka
    // =========================================================================

    case 'save':
        if (isset($_POST["btn_save"], $_POST["user"])) {
			$users = new Users();

			if ($users->Save($_POST["user"]))
			{
				echo '
				<div class="alert alert-success" role="alert">
					<i class="fas fa-check-circle"></i> Data has been successfully saved. <a href="index.php?what=users">Return</a>
				</div>';
			}
			else
			{
				echo '
				<div class="alert alert-danger" role="alert">
					<i class="fas fa-exclamation-circle"></i> There has been an error while saving data. Try again. <a href="index.php?what=users&do=new">Return</a>
				</div>';
			}
		}

		if(isset($_POST["btn_save_user_img"]))
		{
			$update_id = $_POST["update_id"];

			$users = new Users();

			if($users->SaveImage($_FILES, $update_id))
			{
				echo '
                <div class="alert alert-success" role="alert">
                    <i class="fas fa-check-circle"></i> User image has been successfully uploaded to the server. <a href="index.php?what=users">Return</a>
                </div>';
			}
			else
			{
				echo '
                <div class="alert alert-danger" role="alert">
                    <i class="fas fa-exclamation-circle"></i> There has been an error while uploading user image to the server. Try again. <a href="index.php?what=users">Return</a>
                </div>';
			}
		}

		if(isset($_POST["btn_edit"]))
        {
            $users = new Users();

            $update_id = $_POST["update_id"];

            if($update_id > 0)
            {
                if($users->Edit($update_id, $_POST["user"]))
                {
                    echo '
                    <div class="alert alert-success" role="alert">
                        <i class="fas fa-check-circle"></i> Data has been successfully edited. <a href="index.php?what=users">Return</a>
                    </div>';
                }
                else
                {
                    echo '
                    <div class="alert alert-danger" role="alert">
                        <i class="fas fa-exclamation-circle"></i> There has been an error while editing data. Try again. <a href="index.php?what=users&do=new&task=edit&ID=">Return</a>
                    </div>';
                }
            }
        }

        if(isset($_POST["btn_edit_password"]))
        {
            $users = new Users();

            $update_id = $_POST["update_id"];

            if(isset($_GET["task"]) && $_GET["task"] === "edit_pass")
            {
                $check = $users->CheckPassword();
            }

            unset($_POST['user']['repeat_password']);

            if($users->Edit($update_id, $_POST["user"]) && $check == true)
            {
                echo '
                    <div class="alert alert-success" role="alert">
                        <i class="fas fa-check-circle"></i> Password has successfully been changed. <a href="index.php?what=users">Return</a>
                    </div>';
            }
            else
            {
                echo '
                    <div class="alert alert-danger" role="alert">
                        <i class="fas fa-exclamation-circle"></i> There has been an error while editing password. Try again. <a href="index.php?what=users&do=new_password&task=edit&ID='.$id_user.'">Return</a>
                    </div>';
            }
        }

    break;

    // =========================================================================
    // NEW PASSWORD
    // =========================================================================

    case 'new_password':

        $users = new Users();

        if(isset($_GET["task"]) && $_GET["task"] === "edit")
        {
            $id_user = $_GET["ID"];
            $user = $users->getById($id_user);

            $title = "Postavljanje nove lozinke";
            $btn = "btn_edit_password";
        }

        echo '
        <div class="row">
            <div class="col">
                <h2 class="mb-3">'.$title.'</h2>
            </div>
        </div>';

        echo '
        <div class="row">
            <div class="col-4">
                
                <form id="editorjs-frm" method="POST" action="index.php?what=users&do=save&task=edit_pass&ID='.$id_user.'">

                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input type="text" class="form-control form-control-sm" id="password" name="user[password]" value="" required>                                
                    </div>
                    
                    <div class="mb-3">
                        <label for="repeat_password" class="form-label">Repeat password</label>
                        <input type="text" class="form-control form-control-sm" id="repeat_password" name="user[repeat_password]" value="" required>                                
                    </div>

                    <div class="d-grid gap-2">
                        <button type="submit" class="btn btn-primary" name="'.$btn.'" id="editorjs-btn-save">Save</button>
                        <a href="index.php?what=users" class="btn btn-danger">Cancel</a>
                        <input type="hidden" name="update_id" value="'.$id_user.'">
                    </div>           
                </form>

            </div>
        </div>';
    
    break;

    // =========================================================================
    // DEFAULT
    // =========================================================================

    default:
		$db = MysqlDB::getInstance();
		$users = new Users();

		if(isset($_GET["act"]))
		{
			$id_user = (int)$_GET["ID"];

			if($_GET["act"] == "del")
			{
				$query_del = "DELETE FROM users WHERE id = '$id_user'";

				// delete from music_genres img folder
				$existing_img = $users->ProfilePictureExistsForUser($id_user);

				if ($existing_img !== null) {
					unlink($existing_img);
				}

				$result_del = $db->Query($query_del);
			}
			else
			{
				$status = ($_GET["act"] === "deakt") ? 0 : 1;

				$users->Edit($id_user, array("status" => $status));
			}
		}

		echo '
		<div class="row">
			<div class="col"></div>
			<div class="col"></div>
			<div class="col text-end mb-3">
				<a href="index.php?what=users&do=new" class="btn btn-primary"><i class="far fa-plus-square"></i> Add new user</a>
			</div>
			
			<br>
			
			<div class="row">
				<div class="col">';

				$list = $users->List("HR", "0,1");

				echo '
				<table class="table table-sm table-striped table-hover table-bordered table-responsive">
					<thead>
						<tr>
							<th class="text-center" scope="col">ID</th>
							<th scope="col">User Type</th>
							<th scope="col">Firstname</th>
							<th scope="col">Lastname</th>
							<th scope="col">Korisničko ime</th>
							<th scope="col">Sex</th>
							<th scope="col">Datum rođenja</th>
							<th scope="col">Slika</th>
							<th class="text-center" scope="col">Vrijeme unosa</th>
							<th scope="col">Unio</th>
							<th class="text-center" scope="col">Zadnja prijava</th>
							<th class="text-center" scope="col">Akcija</th>
						</tr>
					</thead>
					<tbody>';

						if(is_array($list))
						{
							foreach($list as $id => $user)
							{
								echo '
								<tr>
									<th class="text-center" scope="row">'.$id.'</th>
									<td>'.$user["user_type_name"].'</td>
									<td>'.$user["firstname"].'</td> 
									<td>'.$user["lastname"].'</td> 
									<td>'.$user["username"].'</td> 
									<td>'.$user["sex"].'</td>
									<td>'.$user["date_birth"].'</td>
									<td>'.$user["img"].'</td>
									<td class="text-center">'.$user["created_on"].'</td>
									<td>'.$user["created_by_firstname"].' '.$user["created_by_lastname"].'</td>
									<td class="text-center">'.$user["last_login"].'</td>
									<td class="text-center">
										<div class="btn-group">
											<button type="button" class="btn btn-sm btn-primary dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">';

											echo ($user["status"]) ? '<i class="fas fa-cog"></i>' : '<i class="fas fa-lock"></i>';

											echo '
											</button>
											<ul class="dropdown-menu dropdown-menu-dark dropdown-menu-lg-end">
												<li><a class="dropdown-item" href="index.php?what=users&do=new&task=edit&tab=basic&ID='.$id.'"><i class="fas fa-edit"></i> Uredi</a></li>
												<li><a class="dropdown-item" href="index.php?what=users&do=memberships&ID='.$id.'"><i class="fas fa-address-book"></i> Članarine</a></li>
												<li><a class="dropdown-item" href="index.php?what=users&do=new_password&task=edit&ID='.$id.'"><i class="fas fa-key"></i> Promjena lozinke</a></li>';

												if($user["status"]) {
													echo '<li><a class="dropdown-item" href="index.php?what=users&act=deakt&ID=' . $id . '"><i class="fas fa-lock-open"></i> Deaktiviraj</a></li>';
												}
												else {
													echo '<li><a class="dropdown-item" href="index.php?what=users&act=act&ID=' . $id . '"><i class="fas fa-lock"></i> Aktiviraj</a></li>';
												}
												echo '<li><a class="dropdown-item" href="index.php?what=users&act=del&ID='.$id.'" onclick="return confirm(\'Da li ste sigurni?\')"><i class="fas fa-trash-alt"></i> Obriši</a></li>';
												echo '
											</ul>
										</div>
									</td>
								</tr>';
							}
						}
					echo '
                </tbody>
            </table>
        </div>
    </div>';
}