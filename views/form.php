<?php
$cs = Yii::app()->getClientScript();
Yii::app()->clientScript->registerCSSFile(Yii::app()->theme->baseUrl . '/css/login.css',"screen");
/**
 * @var HOAuthAction $this
 * @var HUserInfoForm $form
 */
 
?>

<style type="text/css">
	.row.field_email,
	.row.field_username,
	.row.field_password,
	.row.buttons{
		margin: 5px 0;
	}
	
	.btn.btn-success{
		width: 100%;
	}
	
	label{
		width: 70px;
	}

	.login-container input[type="text"],
	.login-container input[type="password"]{
		padding-left: 5px;
	}
	
	.errorMessage{
		margin-top: 5px;
		color: red;
	}
	
</style>

<div class="nonboxy-widget" style="margin:0 5px;">
	<div class="widget-head">
		<h5>Registration</h5>
	</div>
	<div class="widget-content">
		<div class="row">
			<div class="col-xs-12 login-container">
				<?= $form->form ?></p>
			</div>
		</div>
	</div>
</div>