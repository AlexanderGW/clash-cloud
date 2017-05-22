import React from "react";
import Badge from './Badge';
import League from './League';
import Difference from './Difference';
import Ranking from './Ranking';
import Role from './Role';

export default class ClanProfile extends React.Component {
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
        var url = 'https://localhost/api/clan/' + this.state.tag;
        if(this.state.date)
            url += '/' + this.state.date;
        fetch(url)
            .then(res => res.json())
            .then(content => {
                this.setState({
                    content: content,
                    loading: false
                });
                document.getElementById('loader').style.display = 'none';
            })
    }

    sortByTrophiesDesc(a,b){
        if(a.trophies > b.trophies)
            return -1;
        if(a.trophies < b.trophies)
            return 1;
        return 0;
    }

    sortByDonationsDesc(a,b){
        if(a.donations > b.donations)
            return -1;
        if(a.donations < b.donations)
            return 1;
        return 0;
    }

    sortByDonationsReceivedDesc(a,b){
        if(a.donations_received > b.donations_received)
            return -1;
        if(a.donations_received < b.donations_received)
            return 1;
        return 0;
    }

    render(){
        const {loading, content} = this.state;

        if(loading){
            return null;
        }

        // Sort current members by trophies
        var membersCurrent = [];
        for(var key in content.csmc){
            membersCurrent[key] = content.csmc[key];
        }
        membersCurrent.sort(this.sortByTrophiesDesc);

        // Create members
        const Members = Object.keys(membersCurrent).map((key) => {
            const c = membersCurrent[key];
            const p = ( content.csmp ? content.csmp[c.player_id] : null );
            const ranking = c.ranking;
            const ratio = ( ( c.donations > 0 && c.donations_received > 0 ) ? ( ( c.donations < c.donations_received ? '1:' + Math.round(c.donations_received / c.donations, 10) : Math.round(c.donations / c.donations_received, 10) + ':1' ) ) : 0 );

            return <div key={`c${content.clan.id}p${c.player_id}`} className="row">
                <div className="col">
                    <div>
                        <League state={c.in_league} trophies={c.trophies}/>
                    </div>
                    <div>
                        <a href={`/player/${c.player.tag}`}>
                            <strong>{c.player.name}</strong><br/>
                            <span className="tag">#{c.player.tag}</span>
                        </a>
                        <Role a={c.role} b={p ? p.role : null}/>
                    </div>
                </div>
                <div className="col">
                    {c.trophies}
                    <Difference a={c.trophies} b={p ? p.trophies : null}/>
                </div>
                <div className="col">
                    {c.donations}
                    <Difference a={c.donations} b={p ? p.donations : null}/>
                </div>
                <div className="col">
                    {ratio}
                </div>
                <div className="col">
                    {c.donations_received}
                    <Difference a={c.donations_received} b={p ? p.donations_received : null}/>
                </div>
                <div className="col">
                    <Ranking a={c.ranking} b={p ? p.ranking : null}/>
                </div>
            </div>
        });

        // Clan profile
        return(
            <div className="profile clan">
                <div className="container mt-4">
                    <div className="card text-center">
                        <div className="card-block">
                            <Badge key={content.csc.badge.name} name={content.csc.badge.name}/>
                            <h1 className="card-title">{content.clan.name}</h1>
                            <h6>#{content.clan.tag}</h6>
                            <p className="card-text">{content.csc.description}</p>

                            <div className="container">
                                <div className="row">
                                    <div className="col">Points</div>
                                    <div className="col">State</div>
                                    <div className="col">Level</div>
                                    <div className="col">War wins</div>
                                    <div className="col">Win streak</div>
                                    <div className="col">Ranking</div>
                                </div>
                                <div className="row">
                                    <div className="col">
                                        {content.csc.points}
                                        <Difference a={content.csc.points} b={content.csp ? content.csp.points : null}/>
                                    </div>
                                    <div className="col">
                                        {content.csc.state}
                                    </div>
                                    <div className="col">
                                        {content.csc.level}
                                        <Difference a={content.csc.level} b={content.csp ? content.csp.donations : null}/>
                                    </div>
                                    <div className="col">
                                        {content.csc.war_wins}
                                        <Difference a={content.csc.war_wins} b={content.csp ? content.csp.war_wins : null}/>
                                    </div>
                                    <div className="col">
                                        {content.csc.war_wins_streak}
                                        <Difference a={content.csc.war_wins_streak} b={content.csp ? content.csp.war_wins_streak : null}/>
                                    </div>
                                    <div className="col">
                                        <Ranking a={content.csc.ranking} b={content.csp ? content.csp.ranking : null}/>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div className="card-footer text-muted">
                            {content.csc.updated_at}{content.csp ? (<span> compared to {content.csp.updated_at}</span>) : null}
                        </div>
                    </div>
                </div>
                <div className="container mt-4">
                    <div className="card">
                        <div className="card-header">
                            Members ({membersCurrent.length})
                        </div>
                        <div className="card-block">
                            <div className="container">
                                <div className="row">
                                    <div className="col">Player</div>
                                    <div className="col">Trophies</div>
                                    <div className="col">Donations</div>
                                    <div className="col">Ratio</div>
                                    <div className="col">Received</div>
                                    <div className="col">Ranking</div>
                                </div>
                                {Members}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        );
    }
}