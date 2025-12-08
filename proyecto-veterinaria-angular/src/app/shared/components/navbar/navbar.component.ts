import { Component, OnInit } from '@angular/core';
import { CommonModule } from '@angular/common';
import { RouterLink, RouterLinkActive } from '@angular/router';
import { AuthService, User } from '../../../core/services/auth.service';

@Component({
    selector: 'app-navbar',
    standalone: true,
    imports: [CommonModule, RouterLink, RouterLinkActive],
    templateUrl: './navbar.component.html',
    styleUrls: ['./navbar.component.scss']
})
export class NavbarComponent implements OnInit {
    currentUser: User | null = null;
    mobileMenuOpen = false;

    constructor(public authService: AuthService) { }

    ngOnInit(): void {
        this.authService.currentUser$.subscribe(user => {
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
        const event = new CustomEvent('openLoginModal');
        window.dispatchEvent(event);
        this.closeMobileMenu();
    }

    openRegisterModal(): void {
        const event = new CustomEvent('openRegisterModal');
        window.dispatchEvent(event);
        this.closeMobileMenu();
    }

    logout(): void {
        this.authService.logout();
        this.closeMobileMenu();
    }
}
