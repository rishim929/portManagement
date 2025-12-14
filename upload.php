<?php
require 'header.php';
require 'functions.php';

$message = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        $fileName = uploadPortfolioFile($_FILES['portfolio']);
        $message = "File uploaded successfully: " . $fileName;
    } catch (Exception $e) {
        $message = "Error: " . $e->getMessage();
    }
}
?>

<h2>Upload Portfolio File</h2>
<p><?php echo htmlspecialchars($message); ?></p>

<form method="post" enctype="multipart/form-data">
    <input type="file" name="portfolio" required>
    <button type="submit">Upload</button>
</form>

<?php require 'footer.php'; ?>
