import {
  ReviewsService
} from "./chunk-MWX26FBN.js";
import {
  DefaultValueAccessor,
  FormBuilder,
  FormControlName,
  FormGroupDirective,
  NgControlStatus,
  NgControlStatusGroup,
  NgSelectOption,
  ReactiveFormsModule,
  SelectControlValueAccessor,
  Validators,
  ɵNgNoValidate,
  ɵNgSelectMultipleOption
} from "./chunk-BT4ILVVH.js";
import {
  NotificationService
} from "./chunk-AJ5OVI2A.js";
import "./chunk-Q57ULFC2.js";
import {
  CommonModule,
  ɵsetClassDebugInfo,
  ɵɵStandaloneFeature,
  ɵɵadvance,
  ɵɵclassProp,
  ɵɵconditional,
  ɵɵdefineComponent,
  ɵɵdirectiveInject,
  ɵɵelement,
  ɵɵelementEnd,
  ɵɵelementStart,
  ɵɵgetCurrentView,
  ɵɵlistener,
  ɵɵnextContext,
  ɵɵproperty,
  ɵɵpureFunction0,
  ɵɵrepeater,
  ɵɵrepeaterCreate,
  ɵɵrepeaterTrackByIdentity,
  ɵɵresetView,
  ɵɵrestoreView,
  ɵɵtemplate,
  ɵɵtext,
  ɵɵtextInterpolate,
  ɵɵtextInterpolate1
} from "./chunk-36WUFF5E.js";

// src/app/features/reviews/reviews.component.ts
var _forTrack0 = ($index, $item) => $item.id;
var _c0 = () => [1, 2, 3, 4, 5];
function ReviewsComponent_Conditional_5_Template(rf, ctx) {
  if (rf & 1) {
    \u0275\u0275elementStart(0, "div", 3);
    \u0275\u0275element(1, "i", 31);
    \u0275\u0275elementStart(2, "p");
    \u0275\u0275text(3, "Cargando rese\xF1as...");
    \u0275\u0275elementEnd()();
  }
}
function ReviewsComponent_Conditional_6_For_2_Conditional_8_Template(rf, ctx) {
  if (rf & 1) {
    \u0275\u0275elementStart(0, "p", 36);
    \u0275\u0275element(1, "i", 14);
    \u0275\u0275text(2);
    \u0275\u0275elementEnd();
  }
  if (rf & 2) {
    const review_r1 = \u0275\u0275nextContext().$implicit;
    \u0275\u0275advance(2);
    \u0275\u0275textInterpolate1(" ", review_r1.pet_name, "");
  }
}
function ReviewsComponent_Conditional_6_For_2_For_11_Template(rf, ctx) {
  if (rf & 1) {
    \u0275\u0275element(0, "i", 2);
  }
  if (rf & 2) {
    const star_r2 = ctx.$implicit;
    const review_r1 = \u0275\u0275nextContext().$implicit;
    \u0275\u0275classProp("filled", star_r2 <= review_r1.rating);
  }
}
function ReviewsComponent_Conditional_6_For_2_Conditional_14_Template(rf, ctx) {
  if (rf & 1) {
    \u0275\u0275elementStart(0, "span", 40);
    \u0275\u0275text(1);
    \u0275\u0275elementEnd();
  }
  if (rf & 2) {
    const review_r1 = \u0275\u0275nextContext().$implicit;
    const ctx_r2 = \u0275\u0275nextContext(2);
    \u0275\u0275advance();
    \u0275\u0275textInterpolate(ctx_r2.getServiceLabel(review_r1.service_type));
  }
}
function ReviewsComponent_Conditional_6_For_2_Template(rf, ctx) {
  if (rf & 1) {
    \u0275\u0275elementStart(0, "div", 32)(1, "div", 33)(2, "div", 34)(3, "div", 35);
    \u0275\u0275element(4, "i", 11);
    \u0275\u0275elementEnd();
    \u0275\u0275elementStart(5, "div")(6, "h4");
    \u0275\u0275text(7);
    \u0275\u0275elementEnd();
    \u0275\u0275template(8, ReviewsComponent_Conditional_6_For_2_Conditional_8_Template, 3, 1, "p", 36);
    \u0275\u0275elementEnd()();
    \u0275\u0275elementStart(9, "div", 37);
    \u0275\u0275repeaterCreate(10, ReviewsComponent_Conditional_6_For_2_For_11_Template, 1, 2, "i", 38, \u0275\u0275repeaterTrackByIdentity);
    \u0275\u0275elementEnd()();
    \u0275\u0275elementStart(12, "p", 39);
    \u0275\u0275text(13);
    \u0275\u0275elementEnd();
    \u0275\u0275template(14, ReviewsComponent_Conditional_6_For_2_Conditional_14_Template, 2, 1, "span", 40);
    \u0275\u0275elementStart(15, "span", 41);
    \u0275\u0275text(16);
    \u0275\u0275elementEnd()();
  }
  if (rf & 2) {
    const review_r1 = ctx.$implicit;
    const ctx_r2 = \u0275\u0275nextContext(2);
    \u0275\u0275advance(7);
    \u0275\u0275textInterpolate(review_r1.customer_name);
    \u0275\u0275advance();
    \u0275\u0275conditional(review_r1.pet_name ? 8 : -1);
    \u0275\u0275advance(2);
    \u0275\u0275repeater(\u0275\u0275pureFunction0(5, _c0));
    \u0275\u0275advance(3);
    \u0275\u0275textInterpolate(review_r1.comment);
    \u0275\u0275advance();
    \u0275\u0275conditional(review_r1.service_type ? 14 : -1);
    \u0275\u0275advance(2);
    \u0275\u0275textInterpolate(ctx_r2.formatDate(review_r1.created_at));
  }
}
function ReviewsComponent_Conditional_6_Template(rf, ctx) {
  if (rf & 1) {
    \u0275\u0275elementStart(0, "div", 4);
    \u0275\u0275repeaterCreate(1, ReviewsComponent_Conditional_6_For_2_Template, 17, 6, "div", 32, _forTrack0);
    \u0275\u0275elementEnd();
  }
  if (rf & 2) {
    const ctx_r2 = \u0275\u0275nextContext();
    \u0275\u0275advance();
    \u0275\u0275repeater(ctx_r2.reviews);
  }
}
function ReviewsComponent_Conditional_7_Template(rf, ctx) {
  if (rf & 1) {
    \u0275\u0275elementStart(0, "div", 5);
    \u0275\u0275element(1, "i", 42);
    \u0275\u0275elementStart(2, "p");
    \u0275\u0275text(3, "S\xE9 el primero en dejar una rese\xF1a");
    \u0275\u0275elementEnd()();
  }
}
function ReviewsComponent_For_44_Template(rf, ctx) {
  if (rf & 1) {
    const _r4 = \u0275\u0275getCurrentView();
    \u0275\u0275elementStart(0, "button", 43);
    \u0275\u0275listener("click", function ReviewsComponent_For_44_Template_button_click_0_listener() {
      const star_r5 = \u0275\u0275restoreView(_r4).$implicit;
      const ctx_r2 = \u0275\u0275nextContext();
      return \u0275\u0275resetView(ctx_r2.setRating(star_r5));
    });
    \u0275\u0275element(1, "i", 2);
    \u0275\u0275elementEnd();
  }
  if (rf & 2) {
    let tmp_10_0;
    const star_r5 = ctx.$implicit;
    const ctx_r2 = \u0275\u0275nextContext();
    \u0275\u0275classProp("selected", star_r5 <= (((tmp_10_0 = ctx_r2.reviewForm.get("rating")) == null ? null : tmp_10_0.value) || 0));
  }
}
function ReviewsComponent_Conditional_45_Template(rf, ctx) {
  if (rf & 1) {
    \u0275\u0275elementStart(0, "span", 26);
    \u0275\u0275text(1, "Por favor selecciona una calificaci\xF3n");
    \u0275\u0275elementEnd();
  }
}
function ReviewsComponent_Conditional_52_Template(rf, ctx) {
  if (rf & 1) {
    \u0275\u0275element(0, "i", 31);
    \u0275\u0275text(1, " Enviando... ");
  }
}
function ReviewsComponent_Conditional_53_Template(rf, ctx) {
  if (rf & 1) {
    \u0275\u0275element(0, "i", 44);
    \u0275\u0275text(1, " Enviar Rese\xF1a ");
  }
}
var ReviewsComponent = class _ReviewsComponent {
  constructor(fb, reviewsService, notificationService) {
    this.fb = fb;
    this.reviewsService = reviewsService;
    this.notificationService = notificationService;
    this.reviews = [];
    this.displayedReviews = [];
    this.loadingReviews = false;
    this.isSubmitting = false;
    this.currentPage = 1;
    this.itemsPerPage = 6;
    this.totalPages = 1;
    this.services = [
      { value: "consulta", label: "Consulta General" },
      { value: "vacunacion", label: "Vacunaci\xF3n" },
      { value: "peluqueria", label: "Peluquer\xEDa" },
      { value: "emergencia", label: "Emergencia" }
    ];
    this.reviewForm = this.fb.group({
      customer_name: ["", [Validators.required, Validators.minLength(2)]],
      pet_name: [""],
      service_type: [""],
      rating: [0, [Validators.required, Validators.min(1), Validators.max(5)]],
      comment: ["", [Validators.required, Validators.minLength(10)]]
    });
  }
  ngOnInit() {
    this.loadReviews();
  }
  loadReviews() {
    this.loadingReviews = true;
    this.reviewsService.getReviews().subscribe({
      next: (reviews) => {
        this.reviews = reviews;
        this.totalPages = Math.ceil(reviews.length / this.itemsPerPage);
        this.updateDisplayedReviews();
        this.loadingReviews = false;
      },
      error: (error) => {
        console.error("Error cargando rese\xF1as:", error);
        this.loadingReviews = false;
      }
    });
  }
  updateDisplayedReviews() {
    const startIndex = (this.currentPage - 1) * this.itemsPerPage;
    const endIndex = startIndex + this.itemsPerPage;
    this.displayedReviews = this.reviews.slice(startIndex, endIndex);
  }
  nextPage() {
    if (this.currentPage < this.totalPages) {
      this.currentPage++;
      this.updateDisplayedReviews();
      window.scrollTo({ top: 0, behavior: "smooth" });
    }
  }
  previousPage() {
    if (this.currentPage > 1) {
      this.currentPage--;
      this.updateDisplayedReviews();
      window.scrollTo({ top: 0, behavior: "smooth" });
    }
  }
  goToPage(page) {
    this.currentPage = page;
    this.updateDisplayedReviews();
    window.scrollTo({ top: 0, behavior: "smooth" });
  }
  get pages() {
    return Array.from({ length: this.totalPages }, (_, i) => i + 1);
  }
  setRating(rating) {
    this.reviewForm.patchValue({ rating });
  }
  onSubmit() {
    if (this.reviewForm.valid) {
      this.isSubmitting = true;
      const reviewData = this.reviewForm.value;
      this.reviewsService.createReview(reviewData).subscribe({
        next: (response) => {
          this.isSubmitting = false;
          this.notificationService.showSuccess("\xA1Gracias por tu rese\xF1a! Se ha enviado correctamente.");
          this.reviewForm.reset();
          this.reviewForm.patchValue({ rating: 0 });
          this.loadReviews();
        },
        error: (error) => {
          this.isSubmitting = false;
          console.error("Error al enviar rese\xF1a:", error);
          this.notificationService.showError("Error al enviar la rese\xF1a. Por favor, int\xE9ntalo de nuevo.");
        }
      });
    }
  }
  getServiceLabel(value) {
    const service = this.services.find((s) => s.value === value);
    return service ? service.label : value;
  }
  formatDate(date) {
    const d = new Date(date);
    const options = {
      year: "numeric",
      month: "long",
      day: "numeric"
    };
    return d.toLocaleDateString("es-ES", options);
  }
  static {
    this.\u0275fac = function ReviewsComponent_Factory(__ngFactoryType__) {
      return new (__ngFactoryType__ || _ReviewsComponent)(\u0275\u0275directiveInject(FormBuilder), \u0275\u0275directiveInject(ReviewsService), \u0275\u0275directiveInject(NotificationService));
    };
  }
  static {
    this.\u0275cmp = /* @__PURE__ */ \u0275\u0275defineComponent({ type: _ReviewsComponent, selectors: [["app-reviews"]], standalone: true, features: [\u0275\u0275StandaloneFeature], decls: 54, vars: 10, consts: [[1, "reviews-container"], [1, "reviews-display"], [1, "fas", "fa-star"], [1, "loading"], [1, "reviews-grid"], [1, "no-reviews"], [1, "add-review"], [1, "fas", "fa-pen"], [3, "ngSubmit", "formGroup"], [1, "form-group"], ["for", "customer_name"], [1, "fas", "fa-user"], ["type", "text", "id", "customer_name", "formControlName", "customer_name", "placeholder", "Ej: Mar\xEDa Garc\xEDa"], ["for", "pet_name"], [1, "fas", "fa-paw"], ["type", "text", "id", "pet_name", "formControlName", "pet_name", "placeholder", "Ej: Max"], ["for", "service_type"], [1, "fas", "fa-briefcase-medical"], ["id", "service_type", "formControlName", "service_type"], ["value", ""], ["value", "consulta"], ["value", "vacunacion"], ["value", "peluqueria"], ["value", "emergencia"], [1, "rating-selector"], ["type", "button", 1, "star-btn", 3, "selected"], [1, "error-message"], ["for", "comment"], [1, "fas", "fa-comment"], ["id", "comment", "formControlName", "comment", "rows", "4", "placeholder", "Cu\xE9ntanos sobre tu experiencia..."], ["type", "submit", 1, "btn-submit", 3, "disabled"], [1, "fas", "fa-spinner", "fa-spin"], [1, "review-card"], [1, "review-header"], [1, "customer-info"], [1, "avatar"], [1, "pet-name"], [1, "rating"], [1, "fas", "fa-star", 3, "filled"], [1, "comment"], [1, "service-badge"], [1, "date"], [1, "fas", "fa-comments"], ["type", "button", 1, "star-btn", 3, "click"], [1, "fas", "fa-paper-plane"]], template: function ReviewsComponent_Template(rf, ctx) {
      if (rf & 1) {
        \u0275\u0275elementStart(0, "div", 0)(1, "section", 1)(2, "h2");
        \u0275\u0275element(3, "i", 2);
        \u0275\u0275text(4, " Lo que dicen nuestros clientes");
        \u0275\u0275elementEnd();
        \u0275\u0275template(5, ReviewsComponent_Conditional_5_Template, 4, 0, "div", 3)(6, ReviewsComponent_Conditional_6_Template, 3, 0, "div", 4)(7, ReviewsComponent_Conditional_7_Template, 4, 0, "div", 5);
        \u0275\u0275elementEnd();
        \u0275\u0275elementStart(8, "section", 6)(9, "h3");
        \u0275\u0275element(10, "i", 7);
        \u0275\u0275text(11, " Comparte tu experiencia");
        \u0275\u0275elementEnd();
        \u0275\u0275elementStart(12, "form", 8);
        \u0275\u0275listener("ngSubmit", function ReviewsComponent_Template_form_ngSubmit_12_listener() {
          return ctx.onSubmit();
        });
        \u0275\u0275elementStart(13, "div", 9)(14, "label", 10);
        \u0275\u0275element(15, "i", 11);
        \u0275\u0275text(16, " Tu nombre * ");
        \u0275\u0275elementEnd();
        \u0275\u0275element(17, "input", 12);
        \u0275\u0275elementEnd();
        \u0275\u0275elementStart(18, "div", 9)(19, "label", 13);
        \u0275\u0275element(20, "i", 14);
        \u0275\u0275text(21, " Nombre de tu mascota ");
        \u0275\u0275elementEnd();
        \u0275\u0275element(22, "input", 15);
        \u0275\u0275elementEnd();
        \u0275\u0275elementStart(23, "div", 9)(24, "label", 16);
        \u0275\u0275element(25, "i", 17);
        \u0275\u0275text(26, " Servicio recibido ");
        \u0275\u0275elementEnd();
        \u0275\u0275elementStart(27, "select", 18)(28, "option", 19);
        \u0275\u0275text(29, "Selecciona un servicio");
        \u0275\u0275elementEnd();
        \u0275\u0275elementStart(30, "option", 20);
        \u0275\u0275text(31, "Consulta General");
        \u0275\u0275elementEnd();
        \u0275\u0275elementStart(32, "option", 21);
        \u0275\u0275text(33, "Vacunaci\xF3n");
        \u0275\u0275elementEnd();
        \u0275\u0275elementStart(34, "option", 22);
        \u0275\u0275text(35, "Peluquer\xEDa");
        \u0275\u0275elementEnd();
        \u0275\u0275elementStart(36, "option", 23);
        \u0275\u0275text(37, "Emergencia");
        \u0275\u0275elementEnd()()();
        \u0275\u0275elementStart(38, "div", 9)(39, "label");
        \u0275\u0275element(40, "i", 2);
        \u0275\u0275text(41, " Calificaci\xF3n * ");
        \u0275\u0275elementEnd();
        \u0275\u0275elementStart(42, "div", 24);
        \u0275\u0275repeaterCreate(43, ReviewsComponent_For_44_Template, 2, 2, "button", 25, \u0275\u0275repeaterTrackByIdentity);
        \u0275\u0275elementEnd();
        \u0275\u0275template(45, ReviewsComponent_Conditional_45_Template, 2, 0, "span", 26);
        \u0275\u0275elementEnd();
        \u0275\u0275elementStart(46, "div", 9)(47, "label", 27);
        \u0275\u0275element(48, "i", 28);
        \u0275\u0275text(49, " Tu opini\xF3n * ");
        \u0275\u0275elementEnd();
        \u0275\u0275element(50, "textarea", 29);
        \u0275\u0275elementEnd();
        \u0275\u0275elementStart(51, "button", 30);
        \u0275\u0275template(52, ReviewsComponent_Conditional_52_Template, 2, 0)(53, ReviewsComponent_Conditional_53_Template, 2, 0);
        \u0275\u0275elementEnd()()()();
      }
      if (rf & 2) {
        let tmp_2_0;
        let tmp_4_0;
        let tmp_5_0;
        \u0275\u0275advance(5);
        \u0275\u0275conditional(ctx.loadingReviews ? 5 : ctx.reviews.length > 0 ? 6 : 7);
        \u0275\u0275advance(7);
        \u0275\u0275property("formGroup", ctx.reviewForm);
        \u0275\u0275advance(5);
        \u0275\u0275classProp("error", ((tmp_2_0 = ctx.reviewForm.get("customer_name")) == null ? null : tmp_2_0.invalid) && ((tmp_2_0 = ctx.reviewForm.get("customer_name")) == null ? null : tmp_2_0.touched));
        \u0275\u0275advance(26);
        \u0275\u0275repeater(\u0275\u0275pureFunction0(9, _c0));
        \u0275\u0275advance(2);
        \u0275\u0275conditional(((tmp_4_0 = ctx.reviewForm.get("rating")) == null ? null : tmp_4_0.invalid) && ((tmp_4_0 = ctx.reviewForm.get("rating")) == null ? null : tmp_4_0.touched) ? 45 : -1);
        \u0275\u0275advance(5);
        \u0275\u0275classProp("error", ((tmp_5_0 = ctx.reviewForm.get("comment")) == null ? null : tmp_5_0.invalid) && ((tmp_5_0 = ctx.reviewForm.get("comment")) == null ? null : tmp_5_0.touched));
        \u0275\u0275advance();
        \u0275\u0275property("disabled", ctx.reviewForm.invalid || ctx.isSubmitting);
        \u0275\u0275advance();
        \u0275\u0275conditional(ctx.isSubmitting ? 52 : 53);
      }
    }, dependencies: [CommonModule, ReactiveFormsModule, \u0275NgNoValidate, NgSelectOption, \u0275NgSelectMultipleOption, DefaultValueAccessor, SelectControlValueAccessor, NgControlStatus, NgControlStatusGroup, FormGroupDirective, FormControlName], styles: ["\n\n.reviews-container[_ngcontent-%COMP%] {\n  max-width: 1200px;\n  margin: 0 auto;\n  padding: 2rem;\n}\n.reviews-display[_ngcontent-%COMP%] {\n  margin-bottom: 4rem;\n}\n.reviews-display[_ngcontent-%COMP%]   h2[_ngcontent-%COMP%] {\n  text-align: center;\n  color: var(--color-primary);\n  font-size: 2rem;\n  margin-bottom: 2rem;\n  display: flex;\n  align-items: center;\n  justify-content: center;\n  gap: 0.5rem;\n}\n.loading[_ngcontent-%COMP%], \n.no-reviews[_ngcontent-%COMP%] {\n  text-align: center;\n  padding: 3rem;\n  color: #666;\n}\n.loading[_ngcontent-%COMP%]   i[_ngcontent-%COMP%], \n.no-reviews[_ngcontent-%COMP%]   i[_ngcontent-%COMP%] {\n  font-size: 3rem;\n  color: var(--color-primary);\n  margin-bottom: 1rem;\n}\n.reviews-grid[_ngcontent-%COMP%] {\n  display: grid;\n  grid-template-columns: repeat(auto-fill, minmax(350px, 1fr));\n  gap: 2rem;\n}\n.review-card[_ngcontent-%COMP%] {\n  background: white;\n  border-radius: 1rem;\n  padding: 1.5rem;\n  box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);\n  transition: transform 0.3s;\n}\n.review-card[_ngcontent-%COMP%]:hover {\n  transform: translateY(-4px);\n  box-shadow: 0 4px 16px rgba(0, 0, 0, 0.15);\n}\n.review-header[_ngcontent-%COMP%] {\n  display: flex;\n  justify-content: space-between;\n  align-items: flex-start;\n  margin-bottom: 1rem;\n}\n.customer-info[_ngcontent-%COMP%] {\n  display: flex;\n  gap: 1rem;\n  align-items: center;\n}\n.avatar[_ngcontent-%COMP%] {\n  width: 50px;\n  height: 50px;\n  border-radius: 50%;\n  background:\n    linear-gradient(\n      135deg,\n      var(--color-primary),\n      var(--color-secondary));\n  display: flex;\n  align-items: center;\n  justify-content: center;\n  color: white;\n  font-size: 1.5rem;\n}\n.customer-info[_ngcontent-%COMP%]   h4[_ngcontent-%COMP%] {\n  margin: 0;\n  color: #333;\n}\n.pet-name[_ngcontent-%COMP%] {\n  margin: 0.25rem 0 0 0;\n  color: #666;\n  font-size: 0.875rem;\n}\n.rating[_ngcontent-%COMP%] {\n  display: flex;\n  gap: 0.25rem;\n}\n.rating[_ngcontent-%COMP%]   i[_ngcontent-%COMP%] {\n  color: #ddd;\n  font-size: 1.2rem;\n}\n.rating[_ngcontent-%COMP%]   i.filled[_ngcontent-%COMP%] {\n  color: #ffc107;\n}\n.comment[_ngcontent-%COMP%] {\n  color: #555;\n  line-height: 1.6;\n  margin: 1rem 0;\n}\n.service-badge[_ngcontent-%COMP%] {\n  display: inline-block;\n  padding: 0.25rem 0.75rem;\n  background: var(--color-primary);\n  color: white;\n  border-radius: 1rem;\n  font-size: 0.875rem;\n  margin-right: 0.5rem;\n}\n.date[_ngcontent-%COMP%] {\n  color: #999;\n  font-size: 0.875rem;\n}\n.add-review[_ngcontent-%COMP%] {\n  background: white;\n  border-radius: 1rem;\n  padding: 2rem;\n  box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);\n}\n.add-review[_ngcontent-%COMP%]   h3[_ngcontent-%COMP%] {\n  color: var(--color-primary);\n  margin-bottom: 1.5rem;\n  display: flex;\n  align-items: center;\n  gap: 0.5rem;\n}\n.form-group[_ngcontent-%COMP%] {\n  margin-bottom: 1.5rem;\n}\n.form-group[_ngcontent-%COMP%]   label[_ngcontent-%COMP%] {\n  display: block;\n  margin-bottom: 0.5rem;\n  color: #333;\n  font-weight: 600;\n  display: flex;\n  align-items: center;\n  gap: 0.5rem;\n}\n.form-group[_ngcontent-%COMP%]   input[_ngcontent-%COMP%], \n.form-group[_ngcontent-%COMP%]   select[_ngcontent-%COMP%], \n.form-group[_ngcontent-%COMP%]   textarea[_ngcontent-%COMP%] {\n  width: 100%;\n  padding: 0.75rem;\n  border: 2px solid #e0e0e0;\n  border-radius: 0.5rem;\n  font-size: 1rem;\n  transition: border-color 0.3s;\n}\n.form-group[_ngcontent-%COMP%]   input[_ngcontent-%COMP%]:focus, \n.form-group[_ngcontent-%COMP%]   select[_ngcontent-%COMP%]:focus, \n.form-group[_ngcontent-%COMP%]   textarea[_ngcontent-%COMP%]:focus {\n  outline: none;\n  border-color: var(--color-primary);\n}\n.form-group[_ngcontent-%COMP%]   input.error[_ngcontent-%COMP%], \n.form-group[_ngcontent-%COMP%]   textarea.error[_ngcontent-%COMP%] {\n  border-color: #f44336;\n}\n.rating-selector[_ngcontent-%COMP%] {\n  display: flex;\n  gap: 0.5rem;\n}\n.star-btn[_ngcontent-%COMP%] {\n  background: none;\n  border: none;\n  font-size: 2rem;\n  color: #ddd;\n  cursor: pointer;\n  transition: all 0.3s;\n}\n.star-btn[_ngcontent-%COMP%]:hover, \n.star-btn.selected[_ngcontent-%COMP%] {\n  color: #ffc107;\n  transform: scale(1.2);\n}\n.error-message[_ngcontent-%COMP%] {\n  color: #f44336;\n  font-size: 0.875rem;\n  margin-top: 0.25rem;\n  display: block;\n}\n.btn-submit[_ngcontent-%COMP%] {\n  width: 100%;\n  padding: 1rem;\n  background: var(--color-primary);\n  color: white;\n  border: none;\n  border-radius: 0.5rem;\n  font-size: 1.1rem;\n  font-weight: 600;\n  cursor: pointer;\n  transition: all 0.3s;\n  display: flex;\n  align-items: center;\n  justify-content: center;\n  gap: 0.5rem;\n}\n.btn-submit[_ngcontent-%COMP%]:hover:not(:disabled) {\n  background: var(--color-primary-dark);\n  transform: translateY(-2px);\n  box-shadow: 0 4px 12px rgba(0, 150, 136, 0.3);\n}\n.btn-submit[_ngcontent-%COMP%]:disabled {\n  opacity: 0.6;\n  cursor: not-allowed;\n}\n@media (max-width: 768px) {\n  .reviews-grid[_ngcontent-%COMP%] {\n    grid-template-columns: 1fr;\n  }\n}\n/*# sourceMappingURL=reviews.component.css.map */"], changeDetection: 0 });
  }
};
(() => {
  (typeof ngDevMode === "undefined" || ngDevMode) && \u0275setClassDebugInfo(ReviewsComponent, { className: "ReviewsComponent", filePath: "src\\app\\features\\reviews\\reviews.component.ts", lineNumber: 387 });
})();
export {
  ReviewsComponent
};
//# sourceMappingURL=chunk-IYPYTKWR.js.map
