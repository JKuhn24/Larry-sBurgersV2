<?php
//Original Author: Jeffrey Kuhn
//Date Created: 1-31-20
//Version: 2 (First Live Version)
//Date Last Modified: 2-7-20
//Modified by: Jeffrey Kuhn
//Modification log: Changed method to getDB

// Get categories for table
function get_categories() {
    $db = Database::getDB();
    $query = 'SELECT * FROM employee
              ORDER BY employeeID';
    $statement = $db->prepare($query);
    $statement->execute();
    return $statement;    
}
// get the names of the categories
function get_category_name($employeeID) {
    $db = Database::getDB();
    $query = 'SELECT * FROM employee
              WHERE employeeID = :employeeID';    
    $statement = $db->prepare($query);
    $statement->bindValue(':employeeID', $employeeID);
    $statement->execute();    
    $category = $statement->fetch();
    $statement->closeCursor();    
    $category_name = $category['employeeName'];
    return $category_name;
}
?>