import { Component } from '@angular/core';

@Component({
    selector: 'login-page',
    template: `<div class="login-box">
                <div class="login-logo">
                    <a href="#"><b>Admin</b>LTE</a>
                </div>
                <div class="login-box-body login">
                    <h2>Login</h2>
            
                    <form action="#" method="post">
                        <div class="form-group has-feedback">
                            <input type="email" class="form-control" placeholder="Email">
                            <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                        </div>
                        <div class="form-group has-feedback">
                            <input type="password" class="form-control" placeholder="Password">
                            <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                        </div>
                        <div class="row">
                            <div class="col-xs-8">
                               <a routerLink="/dashboard" routerLinkActive="active">I forgot my password</a>
                                <!--<a href="#">I forgot my password</a>-->
                            </div><!-- /.col -->
                            <div class="col-xs-4">
                                <input class="btn btn-primary btn-block btn-flat" type="submit" value="Sign In">
                            </div><!-- /.col -->
                         </div>
                    </form>
               
                </div>
            </div>`
})
export class LoginComponent {}
