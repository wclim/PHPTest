<?php

/**
 * This is the model class for table "category".
 *
 * The followings are the available columns in table 'category':
 * @property integer $id
 * @property string $catName
 * @property integer $parentId
 *
 * The followings are the available model relations:
 * @property Category $parent
 * @property Category[] $categories
 */
class Category extends CActiveRecord
{
	static private $asTree = [];

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'category';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('catName', 'required'),
			array('parentId', 'numerical', 'integerOnly'=>true),
			array('catName', 'length', 'max'=>52),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, catName, parentId', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
			'parent' => array(self::BELONGS_TO, 'Category', 'parentId'),
			'categories' => array(self::HAS_MANY, 'Category', 'parentId'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'catName' => 'Name',
			'parentId' => 'Parent',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 *
	 * Typical usecase:
	 * - Initialize the model fields with values from filter form.
	 * - Execute this method to get CActiveDataProvider instance which will filter
	 * models according to data in model fields.
	 * - Pass data provider to CGridView, CListView or any similar widget.
	 *
	 * @return CActiveDataProvider the data provider that can return the models
	 * based on the search/filter conditions.
	 */
	public function search()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id);
		$criteria->compare('catName',$this->catName,true);
		$criteria->compare('parentId',$this->parentId);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Category the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	public static function getTree() {
        if (empty(self::$asTree)) {
            $rows = self::model()->findAll('parentId IS NULL');
            foreach ($rows as $item) {
                self::$asTree[] = self::getTreeItems($item);
            }
        }

        return self::$asTree;
    }

    private static function getTreeItems($modelRow) {

        if (!$modelRow)
            return;

        if (isset($modelRow->categories)) {
            $chump = self::getTreeItems($modelRow->categories);
            if ($chump != null)
                $res = array('children' => $chump, 'text' => CHtml::link($modelRow->catName, '#', array('id' => $modelRow->id)). 
                	self::getAddBtn($modelRow->id).
                	self::getDeleteBtn($modelRow->id));
            else
                $res = array('text' => CHtml::link($modelRow->catName, '#', array('id' => $modelRow->id)) . 
                	self::getAddBtn($modelRow->id).
                	self::getDeleteBtn($modelRow->id));
            return $res;
        } else {
            if (is_array($modelRow)) {
                $arr = array();
                foreach ($modelRow as $leaves) {
                    $arr[] = self::getTreeItems($leaves);
                }
                return $arr;
            } else {
                return array('text' => CHtml::link($modelRow->catName, '#', array('id' => $modelRow->id)). 
                	self::getAddBtn($modelRow->id).
                	self::getDeleteBtn($modelRow->id));
            }
        }
    }

    private function getAddBtn($id){
            return    	CHtml::button("+", 
                		array('class' => "btn btn-xs btn-primary addCat",
                				'data-toggle' => "modal",
                				'data-target'=>"#addCategoryModal",
                				'label'=>"/phptest_v1/framework/PhpTest/index.php?r=category/create&id=".$id));
    }

    private function getDeleteBtn($id){
            return    	CHtml::link("-", "#",
                		array('class' => "btn btn-xs btn-info",
                			'submit'=>array('category/delete','id'=>$id),
        					'confirm' => 'Are you sure you want to delete this item?',
        					'method'=>'post'));
		    }
}


