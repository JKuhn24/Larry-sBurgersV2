<?php
class Database {
    private static $dsn = 'mysql:host=localhost;dbname=larrytables';
    private static $username = 'root';
    private static $password = 'Pa$$w0rd';
    private static $db;


    private function __contruct(){}
    
    public static function getDB() {
          try {
        self::$db = new PDO(self::$dsn, self::$username, self::$password);
        //echo 'DSN: ' . self::$dsn;
        //echo 'username: ' . self::$username;
        //echo 'password: ' . self::$password;
    } catch (PDOException $e) {
        echo "You have entered the wrong credentials";
        exit(); 
}
  return self::$db;
    }
}

class Employee {
    private $employeeID;
    private $employeeName;
    
    public function __construct($id, $name) {
        $this->employeeID = $id;
        $this->employeeName = $name;
    }
    
    public function getID() {
        return $this->employeeID;
    }
    public function setID($value){
        $this->employeeID = $value;
    }
    
    public function getName() {
        return $this->employeeName;
    }
    public function setName($value){
        $this->employeeName = $value;
    }
}

class EmployeeDB {   
    public static function getEmployees(){
        $db = Database::getDB();
        
        $query = 'SELECT * FROM employee
                  ORDER BY employeeID';
        $statement = $db->prepare($query);
        $statement->execute();
        
        $employees = array();
        foreach ($statement as $row) {
            $employee = new employee($row['employeeID'],
                                     $row['employeeName']);
            $employees[] = $employee;
        }
        return $employees;
}
    
}
$employees = EmployeeDB::getEmployees();
?>
<!DOCTYPE html>
<html>
<head>
    <title>Larry's American Burgers</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="description" content="Family run restaurant that focuses mainly on hamburgers." />
    <meta name="keywords" content="food,hamburgers,rastaurant,family" />
    <link href="../css/Style.css" rel="stylesheet">
    <link href="css/Print.css" rel="stylesheet" media="print">
    <link rel="apple-touch-icon" sizes="180x180" href="images/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="images/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x`6" href="images/favicon-16x16.png">
    <link rel="manifest" href="images/site.webmanifest">

</head>
<header>
     <!-- Header -->
    <h1>Larry's American Burgers</h1>
<nav>
    <!-- Navigation -->
    <a id ="navicon" href="#"><img src="images/iconfinder_menu-alt_134216.png" alt=""/></a>
<ul>
    <li><a href="index.html">Home</a></li>
    <li><a href="about.html">About Us</a></li>
    <li><a href="menu.html">Menu</a></li>
    <li><a href="times.html">Business Hours</a></li>
    <li><a href="contact.html">Contact Us</a></li>
</ul>
</nav>
</header>
<body>
<?php foreach ($employees as $employee) : ?>
            <li>
                <ul>
                    <?php echo $employee->getID() . ' , ' . $employee->getName()?>
                </ul>
            </li>
<?php endforeach; ?>
</body>
</html>