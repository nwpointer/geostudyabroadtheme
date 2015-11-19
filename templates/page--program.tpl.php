<link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
<link href='https://fonts.googleapis.com/css?family=Open+Sans:700italic,400,700,600' rel='stylesheet' type='text/css'>
<div id="page" class="<?php print $classes; ?>"<?php print $attributes; ?>>

<!-- test -->

  <!-- ______________________ HEADER _______________________ -->

<?php if($node->field_header_background["und"]): ?>
      <?php 
      $backgroundsrc = $node->field_header_background["und"][0]['uri'];
      ?>
  
  <header id="header" style="background: url(<?php echo("'". file_create_url($backgroundsrc) . "'"); ?>);background-position: center center;background-size:cover;">

    <div class="container">
      <?php $themeimages = $base_path . drupal_get_path( 'theme', variable_get('theme_default', '0') ) . '/images/'; ?>
      
      
      <?php if ($logo): ?>
        <a href="<?php print $front_page; ?>" title="<?php print t('Home'); ?>" rel="home" id="logo" class="geologo">
          <?php $geologo = $themeimages . "GEO_horizontal_White_sv6yqj.png" ?>
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
        <form onsubmit="return explore()">
          <input type="text" placeholder="search">
          <input  type="submit">
        </form>
        <script>
          jQuery(function(){
            var $ = jQuery;
            
          });
        </script>
      </div>
      
    </div>
    <?php
      print_r("<img id='headerbacking' src='" . file_create_url($backgroundsrc) . "'>" );
      ?>
    <?php endif; ?>

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
        <div id="favorites-list">
        </div>
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
            // print("<li><span><a>". drupal_get_title() . "</a></span></li>");
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
              <button onClick={rm.bind(this, type, fav)}>x</button>
            </li>
          )
        }) : 'no ' +  type + ' added';

        return(
          <div>
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
      return(<button onClick={this.toggle}>favorite this active: {this.state.active ? "true" : "false"} </button>)
    }
  })
</script>

<script type="text/jsx">
    // RENDER REACT COMPONENTS

    React.render(
      <Favoriter type="programs" title={jQuery(".title").text()} link={window.location.toLocaleString()}/>,
      document.getElementById('favorite-toggle')
    )

    React.render(
      <Favorites />,
      document.getElementById('favorites-list')
    )

    // TOGGLE FAVLIST COMPONENT

    jQuery("#togglesavedProgramDisplay").click(function(){
      jQuery("#savedProgramDisplay").slideToggle(100);
    });
</script>


