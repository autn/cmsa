<?php

namespace app\models;

use Yii;
use app\models\Node;

/**
 * This is the model class for table "cmsa_node_field".
 *
 * @property integer $id
 * @property string $name
 * @property integer $field_id
 */
class CreateAlias extends \yii\db\ActiveRecord
{
	/*var $options = array();
    function setup(&$model, $settings = array()) {
        $default = array(
			'label' => 'name', 
			'alias' => 'alias', 
		);

		if (!isset($this->__settings[$model->alias]))
		{
			$this->__settings[$model->alias] = $default;
		}
		
		$this->__settings[$model->alias] = am($this->__settings[$model->alias], $settings);
    }*/
	
	/**
	 * Method test existed alias
	 * @param $alias
	 * @param $id
	 * @return true if alias exists, else return false
	 */
	function __isAliasExisted($parent_id, $alias) {
		$node_alias = Node::find()->where(['node_parent_id' => $parent_id, 'alias' => $alias])->one();
		
		if (isset($node_alias)) {
			return true;
		} else {
			return false;
		}
	}
	/**
	 * Method autoCreateAlias help auto create alias from title
	 * @param $title
	 * @return $alias
	 */
	function __autoCreateAlias($parent_id, $name){
		// generate alias from title
		$alias_from_title = $this->__convert2Alias($name);
		$alias = $alias_from_title;
		// create alias
		$number = 1;
		while ($this->__isAliasExisted($parent_id, $alias)) {
			$alias = $alias_from_title . "-" .$number;
			$number++;
		}
        /*$rest = substr($alias, -1);
        if($rest == ')'){
            $alias = substr($alias, 0, -3);
        }*/
		return $alias;
	}
	
    //Function before save.
    /*function beforeValidate(&$model, $created) {
    	$created = !isset($model->data[$model->alias]['id']);
    	$name = isset($model->data[$model->alias][$this->__settings[$model->alias]['label']]) ? $model->data[$model->alias][$this->__settings[$model->alias]['label']] : "";
		$alias = isset($model->data[$model->alias][$this->__settings[$model->alias]['alias']]) ? $model->data[$model->alias][$this->__settings[$model->alias]['alias']] : "";
		
		if ($alias == "") {
			if ($created) {
				$alias = $this->__autoCreateAlias($model, $name);
			} else {
				$alias = $this->__autoCreateAlias($model, $name, $model->id);
			}
		} else  {
			if ($created) {
				$alias = $this->__autoCreateAlias($model, $alias);
			} else {
				$alias = $this->__autoCreateAlias($model, $alias, $model->id);
			}
		}
		
		$model->data[$model->alias][$this->__settings[$model->alias]['alias']] = $alias;
		return true;
    }
*/
	function __convert2Alias($string_alias) {
		$mark=array("à","á","ạ","ả","ã","â","ầ","ấ","ậ","ẩ","ẫ","ă",
		"ằ","ắ","ặ","ẳ","ẵ","è","é","ẹ","ẻ","ẽ","ê","ề"
		,"ế","ệ","ể","ễ",
		"ì","í","ị","ỉ","ĩ",
		"ò","ó","ọ","ỏ","õ","ô","ồ","ố","ộ","ổ","ỗ","ơ"
		,"ờ","ớ","ợ","ở","ỡ",
		"ù","ú","ụ","ủ","ũ","ư","ừ","ứ","ự","ử","ữ",
		"ỳ","ý","ỵ","ỷ","ỹ",
		"đ",
		"À","Á","Ạ","Ả","Ã","Â","Ầ","Ấ","Ậ","Ẩ","Ẫ","Ă"
		,"Ằ","Ắ","Ặ","Ẳ","Ẵ",
		"È","É","Ẹ","Ẻ","Ẽ","Ê","Ề","Ế","Ệ","Ể","Ễ",
		"Ì","Í","Ị","Ỉ","Ĩ",
		"Ò","Ó","Ọ","Ỏ","Õ","Ô","Ồ","Ố","Ộ","Ổ","Ỗ","Ơ"
		,"Ờ","Ớ","Ợ","Ở","Ỡ",
		"Ù","Ú","Ụ","Ủ","Ũ","Ư","Ừ","Ứ","Ự","Ử","Ữ",
		"Ỳ","Ý","Ỵ","Ỷ","Ỹ",
		"Đ"," ");

		
		$no_mark=array("a","a","a","a","a","a","a","a","a","a","a"
		,"a","a","a","a","a","a",
		"e","e","e","e","e","e","e","e","e","e","e",
		"i","i","i","i","i",
		"o","o","o","o","o","o","o","o","o","o","o","o"
		,"o","o","o","o","o",
		"u","u","u","u","u","u","u","u","u","u","u",
		"y","y","y","y","y",
		"d",
		"A","A","A","A","A","A","A","A","A","A","A","A"
		,"A","A","A","A","A",
		"E","E","E","E","E","E","E","E","E","E","E",
		"I","I","I","I","I",
		"O","O","O","O","O","O","O","O","O","O","O","O"
		,"O","O","O","O","O",
		"U","U","U","U","U","U","U","U","U","U","U",
		"Y","Y","Y","Y","Y",
		"D","-");
		
		$string_alias = trim($string_alias);
		//$alias = str_replace('  ',' ',$string_alias);
		$alias = str_replace($mark,$no_mark,$string_alias);
		$result = strtolower($alias);
	    $result = preg_replace('/[^a-z0-9\-_]/','',$result);
	    $result = preg_replace('/\-+/','-',$result);
		return $result;
	}
}
?>