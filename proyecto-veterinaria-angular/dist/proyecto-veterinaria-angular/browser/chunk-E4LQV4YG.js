import {
  AuthService
} from "./chunk-JGFDI6YL.js";
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
  NgSelectOption,
  ReactiveFormsModule,
  RequiredValidator,
  SelectControlValueAccessor,
  Validators,
  ɵNgNoValidate,
  ɵNgSelectMultipleOption
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
  NgForOf,
  __spreadProps,
  __spreadValues,
  catchError,
  map,
  of,
  ɵsetClassDebugInfo,
  ɵɵStandaloneFeature,
  ɵɵadvance,
  ɵɵclassMap,
  ɵɵclassProp,
  ɵɵconditional,
  ɵɵdefineComponent,
  ɵɵdefineInjectable,
  ɵɵdirectiveInject,
  ɵɵelement,
  ɵɵelementEnd,
  ɵɵelementStart,
  ɵɵgetCurrentView,
  ɵɵinject,
  ɵɵlistener,
  ɵɵnextContext,
  ɵɵproperty,
  ɵɵrepeater,
  ɵɵrepeaterCreate,
  ɵɵrepeaterTrackByIdentity,
  ɵɵresetView,
  ɵɵrestoreView,
  ɵɵtemplate,
  ɵɵtext,
  ɵɵtextInterpolate,
  ɵɵtextInterpolate1,
  ɵɵtextInterpolate2
} from "./chunk-36WUFF5E.js";

// src/app/core/services/appointments.service.ts
var AppointmentsService = class _AppointmentsService {
  constructor(http) {
    this.http = http;
    this.apiUrl = environment.apiUrl;
  }
  createAppointment(data) {
    return this.http.post(`${this.apiUrl}/appointments`, data);
  }
  getUserAppointments() {
    return this.http.get(`${this.apiUrl}/appointments`);
  }
  getAppointmentById(id) {
    return this.http.get(`${this.apiUrl}/appointments/${id}`);
  }
  updateAppointment(id, data) {
    return this.http.patch(`${this.apiUrl}/appointments/${id}`, data);
  }
  deleteAppointment(id) {
    return this.http.delete(`${this.apiUrl}/appointments/${id}`);
  }
  static {
    this.\u0275fac = function AppointmentsService_Factory(__ngFactoryType__) {
      return new (__ngFactoryType__ || _AppointmentsService)(\u0275\u0275inject(HttpClient));
    };
  }
  static {
    this.\u0275prov = /* @__PURE__ */ \u0275\u0275defineInjectable({ token: _AppointmentsService, factory: _AppointmentsService.\u0275fac, providedIn: "root" });
  }
};

// src/app/core/services/available-slots.service.ts
var AvailableSlotsService = class _AvailableSlotsService {
  constructor(http) {
    this.http = http;
    this.apiUrl = environment.apiUrl;
  }
  /**
   * Obtiene todas las citas reservadas del backend
   */
  getBookedAppointments() {
    return this.http.get(`${this.apiUrl}/appointments/all`).pipe(map((appointments) => appointments.map((apt) => ({
      preferred_date: apt.preferred_date,
      preferred_time: apt.preferred_time
    }))), catchError(() => of([])));
  }
  /**
   * Obtiene los horarios disponibles para un rango de fechas
   * @param startDate Fecha de inicio (formato: YYYY-MM-DD)
   * @param endDate Fecha de fin (formato: YYYY-MM-DD)
   * @param serviceType Tipo de servicio (opcional)
   */
  getAvailableSlots(startDate, endDate, serviceType) {
    const allSlots = this.generateAllPossibleSlots(startDate, endDate);
    return this.http.get(`${this.apiUrl}/appointments/time-slots`, {
      params: { startDate, endDate }
    }).pipe(map((bookedSlots) => {
      return this.markOccupiedSlots(allSlots, bookedSlots);
    }), catchError((error) => {
      console.error("\u274C Error al consultar time-slots:", error);
      return of(allSlots);
    }));
  }
  /**
   * Verifica si un horario específico está disponible
   */
  checkSlotAvailability(date, time) {
    return this.getBookedAppointments().pipe(map((appointments) => {
      const isBooked = appointments.some((apt) => apt.preferred_date === date && apt.preferred_time === time);
      return { available: !isBooked };
    }), catchError(() => of({ available: true })));
  }
  /**
   * Reserva temporalmente un horario (para evitar doble reserva)
   */
  reserveSlot(date, time) {
    return of({ success: true, reservationId: `temp-${Date.now()}` });
  }
  /**
   * Genera todos los horarios posibles para un rango de fechas
   */
  generateAllPossibleSlots(startDate, endDate) {
    const days = [];
    const start = new Date(startDate);
    const end = new Date(endDate);
    const dayNames = ["Domingo", "Lunes", "Martes", "Mi\xE9rcoles", "Jueves", "Viernes", "S\xE1bado"];
    const doctors = ["Dr. Garc\xEDa", "Dra. Mart\xEDnez", "Dr. L\xF3pez"];
    const workingHours = [
      "09:00",
      "09:30",
      "10:00",
      "10:30",
      "11:00",
      "11:30",
      "12:00",
      "12:30",
      "13:00",
      "13:30",
      "14:00",
      "14:30",
      "15:00",
      "15:30",
      "16:00",
      "16:30",
      "17:00",
      "17:30",
      "18:00",
      "18:30",
      "19:00",
      "19:30"
    ];
    const currentDate = new Date(start);
    while (currentDate <= end) {
      const dayOfWeek = currentDate.getDay();
      if (dayOfWeek !== 0) {
        const dateStr = currentDate.toISOString().split("T")[0];
        const slots = [];
        const availableHours = dayOfWeek === 6 ? workingHours.filter((h) => parseInt(h.split(":")[0]) < 14) : workingHours;
        availableHours.forEach((time, index) => {
          const doctor = doctors[index % doctors.length];
          slots.push({
            id: `${dateStr}-${time}`,
            time,
            available: true,
            // Por defecto todos disponibles
            doctorName: doctor
          });
        });
        days.push({
          date: dateStr,
          dayOfWeek: dayNames[dayOfWeek],
          slots
        });
      }
      currentDate.setDate(currentDate.getDate() + 1);
    }
    return { days };
  }
  /**
   * Marca los slots ocupados basándose en los datos de la BD
   */
  markOccupiedSlots(allSlots, bookedSlots) {
    const days = allSlots.days.map((day) => {
      const slots = day.slots.map((slot) => {
        const dayDateNormalized = day.date;
        const dbSlot = bookedSlots.find((bs) => {
          const dbDate = typeof bs.slot_date === "string" ? bs.slot_date.split("T")[0] : new Date(bs.slot_date).toISOString().split("T")[0];
          const match = dbDate === dayDateNormalized && bs.slot_time === slot.time;
          return match;
        });
        return __spreadProps(__spreadValues({}, slot), {
          available: dbSlot ? dbSlot.current_bookings < dbSlot.max_capacity : true
        });
      });
      return __spreadProps(__spreadValues({}, day), { slots });
    });
    return { days };
  }
  /**
   * Obtiene los próximos N días laborables
   */
  getNextWorkingDays(count = 7) {
    const days = [];
    const today = /* @__PURE__ */ new Date();
    let current = new Date(today);
    while (days.length < count) {
      current.setDate(current.getDate() + 1);
      const dayOfWeek = current.getDay();
      if (dayOfWeek !== 0) {
        days.push(current.toISOString().split("T")[0]);
      }
    }
    return days;
  }
  /**
   * Formatea una fecha para mostrar
   */
  formatDate(dateStr) {
    const date = /* @__PURE__ */ new Date(dateStr + "T00:00:00");
    const options = {
      day: "numeric",
      month: "long",
      year: "numeric"
    };
    return date.toLocaleDateString("es-ES", options);
  }
  static {
    this.\u0275fac = function AvailableSlotsService_Factory(__ngFactoryType__) {
      return new (__ngFactoryType__ || _AvailableSlotsService)(\u0275\u0275inject(HttpClient));
    };
  }
  static {
    this.\u0275prov = /* @__PURE__ */ \u0275\u0275defineInjectable({ token: _AvailableSlotsService, factory: _AvailableSlotsService.\u0275fac, providedIn: "root" });
  }
};

// src/app/features/appointments/appointments.component.ts
var _forTrack0 = ($index, $item) => $item.id;
function AppointmentsComponent_Conditional_5_Template(rf, ctx) {
  if (rf & 1) {
    const _r1 = \u0275\u0275getCurrentView();
    \u0275\u0275elementStart(0, "div", 3);
    \u0275\u0275element(1, "i", 5);
    \u0275\u0275elementStart(2, "h3");
    \u0275\u0275text(3, "Inicia sesi\xF3n para reservar una cita");
    \u0275\u0275elementEnd();
    \u0275\u0275elementStart(4, "p");
    \u0275\u0275text(5, "Necesitas tener una cuenta para poder gestionar tus citas veterinarias");
    \u0275\u0275elementEnd();
    \u0275\u0275elementStart(6, "button", 6);
    \u0275\u0275listener("click", function AppointmentsComponent_Conditional_5_Template_button_click_6_listener() {
      \u0275\u0275restoreView(_r1);
      const ctx_r1 = \u0275\u0275nextContext();
      return \u0275\u0275resetView(ctx_r1.goToLogin());
    });
    \u0275\u0275text(7, "Iniciar Sesi\xF3n");
    \u0275\u0275elementEnd()();
  }
}
function AppointmentsComponent_Conditional_6_Conditional_18_div_24_Template(rf, ctx) {
  if (rf & 1) {
    const _r5 = \u0275\u0275getCurrentView();
    \u0275\u0275elementStart(0, "div", 28);
    \u0275\u0275listener("click", function AppointmentsComponent_Conditional_6_Conditional_18_div_24_Template_div_click_0_listener() {
      const service_r6 = \u0275\u0275restoreView(_r5).$implicit;
      const ctx_r1 = \u0275\u0275nextContext(3);
      return \u0275\u0275resetView(ctx_r1.selectService(service_r6.value));
    });
    \u0275\u0275element(1, "i");
    \u0275\u0275elementStart(2, "h4");
    \u0275\u0275text(3);
    \u0275\u0275elementEnd();
    \u0275\u0275elementStart(4, "p");
    \u0275\u0275text(5);
    \u0275\u0275elementEnd()();
  }
  if (rf & 2) {
    let tmp_4_0;
    const service_r6 = ctx.$implicit;
    const ctx_r1 = \u0275\u0275nextContext(3);
    \u0275\u0275classProp("selected", ((tmp_4_0 = ctx_r1.appointmentForm.get("serviceType")) == null ? null : tmp_4_0.value) === service_r6.value);
    \u0275\u0275advance();
    \u0275\u0275classMap(service_r6.icon);
    \u0275\u0275advance(2);
    \u0275\u0275textInterpolate(service_r6.label);
    \u0275\u0275advance(2);
    \u0275\u0275textInterpolate(service_r6.description);
  }
}
function AppointmentsComponent_Conditional_6_Conditional_18_Template(rf, ctx) {
  if (rf & 1) {
    const _r4 = \u0275\u0275getCurrentView();
    \u0275\u0275elementStart(0, "div", 12)(1, "h2");
    \u0275\u0275text(2, "Informaci\xF3n del Servicio");
    \u0275\u0275elementEnd();
    \u0275\u0275elementStart(3, "div", 13)(4, "div", 14)(5, "label", 15);
    \u0275\u0275text(6, "Nombre de la Mascota");
    \u0275\u0275elementEnd();
    \u0275\u0275element(7, "input", 16);
    \u0275\u0275elementEnd();
    \u0275\u0275elementStart(8, "div", 14)(9, "label", 17);
    \u0275\u0275text(10, "Tipo de Mascota");
    \u0275\u0275elementEnd();
    \u0275\u0275elementStart(11, "select", 18)(12, "option", 19);
    \u0275\u0275text(13, "Selecciona...");
    \u0275\u0275elementEnd();
    \u0275\u0275elementStart(14, "option", 20);
    \u0275\u0275text(15, "\u{1F415} Perro");
    \u0275\u0275elementEnd();
    \u0275\u0275elementStart(16, "option", 21);
    \u0275\u0275text(17, "\u{1F408} Gato");
    \u0275\u0275elementEnd();
    \u0275\u0275elementStart(18, "option", 22);
    \u0275\u0275text(19, "\u{1F43E} Otro");
    \u0275\u0275elementEnd()()()();
    \u0275\u0275elementStart(20, "div", 14)(21, "label", 23);
    \u0275\u0275text(22, "Tipo de Servicio");
    \u0275\u0275elementEnd();
    \u0275\u0275elementStart(23, "div", 24);
    \u0275\u0275template(24, AppointmentsComponent_Conditional_6_Conditional_18_div_24_Template, 6, 6, "div", 25);
    \u0275\u0275elementEnd()();
    \u0275\u0275elementStart(25, "button", 26);
    \u0275\u0275listener("click", function AppointmentsComponent_Conditional_6_Conditional_18_Template_button_click_25_listener() {
      \u0275\u0275restoreView(_r4);
      const ctx_r1 = \u0275\u0275nextContext(2);
      return \u0275\u0275resetView(ctx_r1.nextStep());
    });
    \u0275\u0275text(26, " Continuar ");
    \u0275\u0275element(27, "i", 27);
    \u0275\u0275elementEnd()();
  }
  if (rf & 2) {
    let tmp_3_0;
    const ctx_r1 = \u0275\u0275nextContext(2);
    \u0275\u0275advance(24);
    \u0275\u0275property("ngForOf", ctx_r1.services);
    \u0275\u0275advance();
    \u0275\u0275property("disabled", !((tmp_3_0 = ctx_r1.appointmentForm.get("petName")) == null ? null : tmp_3_0.valid) || !((tmp_3_0 = ctx_r1.appointmentForm.get("petType")) == null ? null : tmp_3_0.valid) || !((tmp_3_0 = ctx_r1.appointmentForm.get("serviceType")) == null ? null : tmp_3_0.valid));
  }
}
function AppointmentsComponent_Conditional_6_Conditional_19_Conditional_3_Template(rf, ctx) {
  if (rf & 1) {
    \u0275\u0275elementStart(0, "div", 29);
    \u0275\u0275element(1, "i", 33);
    \u0275\u0275elementStart(2, "p");
    \u0275\u0275text(3, "Cargando horarios disponibles...");
    \u0275\u0275elementEnd()();
  }
}
function AppointmentsComponent_Conditional_6_Conditional_19_Conditional_4_Conditional_7_For_6_Template(rf, ctx) {
  if (rf & 1) {
    const _r9 = \u0275\u0275getCurrentView();
    \u0275\u0275elementStart(0, "button", 45);
    \u0275\u0275listener("click", function AppointmentsComponent_Conditional_6_Conditional_19_Conditional_4_Conditional_7_For_6_Template_button_click_0_listener() {
      const date_r10 = \u0275\u0275restoreView(_r9).$implicit;
      const ctx_r1 = \u0275\u0275nextContext(5);
      return \u0275\u0275resetView(ctx_r1.selectDay(date_r10));
    });
    \u0275\u0275elementStart(1, "span", 46);
    \u0275\u0275text(2);
    \u0275\u0275elementEnd();
    \u0275\u0275elementStart(3, "span", 47);
    \u0275\u0275text(4);
    \u0275\u0275elementEnd()();
  }
  if (rf & 2) {
    const date_r10 = ctx.$implicit;
    const ctx_r1 = \u0275\u0275nextContext(5);
    \u0275\u0275classProp("selected", ctx_r1.selectedDate === date_r10);
    \u0275\u0275advance(2);
    \u0275\u0275textInterpolate(date_r10.split("-")[2]);
    \u0275\u0275advance(2);
    \u0275\u0275textInterpolate(ctx_r1.getMonthName(date_r10));
  }
}
function AppointmentsComponent_Conditional_6_Conditional_19_Conditional_4_Conditional_7_Conditional_7_For_6_Template(rf, ctx) {
  if (rf & 1) {
    const _r11 = \u0275\u0275getCurrentView();
    \u0275\u0275elementStart(0, "button", 51);
    \u0275\u0275listener("click", function AppointmentsComponent_Conditional_6_Conditional_19_Conditional_4_Conditional_7_Conditional_7_For_6_Template_button_click_0_listener() {
      const slot_r12 = \u0275\u0275restoreView(_r11).$implicit;
      const ctx_r1 = \u0275\u0275nextContext(6);
      return \u0275\u0275resetView(ctx_r1.selectTimeSlot(ctx_r1.selectedDate, slot_r12));
    });
    \u0275\u0275elementStart(1, "span", 52);
    \u0275\u0275text(2);
    \u0275\u0275elementEnd();
    \u0275\u0275elementStart(3, "span", 53);
    \u0275\u0275text(4);
    \u0275\u0275elementEnd()();
  }
  if (rf & 2) {
    const slot_r12 = ctx.$implicit;
    const ctx_r1 = \u0275\u0275nextContext(6);
    \u0275\u0275classProp("selected", (ctx_r1.selectedSlot == null ? null : ctx_r1.selectedSlot.id) === slot_r12.id);
    \u0275\u0275advance(2);
    \u0275\u0275textInterpolate(slot_r12.time);
    \u0275\u0275advance(2);
    \u0275\u0275textInterpolate(slot_r12.doctorName);
  }
}
function AppointmentsComponent_Conditional_6_Conditional_19_Conditional_4_Conditional_7_Conditional_7_Template(rf, ctx) {
  if (rf & 1) {
    \u0275\u0275elementStart(0, "div", 43)(1, "h4");
    \u0275\u0275element(2, "i", 48);
    \u0275\u0275text(3);
    \u0275\u0275elementEnd();
    \u0275\u0275elementStart(4, "div", 49);
    \u0275\u0275repeaterCreate(5, AppointmentsComponent_Conditional_6_Conditional_19_Conditional_4_Conditional_7_Conditional_7_For_6_Template, 5, 4, "button", 50, _forTrack0);
    \u0275\u0275elementEnd()();
  }
  if (rf & 2) {
    const ctx_r1 = \u0275\u0275nextContext(5);
    \u0275\u0275advance(3);
    \u0275\u0275textInterpolate1(" Horarios disponibles para ", ctx_r1.formatDate(ctx_r1.selectedDate), ":");
    \u0275\u0275advance(2);
    \u0275\u0275repeater(ctx_r1.availableTimesForSelectedDate);
  }
}
function AppointmentsComponent_Conditional_6_Conditional_19_Conditional_4_Conditional_7_Conditional_8_Template(rf, ctx) {
  if (rf & 1) {
    \u0275\u0275elementStart(0, "div", 44);
    \u0275\u0275element(1, "i", 54);
    \u0275\u0275elementStart(2, "p");
    \u0275\u0275text(3, "No hay horarios disponibles para este d\xEDa");
    \u0275\u0275elementEnd()();
  }
}
function AppointmentsComponent_Conditional_6_Conditional_19_Conditional_4_Conditional_7_Template(rf, ctx) {
  if (rf & 1) {
    \u0275\u0275elementStart(0, "div", 39)(1, "h4");
    \u0275\u0275element(2, "i", 40);
    \u0275\u0275text(3, " D\xEDas con horarios disponibles:");
    \u0275\u0275elementEnd();
    \u0275\u0275elementStart(4, "div", 41);
    \u0275\u0275repeaterCreate(5, AppointmentsComponent_Conditional_6_Conditional_19_Conditional_4_Conditional_7_For_6_Template, 5, 4, "button", 42, \u0275\u0275repeaterTrackByIdentity);
    \u0275\u0275elementEnd()();
    \u0275\u0275template(7, AppointmentsComponent_Conditional_6_Conditional_19_Conditional_4_Conditional_7_Conditional_7_Template, 7, 1, "div", 43)(8, AppointmentsComponent_Conditional_6_Conditional_19_Conditional_4_Conditional_7_Conditional_8_Template, 4, 0, "div", 44);
  }
  if (rf & 2) {
    const ctx_r1 = \u0275\u0275nextContext(4);
    \u0275\u0275advance(5);
    \u0275\u0275repeater(ctx_r1.availableDates);
    \u0275\u0275advance(2);
    \u0275\u0275conditional(ctx_r1.selectedDate && ctx_r1.availableTimesForSelectedDate.length > 0 ? 7 : ctx_r1.selectedDate ? 8 : -1);
  }
}
function AppointmentsComponent_Conditional_6_Conditional_19_Conditional_4_Conditional_8_Template(rf, ctx) {
  if (rf & 1) {
    \u0275\u0275elementStart(0, "div", 38);
    \u0275\u0275element(1, "i", 55);
    \u0275\u0275elementStart(2, "p");
    \u0275\u0275text(3);
    \u0275\u0275elementEnd();
    \u0275\u0275elementStart(4, "p", 56);
    \u0275\u0275text(5, "Prueba con otro mes");
    \u0275\u0275elementEnd()();
  }
  if (rf & 2) {
    const ctx_r1 = \u0275\u0275nextContext(4);
    \u0275\u0275advance(3);
    \u0275\u0275textInterpolate2("No hay horarios disponibles en ", ctx_r1.months[ctx_r1.selectedMonth], " ", ctx_r1.selectedYear, "");
  }
}
function AppointmentsComponent_Conditional_6_Conditional_19_Conditional_4_Template(rf, ctx) {
  if (rf & 1) {
    const _r8 = \u0275\u0275getCurrentView();
    \u0275\u0275elementStart(0, "div", 34)(1, "button", 35);
    \u0275\u0275listener("click", function AppointmentsComponent_Conditional_6_Conditional_19_Conditional_4_Template_button_click_1_listener() {
      \u0275\u0275restoreView(_r8);
      const ctx_r1 = \u0275\u0275nextContext(3);
      return \u0275\u0275resetView(ctx_r1.changeMonth(-1));
    });
    \u0275\u0275element(2, "i", 36);
    \u0275\u0275elementEnd();
    \u0275\u0275elementStart(3, "h3");
    \u0275\u0275text(4);
    \u0275\u0275elementEnd();
    \u0275\u0275elementStart(5, "button", 35);
    \u0275\u0275listener("click", function AppointmentsComponent_Conditional_6_Conditional_19_Conditional_4_Template_button_click_5_listener() {
      \u0275\u0275restoreView(_r8);
      const ctx_r1 = \u0275\u0275nextContext(3);
      return \u0275\u0275resetView(ctx_r1.changeMonth(1));
    });
    \u0275\u0275element(6, "i", 37);
    \u0275\u0275elementEnd()();
    \u0275\u0275template(7, AppointmentsComponent_Conditional_6_Conditional_19_Conditional_4_Conditional_7_Template, 9, 1)(8, AppointmentsComponent_Conditional_6_Conditional_19_Conditional_4_Conditional_8_Template, 6, 2, "div", 38);
  }
  if (rf & 2) {
    const ctx_r1 = \u0275\u0275nextContext(3);
    \u0275\u0275advance(4);
    \u0275\u0275textInterpolate2("", ctx_r1.months[ctx_r1.selectedMonth], " ", ctx_r1.selectedYear, "");
    \u0275\u0275advance(3);
    \u0275\u0275conditional(ctx_r1.availableDates.length > 0 ? 7 : 8);
  }
}
function AppointmentsComponent_Conditional_6_Conditional_19_Template(rf, ctx) {
  if (rf & 1) {
    const _r7 = \u0275\u0275getCurrentView();
    \u0275\u0275elementStart(0, "div", 12)(1, "h2");
    \u0275\u0275text(2, "Selecciona Fecha y Hora");
    \u0275\u0275elementEnd();
    \u0275\u0275template(3, AppointmentsComponent_Conditional_6_Conditional_19_Conditional_3_Template, 4, 0, "div", 29)(4, AppointmentsComponent_Conditional_6_Conditional_19_Conditional_4_Template, 9, 3);
    \u0275\u0275elementStart(5, "div", 30)(6, "button", 31);
    \u0275\u0275listener("click", function AppointmentsComponent_Conditional_6_Conditional_19_Template_button_click_6_listener() {
      \u0275\u0275restoreView(_r7);
      const ctx_r1 = \u0275\u0275nextContext(2);
      return \u0275\u0275resetView(ctx_r1.previousStep());
    });
    \u0275\u0275element(7, "i", 32);
    \u0275\u0275text(8, " Atr\xE1s ");
    \u0275\u0275elementEnd();
    \u0275\u0275elementStart(9, "button", 26);
    \u0275\u0275listener("click", function AppointmentsComponent_Conditional_6_Conditional_19_Template_button_click_9_listener() {
      \u0275\u0275restoreView(_r7);
      const ctx_r1 = \u0275\u0275nextContext(2);
      return \u0275\u0275resetView(ctx_r1.nextStep());
    });
    \u0275\u0275text(10, " Continuar ");
    \u0275\u0275element(11, "i", 27);
    \u0275\u0275elementEnd()()();
  }
  if (rf & 2) {
    const ctx_r1 = \u0275\u0275nextContext(2);
    \u0275\u0275advance(3);
    \u0275\u0275conditional(ctx_r1.loadingSlots ? 3 : 4);
    \u0275\u0275advance(6);
    \u0275\u0275property("disabled", !ctx_r1.selectedSlot);
  }
}
function AppointmentsComponent_Conditional_6_Conditional_20_Conditional_25_Template(rf, ctx) {
  if (rf & 1) {
    \u0275\u0275elementStart(0, "div", 58);
    \u0275\u0275element(1, "i", 65);
    \u0275\u0275elementStart(2, "div")(3, "strong");
    \u0275\u0275text(4, "Veterinario:");
    \u0275\u0275elementEnd();
    \u0275\u0275elementStart(5, "span");
    \u0275\u0275text(6);
    \u0275\u0275elementEnd()()();
  }
  if (rf & 2) {
    const ctx_r1 = \u0275\u0275nextContext(3);
    \u0275\u0275advance(6);
    \u0275\u0275textInterpolate(ctx_r1.selectedSlot == null ? null : ctx_r1.selectedSlot.doctorName);
  }
}
function AppointmentsComponent_Conditional_6_Conditional_20_Template(rf, ctx) {
  if (rf & 1) {
    const _r13 = \u0275\u0275getCurrentView();
    \u0275\u0275elementStart(0, "div", 12)(1, "h2");
    \u0275\u0275text(2, "Confirma tu Cita");
    \u0275\u0275elementEnd();
    \u0275\u0275elementStart(3, "div", 57)(4, "div", 58);
    \u0275\u0275element(5, "i", 59);
    \u0275\u0275elementStart(6, "div")(7, "strong");
    \u0275\u0275text(8, "Mascota:");
    \u0275\u0275elementEnd();
    \u0275\u0275elementStart(9, "span");
    \u0275\u0275text(10);
    \u0275\u0275elementEnd()()();
    \u0275\u0275elementStart(11, "div", 58);
    \u0275\u0275element(12, "i", 60);
    \u0275\u0275elementStart(13, "div")(14, "strong");
    \u0275\u0275text(15, "Servicio:");
    \u0275\u0275elementEnd();
    \u0275\u0275elementStart(16, "span");
    \u0275\u0275text(17);
    \u0275\u0275elementEnd()()();
    \u0275\u0275elementStart(18, "div", 58);
    \u0275\u0275element(19, "i", 40);
    \u0275\u0275elementStart(20, "div")(21, "strong");
    \u0275\u0275text(22, "Fecha y Hora:");
    \u0275\u0275elementEnd();
    \u0275\u0275elementStart(23, "span");
    \u0275\u0275text(24);
    \u0275\u0275elementEnd()()();
    \u0275\u0275template(25, AppointmentsComponent_Conditional_6_Conditional_20_Conditional_25_Template, 7, 1, "div", 58);
    \u0275\u0275elementEnd();
    \u0275\u0275elementStart(26, "div", 14)(27, "label", 61);
    \u0275\u0275text(28, "Notas Adicionales (Opcional)");
    \u0275\u0275elementEnd();
    \u0275\u0275element(29, "textarea", 62);
    \u0275\u0275elementEnd();
    \u0275\u0275elementStart(30, "div", 30)(31, "button", 31);
    \u0275\u0275listener("click", function AppointmentsComponent_Conditional_6_Conditional_20_Template_button_click_31_listener() {
      \u0275\u0275restoreView(_r13);
      const ctx_r1 = \u0275\u0275nextContext(2);
      return \u0275\u0275resetView(ctx_r1.previousStep());
    });
    \u0275\u0275element(32, "i", 32);
    \u0275\u0275text(33, " Atr\xE1s ");
    \u0275\u0275elementEnd();
    \u0275\u0275elementStart(34, "button", 63);
    \u0275\u0275element(35, "i", 64);
    \u0275\u0275text(36);
    \u0275\u0275elementEnd()()();
  }
  if (rf & 2) {
    let tmp_2_0;
    let tmp_3_0;
    const ctx_r1 = \u0275\u0275nextContext(2);
    \u0275\u0275advance(10);
    \u0275\u0275textInterpolate2("", (tmp_2_0 = ctx_r1.appointmentForm.get("petName")) == null ? null : tmp_2_0.value, " (", (tmp_2_0 = ctx_r1.appointmentForm.get("petType")) == null ? null : tmp_2_0.value, ")");
    \u0275\u0275advance(7);
    \u0275\u0275textInterpolate(ctx_r1.getServiceLabel((tmp_3_0 = ctx_r1.appointmentForm.get("serviceType")) == null ? null : tmp_3_0.value));
    \u0275\u0275advance(7);
    \u0275\u0275textInterpolate(ctx_r1.selectedSlot ? ctx_r1.formatDate(ctx_r1.selectedDate) + " a las " + ctx_r1.selectedSlot.time : "");
    \u0275\u0275advance();
    \u0275\u0275conditional((ctx_r1.selectedSlot == null ? null : ctx_r1.selectedSlot.doctorName) ? 25 : -1);
    \u0275\u0275advance(9);
    \u0275\u0275property("disabled", !ctx_r1.appointmentForm.valid || ctx_r1.isSubmitting);
    \u0275\u0275advance(2);
    \u0275\u0275textInterpolate1(" ", ctx_r1.isSubmitting ? "Reservando..." : "Confirmar Cita", " ");
  }
}
function AppointmentsComponent_Conditional_6_Template(rf, ctx) {
  if (rf & 1) {
    const _r3 = \u0275\u0275getCurrentView();
    \u0275\u0275elementStart(0, "div", 4)(1, "div", 7)(2, "div", 8)(3, "span", 9);
    \u0275\u0275text(4, "1");
    \u0275\u0275elementEnd();
    \u0275\u0275elementStart(5, "span", 10);
    \u0275\u0275text(6, "Servicio");
    \u0275\u0275elementEnd()();
    \u0275\u0275elementStart(7, "div", 8)(8, "span", 9);
    \u0275\u0275text(9, "2");
    \u0275\u0275elementEnd();
    \u0275\u0275elementStart(10, "span", 10);
    \u0275\u0275text(11, "Horario");
    \u0275\u0275elementEnd()();
    \u0275\u0275elementStart(12, "div", 8)(13, "span", 9);
    \u0275\u0275text(14, "3");
    \u0275\u0275elementEnd();
    \u0275\u0275elementStart(15, "span", 10);
    \u0275\u0275text(16, "Detalles");
    \u0275\u0275elementEnd()()();
    \u0275\u0275elementStart(17, "form", 11);
    \u0275\u0275listener("ngSubmit", function AppointmentsComponent_Conditional_6_Template_form_ngSubmit_17_listener() {
      \u0275\u0275restoreView(_r3);
      const ctx_r1 = \u0275\u0275nextContext();
      return \u0275\u0275resetView(ctx_r1.onSubmit());
    });
    \u0275\u0275template(18, AppointmentsComponent_Conditional_6_Conditional_18_Template, 28, 2, "div", 12)(19, AppointmentsComponent_Conditional_6_Conditional_19_Template, 12, 2, "div", 12)(20, AppointmentsComponent_Conditional_6_Conditional_20_Template, 37, 7, "div", 12);
    \u0275\u0275elementEnd()();
  }
  if (rf & 2) {
    const ctx_r1 = \u0275\u0275nextContext();
    \u0275\u0275advance(2);
    \u0275\u0275classProp("active", ctx_r1.currentStep >= 1)("completed", ctx_r1.currentStep > 1);
    \u0275\u0275advance(5);
    \u0275\u0275classProp("active", ctx_r1.currentStep >= 2)("completed", ctx_r1.currentStep > 2);
    \u0275\u0275advance(5);
    \u0275\u0275classProp("active", ctx_r1.currentStep >= 3);
    \u0275\u0275advance(5);
    \u0275\u0275property("formGroup", ctx_r1.appointmentForm);
    \u0275\u0275advance();
    \u0275\u0275conditional(ctx_r1.currentStep === 1 ? 18 : -1);
    \u0275\u0275advance();
    \u0275\u0275conditional(ctx_r1.currentStep === 2 ? 19 : -1);
    \u0275\u0275advance();
    \u0275\u0275conditional(ctx_r1.currentStep === 3 ? 20 : -1);
  }
}
var AppointmentsComponent = class _AppointmentsComponent {
  constructor(fb, router, appointmentsService, notificationService, availableSlotsService, authService) {
    this.fb = fb;
    this.router = router;
    this.appointmentsService = appointmentsService;
    this.notificationService = notificationService;
    this.availableSlotsService = availableSlotsService;
    this.authService = authService;
    this.isSubmitting = false;
    this.currentStep = 1;
    this.loadingSlots = false;
    this.availableDays = [];
    this.selectedSlot = null;
    this.selectedDate = null;
    this.selectedMonth = (/* @__PURE__ */ new Date()).getMonth();
    this.selectedYear = (/* @__PURE__ */ new Date()).getFullYear();
    this.availableDates = [];
    this.availableTimesForSelectedDate = [];
    this.months = [
      "Enero",
      "Febrero",
      "Marzo",
      "Abril",
      "Mayo",
      "Junio",
      "Julio",
      "Agosto",
      "Septiembre",
      "Octubre",
      "Noviembre",
      "Diciembre"
    ];
    this.services = [
      {
        value: "consulta",
        label: "Consulta General",
        description: "Revisi\xF3n general de salud",
        icon: "fas fa-stethoscope"
      },
      {
        value: "vacunacion",
        label: "Vacunaci\xF3n",
        description: "Vacunas y refuerzos",
        icon: "fas fa-syringe"
      },
      {
        value: "peluqueria",
        label: "Peluquer\xEDa",
        description: "Corte y aseo",
        icon: "fas fa-cut"
      },
      {
        value: "emergencia",
        label: "Emergencia",
        description: "Atenci\xF3n urgente",
        icon: "fas fa-ambulance"
      }
    ];
    this.appointmentForm = this.fb.group({
      petName: ["", Validators.required],
      petType: ["", Validators.required],
      serviceType: ["", Validators.required],
      appointmentDate: ["", Validators.required],
      notes: [""]
    });
  }
  ngOnInit() {
    if (!this.authService.isLoggedIn) {
      return;
    }
  }
  goToLogin() {
    this.router.navigate(["/single-page"], { fragment: "login" });
  }
  selectService(value) {
    this.appointmentForm.patchValue({ serviceType: value });
  }
  nextStep() {
    if (this.currentStep === 1) {
      this.loadAvailableDatesForMonth();
    }
    if (this.currentStep < 3) {
      this.currentStep++;
    }
  }
  previousStep() {
    if (this.currentStep > 1) {
      this.currentStep--;
    }
  }
  loadAvailableSlots() {
    this.loadingSlots = true;
    const today = /* @__PURE__ */ new Date();
    const startDate = today.toISOString().split("T")[0];
    const endOfMonth = new Date(today.getFullYear(), today.getMonth() + 1, 0);
    const endDate = endOfMonth.toISOString().split("T")[0];
    const serviceType = this.appointmentForm.get("serviceType")?.value;
    this.availableSlotsService.getAvailableSlots(startDate, endDate, serviceType).subscribe({
      next: (response) => {
        this.availableDays = response.days;
        this.loadingSlots = false;
      },
      error: (error) => {
        console.error("Error cargando horarios:", error);
        this.notificationService.showError("Error al cargar horarios disponibles");
        this.loadingSlots = false;
      }
    });
  }
  loadNextMonth() {
    if (this.availableDays.length === 0)
      return;
    this.loadingSlots = true;
    const lastDate = new Date(this.availableDays[this.availableDays.length - 1].date);
    const nextMonth = new Date(lastDate);
    nextMonth.setDate(lastDate.getDate() + 1);
    const startDate = nextMonth.toISOString().split("T")[0];
    const endOfMonth = new Date(nextMonth.getFullYear(), nextMonth.getMonth() + 1, 0);
    const endDate = endOfMonth.toISOString().split("T")[0];
    const oneYearFromNow = /* @__PURE__ */ new Date();
    oneYearFromNow.setFullYear(oneYearFromNow.getFullYear() + 1);
    if (nextMonth > oneYearFromNow) {
      this.notificationService.showError("No se pueden cargar citas m\xE1s all\xE1 de un a\xF1o");
      this.loadingSlots = false;
      return;
    }
    const serviceType = this.appointmentForm.get("serviceType")?.value;
    this.availableSlotsService.getAvailableSlots(startDate, endDate, serviceType).subscribe({
      next: (response) => {
        this.availableDays = [...this.availableDays, ...response.days];
        this.loadingSlots = false;
      },
      error: (error) => {
        console.error("Error cargando horarios:", error);
        this.notificationService.showError("Error al cargar horarios disponibles");
        this.loadingSlots = false;
      }
    });
  }
  // Métodos para el nuevo diseño
  changeMonth(direction) {
    this.selectedMonth += direction;
    if (this.selectedMonth > 11) {
      this.selectedMonth = 0;
      this.selectedYear++;
    } else if (this.selectedMonth < 0) {
      this.selectedMonth = 11;
      this.selectedYear--;
    }
    this.loadAvailableDatesForMonth();
  }
  loadAvailableDatesForMonth() {
    this.loadingSlots = true;
    this.availableDates = [];
    this.availableTimesForSelectedDate = [];
    this.selectedDate = null;
    const firstDay = new Date(this.selectedYear, this.selectedMonth, 1);
    const lastDay = new Date(this.selectedYear, this.selectedMonth + 1, 0);
    const startDate = firstDay.toISOString().split("T")[0];
    const endDate = lastDay.toISOString().split("T")[0];
    const serviceType = this.appointmentForm.get("serviceType")?.value;
    this.availableSlotsService.getAvailableSlots(startDate, endDate, serviceType).subscribe({
      next: (response) => {
        this.availableDays = response.days;
        this.availableDates = response.days.filter((day) => day.slots.some((slot) => slot.available)).map((day) => day.date);
        this.loadingSlots = false;
      },
      error: (error) => {
        console.error("Error cargando horarios:", error);
        this.notificationService.showError("Error al cargar horarios disponibles");
        this.loadingSlots = false;
      }
    });
  }
  selectDay(date) {
    this.selectedDate = date;
    const dayData = this.availableDays.find((d) => d.date === date);
    if (dayData) {
      this.availableTimesForSelectedDate = dayData.slots.filter((slot) => slot.available);
    } else {
      this.availableTimesForSelectedDate = [];
    }
  }
  selectTimeSlot(date, slot) {
    if (!slot.available)
      return;
    this.selectedSlot = slot;
    this.selectedDate = date;
    const dateTime = `${date}T${slot.time}:00`;
    this.appointmentForm.patchValue({ appointmentDate: dateTime });
  }
  formatDate(dateStr) {
    return this.availableSlotsService.formatDate(dateStr);
  }
  getMonthName(dateStr) {
    const monthIndex = parseInt(dateStr.split("-")[1]) - 1;
    return this.months[monthIndex].substring(0, 3);
  }
  getServiceLabel(value) {
    const service = this.services.find((s) => s.value === value);
    return service ? service.label : value;
  }
  onSubmit() {
    if (this.appointmentForm.valid && this.authService.isLoggedIn) {
      this.isSubmitting = true;
      const formValue = this.appointmentForm.value;
      const user = this.authService.currentUserValue;
      const dateTimeStr = formValue.appointmentDate;
      const [datePart, timePart] = dateTimeStr.split("T");
      const preferredDate = datePart;
      const preferredTime = timePart.substring(0, 5);
      const appointmentData = {
        owner_name: user?.username || "Usuario",
        email: user?.email || "",
        phone: "000000000",
        pet_name: formValue.petName,
        pet_type: formValue.petType,
        service_type: formValue.serviceType,
        preferred_date: preferredDate,
        preferred_time: preferredTime,
        notes: formValue.notes || ""
      };
      this.appointmentsService.createAppointment(appointmentData).subscribe({
        next: (response) => {
          this.isSubmitting = false;
          this.notificationService.showSuccess("\xA1Cita reservada exitosamente! Nos pondremos en contacto contigo pronto.");
          this.appointmentForm.reset();
          this.currentStep = 1;
          this.selectedSlot = null;
          this.selectedDate = null;
          setTimeout(() => {
            this.router.navigate(["/gracias"]);
          }, 1e3);
        },
        error: (error) => {
          this.isSubmitting = false;
          console.error("Error al reservar cita:", error);
          this.notificationService.showError(error.message || "Error al reservar la cita. Por favor, int\xE9ntalo de nuevo.");
        }
      });
    }
  }
  static {
    this.\u0275fac = function AppointmentsComponent_Factory(__ngFactoryType__) {
      return new (__ngFactoryType__ || _AppointmentsComponent)(\u0275\u0275directiveInject(FormBuilder), \u0275\u0275directiveInject(Router), \u0275\u0275directiveInject(AppointmentsService), \u0275\u0275directiveInject(NotificationService), \u0275\u0275directiveInject(AvailableSlotsService), \u0275\u0275directiveInject(AuthService));
    };
  }
  static {
    this.\u0275cmp = /* @__PURE__ */ \u0275\u0275defineComponent({ type: _AppointmentsComponent, selectors: [["app-appointments"]], standalone: true, features: [\u0275\u0275StandaloneFeature], decls: 7, vars: 1, consts: [[1, "page-container"], [1, "appointments-section"], [1, "container"], [1, "login-required"], [1, "appointment-form-container"], [1, "fas", "fa-lock"], [1, "btn-primary", 3, "click"], [1, "step-indicator"], [1, "step"], [1, "step-number"], [1, "step-label"], [3, "ngSubmit", "formGroup"], [1, "form-step"], [1, "form-row"], [1, "form-group"], ["for", "petName"], ["type", "text", "id", "petName", "formControlName", "petName", "placeholder", "Ej: Max", "required", ""], ["for", "petType"], ["id", "petType", "formControlName", "petType", "required", ""], ["value", ""], ["value", "perro"], ["value", "gato"], ["value", "otro"], ["for", "serviceType"], [1, "service-cards"], ["class", "service-card", 3, "selected", "click", 4, "ngFor", "ngForOf"], ["type", "button", 1, "btn-next", 3, "click", "disabled"], [1, "fas", "fa-arrow-right"], [1, "service-card", 3, "click"], [1, "loading"], [1, "step-buttons"], ["type", "button", 1, "btn-back", 3, "click"], [1, "fas", "fa-arrow-left"], [1, "fas", "fa-spinner", "fa-spin"], [1, "month-selector"], ["type", "button", 1, "btn-month-nav", 3, "click"], [1, "fas", "fa-chevron-left"], [1, "fas", "fa-chevron-right"], [1, "no-dates-message"], [1, "available-dates-section"], [1, "fas", "fa-calendar-check"], [1, "dates-grid"], ["type", "button", 1, "date-button", 3, "selected"], [1, "times-section"], [1, "no-times-message"], ["type", "button", 1, "date-button", 3, "click"], [1, "date-day"], [1, "date-month"], [1, "fas", "fa-clock"], [1, "time-slots"], ["type", "button", 1, "time-slot", "available", 3, "selected"], ["type", "button", 1, "time-slot", "available", 3, "click"], [1, "time"], [1, "doctor"], [1, "fas", "fa-info-circle"], [1, "fas", "fa-calendar-times"], [1, "hint"], [1, "appointment-summary"], [1, "summary-item"], [1, "fas", "fa-paw"], [1, "fas", "fa-stethoscope"], ["for", "notes"], ["id", "notes", "formControlName", "notes", "rows", "4", "placeholder", "Describe cualquier s\xEDntoma, comportamiento o informaci\xF3n relevante..."], ["type", "submit", 1, "btn-submit", 3, "disabled"], [1, "fas", "fa-check-circle"], [1, "fas", "fa-user-md"]], template: function AppointmentsComponent_Template(rf, ctx) {
      if (rf & 1) {
        \u0275\u0275elementStart(0, "div", 0)(1, "section", 1)(2, "div", 2)(3, "h1");
        \u0275\u0275text(4, "Reservar Cita");
        \u0275\u0275elementEnd();
        \u0275\u0275template(5, AppointmentsComponent_Conditional_5_Template, 8, 0, "div", 3)(6, AppointmentsComponent_Conditional_6_Template, 21, 14, "div", 4);
        \u0275\u0275elementEnd()()();
      }
      if (rf & 2) {
        \u0275\u0275advance(5);
        \u0275\u0275conditional(!ctx.authService.isLoggedIn ? 5 : 6);
      }
    }, dependencies: [CommonModule, NgForOf, ReactiveFormsModule, \u0275NgNoValidate, NgSelectOption, \u0275NgSelectMultipleOption, DefaultValueAccessor, SelectControlValueAccessor, NgControlStatus, NgControlStatusGroup, RequiredValidator, FormGroupDirective, FormControlName], styles: ['@charset "UTF-8";\n\n\n\n.page-container[_ngcontent-%COMP%] {\n  min-height: calc(100vh - 200px);\n  padding: 4rem 0;\n  background:\n    linear-gradient(\n      135deg,\n      #f5f7fa 0%,\n      #c3cfe2 100%);\n}\n.appointments-section[_ngcontent-%COMP%]   h1[_ngcontent-%COMP%] {\n  font-size: 2.5rem;\n  color: var(--color-primary);\n  text-align: center;\n  margin-bottom: 3rem;\n  text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.1);\n}\n.login-required[_ngcontent-%COMP%] {\n  max-width: 500px;\n  margin: 0 auto;\n  background: white;\n  padding: 3rem;\n  border-radius: 1rem;\n  text-align: center;\n  box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);\n}\n.login-required[_ngcontent-%COMP%]   i[_ngcontent-%COMP%] {\n  font-size: 4rem;\n  color: var(--color-primary);\n  margin-bottom: 1.5rem;\n}\n.login-required[_ngcontent-%COMP%]   h3[_ngcontent-%COMP%] {\n  font-size: 1.5rem;\n  margin-bottom: 1rem;\n  color: #333;\n}\n.login-required[_ngcontent-%COMP%]   p[_ngcontent-%COMP%] {\n  color: #666;\n  margin-bottom: 2rem;\n}\n.btn-primary[_ngcontent-%COMP%] {\n  padding: 1rem 2rem;\n  background-color: var(--color-primary);\n  color: white;\n  border: none;\n  border-radius: 0.5rem;\n  font-size: 1.1rem;\n  font-weight: 600;\n  cursor: pointer;\n  transition: all 0.3s;\n}\n.btn-primary[_ngcontent-%COMP%]:hover {\n  background-color: var(--color-primary-dark);\n  transform: translateY(-2px);\n  box-shadow: 0 4px 12px rgba(0, 150, 136, 0.3);\n}\n.appointment-form-container[_ngcontent-%COMP%] {\n  max-width: 900px;\n  margin: 0 auto;\n  background: white;\n  padding: 2.5rem;\n  border-radius: 1rem;\n  box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);\n}\n.step-indicator[_ngcontent-%COMP%] {\n  display: flex;\n  justify-content: space-between;\n  margin-bottom: 3rem;\n  position: relative;\n}\n.step-indicator[_ngcontent-%COMP%]::before {\n  content: "";\n  position: absolute;\n  top: 20px;\n  left: 0;\n  right: 0;\n  height: 2px;\n  background: #e0e0e0;\n  z-index: 0;\n}\n.step[_ngcontent-%COMP%] {\n  display: flex;\n  flex-direction: column;\n  align-items: center;\n  gap: 0.5rem;\n  position: relative;\n  z-index: 1;\n  flex: 1;\n}\n.step-number[_ngcontent-%COMP%] {\n  width: 40px;\n  height: 40px;\n  border-radius: 50%;\n  background: #e0e0e0;\n  color: #999;\n  display: flex;\n  align-items: center;\n  justify-content: center;\n  font-weight: 600;\n  transition: all 0.3s;\n}\n.step.active[_ngcontent-%COMP%]   .step-number[_ngcontent-%COMP%] {\n  background: var(--color-primary);\n  color: white;\n  box-shadow: 0 4px 12px rgba(0, 150, 136, 0.3);\n}\n.step.completed[_ngcontent-%COMP%]   .step-number[_ngcontent-%COMP%] {\n  background: #4caf50;\n  color: white;\n}\n.step-label[_ngcontent-%COMP%] {\n  font-size: 0.9rem;\n  color: #666;\n  font-weight: 500;\n}\n.step.active[_ngcontent-%COMP%]   .step-label[_ngcontent-%COMP%] {\n  color: var(--color-primary);\n  font-weight: 600;\n}\n.form-step[_ngcontent-%COMP%]   h2[_ngcontent-%COMP%] {\n  font-size: 1.8rem;\n  color: #333;\n  margin-bottom: 2rem;\n  text-align: center;\n}\n.form-row[_ngcontent-%COMP%] {\n  display: grid;\n  grid-template-columns: 1fr;\n  gap: 1.5rem;\n  margin-bottom: 0;\n}\n@media (min-width: 768px) {\n  .form-row[_ngcontent-%COMP%] {\n    grid-template-columns: 1fr 1fr;\n  }\n}\n.form-group[_ngcontent-%COMP%] {\n  margin-bottom: 1.5rem;\n}\n.form-group[_ngcontent-%COMP%]   label[_ngcontent-%COMP%] {\n  display: block;\n  margin-bottom: 0.5rem;\n  font-weight: 600;\n  color: #333;\n}\n.form-group[_ngcontent-%COMP%]   input[_ngcontent-%COMP%], \n.form-group[_ngcontent-%COMP%]   select[_ngcontent-%COMP%], \n.form-group[_ngcontent-%COMP%]   textarea[_ngcontent-%COMP%] {\n  width: 100%;\n  padding: 0.75rem;\n  border: 2px solid #e0e0e0;\n  border-radius: 0.5rem;\n  font-size: 1rem;\n  transition: all 0.3s;\n}\n.form-group[_ngcontent-%COMP%]   input[_ngcontent-%COMP%]:focus, \n.form-group[_ngcontent-%COMP%]   select[_ngcontent-%COMP%]:focus, \n.form-group[_ngcontent-%COMP%]   textarea[_ngcontent-%COMP%]:focus {\n  outline: none;\n  border-color: var(--color-primary);\n  box-shadow: 0 0 0 3px rgba(0, 150, 136, 0.1);\n}\n.service-cards[_ngcontent-%COMP%] {\n  display: grid;\n  grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));\n  gap: 1rem;\n  margin-top: 1rem;\n}\n.service-card[_ngcontent-%COMP%] {\n  padding: 1.5rem;\n  border: 2px solid #e0e0e0;\n  border-radius: 0.75rem;\n  text-align: center;\n  cursor: pointer;\n  transition: all 0.3s;\n}\n.service-card[_ngcontent-%COMP%]:hover {\n  border-color: var(--color-primary);\n  transform: translateY(-4px);\n  box-shadow: 0 6px 20px rgba(0, 150, 136, 0.2);\n}\n.service-card.selected[_ngcontent-%COMP%] {\n  border-color: var(--color-primary);\n  background: rgba(0, 150, 136, 0.05);\n  box-shadow: 0 6px 20px rgba(0, 150, 136, 0.2);\n}\n.service-card[_ngcontent-%COMP%]   i[_ngcontent-%COMP%] {\n  font-size: 2.5rem;\n  color: var(--color-primary);\n  margin-bottom: 0.75rem;\n}\n.service-card[_ngcontent-%COMP%]   h4[_ngcontent-%COMP%] {\n  font-size: 1.1rem;\n  margin-bottom: 0.5rem;\n  color: #333;\n}\n.service-card[_ngcontent-%COMP%]   p[_ngcontent-%COMP%] {\n  font-size: 0.85rem;\n  color: #666;\n  margin: 0;\n}\n.calendar-container[_ngcontent-%COMP%] {\n  max-height: 600px;\n  overflow-y: auto;\n  padding: 1rem;\n  background: #f8f9fa;\n  border-radius: 0.75rem;\n}\n.load-more-container[_ngcontent-%COMP%] {\n  text-align: center;\n  margin-top: 1.5rem;\n  padding: 1rem;\n}\n.btn-load-more[_ngcontent-%COMP%] {\n  padding: 0.75rem 2rem;\n  background: var(--color-primary);\n  color: white;\n  border: none;\n  border-radius: 0.5rem;\n  font-size: 1rem;\n  font-weight: 600;\n  cursor: pointer;\n  transition: all 0.3s;\n  display: inline-flex;\n  align-items: center;\n  gap: 0.5rem;\n}\n.btn-load-more[_ngcontent-%COMP%]:hover:not(:disabled) {\n  background: var(--color-primary-dark);\n  transform: translateY(-2px);\n  box-shadow: 0 4px 12px rgba(0, 150, 136, 0.3);\n}\n.btn-load-more[_ngcontent-%COMP%]:disabled {\n  opacity: 0.6;\n  cursor: not-allowed;\n}\n.month-selector[_ngcontent-%COMP%] {\n  display: flex;\n  align-items: center;\n  justify-content: center;\n  gap: 2rem;\n  margin-bottom: 2rem;\n  padding: 1.5rem;\n  background: white;\n  border-radius: 1rem;\n  box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);\n}\n.month-selector[_ngcontent-%COMP%]   h3[_ngcontent-%COMP%] {\n  margin: 0;\n  font-size: 1.5rem;\n  color: var(--color-primary);\n  min-width: 200px;\n  text-align: center;\n}\n.btn-month-nav[_ngcontent-%COMP%] {\n  background: var(--color-primary);\n  color: white;\n  border: none;\n  width: 40px;\n  height: 40px;\n  border-radius: 50%;\n  cursor: pointer;\n  transition: all 0.3s;\n  display: flex;\n  align-items: center;\n  justify-content: center;\n}\n.btn-month-nav[_ngcontent-%COMP%]:hover {\n  background: var(--color-primary-dark);\n  transform: scale(1.1);\n}\n.available-dates-section[_ngcontent-%COMP%] {\n  margin-bottom: 2rem;\n}\n.available-dates-section[_ngcontent-%COMP%]   h4[_ngcontent-%COMP%] {\n  color: #333;\n  margin-bottom: 1rem;\n  display: flex;\n  align-items: center;\n  gap: 0.5rem;\n}\n.available-dates-section[_ngcontent-%COMP%]   h4[_ngcontent-%COMP%]   i[_ngcontent-%COMP%] {\n  color: var(--color-primary);\n}\n.dates-grid[_ngcontent-%COMP%] {\n  display: grid;\n  grid-template-columns: repeat(auto-fill, minmax(80px, 1fr));\n  gap: 1rem;\n  margin-bottom: 2rem;\n}\n.date-button[_ngcontent-%COMP%] {\n  background: white;\n  border: 2px solid #e0e0e0;\n  border-radius: 0.75rem;\n  padding: 1rem;\n  cursor: pointer;\n  transition: all 0.3s;\n  display: flex;\n  flex-direction: column;\n  align-items: center;\n  gap: 0.25rem;\n}\n.date-button[_ngcontent-%COMP%]:hover {\n  border-color: var(--color-primary);\n  transform: translateY(-2px);\n  box-shadow: 0 4px 12px rgba(0, 150, 136, 0.2);\n}\n.date-button.selected[_ngcontent-%COMP%] {\n  background: var(--color-primary);\n  border-color: var(--color-primary);\n  color: white;\n}\n.date-day[_ngcontent-%COMP%] {\n  font-size: 1.5rem;\n  font-weight: 700;\n}\n.date-month[_ngcontent-%COMP%] {\n  font-size: 0.875rem;\n  opacity: 0.8;\n}\n.times-section[_ngcontent-%COMP%] {\n  background: white;\n  padding: 1.5rem;\n  border-radius: 1rem;\n  box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);\n}\n.times-section[_ngcontent-%COMP%]   h4[_ngcontent-%COMP%] {\n  color: #333;\n  margin-bottom: 1rem;\n  display: flex;\n  align-items: center;\n  gap: 0.5rem;\n}\n.times-section[_ngcontent-%COMP%]   h4[_ngcontent-%COMP%]   i[_ngcontent-%COMP%] {\n  color: var(--color-primary);\n}\n.no-times-message[_ngcontent-%COMP%], \n.no-dates-message[_ngcontent-%COMP%] {\n  text-align: center;\n  padding: 3rem 2rem;\n  background: white;\n  border-radius: 1rem;\n  box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);\n}\n.no-times-message[_ngcontent-%COMP%]   i[_ngcontent-%COMP%], \n.no-dates-message[_ngcontent-%COMP%]   i[_ngcontent-%COMP%] {\n  font-size: 3rem;\n  color: var(--color-primary);\n  margin-bottom: 1rem;\n}\n.no-times-message[_ngcontent-%COMP%]   p[_ngcontent-%COMP%], \n.no-dates-message[_ngcontent-%COMP%]   p[_ngcontent-%COMP%] {\n  color: #666;\n  margin: 0.5rem 0;\n}\n.no-dates-message[_ngcontent-%COMP%]   .hint[_ngcontent-%COMP%] {\n  color: var(--color-primary);\n  font-weight: 600;\n}\n.day-section[_ngcontent-%COMP%] {\n  margin-bottom: 2rem;\n}\n.day-header[_ngcontent-%COMP%] {\n  font-size: 1.2rem;\n  color: #333;\n  margin-bottom: 1rem;\n  padding: 0.75rem;\n  background: white;\n  border-radius: 0.5rem;\n  display: flex;\n  align-items: center;\n  gap: 0.75rem;\n}\n.day-header[_ngcontent-%COMP%]   i[_ngcontent-%COMP%] {\n  color: var(--color-primary);\n}\n.day-name[_ngcontent-%COMP%] {\n  margin-left: auto;\n  font-size: 0.9rem;\n  color: #666;\n  font-weight: normal;\n}\n.time-slots[_ngcontent-%COMP%] {\n  display: grid;\n  grid-template-columns: repeat(auto-fill, minmax(140px, 1fr));\n  gap: 0.75rem;\n}\n.time-slot[_ngcontent-%COMP%] {\n  padding: 0.75rem;\n  border: 2px solid #e0e0e0;\n  border-radius: 0.5rem;\n  background: white;\n  cursor: pointer;\n  transition: all 0.3s;\n  display: flex;\n  flex-direction: column;\n  gap: 0.25rem;\n}\n.time-slot[_ngcontent-%COMP%]:disabled {\n  opacity: 0.5;\n  cursor: not-allowed;\n  background: #f5f5f5;\n}\n.time-slot.available[_ngcontent-%COMP%]:hover:not(:disabled) {\n  border-color: var(--color-primary);\n  transform: translateY(-2px);\n  box-shadow: 0 4px 12px rgba(0, 150, 136, 0.2);\n}\n.time-slot.selected[_ngcontent-%COMP%] {\n  border-color: var(--color-primary);\n  background: var(--color-primary);\n  color: white;\n}\n.time-slot[_ngcontent-%COMP%]   .time[_ngcontent-%COMP%] {\n  font-weight: 600;\n  font-size: 1.1rem;\n}\n.time-slot[_ngcontent-%COMP%]   .doctor[_ngcontent-%COMP%] {\n  font-size: 0.8rem;\n  color: #666;\n}\n.time-slot.selected[_ngcontent-%COMP%]   .doctor[_ngcontent-%COMP%] {\n  color: rgba(255, 255, 255, 0.9);\n}\n.time-slot[_ngcontent-%COMP%]   .unavailable-label[_ngcontent-%COMP%] {\n  font-size: 0.75rem;\n  color: #999;\n}\n.loading[_ngcontent-%COMP%] {\n  text-align: center;\n  padding: 3rem;\n}\n.loading[_ngcontent-%COMP%]   i[_ngcontent-%COMP%] {\n  font-size: 3rem;\n  color: var(--color-primary);\n  margin-bottom: 1rem;\n}\n.appointment-summary[_ngcontent-%COMP%] {\n  background: #f8f9fa;\n  padding: 1.5rem;\n  border-radius: 0.75rem;\n  margin-bottom: 2rem;\n}\n.summary-item[_ngcontent-%COMP%] {\n  display: flex;\n  align-items: flex-start;\n  gap: 1rem;\n  padding: 1rem;\n  margin-bottom: 0.75rem;\n  background: white;\n  border-radius: 0.5rem;\n}\n.summary-item[_ngcontent-%COMP%]:last-child {\n  margin-bottom: 0;\n}\n.summary-item[_ngcontent-%COMP%]   i[_ngcontent-%COMP%] {\n  font-size: 1.5rem;\n  color: var(--color-primary);\n  margin-top: 0.25rem;\n}\n.summary-item[_ngcontent-%COMP%]   div[_ngcontent-%COMP%] {\n  flex: 1;\n}\n.summary-item[_ngcontent-%COMP%]   strong[_ngcontent-%COMP%] {\n  display: block;\n  margin-bottom: 0.25rem;\n  color: #333;\n}\n.summary-item[_ngcontent-%COMP%]   span[_ngcontent-%COMP%] {\n  color: #666;\n}\n.step-buttons[_ngcontent-%COMP%] {\n  display: flex;\n  gap: 1rem;\n  margin-top: 2rem;\n}\n.btn-back[_ngcontent-%COMP%], \n.btn-next[_ngcontent-%COMP%], \n.btn-submit[_ngcontent-%COMP%] {\n  flex: 1;\n  padding: 1rem 2rem;\n  border: none;\n  border-radius: 0.5rem;\n  font-size: 1.1rem;\n  font-weight: 600;\n  cursor: pointer;\n  transition: all 0.3s;\n  display: flex;\n  align-items: center;\n  justify-content: center;\n  gap: 0.5rem;\n}\n.btn-back[_ngcontent-%COMP%] {\n  background: #e0e0e0;\n  color: #666;\n}\n.btn-back[_ngcontent-%COMP%]:hover {\n  background: #d0d0d0;\n}\n.btn-next[_ngcontent-%COMP%], \n.btn-submit[_ngcontent-%COMP%] {\n  background-color: var(--color-primary);\n  color: white;\n}\n.btn-next[_ngcontent-%COMP%]:hover:not(:disabled), \n.btn-submit[_ngcontent-%COMP%]:hover:not(:disabled) {\n  background-color: var(--color-primary-dark);\n  transform: translateY(-2px);\n  box-shadow: 0 4px 12px rgba(0, 150, 136, 0.3);\n}\n.btn-next[_ngcontent-%COMP%]:disabled, \n.btn-submit[_ngcontent-%COMP%]:disabled {\n  opacity: 0.6;\n  cursor: not-allowed;\n}\n@media (max-width: 768px) {\n  .appointment-form-container[_ngcontent-%COMP%] {\n    padding: 1.5rem;\n  }\n  .step-label[_ngcontent-%COMP%] {\n    font-size: 0.75rem;\n  }\n  .service-cards[_ngcontent-%COMP%] {\n    grid-template-columns: 1fr;\n  }\n  .time-slots[_ngcontent-%COMP%] {\n    grid-template-columns: repeat(auto-fill, minmax(120px, 1fr));\n  }\n}\n/*# sourceMappingURL=appointments.component.css.map */'] });
  }
};
(() => {
  (typeof ngDevMode === "undefined" || ngDevMode) && \u0275setClassDebugInfo(AppointmentsComponent, { className: "AppointmentsComponent", filePath: "src\\app\\features\\appointments\\appointments.component.ts", lineNumber: 854 });
})();
export {
  AppointmentsComponent
};
//# sourceMappingURL=chunk-E4LQV4YG.js.map
