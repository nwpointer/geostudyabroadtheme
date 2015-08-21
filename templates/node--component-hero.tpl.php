<?php 
  $node = node_load($nid);
  // required fields
  $header = render($content['field_header']);
  $body = render($content['body']);
  $background = file_create_url(field_get_items('node', $node, 'field_hero_background')[0]["uri"]);

?>



<article 
  class="<?php print $classes; ?>" 
  data-nid="<?php print $node->nid; ?>" 
  style="<?php print "background:url($background); height: 300px;background-position: center bottom;
    background-size: 100%;";  ?>">
  <div class="container">
    <div class="content">
      <?php
        print("
          <p>
            $body
          </p>
        ");
       ?>
    </div> <!-- /content -->
  </div>
</article> <!-- /article #node -->