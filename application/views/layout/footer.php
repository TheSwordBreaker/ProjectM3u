    <!-- Footer  -->
    <footer class="fixed-bottom bg-primary text-light d-block">
      <p>Copyright © 2020 M3u File Project, Inc. All rights reserved.</p>
    </footer>
    <!-- Footer End -->

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->

    <?php if(ENVIRONMENT == 'development'): ?>
      <script src="<?= base_url('assets/js/popper.min.js') ?>"></script>
    <script src="<?= base_url('assets/js/bootstrap.min.js') ?>"></script>
    <script src="<?= base_url('assets/js/jquery.validate.min.js') ?>"></script>
   <?php else: ?>
    
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/jquery.validation/1.15.1/jquery.validate.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" ></script> 
   
    <?php endif ?>
 
  
   
    
    <script src="<?= base_url('assets/js/main.js') ?>"></script>

  </body>
</html>
