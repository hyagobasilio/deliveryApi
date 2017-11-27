import { NgModule, ErrorHandler } from '@angular/core';
import { BrowserModule } from '@angular/platform-browser';
import { IonicApp, IonicModule, IonicErrorHandler } from 'ionic-angular';
import { MyApp } from './app.component';


import { ProfilePage } from '../pages/profile/profile';
import { ContactPage } from '../pages/contact/contact';
import { MyCart } from '../pages/my-cart/my-cart';
import { TabsPage } from '../pages/tabs/tabs';
import { ProductListPage } from '../pages/product-list/product-list';
import { ViewProduct } from '../pages/view-product/view-product';
import { CheckoutPage } from '../pages/checkout/checkout';
import { LoginPage } from '../pages/login/login';

import { StatusBar } from '@ionic-native/status-bar';
import { SplashScreen } from '@ionic-native/splash-screen';
import { Http, HttpModule, JsonpModule } from '@angular/http';
import { Validators } from '@angular/forms';

import  { AppHttpService } from '../providers/app-http-service';
import  { AuthProvider } from '../providers/auth-provider';
import  { AuthenticationHttpService } from '../providers/authentication-http-service';
import { IonicStorageModule } from '@ionic/storage';



@NgModule({
  declarations: [
    MyApp,
    ProfilePage,
    ContactPage,
    MyCart,
    ProductListPage,
    ViewProduct,
    CheckoutPage,
    LoginPage,
    TabsPage,
  ],
  imports: [
    BrowserModule,
    HttpModule,
    JsonpModule,
    IonicModule.forRoot(MyApp),
    IonicStorageModule.forRoot({
      name: '__cesta',
         driverOrder: ['indexeddb', 'sqlite', 'websql']
    })
  ],
  bootstrap: [IonicApp],
  entryComponents: [
    MyApp,
    ProfilePage,
    ContactPage,
    MyCart,
    ProductListPage,
    ViewProduct,
    CheckoutPage,
    LoginPage,
    TabsPage,
  ],
  providers: [
    StatusBar,
    SplashScreen,
    Validators,
    AppHttpService,
    AuthProvider,
    {provide: ErrorHandler, useClass: IonicErrorHandler},
    //{provide: Http, useClass: AuthenticationHttpService}
  ]
})
export class AppModule {}
