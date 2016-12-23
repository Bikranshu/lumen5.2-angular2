import { NgModule }     from '@angular/core';
import { RouterModule } from '@angular/router';

import { LoginComponent }  from './login/login.component';
import { DashboardComponent }  from './dashboard/dashboard.component';

@NgModule({
    imports: [
        RouterModule.forRoot([
            { path: '', component: LoginComponent },
            { path: 'dashboard', component: DashboardComponent },

            // otherwise redirect to home
            { path: '**', redirectTo: '/' }
        ])
    ],
    exports: [
        RouterModule
    ]
})
export class AppRoutingModule {}