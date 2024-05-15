<?php
// *******************************************************
// --                    CONTROLLER                     --
// *******************************************************
require 'conf.php';
require 'app/fcts-tools.php';
require 'app/fcts-html.php';
require 'app/fcts-app.php';

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



    </div><!-- container -->

    <!-- Footer -->
    <?php echo HTMLInsertFooter(); ?>

    <!-- Scripts -->
    <script src="assets/js/app.js"></script>
    <script src="assets/js/tooltips.js"></script>
</body>

</html>