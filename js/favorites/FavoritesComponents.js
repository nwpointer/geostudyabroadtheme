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