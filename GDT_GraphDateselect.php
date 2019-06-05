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
		$choices['14days'] = t('jpgraphsel_14days');
		$choices['this_week'] = t('jpgraphsel_this_week');
		$choices['last_week'] = t('jpgraphsel_last_week');
		$choices['this_month'] = t('jpgraphsel_this_month');
		$choices['last_month'] = t('jpgraphsel_last_month');
		$choices['this_quartal'] = t('jpgraphsel_this_quartal');
		$choices['last_quartal'] = t('jpgraphsel_last_quartal');
		
		
		return $this->choices($choices);
	}
	
	public function renderCell()
	{
		$this->initChoices();
		return parent::renderCell();
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
	
	/**
	 * Get start timestamp for select setting.
	 * @return int
	 */
	public function getStartTime()
	{
		$now = mktime(0, 0, 0);
		switch ($this->getValue())
		{
			case 'today': return $now;
			case 'yesterday': return $now - Time::ONE_DAY;
			case '7days': return strtotime("-7 days", $now);
			case '14days': return strtotime("-14 days", $now);
			case 'this_week': return strtotime('last monday');
			case 'last_week': return strtotime('last monday') - Time::ONE_WEEK;
			case 'this_month': return Time::getTimestamp(date('Y-m-01 00:00:00'));
			case 'last_month':
				$m = intval(date('m'), 10) - 1;
				$y = intval(date('y'), 10);
				$y = $m == 0 ? $y-1 : $y;
				return mktime(0, 0, 0, $m, 1, $y);
			case 'this_quartal':
				$m = intval(date('m'), 10) - 1;
				$m -= $m % 3;
				$m++;
				$y = intval(date('y'), 10);
				return mktime(0, 0, 0, $m, 1, $y);
			case 'last_quartal':
				$y = intval(date('y'), 10);
				$m = intval(date('m'), 10) - 1;
				$m -= $m % 3;
				$m++;
				if ($m === 1)
				{
					$m = 10;
					$y--;
				}
				else
				{
					$m -= 3;
				}
				return mktime(0, 0, 0, $m, 1, $y);
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
			case '14days': return $now;
			case 'this_week': return $now;
			case 'last_week': return strtotime('last monday') - 1; 
			case 'this_month': return $now;
			case 'last_month':
				$m = intval(date('m'), 10);
				return mktime(0, 0, 0, $m, 1) - 1;
			case 'this_quartal': return $now;
			case 'last_quartal':
				$y = intval(date('y'), 10);
				$m = intval(date('m'), 10) - 1;
				$m -= $m % 4;
				$m++;
				if ($m === 1)
				{
					$m = 10;
					$y--;
				}
				else
				{
					$m -= 3;
				}
				return mktime(23, 59, 59, $m+1, 31, $y);
		}
	}
	
}
