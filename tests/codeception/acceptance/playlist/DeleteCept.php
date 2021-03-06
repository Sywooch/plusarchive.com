<?php

/*
 * This file is part of the plusarchive.com
 *
 * (c) Tomoki Morita <tmsongbooks215@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

/* @var $scenario Codeception\Scenario */

$I = new AcceptanceTester($scenario);
$I->wantTo('ensure that playlist/delete works');
$I->seePageNotFound(['/playlist/delete', 'id' => 1]);
$I->loginAsAdmin();
$I->seeMethodNotAllowed(['/playlist/delete', 'id' => 1]);
