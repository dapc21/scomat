    <?php  
	require_once "../procesos.php";
	echo _("Hola  Mundo!");
	echo gettext("Banco");
	
	
	?>
	
	<script type="text/javascript" src="file.php"></script>
	
	<script>
	 function _ (id) {
		if(array_test[id]!=null){
			return array_test[id];
		}
		else{
			return id;
		}
	 }	
	 function gettext (id) {
		return _ (id);
	 }	
	 function gettext_noop (id) {
		return _ (id);
	 }	
	 
	 
	alert(_('Banco'));
	
	</script>
	
	

	
	