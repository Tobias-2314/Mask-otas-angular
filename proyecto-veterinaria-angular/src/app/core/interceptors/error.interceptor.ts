import { HttpInterceptorFn } from '@angular/common/http';
import { inject } from '@angular/core';
import { catchError, throwError } from 'rxjs';
import { Router } from '@angular/router';

export const errorInterceptor: HttpInterceptorFn = (req, next) => {
    const router = inject(Router);

    return next(req).pipe(
        catchError(error => {
            let errorMessage = 'Ha ocurrido un error';

            if (error.error instanceof ErrorEvent) {
                // Client-side error
                errorMessage = `Error: ${error.error.message}`;
            } else {
                // Server-side error
                switch (error.status) {
                    case 400:
                        errorMessage = error.error?.message || 'Solicitud inválida';
                        break;
                    case 401:
                        errorMessage = 'No autorizado. Por favor, inicie sesión.';
                        // Clear tokens and redirect to home
                        localStorage.removeItem('access_token');
                        localStorage.removeItem('currentUser');
                        router.navigate(['/']);
                        break;
                    case 403:
                        errorMessage = 'Acceso prohibido';
                        break;
                    case 404:
                        errorMessage = 'Recurso no encontrado';
                        break;
                    case 409:
                        errorMessage = error.error?.message || 'Conflicto en la solicitud';
                        break;
                    case 500:
                        errorMessage = 'Error del servidor. Inténtelo más tarde.';
                        break;
                    default:
                        errorMessage = error.error?.message || 'Error de conexión con el servidor';
                }
            }

            console.error('Error HTTP:', error);
            return throwError(() => ({ ...error, message: errorMessage }));
        })
    );
};
