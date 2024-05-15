<?php

require 'conf.php';
require 'app/fcts-tools.php';
require 'app/fcts-html.php';
require 'app/fcts-app.php';

// Function to display a success message
function displaySuccessMessage($message) {
    echo '<div class="alert alert-success" role="alert">' . $message . '</div>';
}

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['action']) && $_POST['action'] == 'recordnote') {
    // Capture form data
    $title = $_POST['title_note'];
    $content = $_POST['content_note'];
    $type = $_POST['type_note'];
    $favoris = isset($_POST['favori_note']) ? $_POST['favori_note'] : 0;
    $file_note = $_POST['file_note']; // File to be updated
    $date_note = $_POST['date_note'];

    // Update the note data
    $updated_note = [
        'title' => $title,
        'content' => $content,
        'type' => $type,
        'favoris' => $favoris,
        'file' => $file_note,
        'date' => $date_note
    ];

    // Update the JSON file
    $update_result = UPDATENoteFile($updated_note);

    // Handle the update result
    if ($update_result) {
        $success_message = "Note updated successfully.";
    } else {
        $error_message = "Failed to update note.";
    }
}

// Get the filename of the note to be edited from the URL parameter
$noteFile = $_GET['file'] ?? '';

// If no file is specified, redirect back to the index page
if (empty($noteFile)) {
    header("Location: index.php");
    exit();
}

// Load the note data from the JSON file
$note = LOADNoteFromFile($noteFile);

// If the note is not found, display an error message
if (!$note) {
    echo "Note not found!";
    exit();
}

?>

<!DOCTYPE html>
<html lang="fr">
<?php echo HTMLInsertHeader(); ?>

<body>
    <div class="container">
        <!-- Banner -->
        <?php echo HTMLInsertBanner(); ?>

        <!-- Menu -->
        <?php echo HTMLInsertMenu(); ?>

        <!-- Edit notes -->
        <?php echo HTMLEditNote($note, $noteFile, $successMessage = null, $errorMessage = null); ?>
    </div><!-- container -->

    <!-- Footer -->
    <?php echo HTMLInsertFooter(); ?>

    <!-- Scripts -->
    <script src="assets/js/app.js"></script>
    <script src="assets/js/tooltips.js"></script>
</body>

</html>
