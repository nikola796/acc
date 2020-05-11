    <?php require('partials/header_index.php') ?>
    <?php require ('admin/partials/top_panel.php') ?>
    <div class="page-content">
        <div class="row">
            <div class="col-md-2">
                <?php if(isset($_SESSION['is_logged']) && $_SESSION['is_logged'] === true):?>
                    <?php require ('partials/sidebar.php') ?>
                <?php endif;?>
            </div>
            <div class="col-md-8">
                <div class="row">
                    <div class="col-md-12 panel-warning">
                        <div class="content-box-header panel-heading">
                            <div class="panel-title ">Указания за работa</div>
                        </div>
                        <div class="content-box-large box-with-header">
                            Pellentesque luctus quam quis consequat vulputate. Sed sit amet diam ipsum. Praesent in pellentesque diam, sit amet dignissim erat. Aliquam erat volutpat. Aenean laoreet metus leo, laoreet feugiat enim suscipit quis. Praesent mauris mauris, ornare vitae tincidunt sed, hendrerit eget augue. Nam nec vestibulum nisi, eu dignissim nulla.
                            <br /><br />
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

<?php require('admin/partials/footer.php') ?>
<script>
    $('#home').addClass('current')
</script>
<?php require("admin/partials/bottom.php");