import { Component, OnInit } from '@angular/core';
import { CommonModule } from '@angular/common';
import { FormBuilder, FormGroup, Validators, ReactiveFormsModule } from '@angular/forms';
import { AuthService } from '../../../core/services/auth.service';
import { LocationService, Country, City } from '../../../core/services/location.service';
import { NotificationService } from '../../../core/services/notification.service';

@Component({
    selector: 'app-auth-modal',
    standalone: true,
    imports: [CommonModule, ReactiveFormsModule],
    templateUrl: './auth-modal.component.html',
    styleUrls: ['./auth-modal.component.scss']
})
export class AuthModalComponent implements OnInit {
    showLoginModal = false;
    showRegisterModal = false;
    loginForm!: FormGroup;
    registerForm!: FormGroup;
    countries: Country[] = [];
    cities: City[] = [];
    isLoading = false;

    constructor(
        private fb: FormBuilder,
        private authService: AuthService,
        private locationService: LocationService,
        private notificationService: NotificationService
    ) { }

    ngOnInit(): void {
        this.initForms();
        this.loadCountries();
        this.setupEventListeners();
    }

    private initForms(): void {
        this.loginForm = this.fb.group({
            email: ['', [Validators.required, Validators.email]],
            password: ['', [Validators.required, Validators.minLength(6)]],
            rememberMe: [false]
        });

        this.registerForm = this.fb.group({
            username: ['', [Validators.required, Validators.minLength(3)]],
            email: ['', [Validators.required, Validators.email]],
            countryCode: ['', Validators.required],
            cityId: ['', Validators.required],
            password: ['', [Validators.required, Validators.minLength(6)]],
            confirmPassword: ['', Validators.required],
            acceptTerms: [false, Validators.requiredTrue]
        }, { validators: this.passwordMatchValidator });
    }

    private passwordMatchValidator(form: FormGroup) {
        const password = form.get('password');
        const confirmPassword = form.get('confirmPassword');

        if (password && confirmPassword && password.value !== confirmPassword.value) {
            confirmPassword.setErrors({ passwordMismatch: true });
            return { passwordMismatch: true };
        }
        return null;
    }

    private setupEventListeners(): void {
        window.addEventListener('openLoginModal', () => this.openLoginModal());
        window.addEventListener('openRegisterModal', () => this.openRegisterModal());
    }

    private loadCountries(): void {
        this.locationService.getCountries().subscribe(countries => {
            this.countries = countries;
        });
    }

    onCountryChange(): void {
        const countryCode = this.registerForm.get('countryCode')?.value;
        if (countryCode) {
            this.locationService.getCitiesByCountry(countryCode).subscribe(cities => {
                this.cities = cities;
            });
        }
    }

    openLoginModal(): void {
        this.showLoginModal = true;
        this.showRegisterModal = false;
        this.loginForm.reset();
    }

    openRegisterModal(): void {
        this.showRegisterModal = true;
        this.showLoginModal = false;
        this.registerForm.reset();
    }

    closeLoginModal(): void {
        this.showLoginModal = false;
        this.loginForm.reset();
    }

    closeRegisterModal(): void {
        this.showRegisterModal = false;
        this.registerForm.reset();
    }

    switchToRegister(): void {
        this.closeLoginModal();
        this.openRegisterModal();
    }

    switchToLogin(): void {
        this.closeRegisterModal();
        this.openLoginModal();
    }

    onLogin(): void {
        if (this.loginForm.valid) {
            this.isLoading = true;
            const { email, password } = this.loginForm.value;

            this.authService.login(email, password).subscribe({
                next: (response) => {
                    this.isLoading = false;
                    this.notificationService.showSuccess('¡Inicio de sesión exitoso!');
                    this.closeLoginModal();
                },
                error: (error) => {
                    this.isLoading = false;
                    this.notificationService.showError(error.message || 'Error al iniciar sesión');
                }
            });
        } else {
            this.notificationService.showWarning('Por favor, complete todos los campos correctamente');
        }
    }

    onRegister(): void {
        if (this.registerForm.valid) {
            this.isLoading = true;
            const { confirmPassword, acceptTerms, ...registerData } = this.registerForm.value;

            this.authService.register(registerData).subscribe({
                next: (response) => {
                    this.isLoading = false;
                    this.notificationService.showSuccess('¡Registro exitoso! Ahora puedes iniciar sesión');
                    this.switchToLogin();
                },
                error: (error) => {
                    this.isLoading = false;
                    this.notificationService.showError(error.message || 'Error al registrarse');
                }
            });
        } else {
            this.notificationService.showWarning('Por favor, complete todos los campos correctamente');
        }
    }
}
