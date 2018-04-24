<?php


namespace services;


class View
{

    private $template;


    public function __construct($template)
    {
        $this->template = $template;

    }

    public function renderViewFront($params = array())
    {
        extract($params); // création de la variable dynamiquement
        $template=$this->template;
        ob_start();
        include(VIEWFRONT.$template.'.php');
        $content = ob_get_clean();
        include_once (VIEWFRONT.'_gabaritFront.php');

    }

    public function renderViewBack($params = array())
    {
        extract($params); // création de la variable dynamiquement
        $template=$this->template;
        ob_start();
        include(VIEWBACK.$template.'.php');
        $content = ob_get_clean();
        include_once (VIEWBACK.'_gabaritBack.php');
    }
}