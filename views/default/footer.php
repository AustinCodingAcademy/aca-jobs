
        <div class="row" id="footer">
            <hr />
            <div class="col-md-12">

                <p class="text-muted credit">&copy; <?php _e(APP_NAME); ?></p>
             </div>
        </div>

    </div> <!-- /container -->
    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title"></h4>
          </div>
          <div class="modal-body"></div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            <a id="job-apply" class="btn btn-primary" target="_blank">Original Posting</a>
          </div>
        </div>
      </div>
    </div>

    <script src="/assets/bundle.js"></script>
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->

    <?php if (GA_TRACKING != ''): ?>
    <script type="text/javascript">
        var _gaq = _gaq || [];
        _gaq.push(['_setAccount', '<?php _e(GA_TRACKING); ?>']);
        _gaq.push(['_trackPageview']);

        (function() {
        var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
        ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
        var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
        })();
    </script>
    <?php endif; ?>
    <? if(!array_intersect(explode('/', "$_SERVER[REQUEST_URI]"), ['jobs', 'admin', '5-jobs', 'giving-back'])): ?>
      <?php include 'jobs2careers.php'; ?>
      <?php include 'facebook.php'; ?>
    <?php endif; ?>
  </body>
</html>
