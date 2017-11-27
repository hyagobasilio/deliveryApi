import { Injectable } from '@angular/core';
import { Http, Headers } from '@angular/http';
import 'rxjs/add/operator/toPromise';


interface Options {
    limit?:number;
    page?:number;
}

interface RequestOptions {
  headers?:any;
}

@Injectable()
export class AppHttpService {

  private url: string;
  private endereco : string = 'http://cesta.com/';
  private options: RequestOptions = {};

  constructor (private http: Http) {}
  

  setAccessToken (token: string) {
    //let token = '';
    let header = new Headers({'Authorization': 'Bearer ' + token});
    this.options.headers = header;
  }

  client(url: string) {
    this.url = this.endereco + url;
    return this;
  }

  builder (resource: string) {
    this.url = this.endereco+'api/' + resource;
    return this;
  }

  list (options: Options = {}) {
    let url = this.url;

    if (options.limit === undefined) {
      options.limit = 20;
    }

    if (options.page === undefined) {
      options.page = 1;
    }

    url += '?limit=' + options.limit;
    url += '&page=' + options.page;

    return this.http.get(url, this.options)
      .toPromise()
      .then((res) => {
        return res.json() || {};
      });
  }

  view (id: number) {
    return this.http.get(this.url + '/' + id, this.options)
      .toPromise()
      .then((res) => {
        return res.json() || {};
      });
  }

  update (id: number, data: Object) {
    return this.http.put(this.url + '/' + id, data, this.options)
      .toPromise()
      .then((res) => {
        return res.json() || {};
      });
  }

  insert (data: Object) {
    return this.http.post(this.url, data, this.options)
      .toPromise()
      .then((res) => {
        return res.json() || {};
      });
  }

  delete (id: number) {
    return this.http.delete(this.url + '/' + id, this.options)
      .toPromise()
      .then((res) => {
        return res.json() || {};
      });
  }

  search (term: string) {
    return this.http.get(this.url + '/?like=title,' + term, this.options)
      .toPromise()
      .then((res) => {
        return res.json() || {};
      });
  }
}