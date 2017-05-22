import React from "react";

export default class Item extends React.Component {
    render(){
        return(
            <li className="item" id={this.props.id}>{this.props.text}</li>
        )
    }
}