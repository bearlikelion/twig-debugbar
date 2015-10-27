<?php
/*
* @Author: mark
* @Date:   2014-07-02 16:34:30
* @Last Modified by:   mark
* @Last Modified time: 2014-07-03 10:33:05
*/

namespace Bearlikelion\TwigDebugBar;

class Extension extends \Twig_Extension
{
    public function __construct($assetPath = null)
    {
        $this->debugbar = new \DebugBar\StandardDebugBar();
        $this->renderer = $this->debugbar->getJavascriptRenderer();
        if (!is_null($assetPath)) {
            $this->renderer->setBaseUrl($assetPath);
        }
    }

    public function getFunctions()
    {
        return array(
            'dbg_message' => new \Twig_Function_Method($this, 'message'),
            'dbg_render' => new \Twig_Function_Method($this, 'render', ['is_safe' => ['html']]),
            'dbg_renderHead'  => new \Twig_Function_Method($this, 'renderHead', ['is_safe' => ['html']]),
        );
    }

    public function message($text, $label = info)
    {
        $this->debugbar['messages']->addMessage($text, $label);
    }

    public function render()
    {
        return $this->renderer->render();
    }

    public function renderHead()
    {
        return $this->renderer->renderHead();
    }

    public function getName()
    {
        return 'debugbar_extension';
    }
}
