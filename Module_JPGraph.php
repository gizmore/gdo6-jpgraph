<?php
namespace GDO\JPGraph;

use GDO\Core\GDO_Module;

/**
 * This module provides JpGraph for gdo6 applications.
 * So far only ROOT_PATH needs to be adjusted to the module's root folder, and an own autoloader has been implemented.
 * @version 6.09
 * @since 6.09
 * @author gizmore
 */
final class Module_JPGraph extends GDO_Module
{
	/**
	 * Define jpGraph ROOT_PATH on init.
	 * {@inheritDoc}
	 * @see \GDO\Core\GDO_Module::onInit()
	 */
	public function onInit()
	{
		define('ROOT_PATH', $this->filePath());
	}
	
	/**
	 * JpGraph src folder
	 * @return string
	 */
	public function jpgraphPath()
	{
		return $this->filePath('jpgraph/src');
	}
	
	/**
	 * Include a JpGraph file.
	 * @param string $path
	 */
	public function includeJPGraph($path)
	{
		$path = $this->jpgraphPath() . "/$path";
		require_once $path;
	}
	
	public function onIncludeScripts()
	{
		$this->addJavascript('js/gdo-jpgraph.js');
	}

}
