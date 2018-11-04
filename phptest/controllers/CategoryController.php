<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use app\models\Category;
use execut\widget\TreeView;
use yii\web\JsExpression;

class CategoryController extends Controller
{
	/**
     * Displays phptest.
     *
     * @return string
     */
    public function actionPhptest()
    {
    	$query = Category::find();
    	$categories = $query->orderBy('id')->all();
        $treeView = $this->buildTreeView($categories);

        return $this->render('phptest', [
        	'categories' => $categories,
            'treeView' => $treeView
        ]);
    }

    public function actionCreatecat()
    {
        $this->layout = false;
        $model = new Category();
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['phptest']);
        }

        return $this->render('createCat', [
            'model' => $model,
        ]);
    }

    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['phptest']);
    }

    protected function findModel($id)
    {
        if (($model = category::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    protected function buildTreeView($categories){
        $tree = array();
        $ids = array();

        foreach ($categories as $category) {
          if (!isset($map[$category['parentId']])) {
            $map[$category['parentId']] = array();
          }

          $map[$category['parentId']][] = $category;
          $ids[] = $category['id'];
        }
        return $map;
    }

    public function console_log( $data ){
        echo '<script>';
        echo 'console.log('. json_encode( $data ) .')';
        echo '</script>';
    }

}