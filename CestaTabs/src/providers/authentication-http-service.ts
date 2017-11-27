import { Injectable, Inject } from '@angular/core';
import { NavController, LoadingController  } from 'ionic-angular';
import { Request, Response, XHRBackend, RequestOptions, RequestOptionsArgs, Http, Headers } from '@angular/http';
import { Observable } from 'rxjs/Observable';
import 'rxjs/add/operator/catch';
import 'rxjs/add/observable/throw';
import { Storage } from '@ionic/storage';
import { Router } from '@angular/router';
import { LoginPage } from '../pages/login/login';




@Injectable()
export class AuthenticationHttpService extends Http {
  endereco:string = 'http://cesta.com/';
  
  
  constructor (
    backend: XHRBackend,
    defaultOptions: RequestOptions,
    private storage:Storage
  ) {
    super(backend, defaultOptions);
    
    
    let token:any = this.getTokensFromStorage();

    if (token.access_token) {
      this.setAccessToken(token.access_token);
    }
    

  }
  private redirect() {
    
  }

  request(url: string | Request, options:RequestOptionsArgs) : Observable<Response> {

    return super.request(url, options).catch((error: Response) => {
      if (error.status === 401 || error.status === 0) {
        this.refreshToken()
          .then((response) => {
            if (response) {
              let token:any = this.getTokensFromStorage();
              if (token.access_token) {
                this.setAccessToken(token.access_token);
                console.log('Login atualizado, refaça o último passo');
              }
            } else {

              console.log('refazer o login')
              this.redirect();
            }
          });
      }
      return Observable.throw(error);
    });
  }

  protected setAccessToken(token: string) {
    let header = new Headers({'Authorization': 'Bearer ' + token});
    this._defaultOptions.headers = header;
  }

  protected refreshToken() {
    let token:any = this.getTokensFromStorage();
    if (token.refresh_token) {
      let auth = {
        grant_type: 'refresh_token',
        client_id: '2',
        client_secret: 'jEwmgxhGtYcvfpGnFkA3fHiMpV1midnIScypz8Z6',
        refresh_token: token.refresh_token,
        scope: '',
      }

      return this.post('http://www.cesta.com/oauth/token', auth)
        .toPromise()
        .then((res) => {
          let result = res.json() || {};
          this.storeUserCredentials(result);
          return result.refresh_token !== undefined;
        });
    }
    return new Promise((resolve, reject) => {
      return resolve(false);
    });
  }

  protected getTokensFromStorage() {
    return this.storage.get('tokens')
      .then((t)=>{
         return (t)       
      }, error =>{ 
        return {};
      });

  }

  protected storeUserCredentials(token) {
    console.log('guardando Credenciais, refresh', token)
    //localStorage['tokens'] =JSON.stringify(token);
    this.storage.ready().then(res => { 
      this.storage.set('tokens', JSON.stringify(token));
    });
  }
}