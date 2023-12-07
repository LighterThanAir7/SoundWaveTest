// Ime: music-list.js
// Opis: skirpta za kreiranje music liste
// Autor: Benjamin Babić
// Datum: 16/08/2023

var playerItemsList = [];

function initializeMusicList(phpArray) {
    phpArray.forEach(function(song) {
        var subArray = {
            name: song.title,
            artist: song.main_artist,
            filename: song.filename,
            src: song.song_path,
            duration: song.duration
        };

        playerItemsList.push(subArray);
    });

    // console.log(JSON.stringify(playerItemsList, null, 2));
}