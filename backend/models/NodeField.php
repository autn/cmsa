<?php

namespace app\models;

use Yii;
use app\models\Field;
use app\models\Node;

/**
 * This is the model class for table "cmsa_node_field".
 *
 * @property integer $id
 * @property string $name
 * @property integer $field_id
 */
class NodeField extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'cmsa_node_field';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id'], 'required'],
            [['id', 'node_id'], 'integer'],
            [['name'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'name' => Yii::t('app', 'Name'),
            'field_id' => Yii::t('app', 'Field ID'),
        ];
    }

    public function fieldItem($id, $table = 'node'){
        $field = NodeField::find()->where(['node_id' => $id, 'table' => $table])->one()->field_id;
        if(empty($field) || ($field==null) || ($field==''))
            return false;
        $a = explode(",", $field);
        $b = array();
        foreach ($a as $key => $value) {
            $b[$key] = Field::findOne($value);
        }
        return $b;
    }

    public function getMaxId(){
        return NodeField::find()->orderBy('id DESC')->one()->id + 1;
    }

    public function defaultField(){
        return [
            0   => Field::findOne(4),           //'title'
            1   => Field::findOne(5),           //'alias'
            2   => Field::findOne(6),           //'description'
            3   => Field::findOne(7),           //'body'
            4   => Field::findOne(8),           //'enable'
            5   => Field::findOne(11),          //'lang'
            6   => Field::findOne(15),          //'is_menu'
        ];
    }


    public function getNodeField($listCate = []/*, $id = ''*/){
        /*if(!empty($id)){
            $thisField = $this->fieldItem($id);
            $listCate[] = $thisField;
        }
        $listCate = array_reverse($listCate);*/
        $field = $this->defaultField();
        foreach ($listCate as $cate) {
            if($cate){
                $field = $cate;
                break;
            }
        }
        return $field;
    }

    public function getField($id, $table = 'node'){
        $node = new Node;
        $fields = [];
        $family = $node->getFamily($id);

        foreach ($family as $child) {
            $fields[] = $this->fieldItem($child, $table);
        }

        return $field = $this->getNodeField($fields);
    }
}
