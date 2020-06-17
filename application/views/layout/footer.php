    <!-- Footer  -->
    <footer class="fixed-bottom bg-primary text-light">
      <p>Copyright © 2020 M3u File Project, Inc. All rights reserved.</p>
    </footer>
    <!-- Footer End -->

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
 
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <!-- <script
      src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"
     
    ></script> -->
    <script src="https://cdn.jsdelivr.net/jquery.validation/1.15.1/jquery.validate.min.js"></script>
    <script src="<?= base_url('assets/js/bootstrap.min.js') ?>"></script>
    <script src="<?= base_url('assets/js/main.js') ?>"></script>
    <script>
      var fixHelperModified = function(e, tr) {
        var $originals = tr.children();
        var $helper = tr.clone();
        $helper.children().each(function(index) {
          $(this).width($originals.eq(index).width())
        });
        return $helper;
      },
        updateIndex = function(e, ui) {
          $('td.index', ui.item.parent()).each(function (i) {
            $(this).html(i+1);
          });
          /* $('input[type=text]', ui.item.parent()).each(function (i) {
            $(this).val(i + 1);
          }); -->*/
        };
    
       $("#playlistTable tbody").sortable({
        helper: fixHelperModified,
        stop: updateIndex
      }).disableSelection();
      
        $("tbody").sortable({
        distance: 5,
        delay: 100,
        opacity: 0.6,
        cursor: 'move',
        update: function() {}
          }); 

    </script>
    <!-- <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script> -->
  </body>
</html>
