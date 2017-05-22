import React from "react";
import { BrowserRouter, Route, Link } from 'react-router-dom';
import Header from "./Header.jsx";
import ClanProfile from "./ClanProfile.jsx";
import PlayerProfile from "./PlayerProfile.jsx";

const Main = (props) => (
    <main {...props}/>
)

export default class App extends React.Component {
    constructor(){
        super();
        this.state = {
            loading: true
        }
    }

    // Check Supercell uptime
    //componentDidMount(){
        /*fetch('https://api.github.com/gists')
         .then(res => res.json())
         .then(gists => {
         this.setState({gists})
         })*/
    //}

    componentDidMount(){
        document.getElementById('loader').style.display = 'none';
        this.setState({loading: false});
    }

    render(){
        const {loading} = this.state;

        if(loading){
            return null;
        }
        return(
            <BrowserRouter>
                <Main>
                    <Header/>
                    <Route path="/" exact={true} render={() => (
                        <div>
                            <h1>Welcome to Clash Cloud!</h1>
                            <Link to="./clan/A123">Clan</Link><br/>
                            <Link to="./clan/A123/2017-05-17">Clan with date</Link>
                        </div>
                    )}/>
                    <Route path="/clan/:tag/:date" exact={true} render={({match}) => (
                        <ClanProfile key={match.params.tag} {...match.params}/>
                    )}/>
                    <Route path="/clan/:tag" exact={true} render={({match}) => (
                        <ClanProfile key={match.params.tag} {...match.params}/>
                    )}/>
                    <Route path="/player/:tag/:date" exact={true} render={({match}) => (
                        <PlayerProfile key={match.params.tag} {...match.params}/>
                    )}/>
                    <Route path="/player/:tag" exact={true} render={({match}) => (
                        <PlayerProfile key={match.params.tag} {...match.params}/>
                    )}/>
                </Main>
            </BrowserRouter>
        )
    }
}