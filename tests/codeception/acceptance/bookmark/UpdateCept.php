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
$I->wantTo('ensure that bookmark/update works');
$I->seePageNotFound(['/bookmark/update', 'id' => 1]);
$I->loginAsAdmin();

$I->amOnPage(url(['/bookmark/admin']));
$I->click('//*[@id="w1"]/table/tbody/tr[1]/td[7]/a[2]/i'); // Update link
$I->seeCurrentUrlEquals('/index-test.php/bookmark/update/1');
$I->see('Bookmark', '#menu-controller');
$I->see('Update', '#menu-action');

$I->moveMouseOver('#menu-action');
$I->click('Admin', '#menu-action + .dropdown-menu');
$I->seeCurrentUrlEquals('/index-test.php/bookmark/admin');
$I->moveBack();

$I->moveMouseOver('#menu-action');
$I->click('Create', '#menu-action + .dropdown-menu');
$I->seeCurrentUrlEquals('/index-test.php/bookmark/create');
$I->moveBack();

$I->seeInField('#bookmark-name', 'bookmark1');
$I->seeInField('#bookmark-url', 'https://bookmark1.example.com/');
$I->seeInField('#bookmark-link', "https://twitter.com/bookmark1\nhttps://soundcloud.com/bookmark1");

$I->fillField('#bookmark-name', '');
$I->click('button[type=submit]');
$I->seeElement('.has-error');

$I->fillField('#bookmark-name', 'bookmark-one');
$I->click('button[type=submit]');
$I->seeCurrentUrlEquals('/index-test.php/bookmark/1');
$I->see('Bookmark has been updated.');

$I->moveMouseOver('#menu-action');
$I->click('Admin', '#menu-action + .dropdown-menu');
$I->see('Admin: 4', '#menu-action');
$I->see('bookmark-one', '.grid-view');
$I->dontSee('bookmark1', '.grid-view');

$I->click('//*[@id="w1"]/table/tbody/tr[1]/td[7]/a[2]/i'); // Update link
$I->seeCurrentUrlEquals('/index-test.php/bookmark/update/1');

$I->moveMouseOver('#menu-action');
$I->click('Delete', '#menu-action + .dropdown-menu');
$I->seeInPopup('Are you sure you want to delete this item?');
$I->cancelPopup();

$I->moveMouseOver('#menu-action');
$I->click('Delete', '#menu-action + .dropdown-menu');
$I->acceptPopup();
$I->seeCurrentUrlEquals('/index-test.php/bookmark/admin');
$I->see('Admin: 3', '#menu-action');
$I->dontSee('bookmark-one', '.grid-view');
