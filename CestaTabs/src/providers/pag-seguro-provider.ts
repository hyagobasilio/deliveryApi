import { Injectable, ChangeDetectorRef } from '@angular/core';
import { Http, Headers, RequestOptions } from '@angular/http';
import 'rxjs/add/operator/map';
declare var PagSeguroDirectPayment;
/*
  Generated class for the PagSeguroProvider provider.

  See https://angular.io/docs/ts/latest/guide/dependency-injection.html
  for more info on providers and Angular 2 DI.
*/
@Injectable()
export class PagSeguroProvider {
	paymentMethods:Array<any> = [];
	private paymentMethod = 'CREDIT_CARD';
  creditCard = {
      num: '',
      cvv: '',
      monthExp: '',
      yearExp: '',
      brand: '',
      token: ''
  };
  sessionID:any;
  private cart;

  constructor(public http: Http,
  	private ref:ChangeDetectorRef
  	) {
    console.log('Hello PagSeguroProvider Provider');
  }
  pagarComCartaoDeCredito(cart, dadosCartao){
  	this.cart = cart;
  	this.creditCard = dadosCartao;
  	this.getBandeiraDoCartao();
  }

  getSessionId(){
  	 this.http.get('http://cesta.com/api/session')
    .toPromise().then(res => {
      let session = res.json().sessionId
    	this.sessionID = session;
      PagSeguroDirectPayment.setSessionId(session);
      
    }, error => {
    	console.log(error);
    });
  }

  consultarMetodosDePagamentos(valor) {
  	PagSeguroDirectPayment.getPaymentMethods({
      amount: valor,
      success: response => {
        let paymentMethods = response.paymentMethods;
        console.log(paymentMethods);
        this.paymentMethods = Object.keys(paymentMethods).map((k) => paymentMethods[k]);
        this.ref.detectChanges();
      }
    });
  }

  consultarBandeiraDoCartao(numeroCartao){
    PagSeguroDirectPayment.getBrand({
      cardBin: numeroCartao.substring(0,6),
      	success: response => {
        	console.log(response);
          this.creditCard.brand = response.brand.name
          this.ref.detectChanges();
        }
    });
  }
  getBandeiraDoCartao(){
    PagSeguroDirectPayment.getBrand({
      cardBin: this.creditCard.num.substring(0,6),
      	success: response => {
        	console.log(response);
          this.creditCard.brand = response.brand.name
          this.ref.detectChanges();
          this.getCreditCardToken();
        }
    });
  }

  getCreditCardToken(){
    PagSeguroDirectPayment.createCardToken({
      cardNumber: this.creditCard.num,
      brand: this.creditCard.brand,
      cvv: this.creditCard.cvv,
      expirationMonth: this.creditCard.monthExp,
      expirationYear: this.creditCard.yearExp,
      success: response => {
        this.creditCard.token = response.card.token
        this.ref.detectChanges();
        this.sendPayment();
      }
    });
  }

  sendPayment(){
    let headers = new Headers({'Content-Type': 'application/json'});
    let options = new RequestOptions({headers: headers});
    this.http.post('http://cesta.com/api/order', JSON.stringify({
      items: this.cart.itens,
      token: this.creditCard.token,
      hash: PagSeguroDirectPayment.getSenderHash(),
      method: this.paymentMethod,
      total: this.cart.valorTotal
    }),options)
    .toPromise().then(response => console.log(response));
  }

}
