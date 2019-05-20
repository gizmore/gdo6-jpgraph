<?php
namespace GDO\JPGraph;

use GDO\Core\GDT;
use GDO\Core\GDT_Template;

/**
 * Shows a selection for graphs including the graph image.
 * 
 * @see MethodGraph
 * @author gizmore
 * @version 6.09
 * @since 6.09
 */
class GDT_GraphSelect extends GDT
{
	
	###################
	### GraphMethod ###
	###################
	/**
	 * The method to render
	 * @var MethodGraph
	 */
	public $graphMethod;
	public function graphMethod(MethodGraph $method)
	{
		$this->graphMethod = $method;
		return $this;
	}
	
	
	public function render()
	{
		$tVars = array(
			'gdt' => $this,
		);
		return GDT_Template::php('JPGraph', 'graph_select.php', $tVars);
	}

	############
	### HREF ###
	############
	public function hrefImage()
	{
		return $this->graphMethod->hrefImage();
	}
	
}
