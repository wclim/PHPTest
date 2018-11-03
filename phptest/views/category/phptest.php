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

	<?php foreach ($categories as $category): ?>
		<p>
	        <?= Html::encode("{$category->id} ({$category->catName})") ?>:
	        <?= $category->parentId ?>
	        <?= Html::a('-', ['delete', 'id' => $category->id], [
            'class' => 'btn btn-xs btn-info right-align',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
	        <?= Html::button('+', ['value'=>Url::to('index.php?r=category/createcat&id='.$category->id), 'class' => "btn btn-xs btn-primary right-align addCat"]) ?>
	    </p>
	<?php endforeach; ?>
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
