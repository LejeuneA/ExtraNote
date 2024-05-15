<?php

require 'conf.php';
require 'app/fcts-tools.php';
require 'app/fcts-app.php'; // Include the file containing the DELETE function

$noteFile = $_GET['file'] ?? '';

if (empty($noteFile)) {
    header("Location: index.php");
    exit();
}

// Construct the file path to the note JSON file
$filePath = $noteFile;

// Debugging
echo "Attempting to delete file: " . $filePath . "<br>";

// Call the function to delete the note file
$deleteStatus = DELETENoteFile($filePath);

var_dump($deleteStatus); // Output the result of deletion attempt

if ($deleteStatus) {
    // Redirect to index.php if deletion is successful
    header("Location: index.php");
    exit();
} else {
    // Display an error message if deletion fails
    echo "Failed to delete the note file.";
    exit();
}
