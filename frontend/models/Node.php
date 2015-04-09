<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "cmsa_node".
 *
 * @property integer $id
 * @property integer $node_term_id
 * @property integer $node_parent_id
 * @property string $title
 * @property string $alias
 * @property string $description
 * @property string $body
 * @property integer $enable
 * @property string $create
 * @property string $update
 * @property string $lang
 * @property string $file
 * @property integer $priority
 * @property string $link
 */
class Node extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'cmsa_node';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['node_term_id', 'node_parent_id', 'enable', 'priority'], 'integer'],
            [['description', 'body'], 'string'],
            [['create', 'update'], 'safe'],
            [['title', 'alias', 'lang', 'file', 'link'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'node_term_id' => Yii::t('app', 'Node Term ID'),
            'node_parent_id' => Yii::t('app', 'Node Parent ID'),
            'title' => Yii::t('app', 'Title'),
            'alias' => Yii::t('app', 'Alias'),
            'description' => Yii::t('app', 'Description'),
            'body' => Yii::t('app', 'Body'),
            'enable' => Yii::t('app', 'Enable'),
            'create' => Yii::t('app', 'Create'),
            'update' => Yii::t('app', 'Update'),
            'lang' => Yii::t('app', 'Lang'),
            'file' => Yii::t('app', 'File'),
            'priority' => Yii::t('app', 'Priority'),
            'link' => Yii::t('app', 'Link'),
        ];
    }
}
