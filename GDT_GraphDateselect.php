<?php
namespace GDO\JPGraph;

use GDO\Form\GDT_Select;
use GDO\Date\Time;

final class GDT_GraphDateselect extends GDT_Select
{
	public function __construct()
	{
		$this->initChoices();
	}
	
	public function initChoices()
	{
		$this->emptyLabel(t('jpgraphsel_0'));
		
		$choices = array();
		$choices['custom'] = t('jpgraphsel_custom');
		if ($this->withToday)
		{
			$choices['today'] = t('jpgraphsel_today');
		}
		if ($this->withYesterday)
		{
			$choices['yesterday'] = t('jpgraphsel_yesterday');
		}
		$choices['7days'] = t('jpgraphsel_7days');
		$choices['this_week'] = t('jpgraphsel_this_week');
		$choices['last_week'] = t('jpgraphsel_last_week');
		return $this->choices($choices);
	}
	
	################
	### Settings ###
	################
	public $withToday = true;
	public function withToday($withToday=true)
	{
		$this->withToday = $withToday;
		return $this;
	}
	
	public $withYesterday = true;
	public function withYesterday($withYesterday=true)
	{
		$this->withYesterday = $withYesterday;
		return $this;
	}
	
	##################
	### Range calc ###
	##################
	public function getStartDate()
	{
		return Time::getDate($this->getStartTime());
	}
	
	public function getStartTime()
	{
		$now = mktime(0, 0, 0);
		switch ($this->getValue())
		{
			case 'today': return $now;
			case 'yesterday': return $now - Time::ONE_DAY;
			case '7days': return strtotime("-7 days", $now);
			case 'this_week': return strtotime('last monday');
			case 'last_week': return strtotime('last monday') - Time::ONE_WEEK;
			default: 
		}
	}
	
	public function getEndDate()
	{
		return Time::getDate($this->getEndTime());
	}
	
	public function getEndTime()
	{
		$now = time();
		switch ($this->getValue())
		{
			case 'today':return $now;
			case 'yesterday': return mktime(0, 0, 0) - 1;
			case '7days': return $now;
			case 'this_week': return $now;
			case 'last_week': return strtotime('last monday') - 1; 
		}
	}
	
}
