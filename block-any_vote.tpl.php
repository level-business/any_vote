<?php 
// TODO: explain blurb

?>
<div id="block-<?php print $block->module .'-'. $block->delta; ?>" class="block block-<?php print $block->module; print ' '; print $block->extra_classes?>">

<?php if ($block->subject): ?>
  <h2><?php print $block->subject ?></h2>
<?php endif;?>
  <div class="score"><?php print $block->text_score ?></div>
  <div class="content"><?php print $block->content ?></div>
  <div class="question"><?php print $block->question ?></div>
  <div class="widget"><?php print $block->widget ?></div>
  
</div>