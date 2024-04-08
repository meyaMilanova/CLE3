<?php
// verbinding met de database
$db = mysqli_connect('localhost', '1070054@hr.nl', '12345', 'CLE3');

// controleer het
if (!$db) {
    die("Connection failed: " . mysqli_connect_error());
}

// maak een item
if (isset($_POST['create'])) {
    $item_name = mysqli_real_escape_string($db, $_POST['item_name']);
    $query = "INSERT INTO users (name) VALUES ('$item_name')";
    mysqli_query($db, $query);
}

// Verwijder een item
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $query = "DELETE FROM users WHERE id=$id";
    mysqli_query($db, $query);
}

// Bewerk een item
if (isset($_POST['update'])) {
    $id = $_POST['id'];
    $name = mysqli_real_escape_string($db, $_POST['name']);
    $query = "UPDATE users SET name='$name' WHERE id=$id";
    mysqli_query($db, $query);
}

// Haal alle items op
$query = "SELECT * FROM users";
$result = mysqli_query($db, $query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <style>
        table {
            border-collapse: collapse;
            width: 100%;
        }
        th, td {
            border: 1px solid #dddddd;
            text-align: left;
            padding: 8px;
        }
        th {
            background-color: #f2f2f2;
        }
        form {
            display: inline-block;
        }
    </style>
</head>
<body>
<h2>Bestellingen</h2>
<table>
    <thead>
    <tr>
        <th>ID</th>
        <th>Name</th>
        <th>Actions</th>
    </tr>
    </thead>
    <tbody>
    <?php while ($row = mysqli_fetch_assoc($result)) { ?>
        <tr>
            <td><?php echo $row['id']; ?></td>
            <td>
                <form action="admin.php<?php if(isset($_GET['delete'])) echo '?delete=' . $_GET['delete']; ?>" method="post">
                    <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                    <input type="text" name="name" value="<?php echo $row['name']; ?>">
                    <button type="submit" name="update">Update</button>
                </form>
            </td>
            <td>
                <a href="admin.php?delete=<?php echo $row['id']; ?>">Delete</a>
            </td>
        </tr>
    <?php } ?>
    </tbody>
</table>
</body>
</html>
