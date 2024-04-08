<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="css/style.css">
    <script type="text/javascript" src="main.js" defer></script>
    <title>Document</title>
</head>


<header class="all-header">
    <nav>
        <img src="img/Logo_Teal.png">
        <a id="nav-button" href="order-page.php">Reservering plaatsen</a>
    </nav>
    <div class="header-main-div">
        <p class="background-header-text">Motion <br> Wing</p>
        <div class="header-top-text-div">
            <h1>Motion <br> Wing</h1>
            <p class="header-text">Lorem ipsum dolor sit amet,
                Adipisci animi autem commodi,
                ducimus ea est et eveniet excepturi
                minus mollitia necessitatibus.</p>
        </div>
        <img src="img/Photo-1.png" class="header-img">
    </div>
</header>
<body>
<div class="all-body">
    <main>
        <section class="product-info-section">
            <img src="img/Photo-2.png" class="order-now-img">
            <h2>Hoe werkt de <span class="dark-blue-text"> <br>Motion Wing</span></h2>
            <div class="order-now-div">
                <p class="order-now-text">Lorem ipsum dolor sit amet, consectetur
                    adipiscing elit, sed do eiusmod tempor incididunt ut labore et
                    dolore magna aliqua. Ut enim ad minim veniam, quis nostrud
                    exercitation ullamco laboris nisi ut aliquip ex ea commodo
                    consequat. Duis aute irure dolor in reprehenderit in voluptate
                    velit esse cillum dolore eu fugiat nulla pariatur. Excepteur
                    sint occaecat cupidatat non proident, sunt in culpa qui officia
                    deserunt mollit anim id est laborum.</p>
                <a class="buttons" id="order-now-button" href="order-page.php">Bestel nu</a>
            </div>
        </section>
        <section class="demo-section">
            <img src="img/Photo-3.png" class="demo-vid">
        </section>
        <section class="review-section">
            <h3>Reviews</h3>
            <section class="reviews">
                <div class="review">
                    <div class="visible-review">
                        <div class="review-text-rating">
                            <h1 class="names">Naam 1</h1>
                            <div class="rating">
                                <span class="star">&#9733;</span>
                                <span class="star">&#9733;</span>
                                <span class="star">&#9733;</span>
                                <span class="star">&#9733;</span>
                                <span class="star">&#9733;</span>
                            </div>
                        </div>
                        <button class="button-reviews">Lees meer</button>
                    </div>

                    <div class="extra-info">
                        <p>"Deze aangepaste fietsstuur heeft mijn fietservaring volledig veranderd! Comfortabel en veilig rijden,
                            zelfs met mijn spasmen. Een absolute game-changer! 5 sterren!"</p>
                    </div>
                </div>
                <div class="review">
                    <div class="visible-review">
                        <div class="review-text-rating">
                            <h1 class="names"> Naam 2</h1>
                            <div class="rating">
                                <span class="star">&#9733;</span>
                                <span class="star">&#9733;</span>
                                <span class="star">&#9733;</span>
                                <span class="star">&#9733;</span>
                                <span class="star">&#9734;</span>
                            </div>
                        </div>
                        <button class="button-reviews">Lees meer</button>
                    </div>


                    <div class="extra-info">
                        <p>"Deze aangepaste fietsstuur heeft mijn rijervaring aanzienlijk verbeterd! Comfortabel en stabiel, zelfs
                            met mijn spasmen. Een klein verbeterpunt zou kunnen zijn om de handgrepen iets breder te maken. 4
                            sterren."</p>
                    </div>
                </div>
                <div class="review">
                    <div class="visible-review">
                        <div class="review-text-rating">
                            <h1 class="names">Naam 3</h1>
                            <div class="rating">
                                <span class="star">&#9733;</span>
                                <span class="star">&#9733;</span>
                                <span class="star">&#9733;</span>
                                <span class="star">&#9734;</span>
                                <span class="star">&#9734;</span>
                            </div>
                        </div>
                        <button class="button-reviews">Lees meer</button>
                    </div>


                    <div class="extra-info">
                        <p>"Deze aangepaste fietsstuur heeft mijn fietservaring verbeterd! Het biedt comfort en stabiliteit, zelfs
                            met mijn spasmen. Een verbeterpunt zou zijn om de grip iets steviger te maken. 3 sterren."</p>
                    </div>
                </div>
            </section>
        </section>
    </main>

    <footer>
        <div id="contacts-footer">
            <div class="footer-groups">
                <img class="contact-icon" src="img/phone-call.png">
                <p class="contact-text">0612345678</p>
            </div>
            <div class="footer-groups">
                <img class="contact-icon" src="img/email%20(1).png">
                <p class="contact-text">m.w@gmail.com</p>
            </div>
            <div class="footer-groups">
                <img class="contact-icon" src="img/facebook.png">
                <p class="contact-text">Facebook</p>
            </div>
            <div class="footer-groups">
                <img class="contact-icon" src="img/instagram.png">
                <p class="contact-text">Instagram</p>
            </div>
        </div>
        <div id="logo-footer">
            <img src="img/Logo_White.png">
        </div>
        <div id="policy-footer">
            <p>Privacy Policy </p>
            <p>Terms of Service</p>
            <p>Contact Us </p>
            <p>About Us </p>
            <p>Cookie Policy</p>
        </div>
    </footer>

</div>

<script>
    window.addEventListener('load', init);

    function init() {
        const toggleButtons = document.querySelectorAll(".button");
        for (let button of toggleButtons ) {
            button.addEventListener('click', clickReview);
        }
    }

    function clickReview(e) {
        const review = e.target.closest('.review');
        if (!review) return;

        const extraInfo = review.querySelector('.extra-info');
        if (!extraInfo) return;

        extraInfo.classList.toggle("open");

        if (extraInfo.classList.contains("open")) {
            this.textContent = "Lees minder";
        } else {
            this.textContent = "Lees meer";
        }
    }
</script>

</body>
</html>