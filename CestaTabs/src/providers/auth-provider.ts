import {Http, Headers} from '@angular/http';
import  {AppHttpService } from './app-http-service';
import { Observable } from 'rxjs/Observable';
import {Injectable, Inject} from '@angular/core';
import { Storage } from '@ionic/storage';

@Injectable()
export class AuthProvider {


  private url : string = 'http://cesta.com/';

  private auth = {
      grant_type: 'password',
      client_id: '2',
      client_secret: 'jEwmgxhGtYcvfpGnFkA3fHiMpV1midnIScypz8Z6',
      username: '',
      password: '',
      scope: '',
    };

  isLoggedin: boolean = false;
  AuthToken;

  constructor(public http: Http,
    private storage:Storage
    ) {
      this.http = http;
      this.isLoggedin = false;
      this.AuthToken = null;
  }
  login(email:string, senha:string){
  	let user = {
  		email : email, senha: senha
  	}
  	return this.authenticate(user);
	}

  setAccessToken (token: string) {
  //  this.appHttpService.setAccessToken(token);
  }

  storeUserCredentials(token) {
    console.log('guardando Credenciais', token)
    //localStorage['tokens'] =JSON.stringify(token);
    this.storage.ready().then(res => {
      this.storage.set('tokens', JSON.stringify(token));
    });
  }
  getTokensFromStorage() {
    return this.storage.get('tokens')
      .then((t)=>{
         return (t)
      }, error =>{
        return {};
      });

  }

  destroyUserCredentials() {
      this.isLoggedin = false;
      window.localStorage.clear();
  }

  authenticate(user) {
    this.auth.username = user.email;
		this.auth.password = user.senha;
      return new Promise(resolve => {
        this.http.post(this.url+'oauth/token', this.auth)
        	.subscribe(data => {
            let res = data.json() || {};
            if(res.access_token !== undefined){
          		this.setAccessToken(res.access_token);
              this.storeUserCredentials(res);
              this.isLoggedin = true;
              resolve(true);
            }
            else {
              resolve(false);
            }
        });
      });
  }
  /*
  refresh() {
    this.storage.ready().then(() => {
      this.storage.get('tokens')
      .then((t)=>{
        t= t.json();
        let auth = {
          grant_type: 'refresh_token',
          client_id: '2',
          client_secret: 'R8u3pIAN6kDgiNrymKa5rhPiAoaC3g0pX0UZL4Az',
          refresh_token: t.refresh_token,
          scope: '',
        }
        return new Promise(resolve => {
          this.http.post(this.url+'oauth/token', auth)
            .subscribe(data => {
              let res = data.json() || {};
              if(res.access_token !== undefined){
                this.setAccessToken(res.access_token);
                this.storeUserCredentials(res);
                this.isLoggedin = true;
                resolve(res);
              }
              else {
                resolve({});
              }
          });
        });
      }, error =>{
        return {};
      });
    });
  }*/
  adduser(user) {
    return new Promise(resolve => {
        this.http.post(this.url+'user', user).subscribe(data => {
            if(data.json().success){
                resolve(true);
            }
            else
                resolve(false);
        });
    });
  }

  logout() {
      this.destroyUserCredentials();
  }

  getTokenFromStorage() {

    return this.storage.ready().then(() => {
      this.storage.get('tokens')
      .then((t)=>{
        return JSON.parse(t);
      }, error =>{
        return {};
      });
    });
  }

  /*refreshToken() {
    //let token = localStorage['tokens'] ? JSON.parse(localStorage['tokens']) : {};
     return this.getTokenFromStorage()
     .then((token:any) => {
       console.log('refresh token', token)
      if (token.refresh_token) {
        let auth = {
          grant_type: 'refresh_token',
          client_id: '2',
          client_secret: 'jEwmgxhGtYcvfpGnFkA3fHiMpV1midnIScypz8Z6',
          refresh_token: token.refresh_token,
          scope: '',
        }

        return this.http.post(this.url+'oauth/token', auth)
          .toPromise()
          .then((res) => {
            let result = res.json() || {};
            this.storeUserCredentials(result);
            this.isLoggedin = true;
            return result.refresh_token !== undefined;
          });
      }
     }).catch(e => {
       console.log('erro', e)
      return new Promise((resolve, reject) => {
        this.logout();
        return resolve(false);
      });
     });
  }*/
}
