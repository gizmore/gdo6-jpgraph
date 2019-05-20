<?php
/**
 * @var $gdt \GDO\JPGraph\GDT_GraphSelect
 */
$method = $gdt->graphMethod;
?>
<div class="gdo-jpgraph">
<select onchange="GDO.JPGraph.changeGraph('<?=$gdt->id()?>', this.value)">
  <option value="last_7">7 Tage</option>
  <option value="last_week">Letzte Woche</option>
  <option value="last_month">Letzter Monat</option>
  <option value="this_quart">Dieses Quartal</option>
  <option value="last_quart">Letztes Quartal</option>
</select>
<img <?=$gdt->htmlID()?> src="<?=$gdt->hrefImage()?>" />
</div>
