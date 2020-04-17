<?php
//Original Author: Jeffrey Kuhn
//Date Created: 1-31-20
//Version: 2 (First Live Version)
//Date Last Modified: 1-31-20
//Modified by: Jeffrey Kuhn
//Modification log: page created

//get access to database and other functions
require('model/database.php');
require('model/contact_db.php');
require('model/employee_db.php');

//check credentials
if (filter_input(INPUT_POST, 'username') != NULL || filter_input(INPUT_POST, 'password') != NULL){
$adminUsername = filter_input(INPUT_POST, 'username');
$adminPassword = filter_input(INPUT_POST, 'password');

if ($adminUsername != 'root' || $adminPassword != 'Pa$$w0rd'){
    $error = "Please enter the correct username and password.";
    include ('error.php');
    exit();
}
}
//Detect actions on the form
$action = filter_input(INPUT_POST, 'action');
//list contacts
if ($action == NULL) {
    $action = filter_input(INPUT_GET, 'action');
    if ($action == NULL) {
        $action = 'list_contacts';
    }
}

//list contacts according to action
if ($action == 'list_contacts') {
    $employeeID = filter_input(INPUT_GET, 'employeeID', 
            FILTER_VALIDATE_INT);
    if ($employeeID == NULL || $employeeID == FALSE) {
        $employeeID = 1;
    }
    $category_name = get_category_name($employeeID);
    $categories = get_categories();
    $contacts = get_contacts_by_category($employeeID);
    include('contactList.php');

    //Delete information in the contact form
} else if ($action == 'delete_contact') {
    $contactID = filter_input(INPUT_POST, 'contactID', 
            FILTER_VALIDATE_INT);
    $employeeID = filter_input(INPUT_POST, 'employeeID', 
            FILTER_VALIDATE_INT); 
        delete_contact($contactID);
        header("Location: .?employeeID=$employeeID");
    } 
    else if ($action == 'list_categories') {
    $categories = get_categories();
    include('category_list.php');
}   

?>