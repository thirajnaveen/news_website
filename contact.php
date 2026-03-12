<?php
include 'includes/db.php';
include 'includes/header.php';

if(isset($_POST['send_message'])) {

    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone']; // Added phone
    $subject = $_POST['subject']; // Added subject
    $message = $_POST['message'];

    if(!empty($name) && !empty($email) && !empty($message)) {

        // Use prepared statements for security (prevent SQL injection)
        $stmt = $conn->prepare("INSERT INTO contact_messages (name, email, phone, subject, message) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("sssss", $name, $email, $phone, $subject, $message);

        if($stmt->execute()) {
            $success = "Message sent successfully!";
        } else {
            $error = "Something went wrong!";
        }

        $stmt->close();

    } else {
        $error = "All fields are required!";
    }
}
?>

<head>
    <meta charset="UTF-8">
    <title>Contact Us</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

    <style>
* {
    margin: 0;
    padding: 0;
}

/*body {
    background: #ff5555;
    font-size: 14px;
    font-family: 'Poppins', sans-serif;
}*/

.container {
    width: 80%;
    margin: 50px auto;
}

.contact-box {
    background: #fff;
    display: flex;
}

.contact-left {
    flex-basis: 60%;
    padding: 40px 60px;
}

.contact-right {
    flex-basis: 40%;
    padding: 40px;
    background: #000000;
    color: #fff;
}

.h1 {
    margin-bottom: 10px;
}

.container p {
    margin-bottom: 40px;
}

.input-row {
    display: flex;
    justify-content: space-between;
    margin-bottom: 20px;
}

.input-row .input-group {
    flex-basis: 45%;
}

input {
    width: 100%;
    border: none;
    border-bottom: 1px solid #ccc;
    outline: none;
    padding-bottom: 5px;
}

textarea {
    width: 100%;
    border: 1px solid #ccc;
    outline: none;
    padding: 10px;
    box-sizing: border-box;
}

label {
    margin-bottom: 6px;
    display: block;
    color: #000000;
}

.send-btn {
    background: #000000;
    width: 100px;
    border: none;
    outline: none;
    color: #fff;
    height: 35px;
    border-radius: 30px;
    margin-top: 20px;
    box-shadow: 0px 5px 15px 0px rgba(28,0,181,0.3);
}

.contact-left h3 {
    color: #000000;
    font-weight: 600;
    margin-bottom: 30px;
}

.contact-right h3 {
    font-weight: 600;
    margin-bottom: 30px;
}

tr td:first-child {
    padding-right: 20px;
}

tr td {
    padding-top: 20px;
}


    </style>
    
</head>
<body>
    <div class="container">
        <h1>Connect with Us</h1>
        <p>We would love to respond to your queries and help you succeed. <br>Feel free to get in touch with us.</p>

        <?php if(isset($success)) { echo "<p class='success-msg'>$success</p>"; } ?>
        <?php if(isset($error)) { echo "<p class='error-msg'>$error</p>"; } ?>

        <div class="contact-box">
            <div class="contact-left">
                <h3>Send your request</h3>
                <form method="POST" onsubmit="return validateContactForm();">

                    <div class="input-row">
                        <div class="input-group">
                            <label>Name</label>
                            <input type="text" name="name" id="name" placeholder="">
                        </div>

                        <div class="input-group">
                            <label>Phone</label>
                            <input type="text" name="phone" placeholder="">
                        </div>
                    </div>

                    <div class="input-row">
                        <div class="input-group">
                            <label>Email</label>
                            <input type="email" name="email" id="email" placeholder="">
                        </div>

                        <div class="input-group">
                            <label>Subject</label>
                            <input type="text" name="subject" placeholder="">
                        </div>
                    </div>

                    <label>Message</label>
                    <textarea name="message" id="message" rows="5" placeholder="Your Message"></textarea>

                    <button type="submit" name="send_message" class="send-btn">SEND</button>
    

      
                </form>


            </div>    
                
                <div class="contact-right">
                    <h3>Reach Us</h3>

                    <table>
                        <tr>
                            <td>Email</td>
                            <td>news@gmail.com.com</td>
                        </tr>
                        <tr>
                            <td>Phone</td>
                            <td>+94 11 222227</td>
                        </tr>
                        <tr>
                            <td>Address</td>
                            <td>No,7 Main road, Colombo 07</td>
                        </tr>
                    </table>



                </div>
        </div>
    </div>

    <script>
    function validateContactForm() {
        let name = document.getElementById("name").value.trim();
        let email = document.getElementById("email").value.trim();
        let message = document.getElementById("message").value.trim();

        if(name === "" || email === "" || message === "") {
            alert("All fields are required!");
            return false;
        }
        return true;
    }
    </script>
</body>
<?php include 'includes/footer.php'; ?>