import { Component } from '@angular/core';
import { CommonModule } from '@angular/common';
import { RouterLink } from '@angular/router';
import { FormsModule } from '@angular/forms';
import { NewsletterService } from '../../core/services/newsletter.service';
import { NotificationService } from '../../core/services/notification.service';

@Component({
    selector: 'app-home',
    standalone: true,
    imports: [CommonModule, RouterLink, FormsModule],
    templateUrl: './home.component.html',
    styleUrls: ['./home.component.scss']
})
export class HomeComponent {
    newsletterEmail = '';

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

    testimonials = [
        {
            name: 'María García',
            rating: 4,
            comment: '"Excelente atención, mi perrito Max siempre recibe el mejor cuidado. ¡Totalmente recomendado!"',
            image: '/imagenes/reseña.png'
        },
        {
            name: 'Paco Lopez',
            rating: 5,
            comment: '"Excelente!!, mi gato Tobias está super contento por haber sido capado . ¡Super recomendado!"',
            image: '/imagenes/reseña.png'
        },
        {
            name: 'Laura Trillo',
            rating: 5,
            comment: '"Estoy super contenta de haber llevado a mi mascota a Mask!otas, son todos muy profesionales y muy amables. ¡Gracias por todo!"',
            image: '/imagenes/reseña.png'
        }
    ];

    constructor(
        private newsletterService: NewsletterService,
        private notificationService: NotificationService
    ) { }

    getStars(rating: number): string[] {
        return Array(rating).fill('★');
    }

    onNewsletterSubmit(): void {
        if (this.newsletterEmail) {
            this.newsletterService.subscribe(this.newsletterEmail).subscribe({
                next: (response) => {
                    this.notificationService.showSuccess('¡Suscripción exitosa! Gracias por unirte a nuestro newsletter.');
                    this.newsletterEmail = '';
                    // Redirect to gracias page
                    setTimeout(() => {
                        window.location.href = '/gracias';
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
