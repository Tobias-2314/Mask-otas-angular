import {
  takeUntilDestroyed
} from "./chunk-ZEYZDBUR.js";
import {
  ReviewsService
} from "./chunk-MWX26FBN.js";
import {
  NotificationService
} from "./chunk-AJ5OVI2A.js";
import "./chunk-Q57ULFC2.js";
import {
  CommonModule,
  DatePipe,
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
  ɵɵpipe,
  ɵɵpipeBind2,
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

// src/app/features/admin-dashboard/admin-dashboard.component.ts
var _forTrack0 = ($index, $item) => $item.id;
var _c0 = () => [1, 2, 3, 4, 5];
function AdminDashboardComponent_Conditional_11_Template(rf, ctx) {
  if (rf & 1) {
    \u0275\u0275elementStart(0, "div", 6)(1, "div", 8)(2, "h3");
    \u0275\u0275text(3, "Total Rese\xF1as");
    \u0275\u0275elementEnd();
    \u0275\u0275elementStart(4, "p", 9);
    \u0275\u0275text(5);
    \u0275\u0275elementEnd()();
    \u0275\u0275elementStart(6, "div", 8)(7, "h3");
    \u0275\u0275text(8, "Rating Promedio");
    \u0275\u0275elementEnd();
    \u0275\u0275elementStart(9, "p", 9);
    \u0275\u0275text(10);
    \u0275\u0275elementEnd()();
    \u0275\u0275elementStart(11, "div", 8)(12, "h3");
    \u0275\u0275text(13, "Rese\xF1as Pendientes");
    \u0275\u0275elementEnd();
    \u0275\u0275elementStart(14, "p", 9);
    \u0275\u0275text(15);
    \u0275\u0275elementEnd()()();
  }
  if (rf & 2) {
    const ctx_r0 = \u0275\u0275nextContext();
    \u0275\u0275advance(5);
    \u0275\u0275textInterpolate(ctx_r0.stats.totalReviews);
    \u0275\u0275advance(5);
    \u0275\u0275textInterpolate(ctx_r0.stats.averageRating);
    \u0275\u0275advance(5);
    \u0275\u0275textInterpolate(ctx_r0.stats.pendingReviews);
  }
}
function AdminDashboardComponent_Conditional_12_Conditional_7_Template(rf, ctx) {
  if (rf & 1) {
    \u0275\u0275elementStart(0, "div", 13);
    \u0275\u0275element(1, "i", 15);
    \u0275\u0275text(2, " Cargando datos... ");
    \u0275\u0275elementEnd();
  }
}
function AdminDashboardComponent_Conditional_12_Conditional_8_For_20_Conditional_8_Template(rf, ctx) {
  if (rf & 1) {
    \u0275\u0275elementStart(0, "span", 19);
    \u0275\u0275text(1);
    \u0275\u0275elementEnd();
  }
  if (rf & 2) {
    const review_r4 = \u0275\u0275nextContext().$implicit;
    \u0275\u0275advance();
    \u0275\u0275textInterpolate(review_r4.pet_name);
  }
}
function AdminDashboardComponent_Conditional_12_Conditional_8_For_20_For_14_Template(rf, ctx) {
  if (rf & 1) {
    \u0275\u0275element(0, "i", 30);
  }
  if (rf & 2) {
    const star_r5 = ctx.$implicit;
    const review_r4 = \u0275\u0275nextContext().$implicit;
    \u0275\u0275classProp("filled", star_r5 <= review_r4.rating);
  }
}
function AdminDashboardComponent_Conditional_12_Conditional_8_For_20_Conditional_18_Template(rf, ctx) {
  if (rf & 1) {
    \u0275\u0275elementStart(0, "span", 23);
    \u0275\u0275text(1, "Visible");
    \u0275\u0275elementEnd();
  }
}
function AdminDashboardComponent_Conditional_12_Conditional_8_For_20_Conditional_19_Template(rf, ctx) {
  if (rf & 1) {
    \u0275\u0275elementStart(0, "span", 24);
    \u0275\u0275text(1, "Oculto");
    \u0275\u0275elementEnd();
  }
}
function AdminDashboardComponent_Conditional_12_Conditional_8_For_20_Conditional_22_Template(rf, ctx) {
  if (rf & 1) {
    const _r6 = \u0275\u0275getCurrentView();
    \u0275\u0275elementStart(0, "button", 31);
    \u0275\u0275listener("click", function AdminDashboardComponent_Conditional_12_Conditional_8_For_20_Conditional_22_Template_button_click_0_listener() {
      \u0275\u0275restoreView(_r6);
      const review_r4 = \u0275\u0275nextContext().$implicit;
      const ctx_r0 = \u0275\u0275nextContext(3);
      return \u0275\u0275resetView(ctx_r0.approveReview(review_r4.id));
    });
    \u0275\u0275element(1, "i", 32);
    \u0275\u0275elementEnd();
  }
}
function AdminDashboardComponent_Conditional_12_Conditional_8_For_20_Conditional_23_Template(rf, ctx) {
  if (rf & 1) {
    const _r7 = \u0275\u0275getCurrentView();
    \u0275\u0275elementStart(0, "button", 33);
    \u0275\u0275listener("click", function AdminDashboardComponent_Conditional_12_Conditional_8_For_20_Conditional_23_Template_button_click_0_listener() {
      \u0275\u0275restoreView(_r7);
      const review_r4 = \u0275\u0275nextContext().$implicit;
      const ctx_r0 = \u0275\u0275nextContext(3);
      return \u0275\u0275resetView(ctx_r0.hideReview(review_r4.id));
    });
    \u0275\u0275element(1, "i", 34);
    \u0275\u0275elementEnd();
  }
}
function AdminDashboardComponent_Conditional_12_Conditional_8_For_20_Template(rf, ctx) {
  if (rf & 1) {
    const _r3 = \u0275\u0275getCurrentView();
    \u0275\u0275elementStart(0, "tr")(1, "td");
    \u0275\u0275text(2);
    \u0275\u0275pipe(3, "date");
    \u0275\u0275elementEnd();
    \u0275\u0275elementStart(4, "td")(5, "div", 17)(6, "span", 18);
    \u0275\u0275text(7);
    \u0275\u0275elementEnd();
    \u0275\u0275template(8, AdminDashboardComponent_Conditional_12_Conditional_8_For_20_Conditional_8_Template, 2, 1, "span", 19);
    \u0275\u0275elementEnd()();
    \u0275\u0275elementStart(9, "td");
    \u0275\u0275text(10);
    \u0275\u0275elementEnd();
    \u0275\u0275elementStart(11, "td")(12, "div", 20);
    \u0275\u0275repeaterCreate(13, AdminDashboardComponent_Conditional_12_Conditional_8_For_20_For_14_Template, 1, 2, "i", 21, \u0275\u0275repeaterTrackByIdentity);
    \u0275\u0275elementEnd()();
    \u0275\u0275elementStart(15, "td", 22);
    \u0275\u0275text(16);
    \u0275\u0275elementEnd();
    \u0275\u0275elementStart(17, "td");
    \u0275\u0275template(18, AdminDashboardComponent_Conditional_12_Conditional_8_For_20_Conditional_18_Template, 2, 0, "span", 23)(19, AdminDashboardComponent_Conditional_12_Conditional_8_For_20_Conditional_19_Template, 2, 0, "span", 24);
    \u0275\u0275elementEnd();
    \u0275\u0275elementStart(20, "td")(21, "div", 25);
    \u0275\u0275template(22, AdminDashboardComponent_Conditional_12_Conditional_8_For_20_Conditional_22_Template, 2, 0, "button", 26)(23, AdminDashboardComponent_Conditional_12_Conditional_8_For_20_Conditional_23_Template, 2, 0, "button", 27);
    \u0275\u0275elementStart(24, "button", 28);
    \u0275\u0275listener("click", function AdminDashboardComponent_Conditional_12_Conditional_8_For_20_Template_button_click_24_listener() {
      const review_r4 = \u0275\u0275restoreView(_r3).$implicit;
      const ctx_r0 = \u0275\u0275nextContext(3);
      return \u0275\u0275resetView(ctx_r0.deleteReview(review_r4.id));
    });
    \u0275\u0275element(25, "i", 29);
    \u0275\u0275elementEnd()()()();
  }
  if (rf & 2) {
    const review_r4 = ctx.$implicit;
    \u0275\u0275advance(2);
    \u0275\u0275textInterpolate(\u0275\u0275pipeBind2(3, 8, review_r4.created_at, "shortDate"));
    \u0275\u0275advance(5);
    \u0275\u0275textInterpolate(review_r4.customer_name);
    \u0275\u0275advance();
    \u0275\u0275conditional(review_r4.pet_name ? 8 : -1);
    \u0275\u0275advance(2);
    \u0275\u0275textInterpolate(review_r4.service_type || "-");
    \u0275\u0275advance(3);
    \u0275\u0275repeater(\u0275\u0275pureFunction0(11, _c0));
    \u0275\u0275advance(2);
    \u0275\u0275property("title", review_r4.comment);
    \u0275\u0275advance();
    \u0275\u0275textInterpolate1(" ", review_r4.comment, " ");
    \u0275\u0275advance(2);
    \u0275\u0275conditional(review_r4.is_visible ? 18 : 19);
    \u0275\u0275advance(4);
    \u0275\u0275conditional(!review_r4.is_visible ? 22 : 23);
  }
}
function AdminDashboardComponent_Conditional_12_Conditional_8_Template(rf, ctx) {
  if (rf & 1) {
    \u0275\u0275elementStart(0, "div", 14)(1, "table", 16)(2, "thead")(3, "tr")(4, "th");
    \u0275\u0275text(5, "Fecha");
    \u0275\u0275elementEnd();
    \u0275\u0275elementStart(6, "th");
    \u0275\u0275text(7, "Cliente");
    \u0275\u0275elementEnd();
    \u0275\u0275elementStart(8, "th");
    \u0275\u0275text(9, "Servicio");
    \u0275\u0275elementEnd();
    \u0275\u0275elementStart(10, "th");
    \u0275\u0275text(11, "Rating");
    \u0275\u0275elementEnd();
    \u0275\u0275elementStart(12, "th");
    \u0275\u0275text(13, "Comentario");
    \u0275\u0275elementEnd();
    \u0275\u0275elementStart(14, "th");
    \u0275\u0275text(15, "Estado");
    \u0275\u0275elementEnd();
    \u0275\u0275elementStart(16, "th");
    \u0275\u0275text(17, "Acciones");
    \u0275\u0275elementEnd()()();
    \u0275\u0275elementStart(18, "tbody");
    \u0275\u0275repeaterCreate(19, AdminDashboardComponent_Conditional_12_Conditional_8_For_20_Template, 26, 12, "tr", null, _forTrack0);
    \u0275\u0275elementEnd()()();
  }
  if (rf & 2) {
    const ctx_r0 = \u0275\u0275nextContext(2);
    \u0275\u0275advance(19);
    \u0275\u0275repeater(ctx_r0.reviews);
  }
}
function AdminDashboardComponent_Conditional_12_Template(rf, ctx) {
  if (rf & 1) {
    const _r2 = \u0275\u0275getCurrentView();
    \u0275\u0275elementStart(0, "div", 7)(1, "div", 10)(2, "h2");
    \u0275\u0275text(3, "Administrar Rese\xF1as");
    \u0275\u0275elementEnd();
    \u0275\u0275elementStart(4, "button", 11);
    \u0275\u0275listener("click", function AdminDashboardComponent_Conditional_12_Template_button_click_4_listener() {
      \u0275\u0275restoreView(_r2);
      const ctx_r0 = \u0275\u0275nextContext();
      return \u0275\u0275resetView(ctx_r0.loadReviews());
    });
    \u0275\u0275element(5, "i", 12);
    \u0275\u0275text(6, " Actualizar ");
    \u0275\u0275elementEnd()();
    \u0275\u0275template(7, AdminDashboardComponent_Conditional_12_Conditional_7_Template, 3, 0, "div", 13)(8, AdminDashboardComponent_Conditional_12_Conditional_8_Template, 21, 0, "div", 14);
    \u0275\u0275elementEnd();
  }
  if (rf & 2) {
    const ctx_r0 = \u0275\u0275nextContext();
    \u0275\u0275advance(7);
    \u0275\u0275conditional(ctx_r0.loading ? 7 : 8);
  }
}
var AdminDashboardComponent = class _AdminDashboardComponent {
  constructor(reviewsService, notificationService) {
    this.reviewsService = reviewsService;
    this.notificationService = notificationService;
    this.activeTab = "dashboard";
    this.reviews = [];
    this.loading = false;
    this.stats = {
      totalReviews: 0,
      averageRating: 0,
      pendingReviews: 0
    };
  }
  ngOnInit() {
    this.loadStats();
  }
  loadStats() {
    this.reviewsService.getReviewStats().pipe(takeUntilDestroyed()).subscribe((stats) => {
      this.stats.totalReviews = stats.total;
      this.stats.averageRating = stats.average;
      this.stats.pendingReviews = 0;
    });
  }
  loadReviews() {
    this.activeTab = "reviews";
    this.loading = true;
    this.reviewsService.getAllReviewsForAdmin().pipe(takeUntilDestroyed()).subscribe({
      next: (data) => {
        this.reviews = data;
        this.loading = false;
      },
      error: (err) => {
        console.error("Error al cargar rese\xF1as", err);
        this.loading = false;
      }
    });
  }
  approveReview(id) {
    this.reviewsService.approveReview(id).pipe(takeUntilDestroyed()).subscribe({
      next: () => {
        this.notificationService.showSuccess("Rese\xF1a aprobada");
        this.loadReviews();
        this.loadStats();
      },
      error: () => this.notificationService.showError("Error al aprobar rese\xF1a")
    });
  }
  hideReview(id) {
    this.reviewsService.hideReview(id).pipe(takeUntilDestroyed()).subscribe({
      next: () => {
        this.notificationService.showSuccess("Rese\xF1a ocultada");
        this.loadReviews();
        this.loadStats();
      },
      error: () => this.notificationService.showError("Error al ocultar rese\xF1a")
    });
  }
  deleteReview(id) {
    if (confirm("\xBFEst\xE1s seguro de que quieres eliminar esta rese\xF1a?")) {
      this.reviewsService.deleteReview(id).pipe(takeUntilDestroyed()).subscribe({
        next: () => {
          this.notificationService.showSuccess("Rese\xF1a eliminada");
          this.loadReviews();
          this.loadStats();
        },
        error: () => this.notificationService.showError("Error al eliminar rese\xF1a")
      });
    }
  }
  static {
    this.\u0275fac = function AdminDashboardComponent_Factory(__ngFactoryType__) {
      return new (__ngFactoryType__ || _AdminDashboardComponent)(\u0275\u0275directiveInject(ReviewsService), \u0275\u0275directiveInject(NotificationService));
    };
  }
  static {
    this.\u0275cmp = /* @__PURE__ */ \u0275\u0275defineComponent({ type: _AdminDashboardComponent, selectors: [["app-admin-dashboard"]], standalone: true, features: [\u0275\u0275StandaloneFeature], decls: 13, vars: 6, consts: [[1, "page-container"], [1, "container"], [1, "admin-tabs"], [1, "tab-btn", 3, "click"], [1, "fas", "fa-chart-line"], [1, "fas", "fa-comments"], [1, "stats-grid"], [1, "reviews-management"], [1, "stat-card"], [1, "stat-number"], [1, "table-header"], [1, "btn-refresh", 3, "click"], [1, "fas", "fa-sync-alt"], [1, "loading"], [1, "table-responsive"], [1, "fas", "fa-spinner", "fa-spin"], [1, "admin-table"], [1, "customer-cell"], [1, "name"], [1, "pet"], [1, "rating-cell"], [1, "fas", "fa-star", 3, "filled"], [1, "comment-cell", 3, "title"], [1, "badge", "approved"], [1, "badge", "hidden"], [1, "actions"], ["title", "Aprobar", 1, "btn-icon", "approve"], ["title", "Ocultar", 1, "btn-icon", "hide"], ["title", "Eliminar", 1, "btn-icon", "delete", 3, "click"], [1, "fas", "fa-trash"], [1, "fas", "fa-star"], ["title", "Aprobar", 1, "btn-icon", "approve", 3, "click"], [1, "fas", "fa-check"], ["title", "Ocultar", 1, "btn-icon", "hide", 3, "click"], [1, "fas", "fa-eye-slash"]], template: function AdminDashboardComponent_Template(rf, ctx) {
      if (rf & 1) {
        \u0275\u0275elementStart(0, "div", 0)(1, "div", 1)(2, "h1");
        \u0275\u0275text(3, "Dashboard Administrativo");
        \u0275\u0275elementEnd();
        \u0275\u0275elementStart(4, "div", 2)(5, "button", 3);
        \u0275\u0275listener("click", function AdminDashboardComponent_Template_button_click_5_listener() {
          return ctx.activeTab = "dashboard";
        });
        \u0275\u0275element(6, "i", 4);
        \u0275\u0275text(7, " Resumen ");
        \u0275\u0275elementEnd();
        \u0275\u0275elementStart(8, "button", 3);
        \u0275\u0275listener("click", function AdminDashboardComponent_Template_button_click_8_listener() {
          return ctx.loadReviews();
        });
        \u0275\u0275element(9, "i", 5);
        \u0275\u0275text(10, " Gesti\xF3n de Rese\xF1as ");
        \u0275\u0275elementEnd()();
        \u0275\u0275template(11, AdminDashboardComponent_Conditional_11_Template, 16, 3, "div", 6)(12, AdminDashboardComponent_Conditional_12_Template, 9, 1, "div", 7);
        \u0275\u0275elementEnd()();
      }
      if (rf & 2) {
        \u0275\u0275advance(5);
        \u0275\u0275classProp("active", ctx.activeTab === "dashboard");
        \u0275\u0275advance(3);
        \u0275\u0275classProp("active", ctx.activeTab === "reviews");
        \u0275\u0275advance(3);
        \u0275\u0275conditional(ctx.activeTab === "dashboard" ? 11 : -1);
        \u0275\u0275advance();
        \u0275\u0275conditional(ctx.activeTab === "reviews" ? 12 : -1);
      }
    }, dependencies: [CommonModule, DatePipe], styles: ["\n\n.page-container[_ngcontent-%COMP%] {\n  min-height: calc(100vh - 200px);\n  padding: 4rem 0;\n  background-color: var(--color-bg-gray);\n}\nh1[_ngcontent-%COMP%] {\n  font-size: 2.5rem;\n  color: var(--color-primary);\n  text-align: center;\n  margin-bottom: 2rem;\n}\n.admin-tabs[_ngcontent-%COMP%] {\n  display: flex;\n  justify-content: center;\n  gap: 1rem;\n  margin-bottom: 2rem;\n}\n.tab-btn[_ngcontent-%COMP%] {\n  padding: 0.75rem 1.5rem;\n  background: white;\n  border: none;\n  border-radius: 0.5rem;\n  font-weight: 600;\n  color: #666;\n  cursor: pointer;\n  transition: all 0.3s;\n  display: flex;\n  align-items: center;\n  gap: 0.5rem;\n}\n.tab-btn.active[_ngcontent-%COMP%] {\n  background: var(--color-primary);\n  color: white;\n  transform: translateY(-2px);\n  box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);\n}\n.stats-grid[_ngcontent-%COMP%] {\n  display: grid;\n  grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));\n  gap: 2rem;\n  margin-top: 2rem;\n}\n.stat-card[_ngcontent-%COMP%] {\n  background: white;\n  padding: 2rem;\n  border-radius: 0.5rem;\n  box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);\n  text-align: center;\n}\n.stat-card[_ngcontent-%COMP%]   h3[_ngcontent-%COMP%] {\n  color: var(--color-primary);\n  margin-bottom: 1rem;\n}\n.stat-number[_ngcontent-%COMP%] {\n  font-size: 3rem;\n  font-weight: bold;\n  color: var(--color-primary);\n  margin: 0;\n}\n.reviews-management[_ngcontent-%COMP%] {\n  background: white;\n  border-radius: 0.5rem;\n  padding: 1.5rem;\n  box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);\n}\n.table-header[_ngcontent-%COMP%] {\n  display: flex;\n  justify-content: space-between;\n  align-items: center;\n  margin-bottom: 1.5rem;\n}\n.admin-table[_ngcontent-%COMP%] {\n  width: 100%;\n  border-collapse: collapse;\n}\n.admin-table[_ngcontent-%COMP%]   th[_ngcontent-%COMP%], \n.admin-table[_ngcontent-%COMP%]   td[_ngcontent-%COMP%] {\n  padding: 1rem;\n  text-align: left;\n  border-bottom: 1px solid #eee;\n}\n.admin-table[_ngcontent-%COMP%]   th[_ngcontent-%COMP%] {\n  background-color: #f8f9fa;\n  color: #333;\n  font-weight: 600;\n}\n.customer-cell[_ngcontent-%COMP%] {\n  display: flex;\n  flex-direction: column;\n}\n.customer-cell[_ngcontent-%COMP%]   .pet[_ngcontent-%COMP%] {\n  font-size: 0.85rem;\n  color: #666;\n}\n.rating-cell[_ngcontent-%COMP%] {\n  display: flex;\n  gap: 2px;\n  color: #ddd;\n}\n.rating-cell[_ngcontent-%COMP%]   .filled[_ngcontent-%COMP%] {\n  color: #ffc107;\n}\n.comment-cell[_ngcontent-%COMP%] {\n  max-width: 300px;\n  white-space: nowrap;\n  overflow: hidden;\n  text-overflow: ellipsis;\n  color: #555;\n}\n.badge[_ngcontent-%COMP%] {\n  padding: 0.25rem 0.75rem;\n  border-radius: 1rem;\n  font-size: 0.85rem;\n  font-weight: 600;\n}\n.badge.approved[_ngcontent-%COMP%] {\n  background-color: #dcfce7;\n  color: #166534;\n}\n.badge.hidden[_ngcontent-%COMP%] {\n  background-color: #fee2e2;\n  color: #991b1b;\n}\n.actions[_ngcontent-%COMP%] {\n  display: flex;\n  gap: 0.5rem;\n}\n.btn-icon[_ngcontent-%COMP%] {\n  width: 32px;\n  height: 32px;\n  border-radius: 4px;\n  border: none;\n  cursor: pointer;\n  display: flex;\n  align-items: center;\n  justify-content: center;\n  transition: all 0.2s;\n}\n.btn-icon.approve[_ngcontent-%COMP%] {\n  background-color: #dcfce7;\n  color: #166534;\n}\n.btn-icon.hide[_ngcontent-%COMP%] {\n  background-color: #fff7ed;\n  color: #9a3412;\n}\n.btn-icon.delete[_ngcontent-%COMP%] {\n  background-color: #fee2e2;\n  color: #991b1b;\n}\n.btn-icon[_ngcontent-%COMP%]:hover {\n  transform: scale(1.1);\n}\n/*# sourceMappingURL=admin-dashboard.component.css.map */"] });
  }
};
(() => {
  (typeof ngDevMode === "undefined" || ngDevMode) && \u0275setClassDebugInfo(AdminDashboardComponent, { className: "AdminDashboardComponent", filePath: "src\\app\\features\\admin-dashboard\\admin-dashboard.component.ts", lineNumber: 320 });
})();
export {
  AdminDashboardComponent
};
//# sourceMappingURL=chunk-CNGWRIAF.js.map
