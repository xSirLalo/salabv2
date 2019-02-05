<!--Modal Confirmar para Eliminar-->
    <div class="modal fade" id="confirm-delete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
            
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title" id="myModalLabel">Confirm Delete</h4>
                </div>
            
                <div class="modal-body">
                    <p>You are about to down one track, this procedure is reversible only for admin.</p>
                    <p>Do you want to proceed?</p>
                    <p class="debug-url"></p>
                </div>
                
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                    <a class="btn btn-danger btn-ok">Delete</a>
                </div>
            </div>
        </div>
    </div>

    <script>
        $('#confirm-delete').on('show.bs.modal', function(e) {
            $(this).find('.btn-ok').attr('href', $(e.relatedTarget).data('href'));
            
            $('.debug-url').html('Delete URL: <strong>' + $(this).find('.btn-ok').attr('href') + '</strong>');
        });
    </script>
<!--Fin Modal-->
		</div>	<!--jumbotron-->
  </div>
	<footer class="page-footer font-small blue pt-4 mt-4">
		<div class="footer-copyright navbar-fixed-bottom text-center">
	        © 2018 Copyright:
	        <a href="https://facebook.com/pckonect" target="_blank" class="text-info"> Eduardo Cauich</a>
		</div>
	</footer>
    <!--Tablas responsivas con Stacktable-->
<script type="text/javascript">
$('#card-table').cardtable();
</script> 

<!--DETECTAR LA ENTRADA DE MAYUSCULAS-->
<script type="text/javascript">
$('[type=password]').keypress(function(e) {
  var $password = $(this),
      tooltipVisible = $('.tooltip').is(':visible'),
      s = String.fromCharCode(e.which);
  //Check if capslock is on. No easy way to test for this
  //Tests if letter is upper case and the shift key is NOT pressed.
  if ( s.toUpperCase() === s && s.toLowerCase() !== s && !e.shiftKey ) {
    if (!tooltipVisible)
        $password.tooltip('show');
  } else {
    if (tooltipVisible)
        $password.tooltip('hide');
  }
  //Hide the tooltip when moving away from the password field
  $password.blur(function(e) {
    $password.tooltip('hide');
  });
});
</script>
</body>
</html>