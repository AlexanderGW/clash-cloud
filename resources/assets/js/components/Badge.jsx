import React from "react";

export default class Badge extends React.Component {
	render(){
		return(
			<div><img src={`https://clash.cloud/asset/image/badge/${this.props.name}/128.png`}/></div>
		);
	}
}