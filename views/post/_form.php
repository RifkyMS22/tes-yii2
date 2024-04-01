<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\Post $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="post-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'title')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'content')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'date')->widget(\yii\jui\DatePicker::class, [
        'dateFormat' => 'yyyy-MM-dd HH:mm:ss', // Format tanggal dan waktu yang diinginkan
        'options' => ['class' => 'form-control'],
        'clientOptions' => [
            'changeYear' => true,
            'changeMonth' => true,
            'yearRange' => '1900:' . date('Y'), // Rentang tahun yang diizinkan, misalnya dari 1900 hingga tahun saat ini
            'showSecond' => true, // Tampilkan detik dalam waktu
            'showTimepicker' => true, // Tampilkan jam pada widget
            'defaultDate' => '0', // Nilai tanggal dan waktu default adalah saat ini
        ],
    ]) ?>





    <?= $form->field($model, 'username')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
