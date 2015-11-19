// BASIC STORE IMPLIMENTATION 

FavoritesStore = {
  _state: {
    favorites: {
    	programs:[],
		scholarships:[
			
		]
    }
  },

  watchers:[],

  onChangeDo:function (f) {
  	this.watchers.push(f);
  },

  getState: function() {
    return this._state;
  },

  addFavorite: function(type, favorite) {
  	this._state.favorites[type].push(favorite);
    this.onChange();
  },

  removeFavorite: function (type, favorite) {
  	this._state.favorites[type] = _.without(this._state.favorites[type], _.findWhere(this._state.favorites[type], favorite)) ;
  	this.onChange();
  },

  containsFavorite: function (type, favorite) {
  	//console.log(_.where(this._state.favorites[type], favorite).length > 0);
  	return _.where(this._state.favorites[type], favorite).length > 0;
  },

  toggleFavorite: function (type, favorite) {
  	if(this.containsFavorite(type, favorite)){
  		this.removeFavorite(type, favorite)
  	}else{
  		this.addFavorite(type, favorite)
  	}
  },

  tryGetStateFromStorage: function () {
  	if(localStorage["FavoritesStore"]){
  		this._state = JSON.parse(localStorage.getItem('FavoritesStore'));
  	}
  },

  onChange: function() {
  	this.watchers.forEach(function(v){v()});
  	localStorage.setItem('FavoritesStore', JSON.stringify(this._state));
  }
};
FavoritesStore.tryGetStateFromStorage();