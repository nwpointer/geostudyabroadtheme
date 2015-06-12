<link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">



<div id="page" class="<?php print $classes; ?>"<?php print $attributes; ?>>

  <!-- ______________________ HEADER _______________________ -->


  <header id="header">
    <?php if (drupal_is_front_page()): ?>
    <div class="hero-slider">
      <?php 
        // $heroimages =array(
        // "http://res.cloudinary.com/uogeostudyabroad/image/upload/v1433884289/GEO_Study_Abroad_UO_w0x7xp.jpg",
        // "http://res.cloudinary.com/uogeostudyabroad/image/upload/v1433884288/GEO_Study_Abroad_seville_vjkzgg.jpg",
        // "http://res.cloudinary.com/uogeostudyabroad/image/upload/v1433884288/GEO_Study_Abroad_ufnjpn.jpg"
        // )
      ?>

      <?php 
        $themeimages = $base_path . drupal_get_path( 'theme', variable_get('theme_default', '0') ) . '/images/';
        $heroimagesfolder = $themeimages . "hero/";
        $num = rand(0,2);
        $heroimages =array(
          "GEO_Study_Abroad_UO_w0x7xp.jpg",
          "GEO_Study_Abroad_seville_vjkzgg.jpg",
          "GEO_Study_Abroad_ufnjpn.jpg"
        );
        $randomImage = $heroimagesfolder . $heroimages[$num];
      ?>

      <?php  $selector = 'background_image' . $num; ?>
          <ul class="rslides">
              <li>
                <?php 
                  // $fid = theme_get_setting($selector);
                  // $image_url = file_create_url(file_load($fid)->uri);
                  // print ("<img src=". $image_url . "></img>");
                  print ("<img src=". $randomImage . "></img>");
                ?>
              </li>
          </ul>
    </div>
    <?php endif; ?>

    <div class="container">

      <?php if ($logo): ?>
        <a href="<?php print $front_page; ?>" title="<?php print t('Home'); ?>" rel="home" id="logo">
          <?php $logo = $themeimages . "GEO_horizontal_White_sv6yqj.png" ?>
          <img src="/sites/all/themes/basic/images/GEO_horizontal_White_sv6yqj.png" alt="Home">
        </a>
      <?php endif; ?>

      <?php if ($site_name || $site_slogan): ?>
        <div id="name-and-slogan">

          <?php if ($site_name): ?>
            <?php if ($title): ?>
              <div id="site-name">
                <a href="<?php print $front_page; ?>" title="<?php print t('Home'); ?>" rel="home"><?php print $site_name; ?></a>
              </div>
            <?php else: /* Use h1 when the content title is empty */ ?>
              <h1 id="site-name">
                <a href="<?php print $front_page; ?>" title="<?php print t('Home'); ?>" rel="home"><?php print $site_name; ?></a>
              </h1>
            <?php endif; ?>
          <?php endif; ?>

          <?php if ($site_slogan): ?>
            <div id="site-slogan"><?php print $site_slogan; ?></div>
          <?php endif; ?>

        </div>
      <?php endif; ?>

      <?php if ($main_menu || $secondary_menu): ?>
        <nav id="navigation" class="menu <?php if (!empty($main_menu)) {print "with-primary";}
          if (!empty($secondary_menu)) {print " with-secondary";} ?>">
            <?php print theme('links', array('links' => $main_menu, 'attributes' => array('id' => 'primary', 'class' => array('links', 'clearfix', 'main-menu')))); ?>
            <?php print theme('links', array('links' => $secondary_menu, 'attributes' => array('id' => 'secondary', 'class' => array('links', 'clearfix', 'sub-menu')))); ?>
        </nav> <!-- /navigation -->
      <?php endif; ?>

       <?php 
      $hamburger = $base_path . drupal_get_path( 'theme', variable_get('theme_default', '0') ) . '/images/hamburger.png';
      print '<img id="menu-toggle" src="'.$hamburger .'" height="23" width="27" alt="">';
    ?>

    <script>
      jQuery("#menu-toggle").click(function(){
      jQuery("#secondary-menu").toggle();});
    </script>

      <?php if ($page['header']): ?>
        <div id="header-region">
          <?php print render($page['header']); ?>
        </div>
      <?php endif; ?>

      <div class="explore">
        <?php if (theme_get_setting('leader_image')): ?>
          <p>
            <?php 
              $fid = theme_get_setting('leader_image');
              $image_url = file_create_url(file_load($fid)->uri);
              //print ("<img src=". $image_url . " id='leaderImage'></img>");
            ?>
          </p>
        <?php endif; ?>
        

        <?php if (theme_get_setting('header_text')): ?>
            <?php print_r(theme_get_setting('header_text')) ?>
        <?php endif; ?>

        <form onsubmit="return explore()">
          <input type="text" placeholder="search">
          <input type="submit" value="submit">
        </form>
      </div>
      
    </div>

  </header> <!-- /header -->

  

  <!-- ______________________ MAIN _______________________ -->

  <div id="main">

    <div id="secondaryBar">
      <div class="container">
        <input type="submit" id="togglesavedProgramDisplay" value="my favorites">
      </div>
    </div>
  
    <div id="savedProgramDisplay">
      <div id="page">
        <ul id="favorites-list">
        </ul>
      </div>
    </div>
    <div class="container">
      <ul id="breadcrumbs" style="margin-bottom: .75rem;">
        <?php 
          $bc = drupal_get_breadcrumb();
          foreach ($bc as $crumb) {
            if ($crumb = '<a href="/">Home</a>'){
              $crumb = '<a href="/"><img src="https://cdn4.iconfinder.com/data/icons/pictype-free-vector-icons/16/home-128.png" alt=""></a>';
            }
            print("<li><span>". $crumb . "</span></li>");
          }
          if(isset($node)){
            if(isset($node->field_country)){
              print "<li><span><a href='/programs'>programs</a></span></li>";
              $country = $node->field_country['und'][0]['taxonomy_term']->name ;
              print "<li><span><a href='/programs/search/". $country ."'>". $country . "</a></span></li>"; 
            }
            else{
            print("<li><span><a>". drupal_get_title() . "</a></span></li>");
          }
          }
          else{
            print("<li><span><a>". drupal_get_title() . "</a></span></li>");
          }
        ?>
      </ul> 
      <?php if ($title): ?>
        <h1 class="title"><?php print $title; ?></h1>
      <?php endif; ?>
      <?php if ($page['precontent']): ?>
        <aside id="precontent">
          <?php print render($page['precontent']); ?>
        </aside>
      <?php endif; ?> <!-- /precontent -->
    </div>
    <div class="container">
      <section id="content">
  
          <?php if ( $messages || $tabs || $action_links): ?>
            <div id="content-header">

              <?php if ($page['highlighted']): ?>
                <div id="highlighted"><?php print render($page['highlighted']) ?></div>
              <?php endif; ?>

              <?php print render($title_prefix); ?>

              <?php print render($title_suffix); ?>
              <?php print $messages; ?>
              <?php print render($page['help']); ?>

              <?php if ($tabs): ?>
                <div class="tabs"><?php print render($tabs); ?></div>
              <?php endif; ?>

              <?php if ($action_links): ?>
                <ul class="action-links"><?php print render($action_links); ?></ul>
              <?php endif; ?>

            </div> <!-- /#content-header -->
          <?php endif; ?>

          <div id="content-area">
            <?php print render($page['content']) ?>
          </div>

          <?php print $feed_icons; ?>

      </section> <!-- /content-inner /content -->

      <?php if ($page['sidebar_first']): ?>
        <aside id="sidebar-first" class="column sidebar first">
          <?php print render($page['sidebar_first']); ?>
        </aside>
      <?php endif; ?> <!-- /sidebar-first -->

      <?php if ($page['sidebar_second']): ?>
        <aside id="sidebar-second" class="column sidebar second">
        <div id="favorite-toggle" style="width:100%"></div>
          <?php print render($page['sidebar_second']); ?>
        </aside>
      <?php endif; ?> <!-- /sidebar-second -->
    </div>
  </div> <!-- /main -->

  <!-- ______________________ FOOTER _______________________ -->

  <?php if ($page['footer']): ?>
    <footer id="footer">
      <div class="container">
      <?php print render($page['footer']); ?>
      </div>
    </footer> <!-- /footer -->
  <?php endif; ?>

</div> <!-- /page -->

<script>
        jQuery("#togglesavedProgramDisplay").click(function(){
          jQuery("#savedProgramDisplay").slideToggle(100);
        });
        var persistantList = Ractive.extend({
          partials: {item: "<li><a href='{{link}}'>{{title}}</a> <a class='remove' on-click='remove(i)'>x</a></li>"},
           data: function(){
              return this.reference();
          },
          lifespan: 7,
          key: 'programFavoritesList',
          save: function(){
              this.setCookie(this.key, JSON.stringify(this.get()), this.lifespan);
          },
          reference: function(){
              var favorites = this.getCookie(this.key);
              try{
                  favorites = JSON.parse(favorites)
              }
              catch(err){
                  console.log("favorites is empty or broken: " + err);
                  favorites = {includesThisPage: false, favorites: []};
              }
              return favorites;
          },
          setCookie: function(cname, cvalue, exdays) {
              var d = new Date();
              d.setTime(d.getTime() + (exdays*24*60*60*1000));
              var expires = "expires="+d.toUTCString();
              document.cookie = cname + "=" + cvalue + "; " + expires + "; " + "path=/";
          },

          getCookie: function(cname) {
              var name = cname + "=";
              var ca = document.cookie.split(';');
              for(var i=0; i<ca.length; i++) {
                  var c = ca[i];
                  while (c.charAt(0)==' ') c = c.substring(1);
                  if (c.indexOf(name) == 0) return c.substring(name.length,c.length);
              }
              return "";
          }
      });

      favoritesList = new persistantList({
          el: '#favorites-list',
          template : "<h4>Favorite programs</h4>{{#each favorites: i}}{{>item}}{{/each}}",
          add: function(fav){
              this.get("favorites").push(fav);
              this.toggle('includesThisPage');
              this.save();
          },
          remove: function(fav){
              i = typeof(fav) == "object" ? this.findFavorite(fav) : fav;
              _.isEqual(this.get('favorites')[i],this.pageToFavorite()) && this.toggle('includesThisPage');
              this.splice('favorites', i, 1);
              this.save();
          },
          findFavorite: function(searchValue){
              var index = NaN;
              var searchSpace = this.get("favorites");
              _.each(searchSpace, function(data, idx) { 
                 if (_.isEqual(data, searchValue)) {
                    index = idx;
                    return;
                 }
              });
              return index;
          },
          pageToFavorite: function(){
              item = {title: document.getElementsByClassName("title")[0].innerHTML, link: window.location.href};
              return item; 
          },
          activateToggle: function() {
              this.get("includesThisPage") ? this.remove(this.pageToFavorite()) : this.add(this.pageToFavorite());
          },
          onrender: function(){
            included = this.findFavorite(this.pageToFavorite());
            this.set('includesThisPage', !isNaN(included));
          }
      });

      favoritesList.observe( 'includesThisPage', function ( newValue, oldValue, keypath ) {
          window.dispatchEvent((new CustomEvent('change:favoritesList.includesThisPage', {'detail': newValue})));
      });

      toggler = new Ractive({
          el:'#favorite-toggle',
          template: '<button on-click="activateToggle()" class="lg included-{{state}}">favorite {{#if state}}<i class="fa fa-star fa-lg"></i>{{else}}<i class="fa fa-star-o fa-lg"></i>{{/if}} </button>',
          data : {state: favoritesList.get('includesThisPage')},
          activateToggle: function() {
              favoritesList.activateToggle();
          }
      });

      window.addEventListener('change:favoritesList.includesThisPage',function(e){
          toggler.set('state', e.detail);
      });
      </script>
