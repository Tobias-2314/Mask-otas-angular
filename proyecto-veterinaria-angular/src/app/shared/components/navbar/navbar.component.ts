import { Component, ChangeDetectionStrategy } from '@angular/core';
import { CommonModule } from '@angular/common';
import { RouterLink, RouterLinkActive } from '@angular/router';
import { takeUntilDestroyed } from '@angular/core/rxjs-interop';
import { AuthService, User } from '../../../core/services/auth.service';
import { ModalService } from '../../../core/services/modal.service';

@Component({
    selector: 'app-navbar',
    standalone: true,
    imports: [CommonModule, RouterLink, RouterLinkActive],
    templateUrl: './navbar.component.html',
    styleUrls: ['./navbar.component.scss'],
    changeDetection: ChangeDetectionStrategy.OnPush
})
export class NavbarComponent {
    currentUser: User | null = null;
    mobileMenuOpen = false;

    private destroyRef = takeUntilDestroyed();

    constructor(
        public authService: AuthService,
        private modalService: ModalService
    ) {
        // Suscripción automáticamente limpiada cuando el componente se destruye
        this.authService.currentUser$
            .pipe(takeUntilDestroyed())
            .subscribe(user => {
                this.currentUser = user;
            });
    }



    toggleMobileMenu(): void {
        this.mobileMenuOpen = !this.mobileMenuOpen;
    }

    closeMobileMenu(): void {
        this.mobileMenuOpen = false;
    }

    openLoginModal(): void {
        this.modalService.openLogin();
        this.closeMobileMenu();
    }

    openRegisterModal(): void {
        this.modalService.openRegister();
        this.closeMobileMenu();
    }

    logout(): void {
        this.authService.logout();
        this.closeMobileMenu();
    }
}
