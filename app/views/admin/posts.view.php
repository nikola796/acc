<?php require('partials/header.php') ?>
    <div class="col-md-10">
        <div class="content-box-large">
            <div class="panel-heading">
                <div class="panel-title"><h4 class="text-center">Добавете Вашата публикация в редактора по-долу.</h4></div>

                <div class="panel-options">
                    <a href="#" data-rel="collapse"><i class="glyphicon glyphicon-refresh"></i></a>
                    <a href="#" data-rel="reload"><i class="glyphicon glyphicon-cog"></i></a>
                </div>
            </div>
            <div class="panel-body">
                <form action="" method="post" enctype="multipart/form-data">

                    <div id="callout-formgroup-inputgroup" class="bs-callout bs-callout-warning">

                    </div>
                    <div class="form-group">
                        <textarea cols="80" id="text" name="text" rows="10" placeholder="Място за текст"></textarea>
                    </div>

                    <div class="form-group">
                        <span class="form-control-static"><strong>Изберете от списъка в коя папка да бъде Вашата публикация.</strong></span>

                        <span class="form-control-static"><strong>Или създайте </strong></span>
                        <!-- <button type="button" class="btn btn-success" data-toggle="modal" data-target="#myModal">Нова папка</button> -->
                        <a href="#" id="mod"><strong>Нова папка</strong></a>
                        <!-- Modal -->

                        <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                                aria-hidden="true">&times;</span></button>
                                        <h4 class="modal-title" id="myModalLabel">Нова папка</h4>
                                    </div>
                                    <div id="sel" class="modal-body">
                                        <div class="form-group">
                                            <label for="folderName">Име на новата папка</label>
                                            <input type="text" class="form-control" id="newFolderName"
                                                   placeholder="Наименование">
                                        </div>
                                        <div class="form-group">
                                            <label for="folderName">Място на новата папка</label>
                                            <select name="folder" id="perentFolder" class="form-control">
                                                <?php foreach ($folders as $folder): ?>

                                                    <option value="<?= $folder->category_id ?>"><?= $folder->name ?></option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-default" data-dismiss="modal">Отказ</button>
                                        <button type="button" id="createFolder" class="btn btn-primary">Запази</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- END Modal -->

                    </div>


                    <div id="perentFolders" class="form-group">
                        <select name="folder" class="form-control" id="folder">
                            <?php foreach ($folders as $folder): ?>
                                <option value="<?= $folder->category_id ?>"><?= $folder->name ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <div class="form-group">

                        <input type="button" class="form-control btn-info" id="addAnotherFile" value="Добави файл"/>

                    </div>
                    <div id="attachedFiles">

                    </div>


                    <div class="spacer-bg"></div>
                    <div class="text-center">
                        <!--                <button type="submit" class="btn btn-default" id="view_post" name="view">Прегледай</button>-->
                        <button type="submit" class="btn btn-primary" name="save">Запази</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    </div>
    </div>

<?php require('partials/footer.php') ?>

    <script src="<?php url() ?>/public/js/posts.js"></script>
<script>
    $('#posts').addClass('current')
</script>
<?php require("partials/bottom.php");