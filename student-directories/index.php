<?php
require 'db.php';

$search = isset($_GET['search']) ? $_GET['search'] : '';
$stmt = $conn->prepare("SELECT * FROM students WHERE name LIKE ? OR roll_no LIKE ? ORDER BY batch DESC");
$like = "%$search%";
$stmt->bind_param("ss", $like, $like);
$stmt->execute();
$result = $stmt->get_result();
?>


<!DOCTYPE html>
<html>
<head>
    <title>CSE Student Directory</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <h1>CSE Department Student Directory</h1>
     <h2>Search Students</h2>
    <form method="GET">
        <input type="text" name="search" placeholder="Search by name or roll no" value="<?= htmlspecialchars($search) ?>">
        <button type="submit">Search</button>
    </form>
    <table>
        <tr>
            <th>Photo</th>
            <th>Name</th>
            <th>Roll No</th>
            <th>Email</th>
            <th>Phone</th>
            <th>Batch</th>
            <th>Father's Name</th>
        </tr>
        <?php while ($row = $result->fetch_assoc()): ?>
        <tr>
            <td><img src="<?= $row['photo'] ?>" width="50"></td>
            <td><?= htmlspecialchars($row['name']) ?></td>
            <td><?= htmlspecialchars($row['roll_no']) ?></td>
            <td><?= htmlspecialchars($row['email']) ?></td>
            <td><?= htmlspecialchars($row['phone']) ?></td>
            <td><?= htmlspecialchars($row['batch']) ?></td>
            <td><?= htmlspecialchars($row['father_name']) ?></td>
            
        </tr>
        <?php endwhile; ?>
    </table>
    <p><a href="login.php">Admin Login</a></p>
</body>
</html>
