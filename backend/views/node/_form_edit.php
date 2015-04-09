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
                <input type="checkbox" onchange="change_auto(this);" /><span>Auto Alias</span>
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

    <?php /*= $form->field($model, 'type_content')->textInput() ?>

    <?= $form->field($model, 'node_parent_id')->textInput() ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => 255]) ?>

    <?= $form->field($model, 'alias')->textInput(['maxlength' => 255]) ?>

    <?= $form->field($model, 'description')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'body')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'enable')->textInput() ?>

    <?= $form->field($model, 'create')->textInput() ?>

    <?= $form->field($model, 'update')->textInput() ?>

    <?= $form->field($model, 'lang')->textInput(['maxlength' => 255]) ?>

    <?= $form->field($model, 'file')->textInput(['maxlength' => 255]) ?>

    <?= $form->field($model, 'priority')->textInput() ?>

    <?= $form->field($model, 'link')->textInput(['maxlength' => 255])*/ ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
<script type="text/javascript">
    function change_auto(e){
        var alias = document.getElementById('node-alias');
        if(e.checked)
            alias.value = '';
    }
</script>