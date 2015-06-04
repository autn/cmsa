<?php

namespace app\models;

use Yii;
use app\models\NodeField;

/**
 * This is the model class for table "cmsa_node_content".
 *
 * @property integer $id
 * @property integer $node_parent_id
 * @property string $title
 * @property string $alias
 * @property string $description
 * @property string $body
 * @property integer $enable
 * @property integer $is_menu
 * @property integer $create
 * @property integer $update
 * @property string $lang
 * @property string $file
 * @property integer $priority
 * @property string $link
 */
class NodeArticle extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'cmsa_node_article';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['node_parent_id', 'enable', 'is_menu', 'create', 'update', 'priority'], 'integer'],
            [['description', 'body'], 'string'],
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
            'node_parent_id' => Yii::t('app', 'Node Parent ID'),
            'title' => Yii::t('app', 'Title'),
            'alias' => Yii::t('app', 'Alias'),
            'description' => Yii::t('app', 'Description'),
            'body' => Yii::t('app', 'Body'),
            'enable' => Yii::t('app', 'Enable'),
            'is_menu' => Yii::t('app', 'Is Menu'),
            'create' => Yii::t('app', 'Create'),
            'update' => Yii::t('app', 'Update'),
            'lang' => Yii::t('app', 'Lang'),
            'file' => Yii::t('app', 'File'),
            'priority' => Yii::t('app', 'Priority'),
            'link' => Yii::t('app', 'Link'),
        ];
    }

    public function getArticle($id){
        return NodeArticle::find()->where(['node_parent_id' => $id])->all();
    }

    public function getArticleHtml($id, $field){
        $nodeField = new NodeField;
        $uri = $_SERVER['REQUEST_URI'];
        $articles = $this->getArticle($id);
        $thisFields = $nodeField->getNodeField([$field], $id);
        $html = "<thead><tr>";
        if(($thisFields) && ($thisFields!=NULL))
            foreach ($thisFields as $thisField){
                $html .= "<th>". ucwords($thisField->label) ."</th>";
            }
        
        $html .= "<th></th></tr>";
        $html .= "</thead>";
        $html .= "<tbody>";
        if(isset($articles)):
            $uri_edit = '';
            foreach ($articles as $article) {
                $uri_edit = str_replace("/node/test", "/node/edit_article", $uri);
                $uri_edit .= '/' . $article['alias'];
                $html .= "<tr class='odd gradeX'>";
                foreach ($thisFields as $thisField){
                    $html .= "<td>". $article[$thisField->name] ."</td>";
                }
                $html .= "<td>";
                $html .= "<a href='" . $uri_edit . "?continue=" . $uri . "'><span>Edit</span></a>";
                $html .= "</td></tr>";
            }
        endif;
        $html .= "</tbody>";

        return $html;
    }
}
