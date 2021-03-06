<?php

/*
 * This file is part of the plusarchive.com
 *
 * (c) Tomoki Morita <tmsongbooks215@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace tests\codeception\unit\models\form;

use app\models\PlaylistItem;
use app\models\form\PlaylistItemSortForm;
use tests\codeception\unit\fixtures\PlaylistFixture;
use tests\codeception\unit\fixtures\PlaylistItemFixture;
use tests\codeception\unit\fixtures\TrackFixture;
use yii\codeception\DbTestCase;

class PlaylistItemSortFormTest extends DbTestCase
{
    public function fixtures()
    {
        return [
            'playlist' => [
                'class' => PlaylistFixture::class,
                'dataFile' => '@tests/codeception/unit/fixtures/data/playlist-item-sort-form/playlist.php',
            ],
            'track' => [
                'class' => TrackFixture::class,
                'dataFile' => '@tests/codeception/unit/fixtures/data/playlist-item-sort-form/track.php',
            ],
            'items' => [
                'class' => PlaylistItemFixture::class,
                'dataFile' => '@tests/codeception/unit/fixtures/data/playlist-item-sort-form/playlist_item.php',
            ],
        ];
    }

    public function testValidateId()
    {
        $model = new PlaylistItemSortForm([
            'ids' => $this->items['item2']['id'].','.$this->items['item3']['id'].','.$this->items['item4']['id'],
            'playlist_id' => $this->playlist['playlist1']['id'],
        ]);
        $this->assertFalse($model->save());
        $this->assertTrue(isset($model->errors['ids']));

        $model->ids = $this->items['item1']['id'].','.$this->items['item2']['id'].','.$this->items['item3']['id'];
        $this->assertTrue($model->save());
    }

    public function testValidateIdTotal()
    {
        // The total of the id does not match.
        $model = new PlaylistItemSortForm([
            'ids' => $this->items['item1']['id'].','.$this->items['item2']['id'],
            'playlist_id' => $this->playlist['playlist1']['id'],
        ]);

        $this->assertFalse($model->save());
        $this->assertTrue(isset($model->errors['ids']));

        // Duplicate id
        $model = new PlaylistItemSortForm([
            'ids' => $this->items['item1']['id'].','.$this->items['item1']['id'].','.$this->items['item3']['id'],
            'playlist_id' => $this->playlist['playlist1']['id'],
        ]);
        $this->assertFalse($model->save());
        $this->assertTrue(isset($model->errors['ids']));

        // OK
        $model = new PlaylistItemSortForm([
            'ids' => $this->items['item1']['id'].','.$this->items['item2']['id'].','.$this->items['item3']['id'],
            'playlist_id' => $this->playlist['playlist1']['id'],
        ]);
        $this->assertTrue($model->save());
    }


    public function testSave()
    {
        $model = new PlaylistItemSortForm([
            'ids' => $this->items['item2']['id'].','.$this->items['item3']['id'].','.$this->items['item1']['id'],
            'playlist_id' => $this->playlist['playlist1']['id'],
        ]);
        $this->assertTrue($model->save());

        $model = PlaylistItem::findOne($this->items['item1']['id']);
        $this->assertSame(3, $model->track_number);

        $model = PlaylistItem::findOne($this->items['item2']['id']);
        $this->assertSame(1, $model->track_number);

        $model = PlaylistItem::findOne($this->items['item3']['id']);
        $this->assertSame(2, $model->track_number);

        $model = new PlaylistItemSortForm([
            'ids' => $this->items['item3']['id'].','.$this->items['item1']['id'].','.$this->items['item2']['id'],
            'playlist_id' => $this->playlist['playlist1']['id'],
        ]);
        $this->assertTrue($model->save());

        $model = PlaylistItem::findOne($this->items['item1']['id']);
        $this->assertSame(2, $model->track_number);

        $model = PlaylistItem::findOne($this->items['item2']['id']);
        $this->assertSame(3, $model->track_number);

        $model = PlaylistItem::findOne($this->items['item3']['id']);
        $this->assertSame(1, $model->track_number);
    }
}
