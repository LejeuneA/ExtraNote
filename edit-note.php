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
        displaySuccessMessage($success_message);
    } else {
        echo "Failed to update note.";
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

        <div class="row">
            <div class="col-12">
                <h1 class="mb-3 appMainColor appPageTitle">Modifier la note</h1>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <!-- Edit Note Form -->
                <form id="form_edit_note" action="edit-note.php" method="post">
                    <div class="mb-3 form-group">
                        <label for="title_note" class="form-label appLabel">Titre</label>
                        <input type="text" class="form-control" name="title_note" id="title_note" value="<?php echo htmlspecialchars($note['title']); ?>" required>
                    </div>
                    <div class="mb-3 form-group">
                        <label for="type_note" class="form-label appLabel">Type</label>
                        <select name="type_note" id="type_note" class="form-control" required>
                            <option value="note" <?php echo ($note['type'] === 'note') ? 'selected' : ''; ?>>Note textuelle</option>
                            <option value="code" <?php echo ($note['type'] === 'code') ? 'selected' : ''; ?>>Code Source</option>
                            <option value="lien" <?php echo ($note['type'] === 'lien') ? 'selected' : ''; ?>>Lien / Url</option>
                        </select>
                    </div>
                    <div class="mb-3 form-group">
                        <input class="form-check-input" type="checkbox" value="1" id="favori_note" name="favori_note" <?php echo ($note['favoris'] == 1) ? 'checked' : ''; ?>>
                        <label class="form-check-label" for="favori_note">Ajouter aux favoris</label>
                    </div>
                    <div class="mb-3 form-group">
                        <label for="content_note" class="form-label appLabel">Contenu</label>
                        <textarea name="content_note" id="content_note" class="form-control" rows="10" required><?php echo htmlspecialchars($note['content']); ?></textarea>
                    </div>
                    <!-- Hidden fields to pass note data -->
                    <input type="hidden" name="action" value="recordnote">
                    <input type="hidden" name="file_note" value="<?php echo htmlspecialchars($noteFile); ?>">
                    <input type="hidden" name="date_note" value="<?php echo htmlspecialchars($note['date']); ?>">
                    <!-- Submit and cancel buttons -->
                    <button type="submit" class="btn btn-outline-success">Modifier</button>
                    <a href="index.php?page=view&file=<?php echo urlencode($noteFile); ?>" class="btn btn-outline-danger">Annuler</a>
                </form>
            </div>
        </div>
    </div><!-- container -->

    <!-- Footer -->
    <?php echo HTMLInsertFooter(); ?>

    <!-- Scripts -->
    <script src="assets/js/app.js"></script>
    <script src="assets/js/tooltips.js"></script>
</body>

</html>
