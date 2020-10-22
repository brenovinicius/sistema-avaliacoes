<?php if (isset($_SESSION['message'])) : ?>
    <div class="alert alert-<?= $_SESSION['message_type']; ?> alert-dismissible">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
        <?= $_SESSION['message']; ?>
    </div>
<?php
    unset($_SESSION['message']);
    unset($_SESSION['message_type']);
endif;
?>