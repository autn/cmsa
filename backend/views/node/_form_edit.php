<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Node */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="node-form">

    <?php $form = ActiveForm::begin(); 
    //if($parent != 0)
        echo $form->field($model, 'node_parent_id')->dropdownlist($parent);
    foreach ($fields as $field) {
        switch ($field->name) {
            case 'title':
                echo $form->field($model, 'title')->textInput();
                break;

            case 'alias': ?>
                <input type="checkbox" onchange="change_auto(this);"/><b><span> Auto Alias</span></b>
            <?php
                echo $form->field($model, 'alias')->textInput();
                break;

            case 'description':
                echo $form->field($model, 'description')->textInput();
                break;

            case 'body':
                echo $form->field($model, 'body')->textarea();
                break;

            case 'enable':
                echo $form->field($model, 'enable')->checkBox();
                break;

            case 'is_menu':
                echo $form->field($model, 'is_menu')->checkBox();
                break;

            case 'priority':
                echo $form->field($model, 'priority')->textInput();
                break;

            /*case 'title':
                echo $form->field($model, 'title')->textInput();
                break;

            case 'title':
                echo $form->field($model, 'title')->textInput();
                break;

            case 'title':
                echo $form->field($model, 'title')->textInput();
                break;

            case 'title':
                echo $form->field($model, 'title')->textInput();
                break;*/
            
            default:
                echo $form->field($model, $field->name)->textInput();
                break;
        }
    }?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
<script type="text/javascript">
    function change_auto(e){
        var alias = document.getElementById('node-alias');
        if(alias.value.trim() != '')
            localStorage.setItem('custom_alias_value', alias.value);
        if(e.checked){
            alias.value = '';
            alias.style.display = 'none';
        }else{
            alias.style.display = 'block';
            alias.value = localStorage.getItem('custom_alias_value');
            localStorage.setItem('custom_alias_value', '');
        }
    }
</script>
<style type="text/css">
    .field-node-alias .control-label{
        display: none;
    }
</style>