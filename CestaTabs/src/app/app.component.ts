import { Component } from '@angular/core';
import { Platform } from 'ionic-angular';
import { StatusBar } from '@ionic-native/status-bar';
import { SplashScreen } from '@ionic-native/splash-screen';

import { TabsPage } from '../pages/tabs/tabs';
import { Cart } from '../providers/cart';
import { Http } from '@angular/http';
import { PagSeguroProvider } from '../providers/pag-seguro-provider';

import 'rxjs/add/operator/toPromise';
declare var PagSeguroDirectPayment;
@Component({
  templateUrl: 'app.html',
  providers: [PagSeguroProvider, Cart]
})
export class MyApp {
  rootPage:any = TabsPage;

  constructor(platform: Platform,
    splashScreen: SplashScreen, 
    public http: Http,
    statusBar: StatusBar,
    private pagSeguroProvider:PagSeguroProvider
    ) {
    platform.ready().then(() => {
      // Okay, so the platform is ready and our plugins are available.
      // Here you can do any higher level native things you might need.
      statusBar.styleDefault();
      splashScreen.hide();
      this.pagSeguroProvider.getSessionId();
    });
  }
}
