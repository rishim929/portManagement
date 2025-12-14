<?php

function formatName($name) {
    return ucwords(trim($name));
}

function validateEmail($email) {
    return filter_var($email, FILTER_VALIDATE_EMAIL);
}

function cleanSkills($string) {
    $skills = explode(',', $string);
    return array_map('trim', $skills);
}

function saveStudent($name, $email, $skillsArray) {
    $file = fopen("students.txt", "a");
    $skills = implode('|', $skillsArray);
    fwrite($file, "$name,$email,$skills\n");
    fclose($file);
}

function uploadPortfolioFile($file) {
    $allowed = ['pdf', 'jpg', 'jpeg', 'png'];
    $maxSize = 2 * 1024 * 1024;

    if ($file['error'] !== 0) {
        throw new Exception("Upload error.");
    }

    if ($file['size'] > $maxSize) {
        throw new Exception("File too large.");
    }

    $ext = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));

    if (!in_array($ext, $allowed)) {
        throw new Exception("Invalid file type.");
    }

    if (!is_dir("uploads")) {
        throw new Exception("Uploads folder missing.");
    }

    $newName = "portfolio_" . time() . "." . $ext;

    if (!move_uploaded_file($file['tmp_name'], "uploads/" . $newName)) {
        throw new Exception("Upload failed.");
    }

    return $newName;
}
