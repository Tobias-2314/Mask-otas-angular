import { Component, AfterViewInit } from '@angular/core';
import { RouterOutlet, Router, NavigationEnd } from '@angular/router';
import { filter } from 'rxjs/operators';
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
export class AppComponent implements AfterViewInit {
    title = 'MASK!OTAS - Clínica Veterinaria';

    constructor(private router: Router) { }

    ngAfterViewInit() {
        // Inicializar observador al cargar
        this.initObserver();

        // Reinicializar observador en cada navegación
        this.router.events.pipe(
            filter(event => event instanceof NavigationEnd)
        ).subscribe(() => {
            // Pequeño delay para asegurar que el DOM se renderizó
            setTimeout(() => this.initObserver(), 100);
            // Scroll top en cambio de ruta
            window.scrollTo(0, 0);
        });
    }

    private initObserver() {
        const observerOptions = {
            root: null,
            rootMargin: '0px',
            threshold: 0.1
        };

        const observer = new IntersectionObserver((entries, observer) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('is-visible');
                    observer.unobserve(entry.target); // Dejar de observar una vez animado
                }
            });
        }, observerOptions);

        document.querySelectorAll('.animate-on-scroll').forEach((element) => {
            observer.observe(element);
        });
    }
}
