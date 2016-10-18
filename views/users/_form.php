<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\models\user\AuthItem;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model app\models\user\UserRecord */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="user-record-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'first_name')->textInput(['maxlength' => 100]) ?>

    <?= $form->field($model, 'last_name')->textInput(['maxlength' => 100]) ?>

    <?= $form->field($model, 'username')->textInput(['maxlength' => 255]) ?>

    <?= $form->field($model, 'password')->passwordInput(['maxlength' => 255]) ?>
	
	<?= $form->field($model, 'type')->dropDownList(
        ArrayHelper::map(AuthItem::find()->all(),'name','name'),
        ['prompt'=>'Select Type User']) 
    ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
