import { HttpInterceptorFn } from '@angular/common/http';

export const jwtInterceptor: HttpInterceptorFn = (req, next) => {
    // Get token from localStorage
    const token = localStorage.getItem('access_token');

    // Public endpoints that don't need authentication
    const publicEndpoints = ['/auth/login', '/auth/register', '/contact', '/newsletter/subscribe', '/location'];

    // Check if this is a public endpoint
    const isPublicEndpoint = publicEndpoints.some(endpoint => req.url.includes(endpoint));

    // If token exists and this is not a public endpoint, add Authorization header
    if (token && !isPublicEndpoint) {
        req = req.clone({
            setHeaders: {
                Authorization: `Bearer ${token}`
            }
        });
    }

    return next(req);
};
