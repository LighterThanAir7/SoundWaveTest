<?php

################################################################################
# ime   : songs.php
# opis  : Tool for song administration
# autor : Benjamin Babić
# datum : 07/06/2023
################################################################################

include 'sw-config/env.php';

echo '
<div class="row">
    <div class="col">
        <h1>Songs</h1>
    </div>
</div>';

$do = $_GET["do"] ?? '';

switch ($do) {
	// =========================================================================
	// CASE: new
	// =========================================================================

	case 'new':
		$songs  = new Songs();

		if(isset($_GET["task"]) && $_GET["task"] === "edit") {
			$id_song = $_GET["ID"];
			$song = $songs->getById($id_song);
			
			$song["released_on"] = date("Y-m-d", strtotime($song["released_on"]));

			$duration_time = explode(":", $song["duration"]);
			
			$duration_m = $duration_time[0];
			$duration_s = $duration_time[1];
			
			$title = "Edit song";
			$btn = "btn_edit";

			echo '
			<div class="row">
				<div class="col">
					<h2>'.$title.'</h2>
				</div>
			</div>';

			echo '
			<form id="editorjs-frm" method="POST" action="index.php?what=songs&do=save">
				<div class="row">
					<div class="col-6">
						   
						<div class="mb-3">
							<label for="title" class="form-label">Song name</label>
							<input type="text" id="title" class="form-control form-control-sm" name="song[title]" value="'.$song["title"].'" required>                             
						</div>
						
						<div class="mb-3">
							<label for="artist" class="form-label">Artist</label>
							<input type="text" id="artist" class="form-control form-control-sm" name="song[main_artist]" value="'.$song["main_artist"].'" required>    
						</div>
						
						<div class="mb-3">
							<label for="album" class="form-label">Album</label>
							<input type="text" id="album" class="form-control form-control-sm" name="song[album]" value="'.$song["album"].'" required>    
						</div>
						
						<div class="row align-items-center">
							<div class="col-4">
								<label for="duration" class="form-label">Duration: </label>                      
		
								<select class="form-select-sm" name="song[duration][m]" id="m_from">';

								for ($h = 0; $h < 60; $h++)
								{
									$minute = sprintf("%0d", $h);

									if ($minute == $duration_m)
									{
										$selected = 'selected="selected"';
									}
									else
									{
										$selected = "";
									}

									echo '<option value="'.$minute.'" '.$selected.'>'.$minute.'</option>';
								}

								echo '
								</select> 
								<select class="form-select-sm" name="song[duration][s]" id="s_from">';

								for ($h = 0; $h < 60; $h++)
								{
									$second = sprintf("%02d", $h);

									if ($second == $duration_s)
									{
										$selected = 'selected="selected"';
									}
									else
									{
										$selected = "";
									}

									echo '<option value="'.$second.'" '.$selected.'>'.$second.'</option>';
								}

								echo '
								</select>     
							</div>         
						
						
							<div class="col-8">
								<div class="mb-3">
									<label for="released_on" class="form-label">Released on</label>
									<input type="date" id="duration" class="form-control form-control-sm" name="song[released_on]" value="'.$song["released_on"].'" required>                              
								</div>
							</div>
						</div>
						
						<div class="mb-3">
							<label for="lyrics" class="form-label">Lyrics</label>
							<textarea type="text" id="lyrics" class="form-control form-control-sm" name="song[lyrics]">'.$song["lyrics"].'</textarea>                         
						</div>

						<br>
						<div class="d-grid gap-2">
							<button type="submit" class="btn btn-primary" name="'.$btn.'" id="editorjs-btn-save">Save</button>
							<a href="index.php?what=songs" class="btn btn-danger">Cancel</a>
							<input type="hidden" name="update_id" value="'.$id_song.'">
						</div>           
					</div>
				</div>
			</form>';

		} else if(isset($_GET["task"]) && $_GET["task"] === "import") {
			$song = array();
			$id_song = NULL;

			$song["song_path"] = "";
			$title = "New song";
			$btn = "btn_import";
			echo '
			<div class="row">
				<div class="col">
					<h2>'.$title.'</h2>
				</div>
			</div>

			<form class="col-6" id="editorjs-frm" method="POST" action="index.php?what=songs&do=save">

				<div class="mb-3">
					<label for="song_path" class="form-label">Enter folder path for songs to import</label>
					<input type="text" placeholder="C:\my_folder\songs_to_impot" id="song_path" class="form-control form-control-sm" name="song[song_path]" value="'.$song["song_path"].'" required>                              
				</div>
				
				<br>
				<div class="d-grid gap-2">
					<button type="submit" class="btn btn-primary" name="'.$btn.'" id="editorjs-btn-save">Save</button>
					<a href="index.php?what=songs" class="btn btn-danger">Cancel</a>
					<input type="hidden" name="update_id" value="'.$id_song.'">
				</div>    
			</form>';
		}

	break;

	// =========================================================================
	// CASE: save - za spremanje podataka
	// =========================================================================

	case 'save':

		if (isset($_GET["ID"])) {
			$id_service = (int)$_GET["ID"];
		} else {
			$id_service = NULL;
		}

		if (isset($_POST["btn_save"], $_POST["song"])) {
			$songs = new Songs();
			if ($songs->Save($_POST["song"])) {
				echo '
				<div class="alert alert-success" role="alert">
					<i class="fas fa-check-circle"></i> Data has been successfully saved. <a href="index.php?what=songs">Return</a>
				</div>';
			} else {
				echo '
				<div class="alert alert-danger" role="alert">
					<i class="fas fa-exclamation-circle"></i> There has been an error while saving data. Try again. <a href="index.php?what=songs&do=new">Return</a>
				</div>';
			}
		}

		if (isset($_POST["btn_import"], $_POST["song"])) {
			$songs = new Songs();
			if ($songs->Import($_POST["song"])) {
				echo '
				<div class="alert alert-success" role="alert">
					<i class="fas fa-check-circle"></i> Data has been successfully imported. <a href="index.php?what=songs">Return</a>
				</div>';
			} else {
				echo '
				<div class="alert alert-danger" role="alert">
					<i class="fas fa-exclamation-circle"></i> There has been an error while importing data. Try again. <a href="index.php?what=songs&do=new&task=import">Return</a>
				</div>';
			}
		}

		if (isset($_POST["btn_edit"]))
		{
			$songs = new Songs();

			$update_id = $_POST["update_id"];

			if ($update_id > 0)
			{
				if($songs->Edit($update_id, $_POST["song"]))
				{
					echo '
                    <div class="alert alert-success" role="alert">
                        <i class="fas fa-check-circle"></i> Data has been successfully edited. <a href="index.php?what=songs">Return</a>
                    </div>';
				}
				else
				{
					echo '
                    <div class="alert alert-danger" role="alert">
                        <i class="fas fa-exclamation-circle"></i> There has been an error while editing data. Try again. <a href="index.php?what=songs&do=new&task=edit&ID='.$update_id.'">Return</a>
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
		$songs = new Songs();

		if(isset($_GET["act"]))
		{
			$id_song = (int)$_GET["ID"];

			if($_GET["act"] === "del")
			{
				$query_del = "DELETE FROM songs WHERE id = '$id_song'";

				$existing_song = $songs->SongPathExistsForSong($id_song);
				if ($existing_song !== null) {
					unlink($existing_song);
				}

				$result_del = $db->Query($query_del);
			}
			else {
				$status = ($_GET["act"] === "deakt") ? 0 : 1;
				$songs->Edit($id_song, array("status" => $status));
			}
		}

		echo '
		<div class="row">
			<div class="col">
			</div>
			<div class="col">
			</div>
			<div class="col text-end mb-3">
				<a href="index.php?what=songs&do=new&task=import" class="btn btn-primary"><i class="far fa-plus-square"></i> Import songs</a>
			</div>
			
			<br>
			
			<div class="row">
				<div class="col">';
				$list = $songs->List();

				echo '
				<table class="table table-sm table-striped table-hover table-bordered table-responsive">
					<thead>
						<tr>
							<th class="px-2" scope="col">ID</th>
							<th class="px-2" scope="col">Title</th>
							<th class="px-2" scope="col">Artist</th>
							<th class="px-2" scope="col">Collaborating Artists</th>
							<th class="px-2" scope="col">Album</th>
							<th class="px-2 text-center" scope="col">Duration</th>
							<th class="px-2 text-center" scope="col">Genre</th>
							<th class="px-2 text-center text-nowrap" scope="col">Released on</th>
							<th class="px-2" scope="col">Lyrics</th>
							<th scope="col">Artwork</th>
							<th class="px-2" scope="col">Action</th>
						</tr>
					</thead>
					<tbody>';
					if(is_array($list))
					{
						foreach($list as $id => $song)
						{
							echo '
							<tr class="align-middle">
								<th class="text-center" scope="row">'.$id.'</th>
								<td class="px-2">'.$song["title"].'</td>
								<td class="px-2">'.$song["main_artist"].'</td>
								<td class="px-2">'.$song["collaborating_artists"].'</td>
								<td class="px-2">'.$song["album"].'</td>
								<td class="text-center">'.$song["duration"].'</td>
								<td class="text-center">'.$song["genre_names"].'</td>
								<td class="text-center">'.$song["released_on"].'</td>
								<td>'.$song["lyrics"].'</td>
								<td class="text-center"><img width="40" height="40px" src="'.SITE_URL.'admin/doc/artworks/50x50/'.$song["filename"].'" alt="'.$song["title"].'"></td>
								<td>
									<div class="btn-group">
										<button type="button" class="btn btn-sm btn-primary dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">';
										echo ($song["status"]) ? '<i class="fas fa-cog"></i>' : '<i class="fas fa-lock"></i>';
										echo '
										</button>
										<ul class="dropdown-menu dropdown-menu-dark dropdown-menu-lg-end">
											<li><a class="dropdown-item" href="index.php?what=songs&do=new&task=edit&ID='.$id.'"><i class="fas fa-edit"></i> Edit</a></li>';
												if($song["status"]) {
													echo '<li><a class="dropdown-item" href="index.php?what=songs&act=deakt&ID=' . $id . '"><i class="fas fa-lock-open"></i> Deactivate</a></li>';
												}
												else {
													echo '<li><a class="dropdown-item" href="index.php?what=songs&act=act&ID=' . $id . '"><i class="fas fa-lock"></i> Activate</a></li>';
												}
												echo '
											<li><a class="dropdown-item" href="index.php?what=songs&act=del&ID='.$id.'" onclick="return confirm(\'Are you sure?\')"><i class="fas fa-trash-alt"></i> Delete</a></li>
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