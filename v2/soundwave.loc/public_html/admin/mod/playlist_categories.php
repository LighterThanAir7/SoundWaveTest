<?php

################################################################################
# ime   : genres.php
# opis  : Class for administration of playlist categories
# autor : Benjamin Babić
# datum : 13/08/2023
################################################################################

echo '
<div class="row">
    <div class="col">
        <h1>Genres</h1>
    </div>
</div>';

$do = $_GET["do"] ?? '';

switch ($do) {
	// =========================================================================
	// CASE: new
	// =========================================================================

	case 'new':
		$playlist_categories = new PlaylistCategories();

		if (isset($_GET["task"]) && $_GET["task"] === "edit") {
			$id_playlist_category = $_GET["ID"];
			$playlist_category = $playlist_categories->getById($id_playlist_category);

			$title = "Edit Playlist Category";

			$btn = "btn_edit";
		} else {
			$playlist_category = array();

			$id_playlist_category = NULL;

			$title = "New Playlist Category";
			$playlist_category["name"] = "";
			$playlist_category["img"] = "";

			$playlist_category["created_on"] = "";
			$playlist_category["created_by"] = "";

			$btn = "btn_save";
		}

		echo '
        <div class="row">
            <div class="col">
                <h2>' . $title . '</h2>
            </div>
        </div>';

		echo '
        <div class="row">
            <div class="col-5">
                <form id="editorjs-frm" method="POST" action="index.php?what=playlist_categories&do=save" enctype="multipart/form-data">
                   
                    <div class="mb-3">
                        <label for="name" class="form-label">Name</label>
                        <input type="text" id="name" class="form-control form-control-sm" name="playlist_category[name]" value="' . $playlist_category["name"] . '" required>                             
                    </div>
                    
                    <div class="mb-3">
						<label for="img" class="form-label">Image</label>
						<input id="img" type="file" name="F1" class="form-control" value="' . $playlist_category["img"] . '">                              
					</div>
                    
					<div class="mb-3">';

		if ($playlist_category["img"] != "" && file_exists($playlist_category["img"])) {
			echo '<img src="' . $playlist_category["img"] . '" border="0" width="150px" class="img-thumbnail" alt="genre_img">';
		} else {
			echo '<p>No playlist category images have been uploaded yet</p>';
		}
		echo '
					</div>
                    
                    <br>
                    <div class="d-grid gap-2">
                        <button type="submit" class="btn btn-primary" name="' . $btn . '" id="editorjs-btn-save">Save</button>
                        <a href="index.php?what=playlist_categories" class="btn btn-danger">Cancel</a>
                        <input type="hidden" name="update_id" value="' . $id_playlist_category . '">
                    </div>           
                </form>
            </div>
        </div>';
		break;

	case 'save':

		if (isset($_GET["ID"])) {
			$id_playlist_category = (int)$_GET["ID"];
		} else {
			$id_playlist_category = NULL;
		}

		if (isset($_POST["btn_save"], $_POST["playlist_category"])) {
			$playlist_categories = new PlaylistCategories();
			if ($playlist_categories->Save($_POST["playlist_category"], $_FILES)) {
				echo '
				<div class="alert alert-success" role="alert">
					<i class="fas fa-check-circle"></i> Data has been successfully saved. <a href="index.php?what=playlist_categories">Return</a>
				</div>';
			} else {
				echo '
				<div class="alert alert-danger" role="alert">
					<i class="fas fa-exclamation-circle"></i> There has been an error while saving data. Try again. <a href="index.php?what=playlist_categories&do=new">Return</a>
				</div>';
			}
		}

		if (isset($_POST["btn_edit"])) {
			$playlist_categories = new PlaylistCategories();

			$update_id = $_POST["update_id"];

			if ($update_id > 0) {
				if ($playlist_categories->Edit($update_id, $_POST["playlist_category"], $_FILES)) {
					echo '
                    <div class="alert alert-success" role="alert">
                        <i class="fas fa-check-circle"></i> Data has been successfully edited. <a href="index.php?what=playlist_categories">Return</a>
                    </div>';
				} else {
					echo '
                    <div class="alert alert-danger" role="alert">
                        <i class="fas fa-exclamation-circle"></i> There has been an error while editing data. Try again. <a href="index.php?what=playlist_categories&do=new&task=edit&ID=' . $update_id . '">Return</a>
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
		$playlist_categories = new PlaylistCategories();

		if (isset($_GET["act"])) {
			$id_playlist_category = (int)$_GET["ID"];

			if ($_GET["act"] === "del") {
				$query_del = "DELETE FROM playlist_categories WHERE id = '$id_playlist_category'";

				// delete from music_genres img folder
				$existing_img = $playlist_categories->PlaylistCategoryPictureExistsForUser($id_playlist_category);

				if ($existing_img !== null) {
					unlink($existing_img);
				}

				$result_del = $db->Query($query_del);
			} else {
				$status = ($_GET["act"] === "deakt") ? 0 : 1;
				$playlist_categories->Edit($id_playlist_category, array("status" => $status), $_FILES);
			}
		}

		echo '
		<div class="row">
			<div class="col">
			</div>
			<div class="col">
			</div>
			<div class="col text-end mb-3">
				<a href="index.php?what=playlist_categories&do=new" class="btn btn-primary"><i class="far fa-plus-square"></i> Add new playlist category</a>
			</div>
			
			<br>
			
			<div class="row">
				<div class="col">';
				$list = $playlist_categories->List();

				echo '
				<table class="table table-sm table-striped table-hover table-bordered table-responsive">
					<thead>
						<tr class="text-center">
							<th scope="col">ID</th>
							<th scope="col">Playlist Category Name</th>
							<th scope="col">Playlist Category Img</th>
							<th scope="col">Created on</th>
							<th scope="col">Created by</th>
							<th scope="col">Action</th>
						</tr>
					</thead>
					<tbody>';
					if (is_array($list)) {
						foreach ($list as $id => $playlist_category) {
							echo '
							<tr class="text-center align-middle">
								<th scope="row">' . $id . '</th>
								<td>' . $playlist_category["name"] . '</td>
								<td><img src="' . $playlist_category["img"] . '" border="0" width="100px" class="img-thumbnail" alt="genre_img"></td>
								<td class="text-center">' . $playlist_category["created_on"] . '</td>
								<td class="text-center">' . $playlist_category["created_by"] . '</td>
								<td class="">
									<div class="btn-group">
										<button type="button" class="btn btn-sm btn-primary dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">';
										echo ($playlist_category["status"]) ? '<i class="fas fa-cog"></i>' : '<i class="fas fa-lock"></i>';
										echo '
										</button>
										<ul class="dropdown-menu dropdown-menu-dark dropdown-menu-lg-end">
											<li><a class="dropdown-item" href="index.php?what=playlist_categories&do=new&task=edit&ID=' . $id . '"><i class="fas fa-edit"></i> Edit</a></li>';
										if ($playlist_category["status"]) {
											echo '<li><a class="dropdown-item" href="index.php?what=playlist_categories&act=deakt&ID=' . $id . '"><i class="fas fa-lock-open"></i> Deactivate</a></li>';
										} else {
											echo '<li><a class="dropdown-item" href="index.php?what=playlist_categories&act=act&ID=' . $id . '"><i class="fas fa-lock"></i> Activate</a></li>';
										}
										echo '
										<li><a class="dropdown-item" href="index.php?what=playlist_categories&act=del&ID=' . $id . '" onclick="return confirm(\'Are you sure?\')"><i class="fas fa-trash-alt"></i> Delete</a></li>
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
