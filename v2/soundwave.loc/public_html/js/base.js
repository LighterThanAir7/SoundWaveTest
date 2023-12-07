/* ------------------------------------------------------------------------------------------------------ */
/* ----------------------------------------->   Dropdown   <--------------------------------------------- */
/* ------------------------------------------------------------------------------------------------------ */
/*document.addEventListener('DOMContentLoaded', () => {

    // Nabavi sve nav__iteme bez zadnjeg (jer nema dropdown)
    const navItems = Array.from(document.querySelectorAll('.nav__item')).slice(0, -1);

    navItems.forEach((navItem) => {
        const dropdown = navItem.querySelector('.dropdown');
        const dropdownItems = dropdown.querySelectorAll('.dropdown__item');
        const dropdownHeight = dropdownItems.length * dropdownItems[0].offsetHeight;
        let timeout;

        const closeDropdown = () => {
            timeout = setTimeout(() => {
                const isHoveringNavItem = navItem.matches(':hover');
                const isHoveringDropdown = dropdown.matches(':hover');

                if (!isHoveringNavItem && !isHoveringDropdown) {
                    dropdown.style.height = '0';
                    dropdown.style.boxShadow = 'none';
                }
            }, 100);
        };

        navItem.addEventListener('mouseenter', () => {
            clearTimeout(timeout);
            dropdown.style.height = `${dropdownHeight}px`;
            dropdown.style.boxShadow = '0.5em 0.5em 0.5em 2px rgba(26, 26, 26, 0.66)';
        });

        navItem.addEventListener('mouseleave', closeDropdown);

        dropdown.addEventListener('mouseenter', () => {
            clearTimeout(timeout);
        });

        dropdown.addEventListener('mouseleave', closeDropdown);
    });
});*/

/* ------------------------------------------------------------------------------------------------------ */
/* --------------------------------------->   Language Meni   <------------------------------------------ */
/* ------------------------------------------------------------------------------------------------------ */

/*const languagePickerBtn = document.querySelector('.language-picker');
const languageMenu = document.querySelector('.language-picker__menu');

function toggleLanguageMenu() {
    if (languageMenu.style.display === 'flex') {
        languageMenu.classList.remove('show__language__menu');
        languageMenu.classList.add('hide__language__menu');
        setTimeout(() => {
            languageMenu.style.display = 'none';
        }, 500);
    } else {
        languageMenu.style.display = 'flex';
        languageMenu.classList.remove('hide__language__menu');
        languageMenu.classList.add('show__language__menu');
    }
}

if (languagePickerBtn) {
    languagePickerBtn.addEventListener('click', function(event) {
        toggleLanguageMenu();
        event.stopPropagation();
    });
    document.addEventListener('click', function() {
        if (languageMenu.style.display === 'flex') {
            toggleLanguageMenu();
        }
    });
}*/

/* ------------------------------------------------------------------------------------------------------ */
/* --------------------------------------->   Search Bar   <------------------------------------------ */
/* ------------------------------------------------------------------------------------------------------ */

// const searchInput = document.getElementById('searchInput');
// const searchbarIcon = document.querySelector('.searchbar__form i:nth-of-type(2)');
//
// if (searchInput) {
//     searchInput.addEventListener('focus', () => {
//         searchbarIcon.classList.add('focused');
//     });
//
//     searchInput.addEventListener('blur', () => {
//         searchbarIcon.classList.remove('focused');
//     });
// }


/* ------------------------------------------------------------------------------------------------------ */
/* ----------------------------------------->   Carousel   <--------------------------------------------- */
/* ------------------------------------------------------------------------------------------------------ */

/*const carouselSections = document.querySelectorAll('.carousel-section');

carouselSections.forEach((section) => {
    const carousel = section.querySelector('.carousel');
    const arrowBtns = section.querySelectorAll('.channel__section-arrows i');

    let firstCardWidth = section.querySelector('.carousel__card').offsetWidth * setCarouselColumns();

    let isDragging = false, startX, startScrollLeft;

    arrowBtns.forEach(btn => {
        btn.addEventListener("click", () => {
            carousel.scrollLeft += btn.className === "icon-arrow-left" ? -firstCardWidth : firstCardWidth;
        })
    });


    const dragStart = (e) => {
        isDragging = true;
        carousel.classList.add("dragging");
        // Inicijalna pozicija cursora i scroll pozicije carousela
        startX = e.pageX;
        startScrollLeft = carousel.scrollLeft;
    }

    const dragging = (e) => {
        // Horizontalna koordinata pokazivača miša
        // console.log(e.pageX)
        if(!isDragging)
            return;
        carousel.scrollLeft = startScrollLeft - (e.pageX - startX);
    }

    const dragStop = () => {
        isDragging = false;
        carousel.classList.remove("dragging");
    }

    function setCarouselColumns() {
        const screenWidth = window.innerWidth;

        let columns = 1;
        if (screenWidth >= 1600) {
            columns = 5;
        } else if (screenWidth >= 1300) {
            columns = 4;
        } else if (screenWidth >= 1000) {
            columns = 3;
        } else if (screenWidth >= 700) {
            columns = 2;
        }

        const carousels = document.querySelectorAll('.carousel');
        carousels.forEach((carousel) => {
            if (screenWidth < 700) {
                carousel.style.gridAutoColumns = `100%`;
            } else {
                carousel.style.gridAutoColumns = `calc((100% / ${columns}) - 25px)`;
            }
        });
        return columns;
    }

    carousel.addEventListener("mousedown", dragStart);
    carousel.addEventListener("mousemove", dragging);
    document.addEventListener("mouseup", dragStop);
    window.addEventListener('load', setCarouselColumns);
    window.addEventListener('resize', setCarouselColumns);
});*/


/* ------------------------------------------------------------------------------------------------------ */
/* ----------------------------------->   Smooth Scroll to Top   <--------------------------------------- */
/* ------------------------------------------------------------------------------------------------------ */

/*let arrow_top = document.querySelector('.arrow__top');

if (arrow_top) {
    arrow_top.addEventListener('click', function () {
        scrollToTop(2500); // Specify the duration of the animation in milliseconds
    });
}

function scrollToTop(duration) {
    const start = window.pageYOffset;
    const change = -start;
    const animationStart = performance.now();

    function animate(time) {
        const timeElapsed = time - animationStart;
        const scrollY = easeInOutCubic(timeElapsed, start, change, duration);
        window.scrollTo(0, scrollY);
        if (timeElapsed < duration) {
            requestAnimationFrame(animate);
        }
    }

    function easeInOutCubic(t, b, c, d) {
        t /= d / 2;
        if (t < 1) return c / 2 * t * t * t + b;
        t -= 2;
        return c / 2 * (t * t * t + 2) + b;
    }

    requestAnimationFrame(animate);
}*/

/* ------------------------------------------------------------------------------------------------------ */
/* ----------------------------------->      Add to Playlist     <--------------------------------------- */
/* ------------------------------------------------------------------------------------------------------ */

const addToPlaylistWindow = document.querySelector('.add-to-playlist');
const newPlaylistWindow = document.querySelector('.new-playlist');

// Function to close both elements
function closeElements() {
    addToPlaylistWindow.classList.remove('show');
    newPlaylistWindow.classList.remove('show');
}

// Add a click event listener to the document
document.addEventListener('mousedown', function(event) {
    if (!addToPlaylistWindow.contains(event.target) && !newPlaylistWindow.contains(event.target)) {
        closeElements();
    }
});

// Toggle functions
function toggleAddToPlaylist() {
    addToPlaylistWindow.classList.toggle('show');
    newPlaylistWindow.classList.remove('show');
}

function toggleCreateNewPlaylist() {
    newPlaylistWindow.classList.toggle('show');
    addToPlaylistWindow.classList.remove('show');
}

const closeIcon = document.querySelector('.icon-x');
closeIcon.addEventListener('click', closeElements);




/* ------------------------------------------------------------------------------------------------------ */
/* ----------------------------------->         Player           <--------------------------------------- */
/* ------------------------------------------------------------------------------------------------------ */

// Pripremimo sve elemente koji nam trebaju

const player = document.querySelector('.player'),
    playerArtwork = player.querySelector('.player__artwork img'),
    songTitle = player.querySelector('.player__song-title'),
    songArtist = player.querySelector('.player__artist'),
    mainAudio = player.querySelector('#main-audio'),
    playPauseBtn = player.querySelector('#playPauseBtn'),
    previousBtn = player.querySelector('#previousBtn'),
    nextBtn = player.querySelector('#nextBtn'),
    progressArea = player.querySelector('.player__progress-area'),
    progressBar = player.querySelector('.player__progress-bar'),
    nextItemTitle = player.querySelector('.next-song__title'),
    nextItemArtist = player.querySelector('.next-song__artist'),
    nextItemImg = player.querySelector('.next-song__img'),
    previousItemTitle = player.querySelector('.previous-song__title'),
    previousItemArtist = player.querySelector('.previous-song__artist'),
    previousItemImg = player.querySelector('.previous-song__img'),
    queuePlayerList = player.querySelector('.player-queue__list'),
    queueItemImg = player.querySelector('.player-queue__artwork-img'),
    queueItemName = player.querySelector('.player-queue__song-name'),
    queueItemArtist = player.querySelector('.player-queue__artist'),
    queueItemDuration = player.querySelector('.player-queue__time');

let playerItemIndex = Math.floor((Math.random() * playerItemsList.length) + 1);

window.addEventListener("load", ()=>{
    loadPlayerItem(playerItemIndex); // Pozovi mi loadMusic funkciju kada se window učita
    mainAudio.addEventListener("loadedmetadata", () => {
        updateSongDuration();
    });
    playingNow();
})

function updateSongDuration() {
    let totalDuration = mainAudio.duration;
    let formatedTotalDuration = formatTime(totalDuration);
    let playerDuration = player.querySelector('.player__time-duration');
    playerDuration.innerText = formatedTotalDuration;
}

function formatTime(time) {
    const minutes = Math.floor(time / 60);
    const seconds = Math.floor(time % 60);
    return `${minutes}:${seconds < 10 ? '0' : ''}${seconds}`;
}

function loadPlayerItem(indexNumber) {
    songTitle.innerHTML = playerItemsList[indexNumber - 1].name; // array počinje od 0, pa je zato -1
    songArtist.innerHTML = playerItemsList[indexNumber - 1].artist;
    playerArtwork.src = `${SITE_URL}admin/doc/artworks/original/${playerItemsList[indexNumber - 1].filename}`;
    mainAudio.src = `${SITE_URL}admin/${playerItemsList[indexNumber - 1].src}`;
    testDominantColor();
    loadNextItem(indexNumber);
    loadPreviousItem(indexNumber);
}

function testDominantColor () {
    console.log("Dominantna Boja")
    const colorThief = new ColorThief();

    playerArtwork.onload = function () {
        const dominantColor = colorThief.getColor(playerArtwork);

        // Convert RGB values to RGB format
        // Store the dominant color in a variable
        const dominantColorVariable = `rgb(${dominantColor[0]}, ${dominantColor[1]}, ${dominantColor[2]})`;
        const ConvertedColor = tinycolor(dominantColorVariable).toHsl();

        const closestPrimaryColor = findClosestColor(ConvertedColor, predefinedColors);
        const secondaryColor = oppositeColor(closestPrimaryColor);

        // Use the dominantColorVariable as needed
        console.log("Dominant Color:", dominantColorVariable);
        console.log("Dominant Color:", ConvertedColor);

        console.log("Dominant Color:", closestPrimaryColor);

        document.documentElement.style.setProperty('--clr-primary-100', darkenColor(closestPrimaryColor, 0));
        document.documentElement.style.setProperty('--clr-primary-200', darkenColor(closestPrimaryColor, 15));
        document.documentElement.style.setProperty('--clr-primary-300', darkenColor(closestPrimaryColor, 20));
        document.documentElement.style.setProperty('--clr-primary-400', darkenColor(closestPrimaryColor, 25));
        document.documentElement.style.setProperty('--clr-primary-500', darkenColor(closestPrimaryColor, 30));
        document.documentElement.style.setProperty('--clr-primary-600', darkenColor(closestPrimaryColor, 35));
        document.documentElement.style.setProperty('--clr-primary-700', darkenColor(closestPrimaryColor, 40));
        document.documentElement.style.setProperty('--clr-primary-800', darkenColor(closestPrimaryColor, 45));
        document.documentElement.style.setProperty('--clr-primary-900', darkenColor(closestPrimaryColor, 50));

        document.documentElement.style.setProperty('--clr-secondary-100', darkenColor(secondaryColor, 0));
        document.documentElement.style.setProperty('--clr-secondary-200', darkenColor(secondaryColor, 15));
        document.documentElement.style.setProperty('--clr-secondary-300', darkenColor(secondaryColor, 20));
        document.documentElement.style.setProperty('--clr-secondary-400', darkenColor(secondaryColor, 25));
        document.documentElement.style.setProperty('--clr-secondary-500', darkenColor(secondaryColor, 30));
        document.documentElement.style.setProperty('--clr-secondary-600', darkenColor(secondaryColor, 35));
        document.documentElement.style.setProperty('--clr-secondary-700', darkenColor(secondaryColor, 40));
        document.documentElement.style.setProperty('--clr-secondary-800', darkenColor(secondaryColor, 45));
        document.documentElement.style.setProperty('--clr-secondary-900', darkenColor(secondaryColor, 50));
    };
}

const predefinedColors = {
    "lavanda": { h: 248, s: 100, l: 73, a: 1},
    "neon-blue": { h: 241, s: 100, l: 66, a: 1},
    "deep-sky-blue": { h: 198, s: 100, l: 50, a: 1},
    "baby-blue": { h: 191, s: 100, l: 70, a: 1},
    "mint": { h: 168, s: 100, l: 50, a: 1},
    "spring-green": { h: 156, s: 100, l: 55, a: 1},
    "lemon": { h: 61, s: 100, l: 70, a: 1},
    "yellow-orange": { h: 32, s: 100, l: 62, a: 1},
    "burnt-orange": { h: 14, s: 100, l: 62, a: 1},
    "bittersweet": { h: 0, s: 100, l: 68, a: 1},
    "neon-pink": { h: 331, s: 100, l: 74, a: 1},
    "heliotrope": { h: 277, s: 100, l: 73, a: 1},
    "mauve": { h: 277, s: 100, l: 85, a: 1},
    "white-smoke": { h: 0, s: 0, l: 96, a: 1}
    // ... Add the rest of your predefined colors here
};

function findClosestColor(hslColor, colorList) {
    let closestColor = null;
    let closestDifference = Number.MAX_VALUE;

    // Calculate the difference between the given HSL color and each color in the list
    let closestHSL;
    for (const colorName in colorList) {
        const predefinedHSL = colorList[colorName];
        const hueDiff = Math.abs(hslColor.h - predefinedHSL.h);
        const saturationDiff = Math.abs(hslColor.s * 100 - predefinedHSL.s);
        const lightnessDiff = Math.abs(hslColor.l * 100 - predefinedHSL.l);
        const totalDifference = Math.sqrt(hueDiff ** 2 + saturationDiff ** 2 + lightnessDiff ** 2);

        // Update closest color if the current color is closer
        if (totalDifference < closestDifference) {
            closestDifference = totalDifference;
            closestColor = colorName;

            // Update closestHSL with the HSL values of the closest color
            closestHSL = predefinedHSL;
        }
    }

    return closestHSL;
}

function oppositeColor(hslColor) {
    // Extract HSL values from the HSL object
    const { h, s, l } = hslColor;

    // Calculate the opposite hue by adding 180 degrees and wrapping around 360
    const oppositeHue = (h + 220) % 360;

    // Create the opposite color with the new hue
    const oppositeColor = {
        h: oppositeHue,
        s: s,
        l: l
    };

    return oppositeColor;
}

function darkenColor(hslColor, percentage) {
    // Extract HSL values from the HSL object
    const { h, s, l } = hslColor;

    // Darken the color by reducing the lightness
    const newLightness = Math.max(l - (l * (percentage / 100)), 0);

    // Generate the darkened HSL color string
    return `hsl(${h}, ${s}%, ${newLightness}%)`;
}

function loadNextItem(indexNumber) {
    nextItemTitle.innerHTML = playerItemsList[indexNumber].name;
    nextItemArtist.innerHTML = playerItemsList[indexNumber].artist;
    nextItemImg.src = `${SITE_URL}admin/doc/artworks/250x250/${playerItemsList[indexNumber].filename}`;
}

function loadPreviousItem(indexNumber) {
    previousItemTitle.innerHTML = playerItemsList[indexNumber - 2].name;
    previousItemArtist.innerHTML = playerItemsList[indexNumber - 2].artist;
    previousItemImg.src = `${SITE_URL}admin/doc/artworks/250x250/${playerItemsList[indexNumber - 2].filename}`;
}

for (let i = playerItemIndex; i < playerItemsList.length; i++) {
    // console.log(`${SITE_URL}admin/doc/artworks/250x250/${playerItemsList[i].filename}`);
    let queuePlayerItem = `<li data-index="${i + 1}" class="player-queue__item">
                            <img class="player-queue__artwork-img" src="${SITE_URL}admin/doc/artworks/250x250/${playerItemsList[i].filename}" alt="">
                            <div class="player-queue__song-info">
                                <h5 class="player-queue__song-name">${playerItemsList[i].name}</h5>
                                <p class="player-queue__artist">${playerItemsList[i].artist}<span>&nbsp•&nbsp</span><span class="player-queue__time">${playerItemsList[i].duration}</span></p>
                            </div>
                            <i class="icon-grip-lines"></i>
                        </li>`;
    queuePlayerList.insertAdjacentHTML("beforeend", queuePlayerItem);
}

// console.log(allQueuePlayerItems);

function playingNow() {
    const allQueuePlayerItems = queuePlayerList.querySelectorAll('li');
    console.log(allQueuePlayerItems)
    allQueuePlayerItems.forEach((item, j) => {
        if (item.classList.contains('playing')) {
            item.classList.remove('playing');
        }

        if (item.getAttribute("data-index") === playerItemIndex) {
            item.classList.add("playing");
        }

        // Adding the onclick attribute to each li element
        item.setAttribute("onclick", "clicked(this)");
    });
}

function clicked(element) {
    console.log("Clicked")
    playerItemIndex = element.getAttribute("data-index");
    loadPlayerItem(playerItemIndex);
    playPlayer();
    playingNow();
}

// Play Player Function
function playPlayer() {
    player.classList.add('paused');
    playPauseBtn.className = "icon-pause";
    mainAudio.play();
}

// Pause Player Function
function pausePlayer() {
    player.classList.remove('paused');
    playPauseBtn.className = "icon-play";
    mainAudio.pause()
}

// Previous Player Function
function previousPlayerItem() {
    playerItemIndex--;
    playerItemIndex < 1 ? playerItemIndex = playerItemsList.length : playerItemIndex = playerItemIndex;
    loadPlayerItem(playerItemIndex);
    playPlayer();
    playingNow();
}

// Next Player Function
function nextPlayerItem() {
    playerItemIndex++;
    // Slučaj da kad dođemo do kraja svih pjesama da počnemo od prve
    playerItemIndex > playerItemsList.length ? playerItemIndex = 1 : playerItemIndex = playerItemIndex;
    loadPlayerItem(playerItemIndex);
    playPlayer();
    playingNow();
}
playPauseBtn.addEventListener("click", ()=>{
    const isPaused = player.classList.contains('paused');
    isPaused ? pausePlayer() : playPlayer();
    playingNow();
})

// Previous Button Click Event
previousBtn.addEventListener("click", ()=> {
    previousPlayerItem();
})

// Next Button Click Event
nextBtn.addEventListener("click", ()=> {
    nextPlayerItem();
})

// Promjena širine progress bara ovisno o trajanju pjesme
mainAudio.addEventListener("timeupdate", (e)=> {
    // console.log(e);
    const currentTime = e.target.currentTime; // trenutno vrijeme
    const duration = e.target.duration; // ukupno trajanje
    let progressBarWidth = (currentTime / duration) * 100;
    progressBar.style.width = `${progressBarWidth}%`

    let playerCurrentTime = player.querySelector('.player__time-current');
    let playerDuration = player.querySelector('.player__time-duration');

    mainAudio.addEventListener("loadeddata", ()=> {
        // update total duration
        let totalDuration = mainAudio.duration;
        playerDuration.innerText = formatTime(totalDuration);
    });
    // update current time
    const currentMin = Math.floor(currentTime / 60);
    const currentSec = Math.floor(currentTime % 60);
    playerCurrentTime.innerText = `${currentMin}:${currentSec < 10 ? '0' : ''}${currentSec}`;
})

// update player current song time based of progress bar width

progressArea.addEventListener("click", (e)=> {
    let progressWidthValue = progressArea.clientWidth; // širina progress bara
    let clickedOffsetX = e.offsetX; // X offset
    let playerItemDuration = mainAudio.duration; // ukupno trajanje pjesme

    mainAudio.currentTime = (clickedOffsetX / progressWidthValue) * playerItemDuration;
    // playPlayer();

    // imaj na umu da ako je glazba pauzirana, kad korisnik premota negdje automatski će krenuti
    // Inače treba smo playPlayer() stavit u uvjet koji provjerava je li trenutno pauziran
})

// Shuffle

const iconShuffle = document.querySelector('.icon-shuffle');
const shuffleState = document.querySelector('.shuffle-state');
const shuffleStateText = shuffleState.querySelector('.shuffle-state__text');

iconShuffle.addEventListener('click', toggleShuffleState);

function toggleShuffleState() {
    const isShuffleOn = shuffleState.classList.toggle('on');

    iconShuffle.style.color = isShuffleOn ? 'var(--clr-primary-100)' : '';
    shuffleStateText.textContent = isShuffleOn ? 'on' : 'off';

    shuffleState.style.animation = 'none';
    void shuffleState.offsetWidth;
    shuffleState.style.animation = 'fade-in-out 4s forwards';

    mainAudio.addEventListener("ended", ()=> {
        // random index unutar range-a svih itema
        let randIndex = Math.floor((Math.random() * playerItemsList.length) + 1);
        do {
            randIndex = Math.floor((Math.random() * playerItemsList.length) + 1);
        } while (playerItemIndex == randIndex);
        playerItemIndex = randIndex; // pusti random pjesmu
        loadPlayerItem(playerItemIndex);
        playPlayer();
        playingNow();
    })
}


// Repeat

const iconRepeat = document.querySelector('.icon-repeat');
const repeatState = document.querySelector('.repeat-state');
const repeatStateText = document.querySelector('.repeat-state__text');

iconRepeat.addEventListener('click', toggleRepeatState);

function toggleRepeatState() {

    if (repeatState.classList.contains('on')) {
        repeatState.classList.remove('on');
        repeatState.classList.add('one');
        repeatStateText.textContent = 'this'
        iconRepeat.className = 'icon-repeat_one'
    } else if (repeatState.classList.contains('one')) {
        repeatState.classList.remove('one');
        repeatStateText.textContent = 'off'
        iconRepeat.className = 'icon-repeat'
        iconRepeat.style.color = '';
    } else {
        repeatState.classList.add('on');
        iconRepeat.style.color = 'var(--clr-primary-100)';
    }

    // Reset animation
    repeatState.style.animation = 'none';
    void repeatState.offsetWidth;
    repeatState.style.animation = 'fade-in-out 4s forwards';
}

mainAudio.addEventListener('ended', ()=> {
    if (repeatState.classList.contains('on')) {
        nextPlayerItem();
    } else if (repeatState.classList.contains('one')) {
        mainAudio.currentTime = 0;
        loadPlayerItem(playerItemIndex);
        playPlayer();
        playingNow();
    }
})

// More info

const toggleButton = document.querySelector('.player__more-info .icon-info_outline');
const moreSongInfo = document.querySelector('.player__more-song-info');
const closeButton = moreSongInfo.querySelector('.icon-x');

if (toggleButton) {
    toggleButton.addEventListener('click', () => {
        moreSongInfo.classList.toggle('show');
    });
}

closeButton.addEventListener('click', () => {
    moreSongInfo.classList.remove('show');
});

// Add to Favourite

const addToFavourite = document.getElementById('player__add-to-favourite');

addToFavourite.addEventListener('click', function() {
    this.classList.toggle('icon-heart_outline');
    this.classList.toggle('icon-heart-fill');
});

// Queue

const queueMusic = document.querySelector('.player-queue');
const toggleQueueMusic = document.querySelector('.icon-queue_music');
const closeQueueMusic = queueMusic.querySelector('.icon-x');

toggleQueueMusic.addEventListener('click', () => {
    queueMusic.classList.toggle('show');
});

closeQueueMusic.addEventListener('click', () => {
    queueMusic.classList.remove('show');
});

document.addEventListener('click', (event) => {
    if (!queueMusic.contains(event.target) && event.target !== toggleQueueMusic) {
        queueMusic.classList.remove('show');
    }
});

// Kako zaustavit scrollanje izvan toga kad dođemo do kraja ?

// Lyrics

const playerLyrics = document.querySelector('.player-lyrics');
const togglePlayerLyrics = document.querySelector('.icon-lyrics');
const closePlayerLyrics = playerLyrics.querySelector('.icon-x');

togglePlayerLyrics.addEventListener('click', () => {
    playerLyrics.classList.toggle('show');
});

closePlayerLyrics.addEventListener('click', () => {
    playerLyrics.classList.remove('show');
});

document.addEventListener('click', (event) => {
    if (!playerLyrics.contains(event.target) && event.target !== togglePlayerLyrics) {
        playerLyrics.classList.remove('show');
    }
});


// Volume Slider


let volumeSlider = document.getElementById("volume-slider");

volumeSlider.oninput = function () {
    let min = volumeSlider.getAttribute("min");
    let max = volumeSlider.getAttribute("max");

    let val = volumeSlider.value;

    let range = (max-min);

    let percentage = (val/range)*100;

    volumeSlider.style.backgroundImage = 'linear-gradient(90deg, var(--clr-primary-100) ' + percentage + '%, #222 0%)';
    mainAudio.volume = val/range;
}


const volumeBar = player.querySelector('.volume-bar');
const volumeIcon = player.querySelector('.icon-volume-medium');
volumeIcon.addEventListener("click", ()=> {
    if (volumeBar.classList.contains("show")) {
        volumeIcon.style.color = '';
        volumeBar.classList.remove("show");
    } else {
        volumeBar.classList.toggle("show");
        volumeIcon.style.color = 'var(--clr-primary-100)';
    }
});

// Funkcionalnost da Volume bar nestane nakon X sekundi, ako ga korisnik ne dira




















// const playerSongInfoContainer = document.querySelector('.player__song-info');
// const playerSongTitle = document.querySelector('.player__song-title');
//
// function checkOverflow() {
//     const thresholdWidth = playerSongInfoContainer.clientWidth - 1;
//     const titleWidth = playerSongTitle.clientWidth;
//
//     if (titleWidth > thresholdWidth) {
//         playerSongTitle.classList.animationPlayState = 'running';
//     } else {
//         playerSongTitle.style.animationPlayState = 'paused';
//     }
// }
//
// // Initial check
// setTimeout(checkOverflow, 500);
//
// // Recheck on window resize
// window.addEventListener('resize', checkOverflow);
