import { NavController } from 'ionic-angular';
import { LoginPage } from '../pages/login/login';
import { Component } from '@angular/core';
@Component({
	template: '',
	providers : []
})
export class Redirect {

	constructor(private nav : NavController) {}

	redirect(){
		this.nav.setRoot(LoginPage);
	}
}