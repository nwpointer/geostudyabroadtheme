<link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
<link href='https://fonts.googleapis.com/css?family=Open+Sans:700italic,400,700,600' rel='stylesheet' type='text/css'>


<div id="page" class="<?php print $classes; ?>"<?php print $attributes; ?>>

  <!-- ______________________ HEADER _______________________ -->


  <header id="header">
    <?php if (drupal_is_front_page()): ?>
    <div class="hero-slider">
          <ul class="rslides">
              <li>
                <?php
                  $node_type = "home_page_background_"; // can find this on the node type's "edit" screen in the Drupal admin section.

                  $nodes = node_load_multiple(array(), array('type' => $node_type));
                  // array_shift(array_values($nodes)); 
                  $num = rand(0,sizeof($nodes)-1);

                  $i = 0;
                  foreach($nodes as $key => $value){
                      if($i == $num){
                         echo theme('image', array(
                           'path' => file_create_url($value->field_homebk['und'][0]["uri"]),
                         ));  
                         break; #Exit blucle 
                      }
                      $i++;
                  }
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
  ;(function($) {

  $.fn.unveil = function(threshold, callback) {

    var $w = $(window),
        th = threshold || 0,
        retina = window.devicePixelRatio > 1,
        attrib = retina? "data-src-retina" : "data-src",
        images = this,
        loaded;

    this.one("unveil", function() {
      var source = this.getAttribute(attrib);
      source = source || this.getAttribute("data-src");
      if (source) {
        this.setAttribute("src", source);
        if (typeof callback === "function") callback.call(this);
      }
    });

    function unveil() {
      var inview = images.filter(function() {
        var $e = $(this);
        if ($e.is(":hidden")) return;

        var wt = $w.scrollTop(),
            wb = wt + $w.height(),
            et = $e.offset().top,
            eb = et + $e.height();

        return eb >= wt - th && et <= wb + th;
      });

      loaded = inview.trigger("unveil");
      images = images.not(loaded);
    }

    $w.on("scroll.unveil resize.unveil lookup.unveil", unveil);

    unveil();

    return this;

  };

})(window.jQuery || window.Zepto);


jQuery(document).ready(function() {
  jQuery("img").unveil();
  
  function meow(){
    jQuery("img").unveil();
    console.log('hi');
  }

  setTimeout(meow, 3000);

});

</script>

<script type="text/jsx">
// REACT COMPONENTS

watchFavorites = {
  componentDidMount: function() {
      FavoritesStore.onChangeDo(this.onChange);
  },
  getInitialState: function() {
      return this.getStateFromStore();
  },
  onChange: function() {
      this.setState(this.getStateFromStore());
  },
}

Favorites = React.createClass({
  mixins: [watchFavorites],
  getStateFromStore: function() {
      return FavoritesStore.getState();
  },
  
  render:function () {
    favorites = this.state.favorites;
    rm = function (t,f) {
      FavoritesStore.removeFavorite(t,f);
    }
    lists = Object.keys(this.state.favorites).map(function(type){
      list = favorites[type].length > 0 ? favorites[type].map(function (fav) {
        return(
          <li>
            <a href={fav.link} >{fav.title}</a>
            <a onClick={rm.bind(this, type, fav)}>
              <i className="fa fa-times-circle"></i>
            </a>
          </li>
        )
      }) :  (<li>no {type} added</li>);

      return(
        <div id="list">
          <h4>{type}</h4>
          <ul>
            {list}
          </ul>
        </div>
      )   
    })

    return(
      <div>{lists}</div>
    )
  }
})

Favoriter = React.createClass({
  mixins: [watchFavorites],
  getStateFromStore: function() {
      return {active: FavoritesStore.containsFavorite(this.props.type, {title: this.props.title, link: this.props.link})};
  },
  toggle: function () {
    FavoritesStore.toggleFavorite(this.props.type, {title: this.props.title, link: this.props.link});
  },
  render:function () {
    return(
      <button onClick={this.toggle} className="lg included-{state}">
        favorite <i className={this.state.active ? 'fa fa-star fa-lg' : 'fa fa-star-o fa-lg'} />  
      </button>
    )
  }
})
</script>

<script type="text/jsx">
    // RENDER REACT COMPONENTS

    if(document.getElementById('favorite-toggle')){
      React.render(
        <Favoriter type="programs" title={jQuery(".title").text()} link={window.location.toLocaleString()}/>,
        document.getElementById('favorite-toggle')
      )
    }

    if(document.getElementById('favorites-list')){
      React.render(
        <Favorites />,
        document.getElementById('favorites-list')
      )
    }

    // TOGGLE FAVLIST COMPONENT

    jQuery("#togglesavedProgramDisplay").click(function(){
      jQuery("#savedProgramDisplay").slideToggle(100);
    });
</script>



