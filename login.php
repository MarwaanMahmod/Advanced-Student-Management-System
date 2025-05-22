<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Student Management</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">
    <div class="container mt-5">




        <?php
        require_once "config.php";

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $username = Validator::sanitize($_POST['username']);
            $password = $_POST['password'];

            if ($user->login($username, $password)) {
                header("Location: index.php");
                exit;
            } else {
                $error = "Invalid login credentials.";
            }
        }
        ?>

        <div class="row justify-content-center">
            <div class="col-md-4">
                <div class="card">
                    <div class="card-header bg-primary text-white">Login</div>
                    <div class="card-body">
                        <?php if (isset($error)): ?>
                            <div class="alert alert-danger"><?= $error ?></div>
                        <?php endif; ?>
                        <form method="post">
                            <div class="mb-3">
                                <label class="form-label">Username:</label>
                                <input type="text" name="username" class="form-control" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Password:</label>
                                <input type="password" name="password" class="form-control" required>
                            </div>
                            <button class="btn btn-success w-100" type="submit">Login</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>


    </div> <!-- end container -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>