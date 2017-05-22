import React from "react";

export default class LoadFile extends React.Component {
    constructor(props){
        super(props);
        this.state = {
            url: props.url,
            content: null
        };
    }

    componentDidMount(){
        this.getContent()
    }

    componentWillReceiveProps(newProps){
        if( this.props.url !== newProps.url ){
            this.setState({
                url: newProps.url,
                content: null
            });
            this.getContent()
        }
    }

    getContent(){
        fetch(this.props.url)
            .then(res => res.text())
            .then(content => {
                this.setState({content});
            })
    }
    render(){
        return(
            <pre>{this.state.content || 'Loading...'}</pre>
        )
    }
}