import {
  Subject,
  ɵɵdefineInjectable
} from "./chunk-36WUFF5E.js";

// src/app/core/services/notification.service.ts
var NotificationService = class _NotificationService {
  constructor() {
    this.notificationSubject = new Subject();
    this.notification$ = this.notificationSubject.asObservable();
  }
  showSuccess(message, duration = 3e3) {
    this.notificationSubject.next({ type: "success", message, duration });
  }
  showError(message, duration = 4e3) {
    this.notificationSubject.next({ type: "error", message, duration });
  }
  showInfo(message, duration = 3e3) {
    this.notificationSubject.next({ type: "info", message, duration });
  }
  showWarning(message, duration = 3500) {
    this.notificationSubject.next({ type: "warning", message, duration });
  }
  static {
    this.\u0275fac = function NotificationService_Factory(__ngFactoryType__) {
      return new (__ngFactoryType__ || _NotificationService)();
    };
  }
  static {
    this.\u0275prov = /* @__PURE__ */ \u0275\u0275defineInjectable({ token: _NotificationService, factory: _NotificationService.\u0275fac, providedIn: "root" });
  }
};

// src/environments/environment.ts
var environment = {
  production: false,
  apiUrl: "http://localhost:3000/api"
};

export {
  environment,
  NotificationService
};
//# sourceMappingURL=chunk-AJ5OVI2A.js.map
