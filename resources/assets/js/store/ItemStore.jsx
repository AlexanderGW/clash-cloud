import EventEmitter from 'events';
import ItemStoreDisp from '../ItemStoreDisp.jsx';

class ItemStore extends EventEmitter {
    constructor(){
        super()
        this.items = [
            {
                id: 1233412,
                text: 'First',
                state: 0
            },
            {
                id: 3463221,
                text: 'Second',
                state: 1
            },
        ];
    }

    addItem(data){
        this.items.push({
            id: data.id,
            text: data.text,
            state: 0
        });

        this.emit('change');
    }

    updateItem(data){
        const item = (this.items.find(item => item.id === data.id ));
        if( item )
            this.items[item.id] = data;

        this.emit('change');
    }

    getAll(){
        return this.items;
    }

    handleActions(action){
        switch(action.type){
            case 'ADD_ITEM':
                this.addItem(action.text);
                break;
            case 'RECEIVE_ITEMS':
                Object.keys(action.items).map((key) => {
                    if( this.items.find(item => item.id === action.items[key].id ) == null )
                        this.addItem(action.items[key]);
                    else
                        this.updateItem(action.items[key]);
                })
                break;
        }
    }
}

const itemStore = new ItemStore;

ItemStoreDisp.register(itemStore.handleActions.bind(itemStore))
export default itemStore;