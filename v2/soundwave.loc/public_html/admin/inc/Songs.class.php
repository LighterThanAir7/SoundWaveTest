<?php

################################################################################
# ime   : Songs.class.php
# opis  : Klasa za administriranje svih pjesama
# autor : Benjamin Babić
# datum : 06/06/2023
################################################################################

class Songs {
	/**************************************************************************/
	/**
	 * Return list of all available songs
	 *
	 * @param  int $status
	 * @param  array $search
	 * @return array
	 */

	public function List($status = 1, $search = NULL)
	{
		$db = MysqlDB::getInstance();
		$list_array = array();
		$query = "SELECT songs.id, 
       		songs.status,
       		songs.title,
       		songs.album, 
       		songs.duration,
       		songs.lyrics,
       		songs.song_path,
       		songs.filename,
       		songs.artwork_img,
       		songs.released_on,
       		a.name as main_artist,
       		GROUP_CONCAT(DISTINCT music_genres.name SEPARATOR  ', ') AS genre_names,
       		GROUP_CONCAT(DISTINCT artists.name SEPARATOR  ', ') AS collaborating_artists
		    FROM songs
		    LEFT JOIN song_genre ON songs.id = song_genre.song_id
			LEFT JOIN music_genres ON song_genre.genre_id = music_genres.id
		    LEFT JOIN collaborating_artists ON songs.id = collaborating_artists.song_id
			LEFT JOIN artists ON collaborating_artists.artist_id = artists.id
		    LEFT JOIN artists as a ON songs.artist_id = a.id
		    WHERE songs.status IN (".$status.")
		    GROUP BY songs.id";

		if (is_array($search) && count ($search) > 0)
		{
			if (isset($search["id"]) && $search["id"] > 0)
			{
				$query .= " AND songs.id = " . (int)$search["id"];
			}

			if (isset($search["title"]) && $search["title"] != "")
			{
				$query .= " AND songs.title LIKE " . $db->Clean($search["title"]);
			}
		}

		$query .= " ORDER BY songs.title ASC";
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
			$title 					= $row["title"];
			$main_artist            = $row["main_artist"];
			$album					= $row["album"];
			$duration				= $row["duration"];
			$lyrics					= $row["lyrics"];
			$song_path				= $row["song_path"];
			$filename				= $row["filename"];
			$artwork_img			= $row["artwork_img"];
			$released_on			= date("d.m.Y.", strtotime($row["released_on"]));
			$genre_names			= $row["genre_names"];
			$collaborating_artists	= $row["collaborating_artists"];
//			$created_by             = $row["created_by"];
//			$created_by_firstname   = $row["Created by - Firstname"];
//			$created_by_lastname    = $row["Created by - Lastname"];

			$list_array[$id]["status"] 		= $status;
			$list_array[$id]["title"] 		= $title;
			$list_array[$id]["main_artist"] = $main_artist;
			$list_array[$id]["album"] 		= $album;
			$list_array[$id]["duration"] 	= $duration;
			$list_array[$id]["lyrics"] 		= $lyrics;
			$list_array[$id]["song_path"]	= $song_path;
			$list_array[$id]["filename"]	= $filename;
			$list_array[$id]["artwork_img"] = $artwork_img;
			$list_array[$id]["released_on"] = $released_on;
			$list_array[$id]["genre_names"] = $genre_names;
			$list_array[$id]["collaborating_artists"]= $collaborating_artists;

//			$list_array[$id]["created_on"]              = $created_on;
//			$list_array[$id]["created_by"]              = $created_by;
//			$list_array[$id]["created_by_firstname"]    = $created_by_firstname;
//			$list_array[$id]["created_by_lastname"]     = $created_by_lastname;
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
		$x = new Artists();
		$album = new Albums();
		if(is_array($data))
		{
			$db = MysqlDB::getInstance();
//			$data["created_by"] = $_SESSION["user_id"];
//			$data["created_on"] = date("Y-m-d H:i:s");


			foreach ($data as $song) {

				// Provjera artista prilikom dodavanja u Artist tablicu
				$db_artist_array = $this->getArtistNames();
				$main_artist = $song["main_artist"][0]; // budući da je array...
				$collaborating_artists = $song["collaborating_artists"];

				print_r($main_artist);
				// Provjera za main artista
				if (!in_array($main_artist, $db_artist_array)) {
					$x->Save($main_artist);
				}

				// Provjera za collaborating artiste
				foreach ($collaborating_artists as $collab_artist) {
					if (!in_array($collab_artist, $db_artist_array)){
						$x->Save($collab_artist);
					}
				}

				// Provjera albuma prilikom dodavanja u Albums tablicu
				$db_albums_array = $this->getAlbumNames();

				if (!in_array($song["album"], $db_albums_array)){
					$album->Save($song["album"]);
				}

				// Povezivanje naziva žanra sa ID-om iz tablice music_genres

				$genre_array = $song["genre"];
				unset($song["collaborating_artists"], $song["main_artist"], $song["genre"]);

				// Još mi treba ID artista da ga mogu dodati
				$song["artist_id"] = $this->getArtistIdFromName(1, $main_artist);

				$db->InsertQuery("songs", $song);
				$songId = $db->LastInsertID();

				foreach ($genre_array as $genreName) {
					$insert_vars = array();
					$genreId = $this->getGenreIdFromName(1, $genreName);
					$insert_vars["song_id"] = $songId;
					$insert_vars["genre_id"] = $genreId;
					$db->InsertQuery("song_genre", $insert_vars);
				}

				foreach ($collaborating_artists as $artistName) {
					$insert_vars = array();
					$artistId = $this->getArtistIdFromName(1, $artistName);
					$insert_vars["song_id"] = $songId;
					$insert_vars["artist_id"] = $artistId;
					$db->InsertQuery("collaborating_artists", $insert_vars);
				}
			}
			return true;
		}
		return true;
	}

	/**************************************************************************/
	/**
	 * Get Genre ID from given genre name
	 *
	 * @param $status
	 * @param $genre_name
	 * @return null
	 */
	public function getGenreIdFromName($status = 1, $genre_name) {
		$db = MysqlDB::getInstance();
		$query = "SELECT music_genres.id, 
       		music_genres.status,
       		music_genres.name
		    FROM music_genres
		    WHERE music_genres.status IN (".$status.") AND music_genres.name LIKE ('$genre_name')";

		$result = $db->Query($query);
		if ($row = $db->Fetch($result)) {
			$id_genre = $row["id"];
		} else {
			$id_genre = null; // No matching genre found
		}
		return $id_genre;
	}

	/**************************************************************************/
	/**
	 * Get Genre ID from given genre name
	 *
	 * @param $status
	 * @param $artist_name
	 * @return null
	 */
	public function getArtistIdFromName($status = 1, $artist_name) {
		$db = MysqlDB::getInstance();
		$query = "SELECT artists.id, 
       		artists.status,
       		artists.name
		    FROM artists
		    WHERE artists.status IN (".$status.") AND artists.name LIKE ('$artist_name')";

		$result = $db->Query($query);
		if ($row = $db->Fetch($result)) {
			$id_genre = $row["id"];
		} else {
			$id_genre = null; // No matching artist found
		}
		return $id_genre;
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
			
			echo '<pre>';
			print_r($data);
			$data["duration"] = $data["duration"]["m"].":".$data["duration"]["s"];
			echo '</pre>';
			$db = MysqlDB::getInstance();
			return $db->UpdateQuery("songs", $data, $id);
		}
		return false;
	}

	/**************************************************************************/
	/**
	 * Execute insert method for inserting songs
	 *
	 * @param  mixed $data
	 * @return bool
	 */

	public function Import($data)
	{
		MysqlDB::getInstance();

		$folderPath =  $data["song_path"];
		$this->getSongs($folderPath);

		return true;
	}

	function getMp3Files($folderPath) {
		$mp3Files = array();

		$directoryIterator = new RecursiveDirectoryIterator($folderPath);
		$iterator = new RecursiveIteratorIterator($directoryIterator);

		foreach ($iterator as $file) {
			if ($file->isFile() && strtolower($file->getExtension()) === 'mp3') {
				$mp3Files[] = $file->getPathname();
			}
		}

		return $mp3Files;
	}

	public function getSongs($folderPath) {
		include "getid3/getid3/getid3.php";
		$getID3 = new getID3;

		$mp3Array = $this->getMp3Files($folderPath);
		$song_info = [];

		foreach ($mp3Array as $key => $filename) {
			$file = $getID3->analyze($filename);
			$full_filename      	= $file["filename"];
			$title 					= $file["tags"]["id3v2"]["title"][0];
			$main_artist 			= $file["tags"]["id3v1"]["artist"];
			$collaborating_artists  = $file["tags"]["id3v2"]["artist"];
			array_shift($collaborating_artists);
			$album 					= $file["tags"]["id3v2"]["album"][0];
			$genre 					= $file["tags"]["id3v2"]["genre"];
			$year 					= $file["tags"]["id3v2"]["year"][0];
			$date 					= $file["tags"]["id3v2"]["date"][0];

			$date_format = DateTime::createFromFormat('dmY', $date . $year);
			$released_on = $date_format->format('Y-m-d');

			$playtime_string 	= $file["playtime_string"];

			if (isset($file['comments']['picture'][0])) {
				$imageData = $file['comments']['picture'][0]['data'];
				$base64Image = base64_encode($imageData);

				// Save the artwork image as a local JPG file
				$filenameWithoutExtension = pathinfo($full_filename, PATHINFO_FILENAME);
				$uniqueFilename = $filenameWithoutExtension . '.jpg';

				$artworkFilePath = "C:/xampp/htdocs/soundwave.loc/public_html/admin/doc/artworks/original/" . $uniqueFilename;

				$imageDataBinary = base64_decode($base64Image);
				if (file_put_contents($artworkFilePath, $imageDataBinary)) {
					//echo "Artwork image saved successfully as $uniqueFilename\n";
				} else {
					//echo "Failed to save the artwork image.\n";
				}

				$sizes = array(50, 250);

				foreach ($sizes as $size) {
					$resizedImage = imagecreatetruecolor($size, $size);
					$sourceImage = imagecreatefromstring($imageDataBinary);

					imagecopyresampled(
						$resizedImage, $sourceImage, 0, 0, 0, 0,
						$size, $size, imagesx($sourceImage), imagesy($sourceImage)
					);

					$resizedFilePath = "C:/xampp/htdocs/soundwave.loc/public_html/admin/doc/artworks/".(string)$size."x".(string)$size."/".$uniqueFilename;

					if (imagejpeg($resizedImage, $resizedFilePath, 85)) {
						//echo "Resized artwork image saved successfully as $uniqueFilename\n";
					} else {
						//echo "Failed to save the resized artwork image.\n";
					}

					imagedestroy($resizedImage);
					imagedestroy($sourceImage);
				}

				// Create the artwork URI for the saved JPG image
				$artworkUri = 'doc/artworks/original/' . $uniqueFilename;
			} else {
				$artworkUri = "";
			}

			$destinationFolder = "C:/xampp/htdocs/soundwave.loc/public_html/admin/doc/songs/";

			// prije kopiranja provjeri jel već postoji

			$destinationFile = $destinationFolder . $full_filename;

			if (!file_exists($destinationFile)) {
				copy($filename, $destinationFile);
//				echo "<p class='text-success'>File ".$filename." copied successfully.</p>";
				$song_path = "doc/songs/".$full_filename;

				$song_info[] =
					[
						"title" 		=> $title,
						"main_artist" 	=> $main_artist,
						"collaborating_artists" => $collaborating_artists,
						"album" 		=> $album,
						"genre" 		=> $genre,
						"released_on" 	=> $released_on,
						"duration" 		=> $playtime_string,
						"song_path" 	=> $song_path,
						"filename"		=> $uniqueFilename,
						"artwork_img" 	=> $artworkUri
					];
			} else {
				break;
//				echo "<p class='text-danger'>File ".$filename." already exists in the destination folder.</p>";
			}
		}
		$this->Save($song_info);
	}

	public function getArtistNames() {
		$db = MysqlDB::getInstance();
		$list_array = array();
		$query = "SELECT
       		artists.name
		    FROM artists";

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

			$name = $row["name"];
			$list_array[] = $name;
		}
		return $list_array;
	}

	public function getAlbumNames() {
		$db = MysqlDB::getInstance();
		$list_array = array();
		$query = "SELECT
       		albums.name
		    FROM albums";

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

			$name = $row["name"];
			$list_array[] = $name;
		}
		return $list_array;
	}

	public function SongPathExistsForSong($id) {
		$query = "SELECT song_path
			  FROM songs
			  WHERE songs.id = '$id'";

		$db = MysqlDB::getInstance();
		$result = $db->Query($query);
		$row = $db->Fetch($result);

		return $row["song_path"];
	}
}