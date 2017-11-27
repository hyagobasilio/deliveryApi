import { Component, OnInit } from '@angular/core';
import { NavController } from 'ionic-angular';
import { AppHttpService } from '../../providers/app-http-service';
import { AuthProvider } from '../../providers/auth-provider';
import { LoginPage } from '../login/login';
@Component({
  selector: 'page-profile',
  templateUrl: 'profile.html' 
})
export class ProfilePage implements OnInit {

	produtos:Array<any>= [];

  constructor(public navCtrl: NavController,
    private httpService: AppHttpService
    ) {

  }


  ngOnInit() {

    	this.httpService.builder('productsafe')
    	.list()
      .then(res => {
        console.log('perfil page',res)
    		this.produtos = res;
        console.log(this.produtos);
    	});
    
  }

}
