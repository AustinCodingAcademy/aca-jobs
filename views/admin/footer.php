
        <div class="row" id="footer">
            <hr />
            <div class="col-md-12">

                <p class="text-muted credit">&copy; <?php _e(APP_NAME); ?></p>
             </div>
        </div>

    </div> <!-- /container -->

    <?php if (getenv('APP_MODE') == 'production') { ?>
      <script src="/views/assets/{{cache-break:js/bundle.js}}"></script>
    <?php } else { ?>
      <script src="/views/assets/js/bundle.js"></script>
    <?php } ?>

  </body>
</html>
