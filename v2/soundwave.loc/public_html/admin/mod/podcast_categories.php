<?php

################################################################################
# ime   : podcast_categories.php
# opis  : Class for administration of podcasts
# autor : Benjamin Babić
# datum : 12/08/2023
################################################################################

echo '
<div class="row">
    <div class="col">
        <h1>Podcast Categories</h1>
    </div>
</div>';

$do = $_GET["do"] ?? '';

switch ($do) {
	// =========================================================================
	// CASE: new
	// =========================================================================

	case 'new':
		$podcasts = new PodcastCategories();

		if (isset($_GET["task"]) && $_GET["task"] === "edit") {
			$id_podcast_category = $_GET["ID"];
			$podcast_category = $podcasts->getById($id_podcast_category);

			$title = "Edit podcast category";

			$btn = "btn_edit";
		} else {
			$podcast_category = array();

			$id_podcast_category = NULL;

			$title = "New podcast category";
			$podcast_category["name"] = "";
			$podcast_category["img"] = "";
			$podcast_category["created_on"] = "";
			$podcast_category["created_by"] = "";

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
                <form id="editorjs-frm" method="POST" action="index.php?what=podcasts&do=save" enctype="multipart/form-data">
                   
                    <div class="mb-3">
                        <label for="name" class="form-label">Name</label>
                        <input type="text" id="name" class="form-control form-control-sm" name="podcast_category[name]" value="'.$podcast_category["name"].'" required>                             
                    </div>
                    
                    <div class="mb-3">
						<label for="img" class="form-label">Image</label>
						<input id="img" type="file" name="F1" class="form-control" value="'.$podcast_category["img"].'">                              
					</div>
                    
					<div class="mb-3">';

						if ($podcast_category["img"] != "" && file_exists($podcast_category["img"])) {
							echo '<img src="'.$podcast_category["img"].'" border="0" width="150px" class="img-thumbnail" alt="podcast_category_img">';
						} else {
							echo '<p>No podcast category images have been uploaded yet</p>';
						}
						echo '
					</div>
				
					<br>
					<div class="d-grid gap-2">
						<button type="submit" class="btn btn-primary" name="' . $btn . '" id="editorjs-btn-save">Save</button>
						<a href="index.php?what=podcast_categories" class="btn btn-danger">Cancel</a>
						<input type="hidden" name="update_id" value="'.$id_podcast_category.'">
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
			$id_podcast = (int)$_GET["ID"];
		} else {
			$id_podcast = NULL;
		}

		if (isset($_POST["btn_save"], $_POST["podcast_category"])) {
			$podcast_categories = new PodcastCategories();
			if ($podcast_categories->Save($_POST["podcast_category"], $_FILES)) {
				echo '
				<div class="alert alert-success" role="alert">
					<i class="fas fa-check-circle"></i> Data has been successfully saved. <a href="index.php?what=podcast_categories">Return</a>
				</div>';
			} else {
				echo '
				<div class="alert alert-danger" role="alert">
					<i class="fas fa-exclamation-circle"></i> There has been an error while saving data. Try again. <a href="index.php?what=podcast_categories&do=new">Return</a>
				</div>';
			}
		}

		if (isset($_POST["btn_edit"])) {
			$podcast_categories = new PodcastCategories();

			$update_id = $_POST["update_id"];

			if ($update_id > 0) {
				if ($podcast_categories->Edit($update_id, $_POST["podcast_category"], $_FILES)) {
					echo '
                    <div class="alert alert-success" role="alert">
                        <i class="fas fa-check-circle"></i> Data has been successfully edited. <a href="index.php?what=podcast_categories">Return</a>
                    </div>';
				} else {
					echo '
                    <div class="alert alert-danger" role="alert">
                        <i class="fas fa-exclamation-circle"></i> There has been an error while editing data. Try again. <a href="index.php?what=podcast_categories&do=new&task=edit&ID=' . $update_id . '">Return</a>
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
		$podcast_categories = new PodcastCategories();

		if (isset($_GET["act"])) {
			$id_podcast_category = (int)$_GET["ID"];

			if ($_GET["act"] === "del") {
				$query_del = "DELETE FROM podcast_categories WHERE id = '$id_podcast_category'";

				// delete from music_genres img folder
				$existing_img = $podcast_categories->PodcastPictureExistsForUser($id_podcast_category);

				if ($existing_img !== null) {
					unlink($existing_img);
				}

				$result_del = $db->Query($query_del);
			} else {
				$status = ($_GET["act"] === "deakt") ? 0 : 1;
				$podcast_categories->Edit($id_podcast_category, array("status" => $status), $_FILES);
			}
		}

		echo '
		<div class="row">
			<div class="col">
			</div>
			<div class="col">
			</div>
			<div class="col text-end mb-3">
				<a href="index.php?what=podcast_categories&do=new" class="btn btn-primary"><i class="far fa-plus-square"></i> Add new podcast category</a>
			</div>
			
			<br>
			
			<div class="row">
				<div class="col">';
				$list = $podcast_categories->List();

				echo '
				<table class="table table-sm table-striped table-hover table-bordered table-responsive">
					<thead>
						<tr class="text-center">
							<th scope="col">ID</th>
							<th scope="col">Podcast Category</th>
							<th scope="col">Podcast Category img</th>
							<th scope="col">Created on</th>
							<th scope="col">Created by</th>
							<th scope="col">Action</th>
						</tr>
					</thead>
					<tbody>';
					if (is_array($list)) {
						foreach ($list as $id => $podcast_category) {
							echo '
							<tr class="text-center align-middle">
								<th scope="row">' . $id . '</th>
								<td>' . $podcast_category["name"] . '</td>
								<td><img src="' . $podcast_category["img"] . '" border="0" width="100px" class="img-thumbnail" alt="podcasts_category_img"></td>
								<td class="text-center">' . $podcast_category["created_on"] . '</td>
								<td class="text-center">' . $podcast_category["created_by"] . '</td>
								<td class="">
									<div class="btn-group">
										<button type="button" class="btn btn-sm btn-primary dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">';
										echo ($podcast_category["status"]) ? '<i class="fas fa-cog"></i>' : '<i class="fas fa-lock"></i>';
										echo '
										</button>
										<ul class="dropdown-menu dropdown-menu-dark dropdown-menu-lg-end">
											<li><a class="dropdown-item" href="index.php?what=podcast_categories&do=new&task=edit&ID=' . $id . '"><i class="fas fa-edit"></i> Edit</a></li>';
										if ($podcast_category["status"]) {
											echo '<li><a class="dropdown-item" href="index.php?what=podcast_categories&act=deakt&ID=' . $id . '"><i class="fas fa-lock-open"></i> Deactivate</a></li>';
										} else {
											echo '<li><a class="dropdown-item" href="index.php?what=podcast_categories&act=act&ID=' . $id . '"><i class="fas fa-lock"></i> Activate</a></li>';
										}
										echo '
										<li><a class="dropdown-item" href="index.php?what=podcast_categories&act=del&ID=' . $id . '" onclick="return confirm(\'Are you sure?\')"><i class="fas fa-trash-alt"></i> Delete</a></li>
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