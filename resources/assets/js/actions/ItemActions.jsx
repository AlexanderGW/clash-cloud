import ItemStoreDisp from '../ItemStoreDisp.jsx';

export function addItem(text){
    const id = Date.now()
    ItemStoreDisp.dispatch({
        type: 'ADD_ITEM',
        id: id,
        text: text
    });
}

export function remItem(id){
    ItemStoreDisp.dispatch({
        type: 'REM_ITEM',
    });
}

export function fetchItems(){
    fetch('http://localhost/endpoint/?action=items')
        .then(res => res.json())
        .then(res => {
            ItemStoreDisp.dispatch({
                type: 'RECEIVE_ITEMS',
                items: res.items
            });
        })
}