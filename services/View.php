<?php


namespace entity;


class View
{
    private $template;

    public function __construct($template)
    {
        $this->template = $template;
    }

    public function getViewFront($params = array())
    {
        extract($params); // permet de créer son nom et sa valeur dynamiquement
        $template = $this->template;
        ob_start();
        include(VIEWFRONT.$template.'.php');
        $contentPage = ob_get_clean();
        include_once (VIEWFRONT.'_gabaritFront.php');
    }

    public function getViewBack($params = array())
    {
        extract($params); // permet de créer son nom et sa valeur dynamiquement
        $template = $this->template;
        ob_start();
        include(VIEWBACK.$template.'.php');
        $contentPage = ob_get_clean();
        include_once (VIEWBACK.'_gabaritBack.php');
    }
}