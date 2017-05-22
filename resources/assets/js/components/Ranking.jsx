import React from "react";
import Difference from './Difference';

export default class Ranking extends React.Component {
	render(){
		if(this.props.a == null)
			return null;

		return(
			<div>
				<div><img width="54" src={`https://clash.cloud/asset/image/flag/${this.props.a.location.code}.svg`}/></div>
				<div><span className="rnk">{this.props.a.rank}</span></div>
				<Difference a={this.props.a.rank} b={this.props.b ? this.props.b.rank : null}/>
			</div>
		);
	}
}