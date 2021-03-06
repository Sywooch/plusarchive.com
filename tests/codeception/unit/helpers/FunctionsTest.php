<?php

/*
 * This file is part of the plusarchive.com
 *
 * (c) Tomoki Morita <tmsongbooks215@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace tests\codeception\unit\helpers;

use Yii;
use yii\codeception\TestCase;

class FunctionsTest extends TestCase
{
    public function testApp()
    {
        $this->assertSame(Yii::$app, app());
    }

    public function testDb()
    {
        $this->assertSame(Yii::$app->getDb(), db());
    }

    public function testFormatter()
    {
        $this->assertSame(Yii::$app->getFormatter(), formatter());
    }

    public function testRequest()
    {
        $this->assertSame(Yii::$app->getRequest(), request());
    }

    public function testResponse()
    {
        $this->assertSame(Yii::$app->getResponse(), response());
    }

    public function testSession()
    {
        $this->assertSame(Yii::$app->getSession(), session());
    }

    public function testSecurity()
    {
        $this->assertSame(Yii::$app->getSecurity(), security());
    }

    public function testUser()
    {
        $this->assertSame(Yii::$app->getUser(), user());
    }

    public function testHashids()
    {
        $this->assertSame(Yii::$app->hashids, hashids());
    }

    public function testUrl()
    {
        $this->assertSame('/index-test.php/foo/index?q=bar', url(['/foo/index', 'q' => 'bar']));
    }

    public function testH()
    {
        $this->assertSame('&lt;script&gt;alert(&#039;xss&#039;);&lt;/script&gt;', h("<script>alert('xss');</script>"));
    }

    public function testAssertRevision()
    {
        $v = filemtime(Yii::getAlias('@webroot/favicon.ico'));
        $this->assertSame("/favicon.ico?v=$v", asset_revision('favicon.ico'));

        $v = filemtime(Yii::getAlias('@webroot/css/common.css'));
        $this->assertSame("/css/common.css?v=$v", asset_revision('css/common.css'));
    }
}
