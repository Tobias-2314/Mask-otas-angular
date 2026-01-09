import {
  environment
} from "./chunk-AJ5OVI2A.js";
import {
  HttpClient,
  HttpHeaders
} from "./chunk-Q57ULFC2.js";
import {
  BehaviorSubject,
  catchError,
  tap,
  ɵɵdefineInjectable,
  ɵɵinject
} from "./chunk-36WUFF5E.js";

// src/app/core/services/auth.service.ts
var AuthService = class _AuthService {
  constructor(http) {
    this.http = http;
    this.currentUserSubject = new BehaviorSubject(null);
    this.currentUser$ = this.currentUserSubject.asObservable();
    this.apiUrl = environment.apiUrl;
    const savedUser = localStorage.getItem("currentUser");
    if (savedUser) {
      this.currentUserSubject.next(JSON.parse(savedUser));
    }
  }
  get currentUserValue() {
    return this.currentUserSubject.value;
  }
  get isLoggedIn() {
    return this.currentUserSubject.value !== null && this.getToken() !== null;
  }
  getToken() {
    return localStorage.getItem("access_token");
  }
  login(email, password) {
    const headers = new HttpHeaders({ "Content-Type": "application/json" });
    const body = { email, password };
    return this.http.post(`${this.apiUrl}/auth/login`, body, { headers }).pipe(tap((response) => {
      if (response.access_token && response.user) {
        localStorage.setItem("access_token", response.access_token);
        localStorage.setItem("currentUser", JSON.stringify(response.user));
        this.currentUserSubject.next(response.user);
      }
    }), catchError((error) => {
      console.error("Error de login:", error);
      const errorMessage = error.error?.message || "Error de conexi\xF3n con el servidor";
      throw { success: false, message: errorMessage };
    }));
  }
  register(data) {
    const headers = new HttpHeaders({ "Content-Type": "application/json" });
    return this.http.post(`${this.apiUrl}/auth/register`, data, { headers }).pipe(catchError((error) => {
      console.error("Error de registro:", error);
      const errorMessage = error.error?.message || "Error de conexi\xF3n con el servidor";
      throw { success: false, message: errorMessage };
    }));
  }
  logout() {
    localStorage.removeItem("access_token");
    localStorage.removeItem("currentUser");
    this.currentUserSubject.next(null);
  }
  static {
    this.\u0275fac = function AuthService_Factory(__ngFactoryType__) {
      return new (__ngFactoryType__ || _AuthService)(\u0275\u0275inject(HttpClient));
    };
  }
  static {
    this.\u0275prov = /* @__PURE__ */ \u0275\u0275defineInjectable({ token: _AuthService, factory: _AuthService.\u0275fac, providedIn: "root" });
  }
};

export {
  AuthService
};
//# sourceMappingURL=chunk-JGFDI6YL.js.map
