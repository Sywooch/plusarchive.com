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
$I->wantTo('ensure that store/view works');
$I->seePageNotFound(['/store/view', 'id' => 1]);
$I->loginAsAdmin();

$I->amOnPage(url(['/store/admin']));
$I->click('//*[@id="w1"]/table/tbody/tr[1]/td[6]/a[1]/i');
$I->seeCurrentUrlEquals('/index-test.php/store/1');
$I->see('Store', '#menu-controller');
$I->see('View', '#menu-action');
$I->see('store1', '.detail-view');

$I->moveMouseOver('#menu-action');
$I->click('Admin', '#menu-action + .dropdown-menu');
$I->seeCurrentUrlEquals('/index-test.php/store/admin');
$I->moveBack();

$I->moveMouseOver('#menu-action');
$I->click('Create', '#menu-action + .dropdown-menu');
$I->seeCurrentUrlEquals('/index-test.php/store/create');
$I->moveBack();

$I->moveMouseOver('#menu-action');
$I->click('Update', '#menu-action + .dropdown-menu');
$I->seeCurrentUrlEquals('/index-test.php/store/update/1');
$I->moveBack();

$I->moveMouseOver('#menu-action');
$I->click('Delete', '#menu-action + .dropdown-menu');
$I->seeInPopup('Are you sure you want to delete this item?');
$I->cancelPopup();

$I->moveMouseOver('#menu-action');
$I->click('Delete', '#menu-action + .dropdown-menu');
$I->acceptPopup();
$I->seeCurrentUrlEquals('/index-test.php/store/admin');
$I->see('Admin: 2', '#menu-action');
