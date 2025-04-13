<?php if ($this->session->flashdata('message')) { ?>
<div class="alert alert-success alert-success-new alert-dismissible" role="alert">
    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
    <?php echo $this->session->flashdata('message') ?>
</div>
<?php } ?>
<?php if ($this->session->flashdata('exception')) { ?>
<div class="alert alert-danger alert-danger-new alert-dismissible" role="alert">
    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
    <?php echo $this->session->flashdata('exception') ?>
</div>
<?php } ?>
<?php if (validation_errors()) { ?>
<div class="alert alert-danger alert-danger-new alert-dismissible" role="alert">
    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
    <?php echo validation_errors() ?>
</div>
<?php } ?>