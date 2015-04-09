<?php

namespace app\models;

use Yii;

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
            [['id', 'field_id'], 'integer'],
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
}
