<?php

    $msg = "";

    if(filter_has_var(INPUT_POST, "submit")) {
        $name = htmlspecialchars($_POST["name"]);
        $email = htmlspecialchars($_POST["email"]);
        $message = htmlspecialchars($_POST["message"]);

        if(!empty($name) and !empty($email)) {
            #echo "Your name is $name<br>";
            #echo "Your email is $email<br>";

                if (filter_var($email, FILTER_VALIDATE_EMAIL) == false) {
                    $msg = "Please enter valid email";
                    $msg_class = "alert-danger";
                } else {
                    #echo "PASSED";
                    $to_email = "timbradley94@gmail.com";

                    $subject = "contact request from $name";

                    $body = "<h2>Contact Request</h2>
                            <h4>From: </h4><p>$name</p>
                            <h4>Email: </h4><p>$email</p>
                            <h4>Message from: </h4><p>$message</p>
                            ";

                    #email headers
                    $headers = "MIME-Version 1.0 \r\n";
                    $headers .= "Content-Type: text/html; charset=UTF-8 \r\n";

                    #additional headers
                    $headers .= "From: $name ($email)\r\n";

                    if (mail($to_email, $subject, $body, $headers)) {
                        $msg = "Your message was sent successfully";
                        $msg_class = "alert-success";
                    } else {
                        $msg = "Your message was not sent";
                        $msg_class = "alert-danger";
                    }

                }

        } else {
            #echo "ENTER ALL DETAIL!";
            $msg = "Please fill all fields";
            $msg_class = "alert-danger";
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" 
    integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <title>Contact me</title>
</head>
<body>
    <div class="container">
        <h1 class="page-header">Contact Form</h1>
        <?php if($msg != ""): ?>
            <div class="alert <?php echo "$msg_class"; ?>"><?php echo "$msg"; ?></div>
        <?php endif; ?>
        <form method="post" class="form-group" action="<?php echo $_SERVER['PHP_SELF']; ?>">
            <div>
                <label>Name</label>
                <input type="text" name="name" class="form-control" placeholder="Your name" value="<?php echo isset($_POST["name"]) ? $name : ""; ?>"/>
            </div>
            <div>
                <label>Email</label>
                <input type="text" name="email" class="form-control" placeholder="Your email" value="<?php echo isset($_POST["email"]) ? $email : ""; ?>" />
            </div>
            <div>
                <label>Message</label>
                <textarea name="message" class="form-control"><?php echo isset($_POST["message"]) ? $message : ""; ?></textarea>
            </div>
            <br>
            <div>
                <input type="submit" name="submit" class="btn btn-primary" value="Submit Name" />
            </div>
        </form>
    </div>
</body>
</html>
