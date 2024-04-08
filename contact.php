<?php
session_start();

$errors = ['name' => '', 'email' => '', 'address' => '', 'postcode' => '', 'phone_number' => '', 'color' => '', 'size' => ''];

// Controleer of het formulier is ingediend
if (isset($_POST['submit'])) {
    // Naam controleren
    if (empty($_POST['name'])) {
        $errors['name'] = 'Fout: Naam ontbreekt!';
    }

    // E-mail controleren
    if (empty($_POST['email'])) {
        $errors['email'] = 'Fout: email ontbreekt!';
    }

    // Adres controleren
    if (empty($_POST['address'])) {
        $errors['address'] = 'Fout: adres ontbreekt!';
    }

    // Postcode controleren
    if (empty($_POST['postcode'])) {
        $errors['postcode'] = 'Fout: postcode ontbreekt!';
    }

    // Telefoonnummer controleren
    if (empty($_POST['phone_number'])) {
        $errors['phone_number'] = 'Fout: telefoonnummer ontbreekt!';
    }

    // kleur controleren
    if (empty($_POST['color'])) {
        $errors['color'] = 'Fout: kleur ontbreekt!';
    }
    //maat controleren
    if (empty($_POST['size'])) {
        $errors['size'] = 'Fout: kleur ontbreekt!';
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

        // Doorsturen naar de volgende pagina (datum kiezen)
        header('Location: index.php');
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
    <title>Magazine</title>
    <link rel="stylesheet" href="css/style2.css">
</head>
<body>
<main>
    <div class="info-container">

        <div>
            <h1>Gegevens</h1>
        </div>

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
                   <div class="color"><?php echo $errors['color']; ?></div>
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
                   <p>Ben je niet zeker van de maat? Neem dan contact met ons op.</p>

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
</main>
</body>
</html>
