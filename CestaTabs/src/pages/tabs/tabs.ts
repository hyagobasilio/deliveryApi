import { Component } from '@angular/core';


import { ContactPage } from '../contact/contact';
import { MyCart } from '../my-cart/my-cart';
import { ProductListPage } from '../product-list/product-list';
import { ProfilePage } from '../profile/profile';
import { LoginPage } from '../login/login';
import { Cart } from '../../providers/cart';

@Component({
  templateUrl: 'tabs.html'
})
export class TabsPage {

  tab1Root = ProductListPage;
  tab2Root = MyCart;
  tab3Root = ContactPage;
  tab4Root = ProfilePage;
  tab5Root = LoginPage;

  constructor(private cart: Cart) {

  }
}
