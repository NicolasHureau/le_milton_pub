<?php
    ob_start();
?>
    <section class="container flex-grow-1">

    </section>
<?php
    $content = ob_get_clean();
    require('menu.php');
?>