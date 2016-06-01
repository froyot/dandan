<?php

namespace easydandan\controllers;

use easydandan\components\Controller;

/**
 * Default controller for the `easydandan` module
 */
class SiteController extends Controller
{
    /**
     * Renders the index view for the module
     * @return string
     */
    public function actionIndex()
    {
        return $this->render('index');
    }
}
