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
/* @var $provider string */
/* @var $genre string */
/* @var $search string */

use app\models\Track;
use app\models\TrackGenre;
use yii\helpers\Html;
use yii\helpers\Url;

?>
<div class="col-xs-12 col-sm-3 tile tile-search">
    <div class="thumbnail">
        <div class="caption">
            <a class="refresh-link" href="<?= url(['']) ?>">Reset All</a>
            <br>
            <span class="dropdown">
                <?= Html::a(h($provider).' <span class="caret"></span>', '#', [
                    'id' => 'search-provider',
                    'class' => 'dropdown-toggle label label-default',
                    'data-toggle' => 'dropdown',
                ]) ?>
                <ul class="dropdown-menu">
                    <li><a href="<?= Url::currentPlus(['provider' => null, 'search' => null]) ?>">Reset</a></li>
                    <li role="separator" class="divider"></li>
                    <?php foreach (Track::PROVIDER_DATA as $provider): ?>
                        <li><a href="<?= Url::currentPlus(['provider' => $provider, 'search' => null]) ?>"><?= h($provider) ?></a></li>
                    <?php endforeach ?>
                </ul>
            </span><!-- /.dropdown -->

            <span class="dropdown">
                <?= Html::a(h($genre).' <span class="caret"></span>', '#', [
                    'id' => 'search-genre',
                    'class' => 'dropdown-toggle label label-default',
                    'data-toggle' => 'dropdown',
                ]) ?>
                <ul class="dropdown-menu dropdown-menu-right scrollable-menu">
                    <li><a href="<?= Url::currentPlus(['genre' => null, 'search' => null]) ?>">Reset</a></li>
                    <li role="separator" class="divider"></li>
                    <?php foreach (TrackGenre::getNames()->column() as $genre): ?>
                        <li><a href="<?= Url::currentPlus(['genre' => $genre, 'search' => null]) ?>"><?= h($genre) ?></a></li>
                    <?php endforeach ?>
                </ul>
            </span><!-- /.dropdown -->

            <?= $this->render('/common/form/search', [
                'search' => $search,
                'placeholder' => 'Search artist or title ...',
            ]) ?>

            <div class="pull-right total-count"><?= h($totalCount) ?> results</div>
            <div class="clearfix"></div>
        </div><!-- /.caption -->
    </div><!-- /.thumbnail -->
</div><!-- /.tile -->
