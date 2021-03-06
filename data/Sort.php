<?php

/*
 * This file is part of the plusarchive.com
 *
 * (c) Tomoki Morita <tmsongbooks215@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace app\data;

use Yii;
use yii\data\Sort as SortBase;
use yii\data\Pagination;
use yii\web\Request;

class Sort extends SortBase
{
    /**
     * Returns the page parameter.
     * @return string
     */
    public function getPageParam()
    {
        return (new Pagination)->pageParam;
    }

    /**
     * @inheritdoc
     */
    public function createUrl($attribute, $absolute = false)
    {
        $params = $this->params;

        if (null === $params) {
            $request = Yii::$app->getRequest();
            $params = $request instanceof Request ? $request->getQueryParams() : [];
        }
        if (isset($params[$this->getPageParam()])) {
            unset($params[$this->getPageParam()]);
        }
        $params[$this->sortParam] = $this->createSortParam($attribute);

        $params[0] = null === $this->route
            ? Yii::$app->controller->getRoute()
            : $this->route;

        $urlManager = null === $this->urlManager
            ? Yii::$app->getUrlManager()
            : $this->urlManager;

        return $absolute
            ? $urlManager->createAbsoluteUrl($params)
            : $urlManager->createUrl($params);
    }
}
