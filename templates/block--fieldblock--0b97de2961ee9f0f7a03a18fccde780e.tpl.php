<div id="block-<?php print $block->module .'-'. $block->delta ?>" class="<?php print $classes; ?> clearfix"<?php print $attributes; ?>>
  <div class="block-inner">

    <?php print render($title_prefix); ?>
    <?php if ($block->subject): ?>
      <h2 class="block-title"<?php print $title_attributes; ?>></h2>
    <?php endif;?>
    <?php print render($title_suffix); ?>


    <div class="content" <?php print $content_attributes; ?>>
    	<?php $link = strip_tags($content); ?>
      <?php print("<a class='button' href='" . $link . "'>". $block->subject ."</a>" ); ?>
    </div>

  </div>
</div> <!-- /block-inner /block -->