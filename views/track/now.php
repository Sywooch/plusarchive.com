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
/* @var $model app\models\Track */
/* @var $embed string */
/* @var $id string */

use yii\helpers\Html;

?>
<div id="track-modal" class="modal">
    <div class="text-center modal-dialog">
        <?= Html::tag('iframe', '', [
            'src' => h($embed),
            'data-provider' => h($model->providerText),
            'frameborder' => '0',
            'allowfullscreen' => true,
        ]) ?>
        <?= Html::a('<i class="fa fa-fw fa-eye"></i> View', ['view', 'id' => $id], [
            'class' => 'label label-default',
        ]) ?>
    </div>
</div>
<p id="track-now-title">
    <?= h($model->title) ?>
    <span id="track-now-clear"></span>
</p>

<?php
$this->registerJs(<<<'JS'
var $modal = $('#track-modal');
var $iframe = $modal.find('iframe');

if (/^(Vimeo|YouTube)$/.test($iframe.attr('data-provider'))) {
    $iframe.wrap('<div class="embed-responsive embed-responsive-16by9" />').addClass('embed-responsive-item');
} else {
    $iframe.attr({ 'width': '100%', 'height': '120' });
}
$modal.modal('show');

$(document).on('click', '#track-now-title', function() {
    $('#track-modal').modal('show');
});
$(document).on('click', '#track-now-clear', function() {
    $('#track-now').empty();
});
JS
);
