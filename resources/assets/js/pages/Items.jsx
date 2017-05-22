import React from "react";
import Item from '../components/Item.jsx';
import * as ItemActions from '../actions/ItemActions.jsx';
import ItemStore from '../store/ItemStore.jsx';

export default class Items extends React.Component {
    constructor(){
        super()
        this.state = {
            items: ItemStore.getAll()
        };
    }

    componentWillMount(){
        ItemStore.on('change', this.getItems.bind(this));
    }

    componentWillUnmount(){
        ItemStore.removeListener('change', this.getItems.bind(this));
    }

    getItems(){
        this.setState({
            items: ItemStore.getAll()
        });
    }

    fetchItems(){
        ItemActions.fetchItems()
    }

    render(){
        const {items} = this.state;
        const ItemComponents = items.map((item) => {
            return <Item key={item.id} text={item.text} {...item}/>
        });

        return(
            <div>
                <button onClick={this.fetchItems.bind(this)}>Fetch</button>
                <h2>Items</h2>
                <ul>{ItemComponents}</ul>
            </div>
        );
    }
}