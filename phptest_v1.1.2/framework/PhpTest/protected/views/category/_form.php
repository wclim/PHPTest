<?php
/* @var $this CategoryController */
/* @var $model Category */
/* @var $form CActiveForm */
?>

<div class="form">

<?php 
$form=$this->beginWidget('CActiveForm', array(
	'id'=>'category-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); 
$categories=CHtml::listData(Category::model()->findAll(),'id','catName');
?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'catName'); ?>
		<?php echo $form->textField($model,'catName',array('size'=>52,'maxlength'=>52)); ?>
		<?php echo $form->error($model,'catName'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'parentId'); ?>
		<?php 
			if (isset($_GET['id'])) {
				echo $form->dropDownList($model,'parentId',$categories,array('empty'=>'',
											'options' => array($_GET['id']=>array('selected'=>true)))); 
			} else {
				echo $form->dropDownList($model,'parentId',$categories,array('empty'=>'')); 
			}
		?>
		<?php echo $form->error($model,'parentId'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->