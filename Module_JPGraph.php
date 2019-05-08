<?php
namespace GDO\JPGraph;

use GDO\Core\GDO_Module;

/**
 * @version 6.09
 * @author gizmore
 */
final class Module_JPGraph extends GDO_Module
{
	public function jpgraphPath()
	{
		return $this->filePath('jpgraph/src');
	}
	
	public function includeJPGraph($path)
	{
		$path = $this->jpgraphPath() . "/$path";
		require_once $path;
	}
}
