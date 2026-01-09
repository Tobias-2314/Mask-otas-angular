import { Component, OnInit, ChangeDetectionStrategy, AfterViewInit, OnDestroy, ChangeDetectorRef } from '@angular/core';
import { CommonModule } from '@angular/common';
import { RouterLink, Router } from '@angular/router';
import { FormsModule } from '@angular/forms';

import { NewsletterService } from '../../core/services/newsletter.service';
import { NotificationService } from '../../core/services/notification.service';
import { ReviewsService, Review } from '../../core/services/reviews.service';

@Component({
    selector: 'app-home',
    standalone: true,
    imports: [CommonModule, RouterLink, FormsModule],
    templateUrl: './home.component.html',
    styleUrls: ['./home.component.scss'],
    changeDetection: ChangeDetectionStrategy.OnPush
})
export class HomeComponent implements OnInit, AfterViewInit, OnDestroy {
    newsletterEmail = '';
    reviews: Review[] = [];
    reviewStats = { average: 0, total: 0 };
    loadingReviews = false;
    private observer: IntersectionObserver | null = null;

    services = [
        {
            icon: 'fas fa-heartbeat',
            title: 'Consultas y Chequeos',
            description: 'Revisiones completas y seguimiento personalizado para tu mascota.',
            link: '/servicios#revision'
        },
        {
            icon: 'fas fa-syringe',
            title: 'Vacunación',
            description: 'Mantén a tu mascota protegida con nuestro programa de vacunación.',
            link: '/servicios#vacunacion'
        },
        {
            icon: 'fas fa-cut',
            title: 'Peluquería',
            description: 'Servicios de grooming profesional para mantener a tu mascota hermosa.',
            link: '/servicios#peluqueria'
        }
    ];

    blogPosts = [
        {
            image: '/imagenes/cuidado.png',
            title: 'Cuidados básicos para tu cachorro',
            description: 'Aprende los aspectos fundamentales para el cuidado de tu nuevo amigo.',
            link: '/cuidados'
        },
        {
            image: '/imagenes/nutricion.png',
            title: 'Guía de nutrición para mascotas',
            description: 'Descubre la mejor alimentación para cada etapa de vida.',
            link: '/nutricion'
        },
        {
            image: '/imagenes/ejercicio.png',
            title: 'Ejercicios recomendados',
            description: 'Mantén a tu mascota activa y saludable con estos ejercicios.',
            link: '/ejercicios'
        }
    ];

    constructor(
        private newsletterService: NewsletterService,
        private notificationService: NotificationService,
        private reviewsService: ReviewsService,
        private router: Router,
        private cdr: ChangeDetectorRef
    ) { }

    ngOnInit(): void {
        this.loadReviews();
        this.loadStats();
    }

    ngAfterViewInit() {
        this.setupIntersectionObserver();
    }

    ngOnDestroy() {
        if (this.observer) {
            this.observer.disconnect();
        }
    }

    private setupIntersectionObserver() {
        const options = {
            root: null,
            rootMargin: '0px',
            threshold: 0.1
        };

        this.observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('is-visible');
                    this.observer?.unobserve(entry.target);
                }
            });
        }, options);

        this.observeElements();
    }

    private observeElements() {
        if (!this.observer) return;

        // Give a small delay to ensure DOM is ready
        setTimeout(() => {
            const elements = document.querySelectorAll('.animate-on-scroll');
            elements.forEach(el => {
                if (!el.classList.contains('is-visible')) {
                    this.observer?.observe(el);
                }
            });
        }, 100);
    }

    loadReviews(): void {
        this.loadingReviews = true;
        this.reviewsService.getReviews()
            .subscribe({
                next: (reviews) => {
                    // Mostrar solo las últimas 3 reseñas
                    this.reviews = reviews.slice(0, 3);
                    this.loadingReviews = false;
                    this.cdr.markForCheck(); // Trigger view update
                    // Re-run observer for new review elements
                    this.observeElements();
                },
                error: (error) => {
                    console.error('Error cargando reseñas:', error);
                    this.loadingReviews = false;
                    this.cdr.markForCheck();
                }
            });
    }

    loadStats(): void {
        this.reviewsService.getReviewStats()
            .subscribe({
                next: (stats) => {
                    this.reviewStats = stats;
                    this.cdr.markForCheck();
                },
                error: (error) => {
                    console.error('Error cargando estadísticas:', error);
                }
            });
    }

    getStars(rating: number): string[] {
        return Array(rating).fill('★');
    }

    onNewsletterSubmit(): void {
        if (this.newsletterEmail) {
            this.newsletterService.subscribe(this.newsletterEmail)
                .subscribe({
                    next: (response) => {
                        this.notificationService.showSuccess('¡Suscripción exitosa! Gracias por unirte a nuestro newsletter.');
                        this.newsletterEmail = '';
                        // Usar Router de Angular en lugar de window.location
                        setTimeout(() => {
                            this.router.navigate(['/gracias']);
                        }, 1000);
                    },
                    error: (error) => {
                        this.notificationService.showError(error.message || 'Error al suscribirse. Por favor, inténtalo de nuevo.');
                    }
                });
        } else {
            this.notificationService.showWarning('Por favor, ingresa un correo electrónico válido.');
        }
    }
}
