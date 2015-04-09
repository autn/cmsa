<?php

namespace app\models;

use Yii;
use yii\helpers\ArrayHelper;
use app\models\NodeField;
use app\models\CreateAlias;

/**
 * This is the model class for table "cmsa_node".
 *
 * @property integer $id
 * @property integer $type_content
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
    //$parent;
    public static function tableName()
    {
        return 'cmsa_node';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        $nodeFields = new NodeField;
        $createAlias = new CreateAlias;

        return [
            [['id', 'title'], 'required'],
            [['type_content', 'node_parent_id', 'priority'], 'integer'],
            [['description', 'body'], 'string'],
            [['create', 'update'], 'safe'],
            [['title', 'alias', 'lang', 'file', 'link'], 'string', 'max' => 255],
            ['alias', 'validateAlias']
        ];
    }

    public function validateAlias(){
        $nodeFields =  new NodeField;
        $createAlias = new CreateAlias;
        //Alias existed
        if ($createAlias->__isAliasExisted($this->node_parent_id, $this->alias)){
            $this->addError('alias','Alias is already exists in this section!');
        }
        // Empty alias
        if (trim($this->alias) == ''){
            $this->addError('alias','Invalid Alias');
        }
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'type_content' => Yii::t('app', 'Type Content'),
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
            'is_menu' => Yii::t('app', 'Display in admin menu'),
        ];
    }

    public function getNode($id){
        return Node::find()->where(['node_parent_id' => $id])->all();
    }

    public function getMaxId(){
        return Node::find()->orderBy('id DESC')->one()->id + 1;
    }
    public function saveNode($model){
        $nodeFields = new NodeField;
        $createAlias = new CreateAlias;

        $model->id = $this->getMaxId();
        $model->create = time();
        $model->lang = 'vie';$this->addError($model->alias,'sâs');
        //Auto create alias
        if(!isset($model->alias) || empty($model->alias) || ($model->alias==null) || ($model->alias==''))
            $model->alias = $createAlias->__autoCreateAlias($model->node_parent_id, $model->title);
        //Check alias existed
        elseif ($createAlias->__isAliasExisted($model->node_parent_id, $model->alias)){

        }

        $nodeFields->node_id = $model->id;
        $nodeFields->id = $nodeFields->getMaxId();
        //var_export($nodeFields); //exit();
        if($model->save() && $nodeFields->save())
            return true;
        else
            return false;
    }
    
    // return html drop down
    public static function getParentNode($id){
        if($id!==0 && !empty($id)){
            $parent_id = Node::find()->where(['id' => $id])->one()->node_parent_id;
            $parent    = Node::find()->where(['node_parent_id' => $parent_id])->all();
            return ArrayHelper::map($parent, 'id', 'title');
        }
        //return [1=>2, 2=>3];
    }
}
