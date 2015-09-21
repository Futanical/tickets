<!DOCTYPE html>
<html lang="en">
<head>
    <title>Support</title>
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/reset.css">
    <link rel="stylesheet" href="../css/hover.css">
    <link rel="stylesheet" href="../css/hover-min.css">
    <script src="../ckeditor/ckeditor.js"></script>
</head>
<body>
<header>

    <?php if (isset($_SESSION['admin']) && $_SESSION['admin'] === '1') {
        include '../includes/adminNav.php';
    } else {
        include '../includes/nav.php';
    } ?>

</header>
<section class="tickets">

    <?php dbError($error); ?>

    <h1 class="tickets-header">Submit a Comment</h1>

    <h2 class="greeting">Welcome, <?php echo $_SESSION['firstName']; ?></h2>

    <hr class="style-two">

    <form id="createTicket" method="post" action="" class="center-block-create-ticket">

        <label class="label" for="commentBody">Leave Your Comment</label>
        <textarea id="commentBody" name="commentBody" rows="8" cols="100"></textarea>

        <script>
            CKEDITOR.replace( 'commentBody' );
        </script>

        <input type="submit" name="submit" id="submit" value="Submit">

    </form>
</section>
</body>
</html>