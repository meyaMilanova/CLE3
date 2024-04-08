<?php
session_start();

$errors = ['name' => '', 'email' => '', 'address' => '', 'postcode' => '', 'phone_number' => '', 'color' => '', 'size' => ''];

// Controleer of het formulier is ingediend
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["submit"])) {
    // Naam controleren
    if (empty($_POST['name'])) {
        $errors['name'] = 'Fout: Naam ontbreekt!';
    }

    // E-mail controleren
    if (empty($_POST['email']) || !filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
        $errors['email'] = 'Fout: Email ontbreekt of is verkeerd!';
    }

    // Adres controleren
    if (empty($_POST['address'])) {
        $errors['address'] = 'Fout: Adres ontbreekt!';
    }

    // Postcode controleren
    if (empty($_POST['postcode']) || !preg_match('/^\d{4}\s?[A-Z|a-z]{2}$/i', $_POST['postcode'])){
        $errors['postcode'] = 'Fout: Postcode ontbreekt of is verkeerd!';
    }

    // Telefoonnummer controleren
    if (empty($_POST['phone_number']) || !preg_match('/^(?:\+31|0)(?:[1-9][0-9]?|6\-[1-9][0-9]?)\d{7}$/', $_POST['phone_number'])) {
        $errors['phone_number'] = 'Fout: Telefoonnummer ontbreekt of is verkeerd!';
    }

    // kleur controleren
    if (empty($_POST['color'])) {
        $errors['color'] = 'Fout: Kleur ontbreekt!';
    }
    //maat controleren
    if (empty($_POST['size'])) {
        $errors['size'] = 'Fout: Maat ontbreekt!';
    }

    // Als er geen fouten zijn, de gegevens naar de volgende pagina doorsturen
    if (!array_filter($errors)) {
        $_SESSION['name'] = $_POST['name'];
        $_SESSION['email'] = $_POST['email'];
        $_SESSION['address'] = $_POST['address'];
        $_SESSION['postcode'] = $_POST['postcode'];
        $_SESSION['phone_number'] = $_POST['phone_number'];
        $_SESSION['color'] = $_POST['color'];
        $_SESSION['size'] = $_POST['size'];

        // Doorsturen naar de volgende pagina
        header('Location: confirmation.php');
        exit;
    }
}
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="css/style.css">
    <title>Document</title>
</head>
<header class="all-header">
    <nav id="nav-section">
        <img src="img/Logo_Teal.png">
        <a class="buttons" id="nav-button" href="landing-page.php">Terug naar Home</a>
    </nav>
</header>
<body>
<body>
<div class="photo-container">
    <h4 style="text-align:center">Motion Wing <br> <span class="fiets-span"> Fiets Stuur </span> </h4>

    <div class="container">
        <div class="mySlides">
            <div class="numbertext">1 / 3</div>
            <img class="img-order" src="img/light-test-photo.png" style="width:100%">
        </div>

        <div class="mySlides">
            <div class="numbertext">2 / 3</div>
            <img class="img-order" src="img/blue-test-photo.png" style="width:100%">
        </div>

        <div class="mySlides">
            <div class="numbertext">3 / 3</div>
            <img class="img-order" src="img/dark-test-photo.png" style="width:100%">
        </div>


        <a class="prev" onclick="plusSlides(-1)">❮</a>
        <a class="next" onclick="plusSlides(1)">❯</a>


        <div class="row">
            <div class="column">
                <img class="demo cursor" src="img/light-test-photo.png" style="width:100%" onclick="currentSlide(1)"
                     alt="White Color Product">
            </div>
            <div class="column">
                <img class="demo cursor" src="img/blue-test-photo.png" style="width:100%" onclick="currentSlide(2)"
                     alt="Blue Color Product">
            </div>
            <div class="column">
                <img class="demo cursor" src="img/dark-test-photo.png" style="width:100%" onclick="currentSlide(3)"
                     alt="Black Color Product">
            </div>
        </div>
    </div>
</div>







<div class="info-container">

    <h5>Gegevens</h5>

    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" class="form-container">
        <div class="users">
            <div class="form-group">
                <label for="color">Kleur:</label>
                <select id="color" name="color">
                    <option value="">Kies een kleur</option>
                    <option value="red">Zwart</option>
                    <option value="blue">Blauw</option>
                    <option value="green">Grijs</option>
                </select>
                <div class="error"><?php echo $errors['color']; ?></div>
            </div>

            <div class="form-group">
                <label for="size">Gripdikte:</label>
                <select id="size" name="size">
                    <option value="">Kies een gripdikte</option>
                    <option value="thin">Dun</option>
                    <option value="medium">Gemiddeld</option>
                    <option value="thick">Dik</option>
                    <option value="extra-thick">Extra Dik</option>
                    <option value="custom">Weet ik niet</option>
                </select>
                <div class="error"><?php echo $errors['size']; ?></div>
                <p class="size-message">Ben je niet zeker van de maat? Neem dan contact met ons op.</p>

            </div>

        </div>
        <div class="form-group">
            <label for="name">Naam:</label>
            <input type="text" id="name" name="name" placeholder="Naam" value="<?php echo htmlspecialchars($_POST['name'] ?? ''); ?>">
            <div class="error"><?php echo $errors['name']; ?></div>
        </div>

        <div class="form-group">
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" placeholder="Email" value="<?php echo htmlspecialchars($_POST['email'] ?? ''); ?>">
            <div class="error"><?php echo $errors['email']; ?></div>
        </div>

        <div class="address-code">
            <div class="form-group">
                <label for="address">Adres:</label>
                <input type="text" id="address" name="address" placeholder="Adres" value="<?php echo htmlspecialchars($_POST['address'] ?? ''); ?>">
                <div class="error"><?php echo $errors['address']; ?></div>
            </div>

            <div class="form-group">
                <label for="postcode">Postcode:</label>
                <input type="text" id="postcode" name="postcode" placeholder="Postcode" value="<?php echo htmlspecialchars($_POST['postcode'] ?? ''); ?>">
                <div class="error"><?php echo $errors['postcode']; ?></div>
            </div>
        </div>

        <div class="form-group">
            <label for="tel">Telefoonnummer:</label>
            <input type="tel" id="tel" name="phone_number" placeholder="Telefoon nummer" value="<?php echo htmlspecialchars($_POST['phone_number'] ?? ''); ?>">
            <div class="error"><?php echo $errors['phone_number']; ?></div>
        </div>

        <div class="button-container">
            <button type="submit" name="submit" class="submit-button">Bestellen</button>
        </div>
    </form>
</div>







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


<script>
    // Photo Gallery
    let slideIndex = 1;
    showSlides(slideIndex);
    function plusSlides(n) {
        showSlides(slideIndex += n);
    }
    function currentSlide(n) {
        showSlides(slideIndex = n);
    }
    function showSlides(n) {
        let i;
        let slides = document.getElementsByClassName("mySlides");
        let dots = document.getElementsByClassName("demo");
        if (n > slides.length) {
            slideIndex = 1
        }
        if (n < 1) {
            slideIndex = slides.length
        }
        for (i = 0; i < slides.length; i++) {
            slides[i].style.display = "none";
        }
        for (i = 0; i < dots.length; i++) {
            dots[i].className = dots[i].className.replace(" active", "");
        }
        slides[slideIndex - 1].style.display = "block";
        dots[slideIndex - 1].className += " active";
    }


    // Submit Button Press
    // let button;
    //
    // function submitButton() {
    //     button = document.querySelector(".submit-button");
    //     button.addEventListener("click", buttonPressed);
    // }
    //
    // function buttonPressed() {
    //     document.querySelector(".form-container").submit();
    //     window.location.assign('conformation.php');
    // }
    //
    // submitButton();

    document.addEventListener("DOMContentLoaded", function() {
        document.getElementById("myForm").addEventListener("submit", function(event) {
            // Prevent the default form submission
            event.preventDefault();

            // Verzenden van het formulier naar de adminpagina via AJAX
            let formData = new FormData(this);
            let xhr = new XMLHttpRequest();
            xhr.open("POST", "admin.php", true);
            xhr.onreadystatechange = function() {
                if (xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200) {
                    // Doorsturen van de gebruiker naar de bedankpagina
                    window.location.href = "confirmation.php";
                }
            };
            xhr.send(formData);
        });
    });


</script>


</body>
</html>