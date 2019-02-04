import React from "react";

export default class Badge extends React.Component {
	getSize(size){
		//size *= 2;
		if(size <= 64) {
			size = 64;
		} else if(size <= 128) {
			size = 128;
		} else if(size <= 256) {
			size = 256;
		} else {
			size = 512;
		}
		return size;
	}

	render(){
		return(
			<div><img width={this.props.size} src={`https://clash.cloud/asset/image/badge/${this.props.name}/${this.getSize(this.props.size)}.png`}/></div>
		);
	}
}