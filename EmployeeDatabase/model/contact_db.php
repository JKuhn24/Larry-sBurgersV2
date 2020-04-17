<?php
//Original Author: Jeffrey Kuhn
//Date Created: 1-31-20
//Version: 2 (First Live Version)
//Date Last Modified: 2-12-20
//Modified by: Jeffrey Kuhn
//Modification changed function method for getDB, moved insertIntoDatabase from thankyou.php to here

// Build array to display on page
function get_contacts_by_category($employeeID) {
    $db = Database::getDB();
    $query = 'SELECT * FROM contact
              WHERE contact.employeeID = :employeeID
              ORDER BY contactID';
    $statement = $db->prepare($query);
    $statement->bindValue(':employeeID', $employeeID);
    $statement->execute();
    $contact = $statement->fetchAll();
    $statement->closeCursor();
    return $contact;
}
//delete a contact after responding
function delete_contact($contactID) {
    $db = Database::getDB();
    $query = 'DELETE FROM contact
              WHERE contactID = :contactID';
    $statement = $db->prepare($query);
    $statement->bindValue(':contactID', $contactID);
    $statement->execute();
    $statement->closeCursor();
}

function insertIntoDatabase($contactName, $contactPhone, $contactMail, $contactMessage, $employeeID, $db){
// Add the product to the database  
$query = 'INSERT INTO contact
             (employeeID, contactName, contactPhone, contactMail, contactMessage)
            VALUES
             (:employeeID, :contactName, :contactPhone, :contactMail, :contactMessage)';
$statement = $db->prepare($query);
$statement->bindValue(':employeeID', $employeeID);
$statement->bindValue(':contactName', $contactName);
$statement->bindValue(':contactPhone', $contactPhone);
$statement->bindValue(':contactMail', $contactMail);
$statement->bindValue(':contactMessage', $contactMessage);
$statement->execute();
$statement->closeCursor();
}

?>