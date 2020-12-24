<?php
session_name('LoginForm');
@session_start();

error_reporting(0);
include("config.php");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!--Boostrap-->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <!--Font-->
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    
    <!--Style file-->
    <link rel="stylesheet" href="assets/css/style.css">
    <script src="assets/js/main.js"></script>

    <!--Animation.css-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">

    <title>Homepage</title>



</head>

<body data-new-gr-c-s-check-loaded="8.867.0">
    <!--Header / Navbar-->
    <nav id="mainNav" class="navbar navbar-expand-md fixed-top animate__animated animate__slideInDown">
        <div class="container">
            <a href="index.php" class="navbar-brand font-weight-bold" id="projectName">Bookstore</a>
            <button type="button" class="btn" data-toggle="collapse" data-target="#navbarDefault"><i
                    class="material-icons" id="nav-icon" style="font-size: 36px;">menu</i></button>

            <div id="navbarDefault" class="navbar-collapse collapse justify-content-end">
                <ul class="nav navbar-nav text-uppercase font-weight-bold">
                    <li class="nav-item">
                        <a href="index.php" class="nav-link nav-link-hover active-item">Home</a>
                    </li>
                    <li class="nav-item">
                        <a href="about.php" class="nav-link nav-link-hover">About</a>
                    </li>
                    <li class="nav-item">
                        <a href="categories.php" class="nav-link nav-link-hover">Categories</a>
                    </li>
                    <li class="nav-item">
                        <a href="products.php" class="nav-link nav-link-hover">Products</a>
                    </li>
                    <li class="nav-item">
                        <a href="contact.php" class="nav-link nav-link-hover">Contact</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <!--Intro Section-->
    
    <!--Preloader-->
    <div id="preloader"></div>


    <div id="home" class="intro justify-content-center align-items-center d-flex">
    <div>
    <div class="container">
        <h1>Welcome</h1>
        <?php
        // check if user is logged
        $error = '';
        if (isset($_POST['is_login'])) {
            $sql = "SELECT * FROM " . $SETTINGS["USERS"] . " WHERE `email` = '" . $mysqli->real_escape_string($_POST['email']) . "' AND `password` = '" . $mysqli->real_escape_string($_POST['password']) . "'";
            if ($result = $mysqli->query($sql)) {

                $user = $result->fetch_assoc();
                $result->free();
                if (!empty($user)) {
                    $_SESSION['user_info'] = $user;
                    $sql = " UPDATE " . $SETTINGS["USERS"] . " SET last_login = NOW() WHERE id=" . $user['id'];
                    if (!$mysqli->query($sql)) {
                        printf("Error: %s\n", $mysqli->sqlstate);
                        exit;
                    }
                } else {
                    $error = 'Wrong email or password.';
                }
            } else {
                printf("Error: %s\n", $mysqli->sqlstate);
                exit;
            }
        }

        // action when logout is pressed
        if (isset($_GET['ac']) && $_GET['ac'] == 'logout') {
            $_SESSION['user_info'] = null;
            unset($_SESSION['user_info']);
        }
        if ($error !==''){
            ?><div class="alert alert-danger">
                <strong>Error</strong> <?php echo $error; ?>
            </div>
            <?php
        }
        ?>
        <?php
        // logged in info
        if (isset($_SESSION['user_info']) && is_array($_SESSION['user_info'])) { ?>

            <form id="login-form" class="login-form" name="form1">

                <div id="form-content">
                    <div class="welcome">
                        <?php echo $_SESSION['user_info']['name'] ?>, you are logged in.
                        <br/><br/>
                        <?php echo $_SESSION['user_info']['content'] ?>
                        <br/><br/>
                        <button><a href="index.php?ac=logout" style="color:#3ec038">Logout</a></button>
                    </div>
                </div>

            </form>

        <?php } else {
            //login form
            ?>
            <form id="login-form" class="login-form" name="form1" method="post" action="index.php">
                <input type="hidden" name="is_login" value="1">
                <input id="email" name="email" class="required" type="email" placeholder="Email"><br> <br>
                <input id="password" name="password" class="required" type="password" placeholder="Password">
                <br>
                <br>
                <div><button type="submit" id="login-button">Login</button></div>

            </form>
        <?php } ?>
    </div>
</div>
</div>
</body>

</html>