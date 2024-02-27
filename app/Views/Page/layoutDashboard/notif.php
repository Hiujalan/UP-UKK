<?php if (session()->getTempdata('success')) { ?>
    <div class="alert alert-success" role="alert">
        <p><i data-feather="thumbs-up"></i> <?= session()->getTempdata('success'); ?></p>
    </div>
<?php } elseif (session()->getTempdata('edit')) { ?>
    <div class="alert alert-warning fade show" role="alert">
        <p><i class="fa fa-edit"></i> <?= session()->getTempdata('edit'); ?></p>
    </div>
<?php } elseif (session()->getTempdata('delete')) { ?>
    <div class="alert alert-secondary fade show" role="alert">
        <p><i class="fa fa-trash"></i> <?= session()->getTempdata('delete'); ?></p>
    </div>
<?php } ?>