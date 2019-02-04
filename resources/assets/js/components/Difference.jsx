import React from "react";

export default class Difference extends React.Component {
	getClass(){
		var value = 'chng';
		if(this.props.a < this.props.b)
			value += ' lt';
		return value;
	}

	render(){
		if((this.props.vary == false && this.props.a < this.props.b) || (this.props.a == null || this.props.b == null) || this.props.a == this.props.b)
		if((this.props.vary == false && this.props.a < this.props.b) || (this.props.a == null || this.props.b == null) || this.props.a == this.props.b)
			return null;

		return(
			<div className={this.getClass()}>{Math.abs(this.props.a - this.props.b)}</div>
		);
	}
}