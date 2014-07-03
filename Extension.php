<?php
/*
* @Author: mark
* @Date:   2014-07-02 16:34:30
* @Last Modified by:   mark
* @Last Modified time: 2014-07-03 10:33:05
*/

namespace Bearlikelion\TwigDebugBar;

Class Extension extends \Twig_Extension
{
	public function __construct()
	{
		$this->debugbar = new \DebugBar\StandardDebugBar();
		$this->renderer = $this->debugbar->getJavascriptRenderer();
	}

	public function getFunctions()
	{
		return array(
			'dbg_render' => new \Twig_Function_Method($this, 'render',  array('is_safe' => array('html'))),
			'dbg_renderHead'  => new \Twig_Function_Method($this, 'renderHead',  array('is_safe' => array('html')))
		);
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
