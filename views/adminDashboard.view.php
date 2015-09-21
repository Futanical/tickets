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
<section class="tickets">

    <?php dbError($error); ?>

    <?php
    $end = end($rows);
    if ($stmt->rowCount() >= 1) {

        foreach ($rows as $row) {
            $date = date('F jS, Y', strtotime($row['created']));
            ?>
            <div class="ticket-info">
                <p>
                    <?php if (isset($row['open']) && $row['open'] === '1') { ?>
                        <?php echo "<small class='mini-status open'>open</small>"; ?>
                    <?php } elseif (isset($row['open']) && $row['open'] === '0') { ?>
                        <?php echo "<small class='mini-status closed'>closed</small>"; ?>
                    <?php }
                    echo "<a href='../user/singleTicket.php?id=$row[ticket_id]'><span class='ticket-name'>$row[ticket_name]</span></a>";
                    ?>
                </p>

                <?php if (isset($row['open']) && $row['open'] === '0') { ?>
                    <p class="submitted-closed"><b>Submitted On:</b> <?php echo $date; ?></p>
                    <p class="submitted-closed"><b>Submitted By:</b> <?php echo $row['first_name'] . ' ' . $row['last_name']; ?></p>
                <?php } else { ?>
                    <p class="submitted"><b>Submitted On:</b> <?php echo $date; ?></p>
                    <p class="submitted"><b>Submitted By:</b> <?php echo $row['first_name'] . ' ' . $row['last_name']; ?></p>
                <?php } ?>

                <div class="comment-count-admin">
                    <i class="fa fa-comment"></i><?php echo commentCount($row['ticket_id'], $conn); ?>
                </div>

                <?php if ($row != $end) { ?>
                    <hr class="style-one">
                <?php } ?>
            </div>
        <?php
        }
    } elseif (isset($_SESSION['admin']) && $_SESSION['admin'] === '1') { ?>
        <div class="no-tickets">
            <h1 class="no-ticket-header">No Tickets Found</h1>
            <p class="no-ticket-paragraph">Would you like to view all a <a href="../admin/users.php">users?</a></p>
        </div>
    <?php } else { ?>
        <div class="no-tickets">
            <h1 class="no-ticket-header">No Tickets Found</h1>
            <p class="no-ticket-paragraph">Would you like to submit a <a href="./createTicket.php">ticket?</a></p>
        </div>
    <?php } ?>
</section>
</body>
</html>