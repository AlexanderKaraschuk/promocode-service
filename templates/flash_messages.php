<?php if (!empty($messages)): ?>
    <div class="my-3">
        <?php foreach ($messages as $type => $message): ?>
            <?php foreach ($message as $msg): ?>
                <div class="alert alert-<?php echo $type === 'error' ? 'danger' : $type; ?>" role="alert">
                    <?php echo $msg; ?>
                </div>
            <?php endforeach; ?>
        <?php endforeach; ?>
    </div>
<?php endif; ?>
