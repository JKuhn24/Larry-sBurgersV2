<?php



$dsn = 'mysql:host=localhost;dbname=larryTables';
$username = 'root';
$password = 'Pa$$w0rd';



try {
    $db = new PDO($dsn, $username, $password);
} catch (PDOException $e) {
    $error_message = "Wrong database credentials";
    exit();
}
    $employeeID = 1;
    $category_name = get_category_name($employeeID);
    $categories = get_categories();
    $products = get_products_by_category($employeeID);

function get_categories() {
    global $db;
    $query = 'SELECT * FROM contact
              ORDER BY contactID';
    $statement = $db->prepare($query);
    $statement->execute();
    return $statement;
}
function get_category_name($employeeID) {
    global $db;
    $query = 'SELECT * FROM contact
              WHERE employee_id = :employee_id';    
    $statement = $db->prepare($query);
    $statement->bindValue(':employee_id', $employeeID);
    $statement->execute();    
    $category = $statement->fetch();
    $statement->closeCursor();    
    $customer = $category['employeeID'];
    return $customer;
}

function get_contact($contactID) {
    global $db;
    $query = 'SELECT * FROM contact
              WHERE contactID = :contactID';
    $statement = $db->prepare($query);
    $statement->bindValue(':contactID', $contactID);
    $statement->execute();
    $customer = $statement->fetch();
    $statement->closeCursor();
    return $customer;
}

function get_products_by_category($employeeID) {
    global $db;
    $query = 'SELECT * FROM contact
              WHERE contact.employeeID = :employee_id
              ORDER BY contactID';
    $statement = $db->prepare($query);
    $statement->bindValue(':employee_id', $employeeID);
    $statement->execute();
    $employee_id = $statement->fetchAll();
    $statement->closeCursor();
    return $employee_id;
}
function delete_product($product_id) {
    global $db;
    $query = 'DELETE FROM products
              WHERE productID = :product_id';
    $statement = $db->prepare($query);
    $statement->bindValue(':product_id', $product_id);
    $statement->execute();
    $statement->closeCursor();
}

?>
<!DOCTYPE html>
<html>
<main>
<table>
            <tr>
                <th>Code</th>
                <th>Name</th>
                <th>Price</th>
                <th>&nbsp;</th>
            </tr>
            <?php foreach ($employeeID as $employee_id) : ?>
            <tr>
                <td><?php echo $customer['contactName']; ?></td>
                <td><?php echo $customer['contactMail']; ?></td>
                <td><?php echo $customer['contactMessage']; ?></td>
                <td><form action="." method="post">
                    <input type="hidden" name="action"
                           value="delete_product">
                    <input type="hidden" name="contactID"
                           value="<?php echo $customer['contactID']; ?>">
                    <input type="submit" value="Delete">
                </form></td>
            </tr>
            <?php endforeach; ?>
        </table>
</main>
</html>