        <footer class="row w-100 position-fixed" style="top:95%" id="foot-social">
            <div class="col-12 text-center d-none d-sm-block">
                <?php foreach($social as $s) { ?>
                <a href="<?=$s["link"]?>">
                    <i class="fa fa-<?=$s["icon"]?>"></i>
                </a>
                <? } ?>
            </div>
        </footer>
        </main>
        <?php foreach($js as $js_) { ?>
        <script src="<?= $js_ ?>"></script>
        <?php } ?>
    </body>
    <div class="modal fade" tabindex="-1" role="dialog" id="flash-modal">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="flash-title"></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" id="flash-content">
                    Test
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
</html>
<?php
if (isset($flash)) {
?>
        <script defer>
            $("#flash-title").text('<?=$flash["title"]?>');
            $("#flash-content").text('<?=$flash["content"]?>');
            $("#flash-modal").modal();
        </script>
<?php
}
?>
