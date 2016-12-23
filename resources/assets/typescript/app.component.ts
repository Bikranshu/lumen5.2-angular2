import { Component } from '@angular/core';

@Component({
    selector: 'pbn-app',
    template: `<div class="outer-outlet">
                  <router-outlet></router-outlet>
              </div>`
})
export class AppComponent { }
