<?php
namespace GDO\JPGraph;

use GDO\Core\Method;
use GDO\DB\GDT_UInt;
use GDO\Date\GDT_DateTime;
use GDO\Date\Time;
use GDO\UI\WithTitle;

/**
 * Render a graph.
 * @author gizmore
 */
abstract class MethodGraph extends Method
{
	use WithTitle;

	public function gdoParameters()
	{
		return array(
			GDT_UInt::make('width')->min(48)->max(1024)->initial(640),
			GDT_UInt::make('height')->min(32)->max(1024)->initial(480),
			GDT_DateTime::make('start')->initial(Time::getDate(time()-Time::ONE_WEEK)),
			GDT_DateTime::make('end')->initial(Time::getDate()),
		);
	}
	
	public function getWidth()
	{
		return $this->gdoParameterValue('width');
	}
	
	public function getHeight()
	{
		return $this->gdoParameterValue('height');
	}
	
	public function getStart()
	{
		return $this->gdoParameterVar('start');
	}
	
	public function getStartTime()
	{
		return Time::getTimestamp($this->getStart());
	}
	
	public function getEnd()
	{
		return $this->gdoParameterVar('end');
	}
	
	public function getEndTime()
	{
		return Time::getTimestamp($this->getEnd());
	}
	
	public function hrefImage()
	{
		$param = "&start={$this->getStart()}";
		$param .= "&end={$this->getEnd()}";
		$param .= "&width={$this->getWidth()}";
		$param .= "&height={$this->getHeight()}";
		return $this->href($param);
	}
	
}
