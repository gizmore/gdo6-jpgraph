<?php
use GDO\JPGraph\GDT_GraphDateselect;

/**
 * @var $gdt \GDO\JPGraph\GDT_GraphSelect
 */
$method = $gdt->graphMethod;
?>
<form <?=$gdt->htmlID()?> class="gdt-graph-select">
  <div class="gdo-jpgraph">
    <div class="gdo-jpgraph-selection">
      <?php echo GDT_GraphDateselect::make('date')->withToday(false)->withYesterday(false)->initial('7days')->render(); ?>
      <input type="date" name="start" />
      <input type="date" name="end" />
    </div>
    <img src="<?=$gdt->hrefImage()?>" />
  </div>
</form>
