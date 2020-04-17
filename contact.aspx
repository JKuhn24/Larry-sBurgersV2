<%@ Page Language="C#" %>
<%@ Import Namespace="System.Data.SqlClient" %>

<!DOCTYPE html>

<!-- 

Original Author: Jeffrey Kuhn
Date Created: 8-29-19
Version: 3
Date Last Modified: 4-17-20
Modified by: Jeffrey Kuhn
Modification log: Added meta data, favicon, links to social media and menu in nav
Changed form to submit to 'thankyou.php', added directions to phone number

4-16-20: Updated page to an aspx file. Commented out previous form lines in case changing back to HTML is needed.

4-17-20: Added validation to form and a check for if required fields are empty or not.
 
-->

<script runat="server">
    //Function to go off when the submit button is clicked
    protected void submitButton_Click(object sender, EventArgs e)
    {
        //Check if required fields are empty before sending data
        if (name.Text == "" || mail.Text == "")
        {
            //Send error messeage if fields are not filled out
            errorMessage.Text = "You must enter your name and email.";
        }
        else if (Page.IsValid)
        {
            SqlConnection conn;
            SqlCommand comm;
            string connectionString =
                ConfigurationManager.ConnectionStrings[
                "larrytables"].ConnectionString;
            conn = new SqlConnection(connectionString);
            comm = new SqlCommand("EXEC Insertcontact @nameTextBox,@numberTextBox,@mailTextBox, @msgTextBox", conn);
            comm.Parameters.Add("@nameTextBox", System.Data.SqlDbType.NChar, 50);
            comm.Parameters["@nameTextBox"].Value = name.Text;
            comm.Parameters.Add("@numberTextBox", System.Data.SqlDbType.NChar, 50);
            comm.Parameters["@numberTextBox"].Value = number.Text;
            comm.Parameters.Add("@mailTextBox", System.Data.SqlDbType.NChar, 50);
            comm.Parameters["@mailTextBox"].Value = mail.Text;
            comm.Parameters.Add("@msgTextBox", System.Data.SqlDbType.NChar, 200);
            comm.Parameters["@msgTextBox"].Value = contactMessage.Text;

            try
            {
                //Open connection, execute the query and then redirect to the thank you page
                conn.Open();
                comm.ExecuteNonQuery();
                Response.Redirect("thankyou.html");
            }
            catch (SqlException ex)
            {
                //Send Error if something goes wrong
                errorMessage.Text = "Error submitting the data!" + ex.Message.ToString();

            }
            finally
            {
                //Close connection
                conn.Close();
            }
        }
    }

</script>

<html xmlns="http://www.w3.org/1999/xhtml">
<head>

    <title>Larry's American Burgers Contact Us</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="description" content="Family run restaurant that focuses mainly on hamburgers." />
    <meta name="keywords" content="food,hamburgers,rastaurant,family" />
    <link href="css/Style.css" rel="stylesheet"/>
    <link href="css/Print.css" rel="stylesheet" media="print"/>
    <link rel="apple-touch-icon" sizes="180x180" href="images/apple-touch-icon.png"/>
    <link rel="icon" type="image/png" sizes="32x32" href="images/favicon-32x32.png"/>
    <link rel="icon" type="image/png" sizes="16x`6" href="images/favicon-16x16.png"/>
    <link rel="manifest" href="images/site.webmanifest"/>

</head>
<body>
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
    <li><a href="contact.aspx">Contact Us</a></li>
    <li><a href="login.html">Admin</a></li>
</ul>
</nav>
</header>
    <!-- Main -->
<main>
    <p>If there is something you'd like to contact us about, please fill out the form here and we'll get back to you with an email.<br/>Things labeled with * are required.</p>

    <!-- Contact Form -->
<!--<form id="contact" method="post" action="EmployeeDatabase/thankyou.php">-->
    <form name="contact" runat="server" >
    <fieldset id="contactInfo">
        <legend>Contact Information</legend>
        <div class="formRow">
            <label for="name">Name*</label>
            <!--<input name="name" id="name" type="text" required />-->
            <asp:TextBox ID="name" runat="server" />
        </div>
        <div class="formRow">
            <label for="number">Phone number</label>
            <!--<input name="number" id="number" type="text" placeholder="(000) 000-0000" pattern="^\d{10}$|^(\(\d{3}\)\s*)?\d{3}[\s-]?\d{4}$" />-->
            <asp:TextBox ID="number" runat="server" placeholder="(000) 000-0000" pattern="^\d{10}$|^(\(\d{3}\)\s*)?\d{3}[\s-]?\d{4}$" />
            <label for="number"> Requires at least seven digits.</label>
        </div>
        <div class="formRow">
            <label for="mail">Email address*</label>
            <!--<input name="mail" id="mail" type="email" required />-->
            <asp:TextBox ID="mail" runat="server" type="email" />
        </div>
    </fieldset>
    <fieldset id="contactComment">
        <legend>Comment</legend>
        <div class="formRow">
            <label for="contactMessage">Enter your comment here</label>
            <!--<textarea name="contactMessage" id="contactMessage"></textarea>-->
            <asp:TextBox ID="contactMessage" runat="server" Height="100px" Width="500px" />
        </div>
        <!-- Send or restart buttons -->
        <div id="send">
            <!--<input type="submit" value="Send" />-->
            <asp:Button ID="submitButton" runat="server"
                Text="Send" onclick="submitButton_Click" />
            <input type="reset" value="Restart" />
            <br />
            <asp:Label ID="errorMessage" runat="server"></asp:Label>

        </div>

    </fieldset>
</form>
</main>
     <!-- Footer -->
<footer>
    <h3>Check out our social media!</h3>
    <a href="https://www.facebook.com/" target="_blank"><img src="images/facebook.png" alt="facebook logo" /></a>
    <a href="https://twitter.com/" target="_blank"><img src="images/twitter.png" alt="twitter logo" /></a>
    <h3>Contact Us:</h3>
    <p> 11532 W Place Rd. <br/> <br/>
    <a href="">Larrysburgers@gmail.com</a><br/><br/>
    <a href="">(208)546-7324</a></p>
</footer>
</body>
</html>
