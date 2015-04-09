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

            case 'alias':
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
