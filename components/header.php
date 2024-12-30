<?php

// Check if user is logged in
if (!isset($_SESSION['user_id']) || !isset($_SESSION['first_name'])) {
    // Redirect to login page
    header("Location: login.php");
    exit();
}

// Retrieve session variables
$userId = $_SESSION['user_id'];
$firstName = $_SESSION['first_name'];
?>
<nav class="navbar navbar-expand-lg bg-body-tertiary">
    <div class="container-fluid">
        <a class="navbar-brand" href="#">iTasks</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="#">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Link</a>
                </li>
            </ul>
            <div class="d-flex">
                <p class="me-2" id="<?php echo $userId; ?>">Welcome
                    <?php echo $firstName; ?>
                </p>
                <a href="logout.php" class="btn btn-outline-danger">Logout</a>
            </div>
        </div>
    </div>
</nav>