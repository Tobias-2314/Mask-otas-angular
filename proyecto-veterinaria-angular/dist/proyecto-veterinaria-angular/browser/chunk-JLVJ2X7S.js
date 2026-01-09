import {
  Router
} from "./chunk-KI6KQKNI.js";
import {
  DefaultValueAccessor,
  FormBuilder,
  FormControlName,
  FormGroupDirective,
  NgControlStatus,
  NgControlStatusGroup,
  ReactiveFormsModule,
  RequiredValidator,
  Validators,
  ɵNgNoValidate
} from "./chunk-BT4ILVVH.js";
import {
  NotificationService,
  environment
} from "./chunk-AJ5OVI2A.js";
import {
  HttpClient
} from "./chunk-Q57ULFC2.js";
import {
  CommonModule,
  ɵsetClassDebugInfo,
  ɵɵStandaloneFeature,
  ɵɵadvance,
  ɵɵdefineComponent,
  ɵɵdefineInjectable,
  ɵɵdirectiveInject,
  ɵɵelement,
  ɵɵelementEnd,
  ɵɵelementStart,
  ɵɵinject,
  ɵɵlistener,
  ɵɵproperty,
  ɵɵtext,
  ɵɵtextInterpolate1
} from "./chunk-36WUFF5E.js";

// src/app/core/services/contact.service.ts
var ContactService = class _ContactService {
  constructor(http) {
    this.http = http;
    this.apiUrl = environment.apiUrl;
  }
  submitContact(data) {
    return this.http.post(`${this.apiUrl}/contact`, data);
  }
  static {
    this.\u0275fac = function ContactService_Factory(__ngFactoryType__) {
      return new (__ngFactoryType__ || _ContactService)(\u0275\u0275inject(HttpClient));
    };
  }
  static {
    this.\u0275prov = /* @__PURE__ */ \u0275\u0275defineInjectable({ token: _ContactService, factory: _ContactService.\u0275fac, providedIn: "root" });
  }
};

// src/app/features/contact/contact.component.ts
var ContactComponent = class _ContactComponent {
  constructor(fb, router, contactService, notificationService) {
    this.fb = fb;
    this.router = router;
    this.contactService = contactService;
    this.notificationService = notificationService;
    this.isSubmitting = false;
    this.contactForm = this.fb.group({
      name: ["", Validators.required],
      email: ["", [Validators.required, Validators.email]],
      phone: [""],
      subject: ["", Validators.required],
      message: ["", Validators.required]
    });
  }
  onSubmit() {
    if (this.contactForm.valid) {
      this.isSubmitting = true;
      this.contactService.submitContact(this.contactForm.value).subscribe({
        next: (response) => {
          this.isSubmitting = false;
          this.notificationService.showSuccess("\xA1Mensaje enviado! Nos pondremos en contacto contigo pronto.");
          this.contactForm.reset();
          setTimeout(() => {
            this.router.navigate(["/gracias"]);
          }, 1e3);
        },
        error: (error) => {
          this.isSubmitting = false;
          this.notificationService.showError(error.message || "Error al enviar el mensaje. Por favor, int\xE9ntalo de nuevo.");
        }
      });
    }
  }
  static {
    this.\u0275fac = function ContactComponent_Factory(__ngFactoryType__) {
      return new (__ngFactoryType__ || _ContactComponent)(\u0275\u0275directiveInject(FormBuilder), \u0275\u0275directiveInject(Router), \u0275\u0275directiveInject(ContactService), \u0275\u0275directiveInject(NotificationService));
    };
  }
  static {
    this.\u0275cmp = /* @__PURE__ */ \u0275\u0275defineComponent({ type: _ContactComponent, selectors: [["app-contact"]], standalone: true, features: [\u0275\u0275StandaloneFeature], decls: 57, vars: 3, consts: [[1, "page-container"], [1, "contact-section"], [1, "container"], [1, "contact-grid"], [1, "contact-form-container"], [3, "ngSubmit", "formGroup"], [1, "form-group"], ["for", "name"], ["type", "text", "id", "name", "formControlName", "name", "required", ""], ["for", "email"], ["type", "email", "id", "email", "formControlName", "email", "required", ""], ["for", "phone"], ["type", "tel", "id", "phone", "formControlName", "phone"], ["for", "subject"], ["type", "text", "id", "subject", "formControlName", "subject", "required", ""], ["for", "message"], ["id", "message", "formControlName", "message", "rows", "5", "required", ""], ["type", "submit", 1, "submit-btn", 3, "disabled"], [1, "contact-info"], [1, "info-item"], [1, "fas", "fa-map-marker-alt"], [1, "fas", "fa-phone"], [1, "fas", "fa-envelope"], [1, "fas", "fa-clock"]], template: function ContactComponent_Template(rf, ctx) {
      if (rf & 1) {
        \u0275\u0275elementStart(0, "div", 0)(1, "section", 1)(2, "div", 2)(3, "h1");
        \u0275\u0275text(4, "Contacto");
        \u0275\u0275elementEnd();
        \u0275\u0275elementStart(5, "div", 3)(6, "div", 4)(7, "h2");
        \u0275\u0275text(8, "Env\xEDanos un mensaje");
        \u0275\u0275elementEnd();
        \u0275\u0275elementStart(9, "form", 5);
        \u0275\u0275listener("ngSubmit", function ContactComponent_Template_form_ngSubmit_9_listener() {
          return ctx.onSubmit();
        });
        \u0275\u0275elementStart(10, "div", 6)(11, "label", 7);
        \u0275\u0275text(12, "Nombre");
        \u0275\u0275elementEnd();
        \u0275\u0275element(13, "input", 8);
        \u0275\u0275elementEnd();
        \u0275\u0275elementStart(14, "div", 6)(15, "label", 9);
        \u0275\u0275text(16, "Email");
        \u0275\u0275elementEnd();
        \u0275\u0275element(17, "input", 10);
        \u0275\u0275elementEnd();
        \u0275\u0275elementStart(18, "div", 6)(19, "label", 11);
        \u0275\u0275text(20, "Tel\xE9fono (opcional)");
        \u0275\u0275elementEnd();
        \u0275\u0275element(21, "input", 12);
        \u0275\u0275elementEnd();
        \u0275\u0275elementStart(22, "div", 6)(23, "label", 13);
        \u0275\u0275text(24, "Asunto");
        \u0275\u0275elementEnd();
        \u0275\u0275element(25, "input", 14);
        \u0275\u0275elementEnd();
        \u0275\u0275elementStart(26, "div", 6)(27, "label", 15);
        \u0275\u0275text(28, "Mensaje");
        \u0275\u0275elementEnd();
        \u0275\u0275element(29, "textarea", 16);
        \u0275\u0275elementEnd();
        \u0275\u0275elementStart(30, "button", 17);
        \u0275\u0275text(31);
        \u0275\u0275elementEnd()()();
        \u0275\u0275elementStart(32, "div", 18)(33, "h2");
        \u0275\u0275text(34, "Informaci\xF3n de Contacto");
        \u0275\u0275elementEnd();
        \u0275\u0275elementStart(35, "div", 19);
        \u0275\u0275element(36, "i", 20);
        \u0275\u0275elementStart(37, "p");
        \u0275\u0275text(38, "C/ dels Sants Just i Pastor, 70");
        \u0275\u0275element(39, "br");
        \u0275\u0275text(40, "46940 Manises, Val\xE8ncia");
        \u0275\u0275elementEnd()();
        \u0275\u0275elementStart(41, "div", 19);
        \u0275\u0275element(42, "i", 21);
        \u0275\u0275elementStart(43, "p");
        \u0275\u0275text(44, "+34 123 456 789");
        \u0275\u0275elementEnd()();
        \u0275\u0275elementStart(45, "div", 19);
        \u0275\u0275element(46, "i", 22);
        \u0275\u0275elementStart(47, "p");
        \u0275\u0275text(48, "info@MASK!OTAS.com");
        \u0275\u0275elementEnd()();
        \u0275\u0275elementStart(49, "div", 19);
        \u0275\u0275element(50, "i", 23);
        \u0275\u0275elementStart(51, "p");
        \u0275\u0275text(52, "Lunes - Viernes: 9:00 - 20:00");
        \u0275\u0275element(53, "br");
        \u0275\u0275text(54, " S\xE1bados: 10:00 - 15:00");
        \u0275\u0275element(55, "br");
        \u0275\u0275text(56, " Domingos: Emergencias");
        \u0275\u0275elementEnd()()()()()()();
      }
      if (rf & 2) {
        \u0275\u0275advance(9);
        \u0275\u0275property("formGroup", ctx.contactForm);
        \u0275\u0275advance(21);
        \u0275\u0275property("disabled", !ctx.contactForm.valid || ctx.isSubmitting);
        \u0275\u0275advance();
        \u0275\u0275textInterpolate1(" ", ctx.isSubmitting ? "Enviando..." : "Enviar Mensaje", " ");
      }
    }, dependencies: [CommonModule, ReactiveFormsModule, \u0275NgNoValidate, DefaultValueAccessor, NgControlStatus, NgControlStatusGroup, RequiredValidator, FormGroupDirective, FormControlName], styles: ["\n\n.page-container[_ngcontent-%COMP%] {\n  min-height: calc(100vh - 200px);\n  padding: 4rem 0;\n  background-color: var(--color-bg-gray);\n}\n.contact-section[_ngcontent-%COMP%]   h1[_ngcontent-%COMP%] {\n  font-size: 2.5rem;\n  color: var(--color-primary);\n  text-align: center;\n  margin-bottom: 3rem;\n}\n.contact-grid[_ngcontent-%COMP%] {\n  display: grid;\n  grid-template-columns: 1fr;\n  gap: 2rem;\n}\n@media (min-width: 768px) {\n  .contact-grid[_ngcontent-%COMP%] {\n    grid-template-columns: 1fr 1fr;\n  }\n}\n.contact-form-container[_ngcontent-%COMP%], \n.contact-info[_ngcontent-%COMP%] {\n  background: white;\n  padding: 2rem;\n  border-radius: 0.5rem;\n  box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);\n}\nh2[_ngcontent-%COMP%] {\n  color: var(--color-primary);\n  margin-bottom: 1.5rem;\n}\n.form-group[_ngcontent-%COMP%] {\n  margin-bottom: 1.5rem;\n}\n.form-group[_ngcontent-%COMP%]   label[_ngcontent-%COMP%] {\n  display: block;\n  margin-bottom: 0.5rem;\n  font-weight: 500;\n}\n.form-group[_ngcontent-%COMP%]   input[_ngcontent-%COMP%], \n.form-group[_ngcontent-%COMP%]   textarea[_ngcontent-%COMP%] {\n  width: 100%;\n  padding: 0.75rem;\n  border: 1px solid #d1d5db;\n  border-radius: 0.375rem;\n  font-size: 1rem;\n}\n.form-group[_ngcontent-%COMP%]   input[_ngcontent-%COMP%]:focus, \n.form-group[_ngcontent-%COMP%]   textarea[_ngcontent-%COMP%]:focus {\n  outline: none;\n  border-color: var(--color-primary);\n}\n.submit-btn[_ngcontent-%COMP%] {\n  width: 100%;\n  padding: 0.75rem 1.5rem;\n  background-color: var(--color-primary);\n  color: white;\n  border: none;\n  border-radius: 0.5rem;\n  font-size: 1rem;\n  font-weight: 600;\n  cursor: pointer;\n  transition: background-color 0.3s;\n}\n.submit-btn[_ngcontent-%COMP%]:hover:not(:disabled) {\n  background-color: var(--color-primary-dark);\n}\n.submit-btn[_ngcontent-%COMP%]:disabled {\n  opacity: 0.6;\n  cursor: not-allowed;\n}\n.info-item[_ngcontent-%COMP%] {\n  display: flex;\n  gap: 1rem;\n  margin-bottom: 1.5rem;\n  align-items: flex-start;\n}\n.info-item[_ngcontent-%COMP%]   i[_ngcontent-%COMP%] {\n  font-size: 1.5rem;\n  color: var(--color-primary);\n  margin-top: 0.25rem;\n}\n.info-item[_ngcontent-%COMP%]   p[_ngcontent-%COMP%] {\n  margin: 0;\n  color: var(--color-text-gray);\n  line-height: 1.6;\n}\n/*# sourceMappingURL=contact.component.css.map */"] });
  }
};
(() => {
  (typeof ngDevMode === "undefined" || ngDevMode) && \u0275setClassDebugInfo(ContactComponent, { className: "ContactComponent", filePath: "src\\app\\features\\contact\\contact.component.ts", lineNumber: 178 });
})();
export {
  ContactComponent
};
//# sourceMappingURL=chunk-JLVJ2X7S.js.map
