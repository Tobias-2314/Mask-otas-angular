import { inject } from '@angular/core';
import { Router, CanActivateFn } from '@angular/router';
import { AuthService } from '../services/auth.service';

export const authGuard: CanActivateFn = (route, state) => {
    const authService = inject(AuthService);
    const router = inject(Router);

    if (authService.isLoggedIn) {
        return true;
    }

    // Not logged in, redirect to home and open login modal
    router.navigate(['/']);

    // Trigger login modal to open
    setTimeout(() => {
        window.dispatchEvent(new Event('openLoginModal'));
    }, 100);

    return false;
};
