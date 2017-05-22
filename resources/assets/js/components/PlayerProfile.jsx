import React from "react";
import Badge from './Badge';
import League from './League';
import Difference from './Difference';
import Ranking from './Ranking';
import Role from './Role';

export default class PlayerProfile extends React.Component {
	constructor(props){
		super(props);
		this.state = {
			tag: props.tag,
			date: props.date,
			content: null,
			loading: true
		};
		document.getElementById('loader').style.display = 'block';
	}

	componentDidMount(){
		this.getContent()
	}

	componentWillReceiveProps(newProps){
		if( this.props.tag !== newProps.tag ){
			this.setState({
				tag: newProps.tag,
				date: newProps.date,
				content: null
			});
			this.getContent()
		}
	}

	getContent(){
		var url = 'https://localhost/api/player/' + this.state.tag;
		if(this.state.date)
			url += '/' + this.state.date;
		fetch(url)
			.then(res => res.json())
			.then(content => {
				this.setState({
					content: content,
					loading: false
				});
				document.getElementById('loader').style.display = 'none'
			})
	}

	render(){
		const {loading, content} = this.state

		if(loading){
			return null
		}

		var hasMembership = (content.membership != null)
		var hasRanking = (content.rank != null)

		var freshest;
		if(hasMembership && hasRanking){
			if(Date.parse(content.membership.snapshot.updated_at) >= Date.parse(content.rank.updated_at)){
				freshest = 'M'
			}else{
				freshest = 'R'
			}
		} else if(hasMembership){
			freshest = 'M'
		} else {
			freshest = 'R'
		}

		/*CAN SNAPSHOT NEEDS TO BE GRABBED FOR RANK RESULTS*/

		var clan = ( freshest == 'M' ? content.membership.snapshot.clan : ( ( hasRanking && content.rank.snapshot != null ) ? content.rank.snapshot.clan : null ) )
		var player = ( freshest == 'M' ? content.membership : content.rank )
		var badge = ( clan ? ( freshest == 'M' ? content.membership.snapshot.badge : ( hasRanking ? content.rank.snapshot.badge : null ) ) : null )
console.log(content.membership.snapshot.clan);
		// Player profile
		return(
			<div className="profile player">
				<div className="container mt-4">
					<div className="card text-center">
						<div className="card-block">
							<League state={player.in_league} trophies={player.trophies}/>
							<h1 className="card-title">{content.player.name}</h1>
							<h5>#{content.player.tag}</h5>
							<p className="card-text"></p>

							{clan ? (<div><Badge key={badge.name} name={badge.name}/>
								<h4>{clan.name}</h4>
								<h6>#{clan.tag}</h6></div>) : null}

							<div className="container">
								<div className="row">
									{hasRanking ? (<div className="col">Ranking</div>) : ''}
								</div>
								<div className="row">
								{hasRanking ? (<div className="col"><Ranking a={content.rank}/></div>) : ''}
								</div>
							</div>
						</div>
						<div className="card-footer text-muted">
							{freshest == 'M' ? content.membership.snapshot.updated_at : content.rank.updated_at}
						</div>
					</div>
				</div>
			</div>
		);
	}
}