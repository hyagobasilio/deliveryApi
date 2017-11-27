import {Component, OnInit, ChangeDetectorRef, ViewChild} from '@angular/core';
import {NavController, Segment} from 'ionic-angular';
import {Http, RequestOptions} from "@angular/http";
import { Cart } from '../../providers/cart';
import { PagSeguroProvider } from '../../providers/pag-seguro-provider';

declare var PagSeguroDirectPayment;

@Component({
	selector: 'page-checkout',
  templateUrl: './checkout.html',
})
export class CheckoutPage implements OnInit {

   @ViewChild(Segment)
    segment:Segment;
    
    
    paymentMethod = 'BOLETO';
    creditCard = {
        num: '',
        cvv: '',
        monthExp: '',
        yearExp: '',
        brand: '',
        token: ''
    };

    constructor(private nav:NavController,
                private cart:Cart,
                private ref:ChangeDetectorRef,
                private http: Http,
                private pagSeguroProvider: PagSeguroProvider) {
    }
    numCardChange() {
        if(this.creditCard.num.length >=6) {
            console.log(this.creditCard.num);
            this.pagSeguroProvider.consultarBandeiraDoCartao(this.creditCard.num)
        }
    }

    ngOnInit():any {
        
        //this.segment.ngAfterViewInit();
    }

    paymentCreditCard(){

        this.pagSeguroProvider.pagarComCartaoDeCredito(this.cart, this.creditCard);

    }
}