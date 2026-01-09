import { Injectable } from '@angular/core';
import { Subject } from 'rxjs';

/**
 * Servicio centralizado para gestionar la apertura/cierre de modales
 * Reemplaza el uso de CustomEvents del DOM nativo
 */
@Injectable({
    providedIn: 'root'
})
export class ModalService {
    // Subjects privados para emitir eventos
    private loginModalSubject = new Subject<void>();
    private registerModalSubject = new Subject<void>();

    // Observables públicos para que los componentes se suscriban
    loginModal$ = this.loginModalSubject.asObservable();
    registerModal$ = this.registerModalSubject.asObservable();

    /**
     * Abre el modal de login
     */
    openLogin(): void {
        this.loginModalSubject.next();
    }

    /**
     * Abre el modal de registro
     */
    openRegister(): void {
        this.registerModalSubject.next();
    }
}
