<!DOCTYPE html>
<html>
<head>
<!-- 


Original Author: Jeffrey Kuhn
Date Created: 1-31-20
Version: 1
Date Last Modified: 1-31-20
Modified by: Jeffrey Kuhn
Modification log: Page created
 
-->
    <title>Larry's American Burgers Contacts</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="description" content="Family run restaurant that focuses mainly on hamburgers." />
    <meta name="keywords" content="food,hamburgers,rastaurant,family" />
    <link href="../css/Style.css" rel="stylesheet">
    <link href="css/Print.css" rel="stylesheet" media="print">
    <link rel="apple-touch-icon" sizes="180x180" href="../images/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="../images/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x`6" href="../images/favicon-16x16.png">
    <link rel="manifest" href="../images/site.webmanifest">

</head>
<main>
    <body>
<header>
     <!-- Header -->
    <h1>Larry's American Burgers</h1>
<nav>
    <!-- Navigation -->
    <a id ="navicon" href="#"><img src="images/iconfinder_menu-alt_134216.png" alt=""/></a>
<ul>
    <li><a href="../index.html">Home</a></li>
    <li><a href="../about.html">About Us</a></li>
    <li><a href="../menu.html">Menu</a></li>
    <li><a href="../times.html">Business Hours</a></li>
    <li><a href="../contact.html">Contact Us</a></li>
    <li><a href="../login.html">Admin</a></li>
</ul>
</nav>
</header>
    <body>
        <h1 id="contactHeader" style="padding-top: 1em;">Contact List</h1>

    <section>
        <!-- Display list of employees to sort contacts by -->
        <?php foreach ($categories as $category) : ?>
            <li>
                <a href="?employeeID=<?php echo $category['employeeID']; ?>" name="action">
                    <?php echo $category['employeeName']; ?>
                    </a>
            </li>
        <?php endforeach; ?>
        <!-- display a table of contacts -->
        <h2><?php echo $category_name; ?></h2>
        <table class="employeeTable">
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>email</th>
                <th>Message</th>
                <th>&nbsp;</th>
            </tr>
            <?php foreach ($contacts as $contact) : ?>
            <tr>
                <td><?php echo $contact['contactID']; ?></td>
                <td><?php echo $contact['contactName']; ?></td>
                <td><?php echo $contact['contactMail']; ?></td>
                <td><?php echo $contact['contactMessage']; ?></td>
                <td><form action="." method="post">
                    <input type="hidden" name="action"
                           value="delete_contact">
                    <input type="hidden" name="contactID"
                           value="<?php echo $contact['contactID']; ?>">
                    <input type="hidden" name="employeeID"
                           value="<?php echo $contact['employeeID']; ?>">
                    <input type="submit" value="Delete">
                </form></td>
            </tr>
            <?php endforeach; ?>
        </table> 
        <p>Select your name to see who we'd like you to respond to.<br/><br/>In the case of blank comment, please respond thanking customer for choosing us!<br/><br/> </p>     
    </section>
    </body>
</main>
</html>