<?php

################################################################################
# ime   : albums.php
# opis  : Tool for administration of albums
# autor : Benjamin Babić
# datum : 07/06/2023
################################################################################

echo '
<div class="row">
    <div class="col">
        <h1>Albums</h1>
    </div>
</div>';

$do = $_GET["do"] ?? '';

switch ($do) {
	// =========================================================================
	// CASE: new
	// =========================================================================

	case 'new':
		$albums = new Albums();
		if(isset($_GET["task"]) && $_GET["task"] === "edit") {
			$id_album = $_GET["ID"];
			$album = $albums->getById($id_album);

			$title = "Edit album";

			$btn = "btn_edit";
		} else {
			$song = array();

			$id_album = NULL;

			$title = "New album";
			$album["name"] 					= "";

			$album["created_on"] 			= "";
			$album["created_by"] 			= "";

			$btn = "btn_save";
		}

		echo '
        <div class="row">
            <div class="col">
                <h2>'.$title.'</h2>
            </div>
        </div>';

		echo '
        <div class="row">
            <div class="col-5">
                <form id="editorjs-frm" method="POST" action="index.php?what=albums&do=save" enctype="multipart/form-data">
                   
                    <div class="mb-3">
                        <label for="name" class="form-label">Album name</label>
                        <input type="text" id="name" class="form-control form-control-sm" name="album[name]" value="'.$album["name"].'" required>                             
                    </div>
					
                    <div class="d-grid gap-2">
                        <button type="submit" class="btn btn-primary" name="'.$btn.'" id="editorjs-btn-save">Save</button>
                        <a href="index.php?what=albums" class="btn btn-danger">Cancel</a>
                        <input type="hidden" name="update_id" value="'.$id_album.'">
                    </div>           
                </form>
            </div>
        </div>';
	break;

	// =========================================================================
	// CASE: save - za spremanje podataka
	// =========================================================================

	case 'save':

		if (isset($_GET["ID"])) {
			$id_album = (int)$_GET["ID"];
		} else {
			$id_album = NULL;
		}

		if (isset($_POST["btn_save"], $_POST["album"])) {
			$albums = new Albums();
			if ($albums->Save($_POST["album"], $_FILES)) {
				echo '
				<div class="alert alert-success" role="alert">
					<i class="fas fa-check-circle"></i> Data has been successfully saved. <a href="index.php?what=albums">Return</a>
				</div>';
			} else {
				echo '
				<div class="alert alert-danger" role="alert">
					<i class="fas fa-exclamation-circle"></i> There has been an error while saving data. Try again. <a href="index.php?what=albums&do=new">Return</a>
				</div>';
			}
		}

		if (isset($_POST["btn_edit"]))
		{
			$albums = new Albums();

			$update_id = $_POST["update_id"];

			if ($update_id > 0)
			{
				if($albums->Edit($update_id, $_POST["album"]))
				{
					echo '
                    <div class="alert alert-success" role="alert">
                        <i class="fas fa-check-circle"></i> Data has been successfully edited. <a href="index.php?what=albums">Return</a>
                    </div>';
				}
				else
				{
					echo '
                    <div class="alert alert-danger" role="alert">
                        <i class="fas fa-exclamation-circle"></i> There has been an error while editing data. Try again. <a href="index.php?what=albums&do=new&task=edit&ID='.$update_id.'">Return</a>
                    </div>';
				}
			}
		}

	break;

	// =========================================================================
	// DEFAULT
	// =========================================================================

	default:
		$db = MysqlDB::getInstance();
		$albums = new Albums();

		if(isset($_GET["act"]))
		{
			$id_album = (int)$_GET["ID"];

			if($_GET["act"] === "del")
			{
				$query_del = "DELETE FROM albums WHERE id = '$id_album'";
				$result_del = $db->Query($query_del);
			}
			else {
				$status = ($_GET["act"] === "deakt") ? 0 : 1;
				$albums->Edit($id_album, array("status" => $status));
			}
		}

		echo '
		<div class="row">
			<div class="col">
			</div>
			<div class="col">
			</div>
			<div class="col text-end mb-3">
				<a href="index.php?what=albums&do=new" class="btn btn-primary"><i class="far fa-plus-square"></i> Add new album</a>
			</div>
			
			<br>
			
			<div class="row">
				<div class="col">';
				$list = $albums->List();

				echo '
				<table class="table table-sm table-striped table-hover table-bordered table-responsive">
					<thead>
						<tr>
							<th class="text-center" scope="col">ID</th>
							<th class="px-2" scope="col">Album name</th>
							<th class="text-center" scope="col">Created on</th>
							<th class="text-center" scope="col">Created by</th>
							<th class="text-center" scope="col">Action</th>
						</tr>
					</thead>
					<tbody>';
					if(is_array($list))
					{
						foreach($list as $id => $album)
						{
							echo '
							<tr>
								<th class="text-center" scope="row">'.$id.'</th>
								<td class="px-2">'.$album["name"].'</td>  
								<td class="text-center">'.$album["created_on"].'</td>  
								<td class="text-center">'.$album["created_by"].'</td>  
								<td class="text-center">
									<div class="btn-group">
										<button type="button" class="btn btn-sm btn-primary dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">';
										echo ($album["status"]) ? '<i class="fas fa-cog"></i>' : '<i class="fas fa-lock"></i>';
										echo '
										</button>
										<ul class="dropdown-menu dropdown-menu-dark dropdown-menu-lg-end">
											<li><a class="dropdown-item" href="index.php?what=albums&do=new&task=edit&ID='.$id.'"><i class="fas fa-edit"></i> Edit</a></li>';
										if($album["status"]) {
											echo '<li><a class="dropdown-item" href="index.php?what=albums&act=deakt&ID=' . $id . '"><i class="fas fa-lock-open"></i> Deactivate</a></li>';
										}
										else {
											echo '<li><a class="dropdown-item" href="index.php?what=albums&act=act&ID=' . $id . '"><i class="fas fa-lock"></i> Activate</a></li>';
										}
										echo '
											<li><a class="dropdown-item" href="index.php?what=albums&act=del&ID='.$id.'" onclick="return confirm(\'Are you sure?\')"><i class="fas fa-trash-alt"></i> Delete</a></li>
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