<?php
require_once "config.php";
if (!$user->isLoggedIn()) header("Location: login.php");

$id = $_GET['id'] ?? null;
$existing = $student->getById($id);

if (!$existing) {
    echo "Student not found!";
    exit;
}

$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = Validator::sanitize($_POST['name']);
    $email = Validator::sanitize($_POST['email']);
    $phone = Validator::sanitize($_POST['phone']);
    $address = Validator::sanitize($_POST['address']);

    if (!Validator::required($name)) {
        $error = "Name is required.";
    } elseif ($email && !Validator::isEmail($email)) {
        $error = "Invalid email format.";
    } else {
        $student->update($id, $name, $email, $phone, $address);
        header("Location: index.php");
        exit;
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Edit Student</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">
    <div class="container mt-5">

        <div class="card">
            <div class="card-header bg-warning text-white">
                Edit Student
            </div>
            <div class="card-body">
                <?php if ($error): ?>
                    <div class="alert alert-danger"><?= $error ?></div>
                <?php endif; ?>
                <form method="post">
                    <div class="mb-3">
                        <label class="form-label">Name:</label>
                        <input type="text" name="name" class="form-control" value="<?= htmlspecialchars($existing['name']) ?>" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Email:</label>
                        <input type="email" name="email" class="form-control" value="<?= htmlspecialchars($existing['email']) ?>">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Phone:</label>
                        <input type="text" name="phone" class="form-control" value="<?= htmlspecialchars($existing['phone']) ?>">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Address:</label>
                        <textarea name="address" class="form-control"><?= htmlspecialchars($existing['address']) ?></textarea>
                    </div>
                    <button type="submit" class="btn btn-success">Update</button>
                    <a href="index.php" class="btn btn-secondary">Back</a>
                </form>
            </div>
        </div>

    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>