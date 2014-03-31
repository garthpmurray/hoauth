<?php
/**
 * View to display `yii-user` authentication errors
 * 
 * @var $errorCode error code from `yii-user` module UserIdentity class
 * @var $user current user model
 */

switch($errorCode)
{
	case UserIdentity::ERROR_STATUS_NOTACTIV:
	$error = HOAuthAction::t('must be activated! Check your email for details!');
	break;
	case UserIdentity::ERROR_STATUS_BAN:
	$error = HOAuthAction::t('is banned!');
	break;
}
?>
<div class="nonboxy-widget" style="margin:0 5px;">
	<div class="widget-head">
		<h5>Account Creation</h5>
	</div>
	<div class="widget-content">
		<p><b><?= HOAuthAction::t('Sorry, but your account') ?> <?php echo $error; ?>!</b></p>
		<p>
			<?php
			echo CHtml::link(HOAuthAction::t('Return to main page'), '/') .
			' | ' .
			CHtml::link(HOAuthAction::t('Return to login page'), Yii::app()->getModule('user')->loginUrl);
			?>
		</p>
	</div>
</div>