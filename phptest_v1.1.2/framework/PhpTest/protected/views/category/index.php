<?php
/* @var $this CategoryController */
/* @var $dataProvider CActiveDataProvider */

Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl . "/js/custom.js", CClientScript::POS_END);
Yii::app()->clientScript->registerScriptFile('https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js');
Yii::app()->clientScript->registerCssFile('https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css');
Yii::app()->clientScript->registerCssFile(Yii::app()->baseUrl . "/css/custom.css");

?>

<h1>Categories</h1>

<?php 
$this->widget('CTreeView',array(
		'id'=>'categoryTree',
        'data'=>$dataTree,
        'animated'=>'fast', //quick animation
        'collapsed'=>'false',//remember must giving quote for boolean value in here
        'htmlOptions'=>array(
                'class'=>'treeview-gray',//there are some classes that ready to use
        ),
)); 
?>

<?= '<button type="button" class="btn btn-primary addCat" data-toggle="modal" data-target="#addCategoryModal" label="/phptest_v1/framework/PhpTest/index.php?r=category/create">+</button>' ?>

<?= 
	'<div class="modal fade" id="addCategoryModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	  <div class="modal-dialog" role="document">
	    <div class="modal-content">
	      <div id="modalContent" class="modal-body">
	      </div>
	    </div>
	  </div>
	</div>'
?>