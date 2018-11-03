<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use app\models\Category;

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
    	
        return $this->render('phptest', [
        	'categories' => $categories,
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

}