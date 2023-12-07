const app = Vue.createApp({
    components: {
        'nav-component': {
            template: `
        <header>
            <nav class="nav">
                <a class="nav__logo" href="index.php?what=page-home">
                    <i class="icon-logo"></i><span>SoundWave</span>
                </a>
                <ul class="nav__list">
                    <li class="nav__item" v-for="categoryItem in navItems" @mouseenter="openDropdown($event)" @mouseleave="closeDropdown($event)">
                        <a class="nav__link" :href="'index.php?what=page-' + categoryItem.category.toLowerCase()">
                            {{ categoryItem.category }}
                        </a>
                        <ul class="dropdown">
                            <li class="dropdown__item" v-for="menuItem in categoryItem.items">
                                <a class="dropdown__link" href="#">{{ menuItem }}</a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav__item">
                        <a class="nav__link nav__link--button" :href="'index.php?what=page-' + (page_title === 'About' || page_title === 'Login' ? 'home' : 'login')">
                            {{ page_title === 'About' || page_title === 'Login' ? 'Home' : 'Join Now' }}
                        </a>
                    </li>
                </ul>
            </nav>
        </header>
    `,
            data() {
                return {
                    navItems: [
                        {
                            category: 'About',
                            items: ['Explore', 'Pricing'],
                        },
                        {
                            category: 'Support',
                            items: ['Download', 'Import', 'Devices', 'Help'],
                        },
                    ],
                    page_title: 'Home',
                    dropdownHeight: 0,
                    timeout: null,
                };
            },
            methods: {
                openDropdown(event) {
                    const navItem = event.target;
                    const dropdownItems = navItem.querySelectorAll('.dropdown__item');
                    this.dropdownHeight = dropdownItems.length * dropdownItems[0].offsetHeight;
                    navItem.querySelector('.dropdown').style.height = `${this.dropdownHeight}px`;
                    navItem.querySelector('.dropdown').style.boxShadow = '0.5em 0.5em 0.5em 2px rgba(26, 26, 26, 0.66)';
                    clearTimeout(this.timeout);
                },
                closeDropdown(event) {
                    const navItem = event.target;
                    const dropdown = navItem.querySelector('.dropdown');
                    this.timeout = setTimeout(() => {
                        dropdown.style.height = '0';
                        dropdown.style.boxShadow = 'none';
                    }, 100);
                },
            },
        },
        'footer-bottom': {
            template: `
                <footer class="footer-bottom" :class="{'footer-bottom--absolute': page_title === 'Home' || page_title === 'Login' || page_title === 'About'}">
                    <div class="footer-bottom__company">
                        <a class="footer-bottom__logo" href="index.php?what=page-home"><i class="icon-logo"></i></a>
                        <span class="footer-bottom__copyright">© 2022 SoundWave LLC</span>
                    </div>
        
                    <ul class="footer-bottom__list">
                        <li v-for="link in footerLinks" :key="link">
                            <a class="footer__link" href="">{{ link }}</a>
                        </li>
                        <button class="language-picker" @click="test()">
                            <i class="icon-language"></i><span>Language</span>
                            <ul class="language-picker__menu" v-show="isLanguageMenuOpen">
                                <li v-for="language in languages" :key="language">{{ language }}</li>
                            </ul>
                        </button>
                    </ul>
                </footer>
            `,
            data() {
                return {
                    languages: [
                        "English",
                        "Български",
                        "Český",
                        "Français",
                        "Hrvatski",
                        "Italiano",
                        "Chinese",
                        "Norsk",
                        "Polski",
                        "Português",
                        "Slovenščina",
                        "Srpski",
                    ],
                    footerLinks: ["Privacy", "Terms", "Accessibility", "Contact"],
                    isLanguageMenuOpen: false,
                    page_title: document.title,
                };
            },
            methods: {
                test () {
                    const languageMenu = document.querySelector('.language-picker__menu');
                    toggleLanguageMenu();

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
                        // this.isLanguageMenuOpen = !this.isLanguageMenuOpen;
                    }
                }
            },
        },
        'scroll-to-top': {
            template: `
                <i class="arrow__top icon-arrow-up" @click="scrollToTop(2500)"></i>
            `,
            methods: {
                scrollToTop(duration) {
                    const start = window.pageYOffset;
                    const change = -start;
                    const animationStart = performance.now();

                    const animate = (time) => {
                        const timeElapsed = time - animationStart;
                        const scrollY = this.easeInOutCubic(timeElapsed, start, change, duration);
                        window.scrollTo(0, scrollY);
                        if (timeElapsed < duration) {
                            requestAnimationFrame(animate);
                        }
                    };
                    requestAnimationFrame(animate);
                },

                easeInOutCubic(t, b, c, d) {
                    t /= d / 2;
                    if (t < 1) return c / 2 * t * t * t + b;
                    t -= 2;
                    return c / 2 * (t * t * t + 2) + b;
                }
            },
        },
        'carousel': {
            mounted() {
                this.initializeCarousel()
            },
            methods: {
                initializeCarousel() {
                    const carouselSections = document.querySelectorAll('.carousel-section');
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

                        function dragStart(e) {
                            isDragging = true;
                            carousel.classList.add("dragging");
                            startX = e.pageX;
                            startScrollLeft = carousel.scrollLeft;
                        }
                        function dragging(e) {
                            if (!isDragging) return;
                            carousel.scrollLeft =
                            startScrollLeft - (e.pageX - startX);
                        }
                        function dragStop() {
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
                        window.addEventListener('resize', () => {
                            firstCardWidth = section.querySelector('.carousel__card').offsetWidth * setCarouselColumns();
                        });
                    });
                }
            },
        }
    }
});

app.mount('#app');
