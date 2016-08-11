<!-- search -->
<div class="well">
  <div class="row">
    <form class="form-horizontal" role="form" method="post" action="<?php _e(BASE_URL . 'search/'); ?>">
    	<input type="hidden" name="<?php _e($csrf_key); ?>" value="<?php _e($csrf_token); ?>">
      <div class="col-md-6">
        <input type="text" class="form-control input-lg" name="terms" placeholder="<?php echo $lang->t('search|search_for'); ?>">
      </div>
      <div class="col-md-2">
        <input type="submit" value="SUBMIT" class="btn btn-lg btn-block btn-default"/>
      </div>
      <div class="col-md-4">
        <a type="button" class="btn btn-info btn-lg btn-block" href="<?php _e(BASE_URL); ?>jobs/new" <?php if (ALLOW_JOB_POST == INACTIVE) { echo 'disabled'; } ?>>
        <?php echo $lang->t('jobs|post_job'); ?>
        </a>
      </div>
    </form>
  </div>
</div>
