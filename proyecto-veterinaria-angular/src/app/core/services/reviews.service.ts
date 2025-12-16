import { Injectable } from '@angular/core';
import { HttpClient } from '@angular/common/http';
import { Observable } from 'rxjs';
import { environment } from '../../../environments/environment';

export interface Review {
    id: string;
    customer_name: string;
    rating: number;
    comment: string;
    pet_name?: string;
    service_type?: string;
    is_approved: boolean;
    is_visible: boolean;
    created_at: Date;
}

export interface CreateReviewDto {
    customer_name: string;
    rating: number;
    comment: string;
    pet_name?: string;
    service_type?: string;
}

@Injectable({
    providedIn: 'root'
})
export class ReviewsService {
    private apiUrl = environment.apiUrl;

    constructor(private http: HttpClient) { }

    getReviews(): Observable<Review[]> {
        return this.http.get<Review[]>(`${this.apiUrl}/reviews`);
    }

    createReview(review: CreateReviewDto): Observable<any> {
        return this.http.post(`${this.apiUrl}/reviews`, review);
    }

    getAllReviewsForAdmin(): Observable<Review[]> {
        return this.http.get<Review[]>(`${this.apiUrl}/reviews/admin/all`);
    }

    approveReview(id: string): Observable<any> {
        return this.http.patch(`${this.apiUrl}/reviews/${id}/approve`, {});
    }

    hideReview(id: string): Observable<any> {
        return this.http.patch(`${this.apiUrl}/reviews/${id}/hide`, {});
    }

    deleteReview(id: string): Observable<any> {
        return this.http.delete(`${this.apiUrl}/reviews/${id}`);
    }

    getReviewStats(): Observable<{ average: number; total: number }> {
        return this.http.get<{ average: number; total: number }>(`${this.apiUrl}/reviews/stats`);
    }
}
