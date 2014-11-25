<div class="login-wrap">
		<h4><?php echo $_SESSION['site_name']; ?></h4>
		<div class="login">
			
			<?php $form=$this->beginWidget('CActiveForm', array(
				'id'=>'login-form',
				'enableAjaxValidation'=>false,
				'clientOptions'=>array(
					'validateOnSubmit'=>true,
				),
				'htmlOptions' => array("class"=>"form-horizontal"),
			)); ?>

			<?php echo $form->errorSummary($model); ?>
			<?php echo Yii::app()->user->getFlash('login'); ?>

			<div class="email">
				<?php echo $form->textField($model,'username', array("class" => "input-block-level", "placeholder" => "Username")); ?>
				<?php echo $form->error($model,'username'); ?>
			</div>

			<div class="pw">
				<?php echo $form->passwordField($model,'password', array("class" => "input-block-level", "placeholder" => "Password")); ?>
				<?php echo $form->error($model,'password'); ?>
			</div>

			<button type="submit" value="Sign In" class='button button-basic-darkblue btn-block'>Sign In</button>
			
			<?php $this->endWidget(); ?>
		</div>
		<h6>© <?php echo date('Y'); ?> - <?php echo $_SESSION['site_name']; ?>. <a href="http://gedelumbung.com" target="_blank">DLMBG</a>.</h6>
	</div>