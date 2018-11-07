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
	$asTree = getTree($treeRoots);
	function getTree($roots) {
        if (empty($asTree)) {
            $rows = $roots;
            foreach ($rows as $item) {
                $asTree[] = getTreeItems($item);
            }
        }

        return $asTree;
    }

    function getTreeItems($modelRow) {

        if (!$modelRow)
            return;

        if (isset($modelRow->categories)) {
            $chump = getTreeItems($modelRow->categories);
            if ($chump != null)
                $res = array('children' => $chump, 'text' => CHtml::link($modelRow->catName, '#', array('id' => $modelRow->id)). 
                	getAddBtn($modelRow->id).
                	getDeleteBtn($modelRow->id));
            else
                $res = array('text' => CHtml::link($modelRow->catName, '#', array('id' => $modelRow->id)) . 
                	getAddBtn($modelRow->id).
                	getDeleteBtn($modelRow->id));
            return $res;
        } else {
            if (is_array($modelRow)) {
                $arr = array();
                foreach ($modelRow as $leaves) {
                    $arr[] = getTreeItems($leaves);
                }
                return $arr;
            } else {
                return array('text' => CHtml::link($modelRow->catName, '#', array('id' => $modelRow->id)). 
                	getAddBtn($modelRow->id).
                	getDeleteBtn($modelRow->id));
            }
        }
    }

    function getAddBtn($id){
            return    	CHtml::button("+", 
                		array('class' => "btn btn-xs btn-primary addCat",
                				'data-toggle' => "modal",
                				'data-target'=>"#addCategoryModal",
                				'label'=>"/phptest_v1/framework/PhpTest/index.php?r=category/create&id=".$id));
    }

    function getDeleteBtn($id){
            return    	CHtml::link("-", "#",
                		array('class' => "btn btn-xs btn-info",
                			'submit'=>array('category/delete','id'=>$id),
        					'confirm' => 'Are you sure you want to delete this item?',
        					'method'=>'post'));
	}

$this->widget('CTreeView',array(
		'id'=>'categoryTree',
        'data'=>$asTree,
        'animated'=>'fast', //quick animation
        'collapsed'=>'false',//remember must giving quote for boolean value in here
        'htmlOptions'=>array(
                'class'=>'treeview-gray',//there are some classes that ready to use
        ),
)); 
?>

<?= CHtml::button("+", 
                		array('class' => "btn btn-xs btn-primary addCat",
                				'data-toggle' => "modal",
                				'data-target'=>"#addCategoryModal",
                				'label'=>"/phptest_v1/framework/PhpTest/index.php?r=category/create"));?>

<?= 
	CHtml::Opentag("div", array('id'=>"addCategoryModal", 'class' => "modal fade" , 'tabindex'=>"-1", 'role'=>"dialog", 'aria-labelledby'=>"exampleModalLabel", 'aria-hidden'=>"true")).
		CHtml::Opentag("div", array('role'=>"document", 'class' => "modal-dialog")).
			CHtml::Opentag("div", array('class' => "modal-content")).
	    		CHtml::tag("div", array('id'=>"modalContent", 'class' => "modal-body")).
	    	CHtml::Closetag("div").
	  	CHtml::Closetag("div").
	CHtml::Closetag("div");
?>