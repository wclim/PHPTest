<?php

/* @var $this yii\web\View */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\bootstrap\Modal;
use app\models\Category;
use yii\helpers\ArrayHelper;


use yii\helpers\Url;

$this->title = 'Create Category';
?>
    <h1><?= Html::encode($this->title) ?></h1>
    <div class="row">
        <div class="col-lg-5">
		    <?php $form = ActiveForm::begin();	
		    	$categories=Category::find()->all(); 
		    	$listData=ArrayHelper::map($categories,'id','catName');?>

			    <?= $form->field($model, 'catName')->textInput(['autofocus' => true],['maxlength' => true]) ?>

			    <?php 
			    	if (isset($_GET['id'])) {
					    echo $form->field($model, 'parentId')->dropDownList(
					        $listData,
					        ['options' => 
					        		[$_GET['id'] => ['Selected'=>true]],
							        ['prompt'=>'']
							]
				        );
				    }else{
				    	echo $form->field($model, 'parentId')->dropDownList(
				        $listData,
				        ['prompt'=>'']
				        );
				    }
				?>


			    <div class="form-group">
			        <?= Html::submitButton('Create', ['class' => 'btn btn-primary', 'name' => 'create-cat-button']) ?>
			    </div>

		    <?php ActiveForm::end(); ?>

		</div>
    </div>
