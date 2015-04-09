<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "cmsa_node_term".
 *
 * @property integer $id
 * @property string $name
 * @property integer $parent_id
 * @property string $alias
 * @property integer $priority
 */
class NodeTerm extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'cmsa_node_term';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['parent_id', 'priority'], 'integer'],
            [['name', 'alias'], 'string', 'max' => 255]
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
            'parent_id' => Yii::t('app', 'Parent ID'),
            'alias' => Yii::t('app', 'Alias'),
            'priority' => Yii::t('app', 'Priority'),
        ];
    }
}
