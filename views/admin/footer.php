        
        <div class="row" id="footer">
            <hr />
            <div class="col-md-12">
                
                <p class="text-muted credit">&copy; <?php _e(APP_NAME); ?></p>
             </div>
        </div>
    
    </div> <!-- /container -->
    
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://code.jquery.com/jquery-1.10.2.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="<?php _e(BASE_URL); ?>vendor/twbs/bootstrap/dist/js/bootstrap.min.js"></script>
    <script src="<?php _e(BASE_URL); ?>vendor/imsky/holder/holder.js"></script>
    
    <?php if (isset($filestyle)): ?>
        <script src="<?php _e(BASE_URL); ?>vendor/grimmlink/bootstrap-filestyle/bootstrap-filestyle.min.js"></script>
    <?php endif; ?>
    <?php if (isset($markdown)): ?>
        <script src="<?php _e(BASE_URL); ?>vendor/npm-asset/markdown/lib/markdown.js"></script>
        <script src="<?php _e(BASE_URL); ?>vendor/npm-asset/to-markdown/dist/to-markdown.js"></script>
        <script src="<?php _e(BASE_URL); ?>vendor/npm-asset/bootstrap-markdown/js/bootstrap-markdown.js"></script>
    <?php endif; ?>
  </body>
</html>