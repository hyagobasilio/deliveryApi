import { Component } from '@angular/core';
import { NavController, NavParams } from 'ionic-angular';
import { Cart } from '../../providers/cart';
import { PagSeguroProvider } from '../../providers/pag-seguro-provider';
import { CheckoutPage } from '../checkout/checkout';



@Component({
  selector: 'page-my-cart',
  templateUrl: 'my-cart.html',
})
export class MyCart {


  constructor(public navCtrl: NavController, public navParams: NavParams,
   private cart: Cart,
   private pagSeguroProvider:PagSeguroProvider
   ) {
  }

  buy(){
  	this.pagSeguroProvider.consultarMetodosDePagamentos(this.cart.valorTotal);
  	this.navCtrl.push(CheckoutPage);
  }

}
