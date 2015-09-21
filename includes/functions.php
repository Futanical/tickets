<?php

function retainForm($key) {
    if ($_POST && (isset($_POST[$key]))) {
        echo $_POST[$key];
    } else {
        echo '';
    }
}

function retainFormState($state) {
    if ($_POST && $_POST['state'] == "$state") {
        echo 'selected';
    }
}

function errorHandle($missingArray, $key, $missingArray, $error) {
    if ($missingArray && in_array($key, $missingArray)) { ?>
        <span class="warning"><?php echo $error; ?></span>
    <?php }
}

function commentCount($id, $conn) {
    $sql = "SELECT comment FROM comments INNER JOIN tickets ON comments.ticket_id = tickets.ticket_id WHERE tickets.ticket_id = :ticketID";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':ticketID', $id);
    $stmt->execute();
    $rowCount = $stmt->rowCount();

    return $rowCount + 1;
}

function dbError($error) {
    if (isset($error)) { ?>
        <p class="db-error"><?php echo $error; ?></p>
    <?php }
}
