import { Component } from '@angular/core';
import { RouterOutlet } from '@angular/router';
import { NavbarComponent } from './shared/components/navbar/navbar.component';
import { FooterComponent } from './shared/components/footer/footer.component';
import { CookiePopupComponent } from './shared/components/cookie-popup/cookie-popup.component';
import { AuthModalComponent } from './shared/components/auth-modal/auth-modal.component';

@Component({
    selector: 'app-root',
    standalone: true,
    imports: [
        RouterOutlet,
        NavbarComponent,
        FooterComponent,
        CookiePopupComponent,
        AuthModalComponent
    ],
    template: `
    <app-navbar></app-navbar>
    <router-outlet></router-outlet>
    <app-footer></app-footer>
    <app-cookie-popup></app-cookie-popup>
    <app-auth-modal></app-auth-modal>
  `,
    styles: []
})
export class AppComponent {
    title = 'MASK!OTAS - Clínica Veterinaria';
}
