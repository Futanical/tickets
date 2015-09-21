<!DOCTYPE html>
<html lang="en">
<head>
    <title>Support</title>
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/reset.css">
    <link rel="stylesheet" href="../css/hover.css">
    <link rel="stylesheet" href="../css/hover-min.css">
    <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
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
<section class="comments-section">

    <?php dbError($error); ?>

    <h1 class="single-tickets-header"><?php echo $ticket['ticket_name']; ?></h1>

    <?php if (isset($ticketStatus['open']) && $ticketStatus['open'] === '1') { ?>
        <small class='status open'>open</small>
    <?php } elseif (isset($ticketStatus['open']) && $ticketStatus['open'] === '0') { ?>
        <small class='status closed'>closed</small>
    <?php
    } ?>

    <hr class="style-three">

    <i class="fa fa-reply"></i><h2 class="reply"><a href="../user/comment.php?id=<?php echo $_GET['id']; ?>">Reply</h2></a>

    <?php if (isset($_SESSION['admin']) && $_SESSION['admin'] === '1') { ?>
        <form method="post" action="">
            <i class="fa fa-times"></i><input type="submit" name="deleteTicket" id="deleteTicket" value="Delete">
            <?php if (isset($ticketStatus['open']) && $ticketStatus['open'] === '1') { ?>
                <i class="fa fa-power-off"></i><input type="submit" name="closeTicket" id="closeTicket" value="Close">
            <?php } elseif (isset($ticketStatus['open']) && $ticketStatus['open'] === '0') { ?>
                <i class="fa fa-power-off"></i><input type="submit" name="closeTicket" id="closeTicket" value="Open">
            <?php
            } ?>
        </form>
    <?php } ?>

    <section class="comment">

        <a href="editTicket.php?id=<?php echo $ticket['ticket_id']; ?>"><i class="fa fa-pencil-square-o"></i></a>

        <div class="profile">
            <img src="<?php echo $ticket['picture_url'] ?>" class="img-circle">
            <div class="comments-name"><?php echo $ticket['first_name'] . ' ' . $ticket['last_name']; ?></div>
        </div>
        <div class="comments">
            <p><?php echo html_entity_decode($ticket['ticket_text']); ?></p>
        </div>
    </section>

    <?php foreach ($rows as $row) { ?>
    <section class="comment">

        <?php if ($row['id'] === $_SESSION['userId'] || $_SESSION['admin'] === '1') { ?>
        <a href="editComment.php?id=<?php echo $row['comment_id']; ?>"><i class="fa fa-pencil-square-o"></i></a>
        <a href="deleteComment.php?id=<?php echo $row['comment_id']; ?>"><i class="fa fa-times delete"></i></a>
        <?php } ?>

        <div class="profile">
            <img src="<?php echo $row['picture_url'] ?>" class="img-circle">
            <div class="comments-name"><?php echo $row['first_name'] . ' ' . $row['last_name']; ?></div>
        </div>
        <div class="comments">
            <p><?php echo $row['comment']; ?></p>
        </div>
    </section>
    <?php } ?>

</section>
</body>
</html>