<?php 
    include("database.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRM Project</title>
</head>
<body style="background-color: black; color: white;">
    <form action="<?php htmlspecialchars($_SERVER["PHP_SELF"]) ?>" method="POST">
        <h3>Login form</h3>
        <div>
            <label for="email">Email:</label>
            <input type="email" name="email" id="email" required>
        </div>
        <div>
            <label for="password">Password:</label>
            <input type="password" name="password" id="password" required>
        </div>
        <input type="submit" value="Submit" name="login_submit">
    </form>

    <br>
    <hr>
    <br>

    <form action="<?php htmlspecialchars($_SERVER["PHP_SELF"]) ?>" method="POST">
        <h3>Sign up form:</h3>
        <div>
            <label for="first_name">First name:</label>
            <input type="text" name="first_name" id="first_name" required>
        </div>
        <div>
            <label for="last_name">Last name:</label>
            <input type="text" name="last_name" id="last_name" required>
        </div>
        <div>
            <label for="email">Email:</label>
            <input type="email" name="email" id="email" required>
        </div>
        <div>
            <label for="password">Password:</label>
            <input type="password" name="password" id="password" min="8" max="35" required>
        </div>
        <input type="submit" value="Submit" name="signup_submit">
    </form>
</body>
</html>

<?php 
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (isset($_POST["login_submit"])) {
            $email = strtolower(trim($_POST["email"]));
            if (filter_var($email, FILTER_VALIDATE_EMAIL) && strlen($email) < 254) {
                $sanitized_email = htmlspecialchars($email, ENT_QUOTES, 'UTF-8');

                // sql statement to check if the user exists
                $statement = $connect->prepare("SELECT email, password, user_role FROM users WHERE email = ?");
                $statement->bind_param('s', $sanitized_email);
                $statement->execute();
                $result = $statement->get_result();
                $user = $result->fetch_assoc();
                $statement->close();
                echo var_dump($user);
            }
        }
    }
?>



