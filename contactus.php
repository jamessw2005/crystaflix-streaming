<?php
require_once("includes/header.php");
require_once("includes/classes/FormSanitizer.php");
require_once("includes/classes/Constants.php");
require_once("includes/classes/Account.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $name = $_POST['name'];
    $email = $_POST['email'];
    $message = $_POST['message'];
    $msg="";

    // Validate and sanitize data (you can add more validation if needed)
    $name = htmlspecialchars($name);
    $email = filter_var($email, FILTER_SANITIZE_EMAIL);
    $message = htmlspecialchars($message);

    // Insert data into the database
    $sql = "INSERT INTO feedback (name, email, message) VALUES (?, ?, ?)";
    $stmt = $con->prepare($sql);
    
    // Bind parameters
    $stmt->bindValue(1, $name);
    $stmt->bindValue(2, $email);
    $stmt->bindValue(3, $message);

    // Execute the statement
    if ($stmt->execute()) {
        echo "<script>alert('Thank You for your feedback!');</script>";
    } else {
        // Error occurred
        echo "Error: " . $stmt->error;
    }
}



?>
<html>
    <head>
        <style>
            .contactus{
                width: 100%;
                height: 862px;
                background: url("assets/images/rdr.jpg");
                background-size:contain;
                box-shadow: 0 0 200px rgba(0,0,0,0.9) inset;
            }
            .overlay{
                position: fixed;
                height: 100%;
                width: 100%;
                position: absolute;
            }
            .overlay h2 {
                position: relative;
                top: 50%;
                display: flex;
                flex-direction: column;
                justify-content: center;
                color: #fff;
                font-size: 100px;
                margin-left: 20%;
                text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5);
            }
            .cont {
                height: 50px;
                width: 600px;
                border: 1px solid #dedede;
                background-color: transparent;
                color: #fff;
                font-size: 20px;
                padding: 5px 10px;
                border-radius: 5px;
            }
            textarea{
                width: 100%; /* Set the width to fill its container */
                padding: 10px; /* Add padding for better spacing */
                font-size: 16px; /* Set the font size */
                border: 1px solid #ccc; /* Add a border */
                border-radius: 5px; /* Add rounded corners */
                resize: vertical; /* Allow vertical resizing */
                box-sizing: border-box;
                background: transparent;
                color: #fff;
                border-bottom: 1px white solid ;
                height: 200px;
                
            }
            .settingsCont {
                display:flex;
                flex-direction: column;
                margin: 20px 0;
                border-bottom: 1px solid #dedede;
                padding-bottom: 20px;
            }
            .settingsCont .formSection {
                display:flex;
                flex-direction: column;
                margin: 20px 0;
                border-bottom: 1px solid #dedede;
                padding-bottom: 20px;
            }
            .settingsCont h2 {
                color: #fff;
                margin-top: 0;
                font-size: 70px;
                margin-bottom: 10px;
            }
            .settingsCont h4 {
                color: #fff;
                margin-top: 0;
                margin-left: 10px;
                /* font-size: 70px; */
            }
            .settingsCont {
                padding-top: 60px;
                background-color: transparent;
                width: 80%;
                margin-left: auto;
                margin-right: auto;
            }
            .settingsCont .formSection input {
                display: block;
                margin-bottom: 10px;
                width: 80%;
            } 
            .formSection input[type='submit'] {
                background-color: #dc1928;
                width: 20%;
                height: 40px;
                border: none;
                border-radius: 5px;
                color: #fff;    
                display: flex;
                justify-content: center;
                margin: auto;
                margin-top: 10px;
            }
        </style>
    </head>
    <body>
        <div class="contactus">
            <div class="overlay">
                <h2>Wanna Contact US?</h2>
            </div>
        </div>
        <div class="settingsCont">
        <div class="formSection">
                <form method="POST">

                    <h2>Contact Us</h2>
                    <h4>Fill the form for contacting us..!</h4>
                    
                    <input class="cont" type="text" name="name" placeholder="Your Name"  required>
                    <input class="cont" type="email" name="email" placeholder="Your Email Address">
                    <textarea name="message" placeholder="Your Message"></textarea>

                    <input type="submit" name="submitFeedbackButton" value="Submit">


                    <!-- <div class="message">
                    <h4>/h4>
                    </div> -->
                </form>
            </div>
        </div>
       
        

    </body>
</html>