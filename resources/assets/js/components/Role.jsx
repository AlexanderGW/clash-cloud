import React from "react";

export default class Ranking extends React.Component {
	render(){
		if(!this.props.a == null || this.props.a == 'M')
			return null;

		return(
			<div className={`rl ${this.props.a.toLowerCase()}`}>
				{this.props.b == null ? 'New' : ( this.props.a == 'E' ? 'Elder' : ( this.props.a == 'C' ? 'Coleader' : 'Leader' ) )}
			</div>
		);
	}
}