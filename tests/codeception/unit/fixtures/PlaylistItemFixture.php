<?php

/*
 * This file is part of the plusarchive.com
 *
 * (c) Tomoki Morita <tmsongbooks215@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace tests\codeception\unit\fixtures;

use app\models\PlaylistItem;
use yii\test\ActiveFixture;

class PlaylistItemFixture extends ActiveFixture
{
    public $modelClass = PlaylistItem::class;
}
