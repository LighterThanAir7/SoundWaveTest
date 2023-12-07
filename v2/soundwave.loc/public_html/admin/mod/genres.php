<?php

################################################################################
# ime   : genres.php
# opis  : Class for administration of genres
# autor : Benjamin Babić
# datum : 07/06/2023
################################################################################

echo '
<div class="row">
    <div class="col">
        <h1>Genres</h1>
    </div>
</div>';

$do = $_GET["do"] ?? '';

switch ($do)
{
	// =========================================================================
	// CASE: new
	// =========================================================================

	case 'new':
		$genres  = new Genres();

		if(isset($_GET["task"]) && $_GET["task"] === "edit") {
			$id_genre = $_GET["ID"];
			$genre = $genres->getById($id_genre);

			$title = "Edit genre";

			$btn = "btn_edit";
		} else {
			$genre = array();

			$id_genre = NULL;

			$title = "New genre";
			$genre["name"] = "";
			$genre["img"]  = "";

			$genre["created_on"] 	= "";
			$genre["created_by"] 	= "";

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
                <form id="editorjs-frm" method="POST" action="index.php?what=genres&do=save" enctype="multipart/form-data">
                   
                    <div class="mb-3">
                        <label for="name" class="form-label">Name</label>
                        <input type="text" id="name" class="form-control form-control-sm" name="genre[name]" value="'.$genre["name"].'" required>                             
                    </div>
                    
                    <div class="mb-3">
						<label for="img" class="form-label">Image</label>
						<input id="img" type="file" name="F1" class="form-control" value="'.$genre["img"].'">                              
					</div>
                    
					<div class="mb-3">';

					if($genre["img"] != "" && file_exists($genre["img"]))
					{
						echo '<img src="'.$genre["img"].'" border="0" width="150px" class="img-thumbnail" alt="genre_img">';
					} else {
						echo '<p>No genre image have been uploaded yet</p>';
					}
					echo '
					</div>
                    
                    <br>
                    <div class="d-grid gap-2">
                        <button type="submit" class="btn btn-primary" name="'.$btn.'" id="editorjs-btn-save">Save</button>
                        <a href="index.php?what=genres" class="btn btn-danger">Cancel</a>
                        <input type="hidden" name="update_id" value="'.$id_genre.'">
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

		if (isset($_POST["btn_save"], $_POST["genre"])) {
			$genres = new Genres();
			if ($genres->Save($_POST["genre"], $_FILES)) {
				echo '
				<div class="alert alert-success" role="alert">
					<i class="fas fa-check-circle"></i> Data has been successfully saved. <a href="index.php?what=genres">Return</a>
				</div>';
			} else {
				echo '
				<div class="alert alert-danger" role="alert">
					<i class="fas fa-exclamation-circle"></i> There has been an error while saving data. Try again. <a href="index.php?what=genres&do=new">Return</a>
				</div>';
			}
		}

		if (isset($_POST["btn_edit"]))
		{
			$genres = new Genres();

			$update_id = $_POST["update_id"];

			if ($update_id > 0)
			{
				if($genres->Edit($update_id, $_POST["genre"], $_FILES))
				{
					echo '
                    <div class="alert alert-success" role="alert">
                        <i class="fas fa-check-circle"></i> Data has been successfully edited. <a href="index.php?what=genres">Return</a>
                    </div>';
				}
				else
				{
					echo '
                    <div class="alert alert-danger" role="alert">
                        <i class="fas fa-exclamation-circle"></i> There has been an error while editing data. Try again. <a href="index.php?what=genres&do=new&task=edit&ID='.$update_id.'">Return</a>
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
		$genres = new Genres();

		if(isset($_GET["act"]))
		{
			$id_genre = (int)$_GET["ID"];

			if($_GET["act"] === "del")
			{
				$query_del = "DELETE FROM music_genres WHERE id = '$id_genre'";

				// delete from music_genres img folder
				$existing_img = $genres->GenrePictureExistsForUser($id_genre);

				if ($existing_img !== null) {
					unlink($existing_img);
				}

				$result_del = $db->Query($query_del);
			}
			else {
				$status = ($_GET["act"] === "deakt") ? 0 : 1;
				$genres->Edit($id_genre, array("status" => $status), $_FILES);
			}
		}

		echo '
		<div class="row">
			<div class="col">
			</div>
			<div class="col">
			</div>
			<div class="col text-end mb-3">
				<a href="index.php?what=genres&do=new" class="btn btn-primary"><i class="far fa-plus-square"></i> Add new genre</a>
			</div>
			
			<br>
			
			<div class="row">
				<div class="col">';
				$list = $genres->List();

				echo '
				<table class="table table-sm table-striped table-hover table-bordered table-responsive">
					<thead>
						<tr class="text-center">
							<th scope="col">ID</th>
							<th scope="col">Album name</th>
							<th scope="col">Artwork img</th>
							<th scope="col">Created on</th>
							<th scope="col">Created by</th>
							<th scope="col">Action</th>
						</tr>
					</thead>
					<tbody>';
					if(is_array($list))
					{
						foreach($list as $id => $genre)
						{
							echo '
							<tr class="text-center align-middle">
								<th scope="row">'.$id.'</th>
								<td>'.$genre["name"].'</td>
								<td><img src="'.$genre["img"].'" border="0" width="100px" class="img-thumbnail" alt="genre_img"></td>
								<td class="text-center">'.$genre["created_on"].'</td>
								<td class="text-center">'.$genre["created_by"].'</td>
								<td class="">
									<div class="btn-group">
										<button type="button" class="btn btn-sm btn-primary dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">';
										echo ($genre["status"]) ? '<i class="fas fa-cog"></i>' : '<i class="fas fa-lock"></i>';
										echo '
										</button>
										<ul class="dropdown-menu dropdown-menu-dark dropdown-menu-lg-end">
											<li><a class="dropdown-item" href="index.php?what=genres&do=new&task=edit&ID='.$id.'"><i class="fas fa-edit"></i> Edit</a></li>';
											if($genre["status"]) {
												echo '<li><a class="dropdown-item" href="index.php?what=genres&act=deakt&ID=' . $id . '"><i class="fas fa-lock-open"></i> Deactivate</a></li>';
											}
											else {
												echo '<li><a class="dropdown-item" href="index.php?what=genres&act=act&ID=' . $id . '"><i class="fas fa-lock"></i> Activate</a></li>';
											}
											echo '
											<li><a class="dropdown-item" href="index.php?what=genres&act=del&ID='.$id.'" onclick="return confirm(\'Are you sure?\')"><i class="fas fa-trash-alt"></i> Delete</a></li>
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