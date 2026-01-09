import {
  CommonModule,
  ɵsetClassDebugInfo,
  ɵɵStandaloneFeature,
  ɵɵdefineComponent,
  ɵɵelement,
  ɵɵelementEnd,
  ɵɵelementStart,
  ɵɵtext
} from "./chunk-36WUFF5E.js";

// src/app/features/services/services.component.ts
var ServicesComponent = class _ServicesComponent {
  static {
    this.\u0275fac = function ServicesComponent_Factory(__ngFactoryType__) {
      return new (__ngFactoryType__ || _ServicesComponent)();
    };
  }
  static {
    this.\u0275cmp = /* @__PURE__ */ \u0275\u0275defineComponent({ type: _ServicesComponent, selectors: [["app-services"]], standalone: true, features: [\u0275\u0275StandaloneFeature], decls: 50, vars: 0, consts: [[1, "page-container"], [1, "services-detail"], [1, "container"], ["id", "revision", 1, "service-section"], [1, "fas", "fa-heartbeat"], ["id", "vacunacion", 1, "service-section"], [1, "fas", "fa-syringe"], ["id", "peluqueria", 1, "service-section"], [1, "fas", "fa-cut"]], template: function ServicesComponent_Template(rf, ctx) {
      if (rf & 1) {
        \u0275\u0275elementStart(0, "div", 0)(1, "section", 1)(2, "div", 2)(3, "h1");
        \u0275\u0275text(4, "Nuestros Servicios");
        \u0275\u0275elementEnd();
        \u0275\u0275elementStart(5, "div", 3)(6, "h2");
        \u0275\u0275element(7, "i", 4);
        \u0275\u0275text(8, " Consultas y Chequeos");
        \u0275\u0275elementEnd();
        \u0275\u0275elementStart(9, "p");
        \u0275\u0275text(10, "Ofrecemos consultas veterinarias completas con profesionales experimentados. Realizamos chequeos regulares, diagn\xF3sticos y tratamientos personalizados para mantener a tu mascota en \xF3ptimo estado de salud.");
        \u0275\u0275elementEnd();
        \u0275\u0275elementStart(11, "ul")(12, "li");
        \u0275\u0275text(13, "Consultas generales");
        \u0275\u0275elementEnd();
        \u0275\u0275elementStart(14, "li");
        \u0275\u0275text(15, "Chequeos preventivos");
        \u0275\u0275elementEnd();
        \u0275\u0275elementStart(16, "li");
        \u0275\u0275text(17, "Diagn\xF3stico y tratamiento");
        \u0275\u0275elementEnd();
        \u0275\u0275elementStart(18, "li");
        \u0275\u0275text(19, "Seguimiento personalizado");
        \u0275\u0275elementEnd()()();
        \u0275\u0275elementStart(20, "div", 5)(21, "h2");
        \u0275\u0275element(22, "i", 6);
        \u0275\u0275text(23, " Vacunaci\xF3n");
        \u0275\u0275elementEnd();
        \u0275\u0275elementStart(24, "p");
        \u0275\u0275text(25, "Contamos con un completo programa de vacunaci\xF3n para proteger a tu mascota contra enfermedades comunes. Nuestro calendario de vacunaci\xF3n est\xE1 adaptado a las necesidades espec\xEDficas de cada animal.");
        \u0275\u0275elementEnd();
        \u0275\u0275elementStart(26, "ul")(27, "li");
        \u0275\u0275text(28, "Vacunas obligatorias");
        \u0275\u0275elementEnd();
        \u0275\u0275elementStart(29, "li");
        \u0275\u0275text(30, "Vacunas optativas");
        \u0275\u0275elementEnd();
        \u0275\u0275elementStart(31, "li");
        \u0275\u0275text(32, "Cartilla de vacunaci\xF3n");
        \u0275\u0275elementEnd();
        \u0275\u0275elementStart(33, "li");
        \u0275\u0275text(34, "Recordatorios autom\xE1ticos");
        \u0275\u0275elementEnd()()();
        \u0275\u0275elementStart(35, "div", 7)(36, "h2");
        \u0275\u0275element(37, "i", 8);
        \u0275\u0275text(38, " Peluquer\xEDa Canina y Felina");
        \u0275\u0275elementEnd();
        \u0275\u0275elementStart(39, "p");
        \u0275\u0275text(40, "Servicios profesionales de grooming para mantener a tu mascota limpia, saludable y hermosa. Utilizamos productos de alta calidad y t\xE9cnicas especializadas.");
        \u0275\u0275elementEnd();
        \u0275\u0275elementStart(41, "ul")(42, "li");
        \u0275\u0275text(43, "Ba\xF1o y secado");
        \u0275\u0275elementEnd();
        \u0275\u0275elementStart(44, "li");
        \u0275\u0275text(45, "Corte de pelo");
        \u0275\u0275elementEnd();
        \u0275\u0275elementStart(46, "li");
        \u0275\u0275text(47, "Corte de u\xF1as");
        \u0275\u0275elementEnd();
        \u0275\u0275elementStart(48, "li");
        \u0275\u0275text(49, "Limpieza de o\xEDdos");
        \u0275\u0275elementEnd()()()()()();
      }
    }, dependencies: [CommonModule], styles: ['@charset "UTF-8";\n\n\n\n.page-container[_ngcontent-%COMP%] {\n  min-height: calc(100vh - 200px);\n  padding: 4rem 0;\n}\n.services-detail[_ngcontent-%COMP%]   h1[_ngcontent-%COMP%] {\n  font-size: 2.5rem;\n  color: var(--color-primary);\n  text-align: center;\n  margin-bottom: 3rem;\n}\n.service-section[_ngcontent-%COMP%] {\n  background: white;\n  padding: 2rem;\n  margin-bottom: 2rem;\n  border-radius: 0.5rem;\n  box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);\n}\n.service-section[_ngcontent-%COMP%]   h2[_ngcontent-%COMP%] {\n  color: var(--color-primary);\n  margin-bottom: 1rem;\n  font-size: 1.5rem;\n}\n.service-section[_ngcontent-%COMP%]   p[_ngcontent-%COMP%] {\n  color: var(--color-text-gray);\n  line-height: 1.6;\n  margin-bottom: 1rem;\n}\n.service-section[_ngcontent-%COMP%]   ul[_ngcontent-%COMP%] {\n  list-style: none;\n  padding-left: 0;\n}\n.service-section[_ngcontent-%COMP%]   li[_ngcontent-%COMP%] {\n  padding: 0.5rem 0;\n  padding-left: 1.5rem;\n  position: relative;\n}\n.service-section[_ngcontent-%COMP%]   li[_ngcontent-%COMP%]::before {\n  content: "\\2713";\n  position: absolute;\n  left: 0;\n  color: var(--color-primary);\n  font-weight: bold;\n}\n/*# sourceMappingURL=services.component.css.map */'], changeDetection: 0 });
  }
};
(() => {
  (typeof ngDevMode === "undefined" || ngDevMode) && \u0275setClassDebugInfo(ServicesComponent, { className: "ServicesComponent", filePath: "src\\app\\features\\services\\services.component.ts", lineNumber: 104 });
})();
export {
  ServicesComponent
};
//# sourceMappingURL=chunk-ZF7L2VZA.js.map
