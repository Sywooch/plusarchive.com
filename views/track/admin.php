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
/* @var $data yii\data\ActiveDataProvider */
/* @var $provider string */
/* @var $genre string */
/* @var $status string */
/* @var $sort string */
/* @var $search string */
/* @var $embedUrl string */

use yii\helpers\Html;
use yii\widgets\LinkPager;
use yii\widgets\Pjax;

$this->title = 'Admin Tracks - '.app()->name;
?>
<div id="track-now" class="text-center"></div>

<?php Pjax::begin(['id' => 'track-pjax']) ?>
    <?= $this->render('/common/nav/admin', [
        'totalCount' => $data->totalCount,
    ]) ?>
    <div id="tile-container" class="row text-center">
        <?= $this->render('_search-admin', [
            'provider' => $provider,
            'genre' => $genre,
            'sort' => $sort,
            'status' => $status,
            'search' => $search,
            'total' => $data->totalCount,
        ]) ?>
        <?php /* @var $model app\models\Track */ ?>
        <?php /* @var $genre app\models\TrackGenre */ ?>
        <?php foreach ($data->models as $model): ?>
            <div class="col-xs-12 col-sm-3 tile">
                <div class="thumbnail">
                    <?= Html::tag('img', '', [
                        'class' => 'lazy track-image',
                        'data-original' => h($model->image),
                        'data-url' => $embedUrl,
                        'data-id' => hashids()->encode($model->id),
                    ]) ?>
                    <div class="caption">
                        <?= h($model->title) ?>
                        <br>
                        <?php if (null !== $model->newText): ?>
                            <span class="label label-new"><?= h($model->newText) ?></span>
                        <?php endif ?>
                        <?= Html::a(h($model->statusText), ['', 'status' => $model->statusText], [
                            'class' => 'label label-default',
                        ]) ?>
                        <?= Html::a(h($model->providerText), ['', 'provider' => $model->providerText], [
                                'class' => 'label label-default',
                        ]) ?>
                        <?php foreach ($model->trackGenres as $genre): ?>
                            <?= Html::a(h($genre->name), ['', 'genre' => $genre->name], [
                                'class' => 'label label-default',
                            ]) ?>
                        <?php endforeach ?>
                        <br>
                        <?= Html::a('<i class="fa fa-fw fa-edit"></i> Update', ['update', 'id' => $model->id], [
                            'class' => 'label label-default',
                            'data-pjax' => '0',
                        ]) ?>
                        <?= Html::a('<i class="fa fa-fw fa-trash-o"></i> Delete', ['delete', 'id' => $model->id], [
                            'class' => 'label label-default',
                            'data-confirm' => 'Are you sure you want to delete this item?',
                            'data-method' => 'post',
                        ]) ?>
                        <br>
                        <div class="pull-right track-created-date">
                            <?= formatter()->asDate($model->created_at) ?>
                        </div>
                        <div class="clearfix"></div>
                    </div><!-- /.caption -->
                </div><!-- /.thumbnail -->
            </div><!-- /.tile -->
        <?php endforeach ?>
    </div><!-- /.row -->

    <?= LinkPager::widget(['pagination' => $data->pagination]) ?>
<?php Pjax::end() ?>

<?= $this->render('/common/js/tile') ?>
<?= $this->render('_now') ?>
