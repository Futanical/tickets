<!DOCTYPE html>
<html lang="en">
<head>
    <title>Sign Up!</title>
    <link rel="stylesheet" href="./css/bootstrap.css">
    <link rel="stylesheet" href="./css/bootstrap.min.css">
    <link rel="stylesheet" href="./css/bootstrap-responsive.css">
    <link rel="stylesheet" href="./css/bootstrap-responsive.min.css">
    <link rel="stylesheet" href="./css/style.css">
    <link href='http://fonts.googleapis.com/css?family=PT+Sans:400,700,400italic,700italic' rel='stylesheet'
          type='text/css'>
</head>
<body>
<div class="container">
    <span class="span12">

        <form id="" method="post" action="" class="center-block">

            <?php echo "<p class='db-error'>$error</p>"; ?>

            <label for="username">Username</label>
            <input type="text" name="username" id="username">

            <label for="password">Password</label>
            <input type="password" name="password" id="password">

            <input type="submit" name="login" id="login" value="Login">

        </form>

        <p class="sign-up">Don't have an account? <a href="./controllers/signUp.php">Sign up!</a></p>

    </span>
</div>
</body>
</html>