class Spacer
{
    static get toolbox() {
        return {
            title: 'Spacer',
            icon: '<svg width="19" height="4" viewBox="0 0 19 4" xmlns="http://www.w3.org/2000/svg"><path d="M1.25 0H7a1.25 1.25 0 1 1 0 2.5H1.25a1.25 1.25 0 1 1 0-2.5zM11 0h5.75a1.25 1.25 0 0 1 0 2.5H11A1.25 1.25 0 0 1 11 0z"/></svg>'
        };
    }

    constructor({data, config, api}) {
        this.api = api;
        
        this._CSS = {
            block: this.api.styles.block,
            wrapper: 'ce-spacer'
        }
    }

    render(){
        let div = document.createElement('div');
        div.classList.add(this._CSS.wrapper, this._CSS.block);
        return div;
    }

    save(blockContent){
        return {
        }
    }
}