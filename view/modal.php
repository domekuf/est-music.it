<div class="modal fade" id="<?=$id?>" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
          <div class="modal-content">
              <div class="modal-header">
                  <h5 class="text-capitalize"><?=$title?></h5>
                  <a role="button" class="close" data-dismiss="modal" aria-label="Close">
                      <i class="fa fa-times"></i>
                  </a>
              </div>
              <div class="modal-body text-justify">
              <?=$content?>
              </div>
              <?php if ($footer_visible) { ?>
              <div class="modal-footer">
              </div>
              <?php } ?>
          </div>
    </div>
</div>
