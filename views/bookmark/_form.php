<?php

/*
 * This file is part of the plusarchive.com
 *
 * (c) Tomoki Morita <tmsongbooks215@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

/* @var $this yii\web\View */
/* @var $form yii\widgets\ActiveForm */
/* @var $model app\models\Bookmark */

use dosamigos\selectize\SelectizeTextInput;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

?>
<div class="row">
    <div class="col-xs-12 col-sm-1"></div>
    <div class="col-xs-12 col-sm-5">
        <?php $form = ActiveForm::begin() ?>
            <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>
            <?= $form->field($model, 'url')->textInput(['maxlength' => true]) ?>
            <?= $form->field($model, 'link')->textarea(['rows' => 6]) ?>
            <?= $form->field($model, 'tagValues')->widget(SelectizeTextInput::class, ['loadUrl' => ['bookmark-tag/list']]) ?>
            <?= $form->field($model, 'status')->DropdownList($model::STATUS_DATA) ?>
            <div class="form-group">
                <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => 'btn btn-primary']) ?>
            </div>
        <?php ActiveForm::end() ?>
    </div>
    <div class="col-xs-12 col-sm-5">
        <div class="alert alert-info">
            <i class="fa fa-info-circle"></i>
            <strong><?= h($model->getAttributeLabel('link')) ?></strong>
            が複数ある場合は改行で区切って入力してください。
        </div>
    </div>
    <div class="col-xs-12 col-sm-1"></div>
</div><!-- /.row -->
