<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "cmsa_field".
 *
 * @property integer $id
 * @property string $name
 * @property string $label
 * @property integer $type_id
 * @property string $field_type
 * @property integer $use_wyswyg
 */
class Field extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'cmsa_field';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['type_id', 'use_wyswyg'], 'integer'],
            [['name', 'label', 'field_type'], 'string', 'max' => 255]
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
            'label' => Yii::t('app', 'Label'),
            'type_id' => Yii::t('app', 'Type ID'),
            'field_type' => Yii::t('app', 'Field Type'),
            'use_wyswyg' => Yii::t('app', 'Use Wyswyg'),
        ];
    }
}
