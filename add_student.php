<?php
require_once __DIR__ . '/header.php';
require_once __DIR__ . '/function.php';

$message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    try {
        $name = formatName($_POST['name']);
        $email = $_POST['email'];
        $skillsString = $_POST['skills'];

        if (empty($name) || empty($email) || empty($skillsString)) {
            throw new Exception("All fields are required.");
        }

        if (!validateEmail($email)) {
            throw new Exception("Invalid email format.");
        }

        $skillsArray = cleanSkills($skillsString);
        saveStudent($name, $email, $skillsArray);

        $message = "Student saved successfully!";
    } catch (Exception $e) {
        $message = "Error: " . $e->getMessage();
    }
}
?>

<h3>Add Student Info</h3>

<form method="post">
    Name: <input type="text" name="name"><br><br>
    Email: <input type="text" name="email"><br><br>
    Skills (comma-separated): <input type="text" name="skills"><br><br>
    <button type="submit">Save Student</button>
</form>

<p><?php echo $message; ?></p>

<?php require_once __DIR__ . '/footer.php'; ?>
