import React from "react";

export default class Header extends React.Component {
    render() {
        return (
            <nav className="top-nav">
                <div className="container">
                    <div className="row">
                        <a className="brand" href="/">Clash-cloud</a>
                    </div>
                </div>
            </nav>
        );
    }
}