<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\models\user\UserRecord;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model app\models\posts\Posts */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="posts-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'post_title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'post_description')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'author_id')->dropDownList(
        //ArrayHelper::map(UserRecord::find()->all(),'id','first_name'),
        ArrayHelper::map(UserRecord::find()->all(),'id','fullName'),
        ['prompt'=>'Select Author']) 
    ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
