import { Routes } from '@angular/router';
import { HomeComponent } from './features/home/home.component';
import { authGuard } from './core/guards/auth.guard';

export const routes: Routes = [
    {
        path: '',
        component: HomeComponent
    },
    {
        path: 'servicios',
        loadComponent: () => import('./features/services/services.component').then(m => m.ServicesComponent)
    },
    {
        path: 'citas',
        loadComponent: () => import('./features/appointments/appointments.component').then(m => m.AppointmentsComponent)
    },
    {
        path: 'contacto',
        loadComponent: () => import('./features/contact/contact.component').then(m => m.ContactComponent)
    },
    {
        path: 'cuidados',
        loadComponent: () => import('./features/blog/cuidados/cuidados.component').then(m => m.CuidadosComponent)
    },
    {
        path: 'nutricion',
        loadComponent: () => import('./features/blog/nutricion/nutricion.component').then(m => m.NutricionComponent)
    },
    {
        path: 'ejercicios',
        loadComponent: () => import('./features/blog/ejercicios/ejercicios.component').then(m => m.EjerciciosComponent)
    },
    {
        path: 'legal',
        loadComponent: () => import('./features/legal/legal.component').then(m => m.LegalComponent)
    },
    {
        path: 'admin-dashboard',
        loadComponent: () => import('./features/admin-dashboard/admin-dashboard.component').then(m => m.AdminDashboardComponent),
        canActivate: [authGuard]
    },
    {
        path: 'gracias',
        loadComponent: () => import('./features/gracias/gracias.component').then(m => m.GraciasComponent)
    },
    {
        path: 'resenas',
        loadComponent: () => import('./features/reviews/reviews.component').then(m => m.ReviewsComponent)
    },
    {
        path: '**',
        redirectTo: ''
    }
];
