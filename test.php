<?php

require './config/config.php';

$conn = connect($config);

// CREATE THE TICKET

//$sql = "SELECT id FROM users WHERE username = 'Futanical'";
//$stmt = $conn->query($sql);
//$stmt->execute();
//$userRowId = $stmt->fetch(PDO::FETCH_ASSOC);
//
//$sql = "INSERT INTO tickets (created, ticket_name, ticket_text, user_id) VALUES(now(), 'Test', 'This is a ticket test', '$userRowId[id]')";
//$stmt = $conn->query($sql);

// DISPLAY TICKETS ON PAGE WITH LINK TO SINGULAR TICKET USING $_GET['ticket_id']

//$sql = "SELECT ticket_id, ticket_name, ticket_text FROM tickets INNER JOIN users ON users.id = tickets.user_id WHERE username = 'Futanical';";
//$stmt = $conn->query($sql);
//$stmt->execute();
//$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

//foreach ($rows as $row) { ?>
<!--    <p><a href="ticket.php?id=--><?php //echo $row['ticket_id']; ?><!--">--><?php //echo $row['ticket_name']; ?><!--</a></p>-->
<?php //}

// REDIRECTED TO SINGULAR TICKET IN ORDER TO COMMENT ON TICKET NOW THAT WE HAVE TICKET ID

//$sql = "INSERT INTO comments (comment, user_id, ticket_id) VALUES('This is a comment', '$userRowId[id]', '$row[ticket_id]')";
//$stmt = $conn->query($sql);
//

// TO VIEW ALL COMMENTS
//$sql = "SELECT comment, username FROM comments INNER JOIN users ON users.id = comments.user_id";
//$stmt = $conn->query($sql);
//$stmt->execute();
//$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
//
//print_r($result); die();

// TO SPIT OUT COMMENTS FROM A SINGULAR TICKET ON PAGE
// SELECT comment, username, tickets.ticket_id FROM comments INNER JOIN users ON users.id = comments.user_id INNER JOIN tickets ON tickets.ticket_id = comments.ticket_id WHERE tickets.ticket_id = 34;

?>






