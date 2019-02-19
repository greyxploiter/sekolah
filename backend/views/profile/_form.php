<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\widgets\FileInput;

/* @var $this yii\web\View */
/* @var $model common\models\ModuleProfile */
/* @var $form yii\widgets\ActiveForm */

?>

<div class="module-profile-form">

    <?php $form = ActiveForm::begin(['options'=>['enctype'=>'multipart/form-data']]); ?>


    <div class="container-fluid">
            <?= $form->errorSummary($model); ?>
            <?php

            if($model->scenario == "create")
            {
                echo $form->field($model, 'user_id')->widget(\kartik\widgets\Select2::classname(), [
                        'data' => \yii\helpers\ArrayHelper::map(\common\models\User::find()->orderBy('id')->asArray()->all(), 'id', 'username'),
                        'options' => ['placeholder' => 'Choose User'],
                        'pluginOptions' => [
                            'allowClear' => true
                        ],
                    ]);
            }
             ?>

            <?= $form->field($model, 'nama')->textInput(['maxlength' => true, 'placeholder' => 'Nama']) ?>

            <?= $form->field($model, 'tgl_lahir')->textInput(['placeholder' => 'Tgl Lahir']) ?>

            <?= $form->field($model, 'tempat_lahir')->textInput(['maxlength' => true, 'placeholder' => 'Tempat Lahir']) ?>

            <?= $form->field($model, 'bio')->textarea(['rows' => 6]) ?>

            <?= $form->field($model, 'no_telp')->textInput(['maxlength' => true, 'placeholder' => 'No Telp']) ?>

            <?= $form->field($model, 'image')->widget(FileInput::classname(), [
                'options' => ['accept' => 'image/*'],
                ]);?>

            <?= $form->field($model, 'lock', ['template' => '{input}'])->textInput(['style' => 'display:none']); ?>

            <div class="form-group">
                <?= Html::submitButton($model->isNewRecord ? 'Tambah' : 'Ubah', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
                <?= Html::a(Yii::t('app', 'Batal'), Yii::$app->request->referrer , ['class'=> 'btn btn-danger']) ?>
            </div>
    </div>


    <?php ActiveForm::end(); ?>

</div>
