<?php
/*
    ** This function get the header
    ** But you can delete it without problem
    */
get_header();

/**
 * Mail Validation
 */

// define variables and set to empty values
$nameErr = $emailErr =  $subjectErr = $messageErr = "";
$name = $email = $message = $subject = "";
$sendEmail = false;
$successMessage = "";


if ($_SERVER["REQUEST_METHOD"] == "POST") {

    if (isset($_POST['submit'])) {
        if (empty($_POST["name"])) {
            $nameErr = "Name is required";
            $sendEmail = false;
        } else {
            $name = test_input($_POST["name"]);
            // check if name only contains letters and whitespace
            if (!preg_match("/^[a-zA-Z-' ]*$/", $name)) {
                $nameErr = "Only letters and white space allowed";
                $sendEmail = false;
            }
        }

        if (empty($_POST["email"])) {
            $emailErr = "Email is required";
            $sendEmail = false;
        } else {
            $email = test_input($_POST["email"]);
            // check if e-mail address is well-formed
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $emailErr = "Invalid email format";
                $sendEmail = false;
            }
        }

        if (empty($_POST["subject"])) {
            $subjectErr = "Subject is required";
        } else {
            $subject = test_input($_POST["subject"]);
        }

        if (empty($_POST["message"])) {
            $messageErr = "Message is required";
            $sendEmail = false;
        } else {
            $message = test_input($_POST["message"]);
        }

        if ($sendEmail) {
            wp_mail('ejvsrlnrebybipnqni@zqrni.net', $subject, $message);
            $successMessage = "Message has been sent successfully";
        }
    }
}

function test_input($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

?>

<div class="container">
    <div class="contact-container bg-white p-3 mt-5">
        <div class="row">
            <div class="col-md-5 d-none d-md-block">
                <div class="message-logo d-flex justify-content-center align-items-center h-100">
                    <i class="far fa-paper-plane fa-10x text-primary"></i>
                </div>
            </div>
            <div class="col-md-7">
                <h1 class="h3 mb-3">Contact Us</h1>
                <?php if ($successMessage) : ?>
                    <div class="alert alert-success" role="alert">
                        <?php $successMessage; ?>
                    </div>
                <?php endif; ?>
                <form method="post" action="<?php the_permalink(); ?>" enctype="text/plain">
                    <div class="mb-3">
                        <label for="name" class="form-label">Name*</label>
                        <input type="text" name="name" class="form-control bg-secondary text-white" id="name" value="<?php echo $name; ?>">
                        <p class="text-danger"><?php echo $nameErr; ?></p>
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email*</label>
                        <input type="text" name="email" class="form-control bg-secondary text-white" id="email" value="<?php echo $email; ?>">
                        <p class="text-danger"><?php echo $emailErr; ?></p>
                    </div>
                    <div class="mb-3">
                        <label for="subject" class="form-label">Subject*</label>
                        <input type="text" name="subject" class="form-control bg-secondary text-white" id="subject" value="<?php echo $subject; ?>">
                        <p class="text-danger"><?php echo $subjectErr; ?></p>
                    </div>
                    <div class="mb-3">
                        <label for="message" class="form-label">Message*</label>
                        <textarea class="form-control bg-secondary text-white" id="message" rows="3" name="message"><?php echo $message; ?></textarea>
                        <p class="text-danger"><?php echo $messageErr; ?></p>
                    </div>
                    <input type="submit" name="submit" class="btn btn-primary" value="Send">
                </form>
            </div>
        </div>
    </div>
</div>



<?php
/*
    ** This function get the footer with all scripts that very important for your theme to be round
    ** Don't delete this function it's very important for theme to be run without any problem
    */
get_footer();
?>