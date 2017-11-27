import { Component } from '@angular/core';
import { NavController, NavParams } from 'ionic-angular';
import { AuthProvider } from '../../providers/auth-provider';
import { ToastController } from 'ionic-angular';
import { FormBuilder, FormGroup } from '@angular/forms';
import {Http, RequestOptions} from "@angular/http";

interface User {
	username?:string;
	password?:string;
}
@Component({
  selector: 'page-login',
  templateUrl: 'login.html',
})
export class LoginPage {

	private loginForm : FormGroup;
	estaAutenticado: boolean;
  email: string;
  senha: string;
  isLogado:boolean;

  constructor(public navCtrl: NavController, public navParams: NavParams,
  	private authProvider: AuthProvider,
  	private toastCtrl: ToastController,
  	fb: FormBuilder,
    private http :  Http) {
  }

  public login () {

    let user = {
      email : this.email, senha: this.senha
    }

    this.authProvider.authenticate(user)
    .then(res => {
      console.log(res)
    	this.navCtrl.parent.select(1);

    },error => {
      console.log('erro login', error)
    }).catch(error => {
    	this.toastCtrl.create({
          message: 'Error ao tentar logar. Tente novamente mais tarde.',
          duration: 3000,
          position: 'bottom'
        })
      .present();
    });
  }
  autenticar() {
    let auth = {
      grant_type: 'password',
      client_id: '2',
      client_secret: 'jEwmgxhGtYcvfpGnFkA3fHiMpV1midnIScypz8Z6',
      username: this.email,
      password: this.senha,
      scope: '',
    };

    this.http.post('http://cesta.com/oauth/token', auth)
    .toPromise()
    .then(res => {
      this.isLogado = true;
      console.log(res);
    }, error => {
      console.log(error);
    }).catch(e => {
      console.log('catch', e);
    })

  }
}
