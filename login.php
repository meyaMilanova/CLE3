<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();

// Database connection
$db = mysqli_connect('localhost', '1070054@hr.nl', '12345', 'CLE3');

// Check the database connection
if (!$db) {
    die("Connection failed: " . mysqli_connect_error());
}

$errors = ['email' => '', 'password' => ''];

// Function to redirect the user to the admin page
function redirectToAdminPage()
{
    header('Location: admin.php');
    exit;
}

if (isset($_POST['submit'])) {
    // Check if email is filled
    if (empty($_POST['email'])) {
        $errors['email'] = 'You must fill in your email';
    } else {
        // Validate email format
        if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
            $errors['email'] = 'Invalid email format';
        }
    }

    // Check if password is filled
    if (empty($_POST['password'])) {
        $errors['password'] = 'You must fill in your password';
    }

    // No errors? Proceed
    if (empty($errors['email']) && empty($errors['password'])) {
        $email = mysqli_real_escape_string($db, $_POST['email']);
        $password = mysqli_real_escape_string($db, $_POST['password']);

        $query = "SELECT id, password, is_verified FROM admin WHERE email ='$email'";
        $result = mysqli_query($db, $query);
        if (!$result) {
            die("Query failed: " . mysqli_error($db));
        }

        if (mysqli_num_rows($result) == 1) {
            $user = mysqli_fetch_assoc($result);
            if (password_verify($password, $user['password'])) {
                // Authentication successful, set session variables
                $_SESSION['id'] = $user['id'];
                $_SESSION['email'] = $email;
                $_SESSION['password'] = password_hash($password, PASSWORD_DEFAULT);
                $_SESSION['verification'] = $user['is_verified'];
                setcookie('session_id', session_id(), time() + 86400);

                // Step 1: Retrieve passwords from the database
                $query = "SELECT id, password FROM admin";
                $result = mysqli_query($db, $query);

                if ($result) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        $id = $row['id'];
                        $password = $row['password'];

                        // Step 2: Hash passwords in PHP
                        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

                        // Step 3: Update passwords in the database
                        $updateQuery = "UPDATE admin SET password = '$hashedPassword' WHERE id = $id";
                        mysqli_query($db, $updateQuery);
                    }
                } else {
                    echo "Error retrieving records from the database: " . mysqli_error($db);
                }

                // Redirect to the admin page
                redirectToAdminPage();
            } else {
                // Incorrect email or password
                $errors['loginFailed'] = "Incorrect email or password";
            }
        } else {
            // Incorrect email or password
            $errors['loginFailed'] = "Incorrect email or password";
        }
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
    <title>Login page</title>
    <link rel="stylesheet">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .container {
            background-color: #fff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 300px;
        }

        h2 {
            margin-top: 0;
        }

        .control {
            margin-bottom: 15px;
        }

        .label {
            display: block;
            margin-bottom: 5px;
        }

        .input {
            width: 100%;
            padding: 8px;
            border: 1px solid #ccc;
            border-radius: 3px;
        }

        .error {
            color: red;
            font-size: 14px;
            margin-top: 5px;
        }

        input[type="submit"] {
            background-color: #007bff;
            color: #fff;
            border: none;
            padding: 10px 20px;
            border-radius: 3px;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
<section>
    <div>
        <h2>Log in to your account</h2>
        <form action="<?= htmlspecialchars($_SERVER["PHP_SELF"]) ?>" method="post">
            <div class="control">
                <label class="label" for="email">Email</label>
                <input class="input" id="email" type="text" name="email"
                       value="<?= htmlspecialchars($_POST['email'] ?? '') ?>">
                <div class="error"><?= $errors['email'] ?></div>
                <label class="label" for="password">Password</label>
                <input class="input" id="password" type="password" name="password">
                <div class="error"><?= $errors['password'] ?></div>
            </div>
            <input type="submit" name="submit" value="Login">
        </form>
    </div>
</section>
</body>
</html>
