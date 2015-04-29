
        var persistantList = Ractive.extend({
          partials: {item: "<li><a href='{{link}}'>{{title}}</a> <a on-click='remove(i)'>x</a></li>"},
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
          template : "{{#each favorites: i}}{{>item}}{{/each}}",
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
              item = {title: "Arg", link: window.location.href};
              return item;
          },
          activateToggle: function() {
              this.get("includesThisPage") ? this.remove(this.pageToFavorite()) : this.add(this.pageToFavorite());
          }
      });

      favoritesList.observe( 'includesThisPage', function ( newValue, oldValue, keypath ) {
          window.dispatchEvent((new CustomEvent('change:favoritesList.includesThisPage', {'detail': newValue})));
      });

      toggler = new Ractive({
          el:'#favorite-toggle',
          template: '<button on-click="activateToggle()" class="included-{{state}}">saved: {{state}} </button>',
          data : {state: favoritesList.get('includesThisPage')},
          activateToggle: function() {
              favoritesList.activateToggle();
          }
      });

      window.addEventListener('change:favoritesList.includesThisPage',function(e){
          toggler.set('state', e.detail);
      });