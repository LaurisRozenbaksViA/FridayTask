<?php

namespace PHPBootcamp\Controllers;

class WiskeyController extends AbstractController
{
    public function wiskeyAction()
    {
        /** @var \Wsikey $wiskey */
        $wiskey = $this->container->get('model.wiskey');
        $randomWiskey = $wiskey->getRandomWiskey();

        $templateVariables = ['wiskey' => $randomWiskey];
        $template = 'views/wiskey.view.php';

        return $this->render($template, $templateVariables);
    }
}