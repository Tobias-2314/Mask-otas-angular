import {
  environment
} from "./chunk-AJ5OVI2A.js";
import {
  HttpClient
} from "./chunk-Q57ULFC2.js";
import {
  ɵɵdefineInjectable,
  ɵɵinject
} from "./chunk-36WUFF5E.js";

// src/app/core/services/reviews.service.ts
var ReviewsService = class _ReviewsService {
  constructor(http) {
    this.http = http;
    this.apiUrl = environment.apiUrl;
  }
  getReviews() {
    return this.http.get(`${this.apiUrl}/reviews`);
  }
  createReview(review) {
    return this.http.post(`${this.apiUrl}/reviews`, review);
  }
  getAllReviewsForAdmin() {
    return this.http.get(`${this.apiUrl}/reviews/admin/all`);
  }
  approveReview(id) {
    return this.http.patch(`${this.apiUrl}/reviews/${id}/approve`, {});
  }
  hideReview(id) {
    return this.http.patch(`${this.apiUrl}/reviews/${id}/hide`, {});
  }
  deleteReview(id) {
    return this.http.delete(`${this.apiUrl}/reviews/${id}`);
  }
  getReviewStats() {
    return this.http.get(`${this.apiUrl}/reviews/stats`);
  }
  static {
    this.\u0275fac = function ReviewsService_Factory(__ngFactoryType__) {
      return new (__ngFactoryType__ || _ReviewsService)(\u0275\u0275inject(HttpClient));
    };
  }
  static {
    this.\u0275prov = /* @__PURE__ */ \u0275\u0275defineInjectable({ token: _ReviewsService, factory: _ReviewsService.\u0275fac, providedIn: "root" });
  }
};

export {
  ReviewsService
};
//# sourceMappingURL=chunk-MWX26FBN.js.map
