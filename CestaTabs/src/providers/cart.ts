
export class Cart {

	itens: Array<any> = [];
	valorTotal = 0;
	quantidadeDeItens = 0;

	addItem(item) {
		let exist = true;
		for(let i =0 ; i < this.itens.length; i++) {
			if(this.itens[i].id === item.id) {
				console.log('existe', i);
				exist = false;
				//set amount
				this.itens[i].quantidade += Number(item.amount);
				
			}
		}
		if(exist || (this.itens.length == 0)) {
			
			this.itens.push({id: item.id, name: item.name, quantidade: Number(item.amount), price: Number(item.price)})
			
		}
		this.calculateValorTotalAndAmountFinal();
	}

	calculateValorTotalAndAmountFinal(){
		let total = 0;
		let amountFinal =0;
		for (let i =0; i < this.itens.length; i++) {
			total += this.itens[i].price * this.itens[i].quantidade;
			amountFinal += this.itens[i].quantidade;
		}
		this.quantidadeDeItens = amountFinal;
		this.valorTotal = total;
	}

	removeItem(item){
		let position = null;
		for (let i =0; i < this.itens.length; i++) {
			if(this.itens[i].id === item.id) {
				position = i;
			}
		}

		if (position != null) {
			this.itens.splice(position,1);
		}
		this.calculateValorTotalAndAmountFinal();
	}

}
