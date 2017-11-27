import { Component } from '@angular/core';
import { NavController, NavParams } from 'ionic-angular';
import { ViewChild } from '@angular/core';
import { FormBuilder, Validators } from '@angular/forms';
import { Slides } from 'ionic-angular';
import { ToastController } from 'ionic-angular';
import { Cart } from '../../providers/cart';



@Component({
  selector: 'page-view-product',
  templateUrl: 'view-product.html',
})
export class ViewProduct {

	@ViewChild(Slides) slides: Slides;
	private cadastro:any = {};
	private product:Object;
	
  constructor(public navCtrl: NavController, 
    public navParams: NavParams, 
  	private cart: Cart, 
    private formBuilder: FormBuilder, 
    private validators: Validators,
    private toastCtrl: ToastController
    ) {
  	this.cadastro = this.formBuilder.group({
  		amount: ['', Validators.compose([Validators.required, Validators.minLength(1)])]
  	});
  	this.product = this.navParams.get('product');
  }

  addItem() {
    if (!(Number(this.cadastro.value.amount) > 0)) {
      this.toastCtrl.create({
          message: 'Insira uma quantidade válida',
          duration: 3000,
          position: 'top'
        })
      .present();
    } else {
      this.product["amount"] = Number(this.cadastro.value.amount);
      this.cart.addItem(this.product);
      this.navCtrl.parent.select(1);
    }
  	
  }

}
