<?php

/* @var $this yii\web\View */


use yii\helpers\Html;
use yii\bootstrap\Modal;
use yii\helpers\Url;

$this->title = 'PhpTest';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-about">
    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        This is the Php Test Page.
    </p>

    <?php
    function helper($treeView, $parentId = "") {
		echo '<ul>';
		foreach ($treeView[$parentId] as $entry) {
			printf('<li class="none"><span></span>%s', $entry['catName']);
			echo "<div class='actions'>";
	        echo Html::button('+', ['value'=>Url::to('index.php?r=category/createcat&id='.$entry['id']), 'class' => "btn btn-xs btn-primary addCat"]);
	        echo Html::a('-', ['delete', 'id' => $entry['id']], [
	            'class' => 'btn btn-xs btn-info',
	            'data' => [
	                'confirm' => 'Are you sure you want to delete this item?',
	                'method' => 'post',
	            ],
        	]);
	        echo '</div>';
			if (isset($treeView[$entry['id']])) {
				helper($treeView, $entry['id']);
			}
			echo '</li>';
		}

		echo '</ul>';
	  }

	// create ul
	helper($treeView);
	?>
	<?= Html::button('+', ['value'=>Url::to('index.php?r=category/createcat'), 'class' => "btn btn-primary addCat"]) ?>

	<?php
		Modal::begin([
			'header'=>'<h4>New Category</h4>',
			'id'=>'modal',
			'size'=>'modal-lg',
		]);

		echo "<div id='modalContent'></div>";

		Modal::end();
	?>

	


</div>
