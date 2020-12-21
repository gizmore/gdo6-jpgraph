<?php
namespace GDO\JPGraph;

use GDO\Core\GDO_Module;
use GDO\DB\GDT_UInt;

/**
 * This module provides JPGraph for gdo6 applications.
 * So far only jpgraph's ROOT_PATH needs to be adjusted to the module's root folder, and an own autoloader has been implemented.
 * @version 6.09
 * @since 6.09
 * @author gizmore
 */
final class Module_JPGraph extends GDO_Module
{
    public function thirdPartyFolders() { return ['/jpgraph/']; }
    
	public function getConfig()
	{
		return array(
			GDT_UInt::make('jpgraph_default_width')->initial('480'),
			GDT_UInt::make('jpgraph_default_height')->initial('320'),
		);
	}
	public function cfgDefaultWidth() { return $this->getConfigVar('jpgraph_default_width'); }
	public function cfgDefaultHeight() { return $this->getConfigVar('jpgraph_default_height'); }
	
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
	
	public function onLoadLanguage()
	{
		return $this->loadLanguage('lang/jpgraph');
	}
	
	public function onIncludeScripts()
	{
		if (module_enabled('JQuery'))
		{
			$this->addJavascript('js/gdo-jpgraph.js');
		}
	}

}
