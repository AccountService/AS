<?php

namespace controller;

use lib\Controller;


class IndexController extends Controller
{
    public function indexAction()
    {

    }
    public function testAction()
    {

        $PrModel = $this->app->getModel('Product');
        $this->view->assign('q', $PrModel->getProduct('q'));
    }


}