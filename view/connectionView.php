<?php
    ob_start();
?>
    <section class="container mt-3">
        
    </section>
<?php
    $content = ob_get_clean();
    require('base.php');
?>