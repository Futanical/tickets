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

    <h1 class="tickets-header">Submit a Ticket</h1>

    <h2 class="greeting">Welcome, <?php echo $_SESSION['firstName']; ?></h2>

    <hr class="style-two">

    <form id="createTicket" method="post" action="" class="center-block-create-ticket">

        <?php dbError($error); ?>

        <label class="label" for="ticketName">Subject</label>
        <input type="text" name="ticketName" id="ticketName">

        <label class="label" for="ticketBody">Describe Your Issue</label>
        <textarea id="ticketBody" name="ticketBody" rows="8" cols="100"></textarea>

        <script>
            // Replace the <textarea id="editor1"> with a CKEditor
            // instance, using default configuration.
            CKEDITOR.replace( 'ticketBody' );
        </script>

        <input type="submit" name="submit" id="submit" value="Submit">

    </form>

</section>
</body>
</html>