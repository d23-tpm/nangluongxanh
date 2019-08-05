<div class="row">
	<div id="backup" class="backup form col-md-6 col-md-offset-3">
		<h3 class="namepackage">Backup Database</h3>
		<?php
		echo '<h4><i class="fa fa-check-square-o"></i> Package Completed</h4>';
		echo '<div class="filename"><strong>Name: </strong>'.$filename.'</div>';
		echo $this->Html->link('<i class="fa fa-download"></i>Download Database', array('controller'=>'backup','action'=>'admin_database_mysql_dump'),array('escape'=>false));
		?>
	</div>
</div>

