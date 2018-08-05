        <footer class="row w-100 position-fixed" style="top:95%" id="foot-social">
            <div class="col-12 text-center">
                <a href="https://www.facebook.com/electricstringtrio">
                    <i class="fa fa-facebook"></i>
                </a>
                <a href="https://www.instagram.com/est_musicproject">
                    <i class="fa fa-instagram"></i>
                </a>
                <a href="https://www.youtube.com/channel/UCdY0dNJEseVizErYPH3kfyA">
                    <i class="fa fa-youtube"></i>
                </a>
                <a href="https://itunes.apple.com/it/album/est-play-mozart-arr-for-jazz-trio/1364427290">
                    <i class="fa fa-music"></i>
                </a>
            </div>
        </footer>
        </main>
        <script src="<?=JQ?>/jquery.min.js"></script>
        <script src="<?=BS?>/js/bootstrap.bundle.min.js"></script>
        <script src="<?=RT?>/js/main.js"></script>
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
