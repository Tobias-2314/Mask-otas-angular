import { Component, ElementRef, ViewChild, AfterViewChecked, ChangeDetectionStrategy, ChangeDetectorRef } from '@angular/core';
import { CommonModule } from '@angular/common';
import { FormsModule } from '@angular/forms';
import { ChatService, ChatMessage } from '../../../core/services/chat.service';

@Component({
  selector: 'app-chatbot',
  standalone: true,
  imports: [CommonModule, FormsModule],
  changeDetection: ChangeDetectionStrategy.OnPush,
  template: `
    <div class="chatbot-container" [class.open]="isOpen">
      <!-- Botón Flotante -->
      <button class="chat-toggle" (click)="toggleChat()" *ngIf="!isOpen">
        <i class="fas fa-robot"></i>
        <span class="tooltip">¡Hola! ¿Te ayudo?</span>
      </button>

      <!-- Ventana de Chat -->
      <div class="chat-window" *ngIf="isOpen">
        <div class="chat-header">
          <div class="header-info">
            <i class="fas fa-robot"></i>
            <div>
              <h3>Asistente MASK!OTAS</h3>
              <span class="status">En línea</span>
            </div>
          </div>
          <button class="close-btn" (click)="toggleChat()">
            <i class="fas fa-times"></i>
          </button>
        </div>

        <div class="chat-messages" #scrollContainer>
          <div class="message system-message">
            <div class="avatar">
              <i class="fas fa-robot"></i>
            </div>
            <div class="bubble">
              ¡Hola! Soy el asistente virtual de MASK!OTAS. 🐾
              <br>¿En qué puedo ayudarte hoy?
            </div>
          </div>

          <div *ngFor="let msg of messages" class="message" [class.user-message]="msg.isUser" [class.bot-message]="!msg.isUser">
            <div class="avatar" *ngIf="!msg.isUser">
              <i class="fas fa-robot"></i>
            </div>
            <div class="bubble">
              {{ msg.text }}
            </div>
          </div>

          <div class="message bot-message" *ngIf="isLoading">
            <div class="avatar">
              <i class="fas fa-robot"></i>
            </div>
            <div class="bubble typing">
              <span></span>
              <span></span>
              <span></span>
            </div>
          </div>
        </div>

        <div class="chat-input-area">
          <input 
            type="text" 
            [(ngModel)]="newMessage" 
            (keyup.enter)="sendMessage()" 
            placeholder="Escribe tu pregunta..."
            [disabled]="isLoading">
          <button (click)="sendMessage()" [disabled]="!newMessage.trim() || isLoading">
            <i class="fas fa-paper-plane"></i>
          </button>
        </div>
      </div>
    </div>
  `,
  styles: [`
    .chatbot-container {
      position: fixed;
      bottom: 20px;
      right: 20px;
      z-index: 1000;
      font-family: 'Arial', sans-serif;
    }

    /* Botón Flotante */
    .chat-toggle {
      width: 60px;
      height: 60px;
      border-radius: 50%;
      background: var(--color-primary, #009688);
      color: white;
      border: none;
      box-shadow: 0 4px 12px rgba(0,0,0,0.2);
      cursor: pointer;
      display: flex;
      align-items: center;
      justify-content: center;
      font-size: 24px;
      transition: transform 0.3s;
      position: relative;
    }

    .chat-toggle:hover {
      transform: scale(1.1);
    }

    .tooltip {
      position: absolute;
      right: 70px;
      background: #333;
      color: white;
      padding: 5px 10px;
      border-radius: 5px;
      font-size: 14px;
      white-space: nowrap;
      opacity: 0;
      transition: opacity 0.3s;
      pointer-events: none;
    }

    .chat-toggle:hover .tooltip {
      opacity: 1;
    }

    /* Ventana de Chat */
    .chat-window {
      width: 350px;
      height: 500px;
      background: white;
      border-radius: 12px;
      box-shadow: 0 5px 20px rgba(0,0,0,0.15);
      display: flex;
      flex-direction: column;
      overflow: hidden;
      animation: slideUp 0.3s ease-out;
    }

    @keyframes slideUp {
      from { transform: translateY(20px); opacity: 0; }
      to { transform: translateY(0); opacity: 1; }
    }

    /* Header */
    .chat-header {
      background: var(--color-primary, #009688);
      color: white;
      padding: 15px;
      display: flex;
      justify-content: space-between;
      align-items: center;
    }

    .header-info {
      display: flex;
      align-items: center;
      gap: 10px;
    }

    .header-info i {
      font-size: 24px;
    }

    .header-info h3 {
      margin: 0;
      font-size: 16px;
    }

    .status {
      font-size: 12px;
      opacity: 0.9;
    }

    .close-btn {
      background: none;
      border: none;
      color: white;
      cursor: pointer;
      font-size: 18px;
    }

    /* Mensajes */
    .chat-messages {
      flex: 1;
      padding: 15px;
      overflow-y: auto;
      background: #f5f5f5;
      display: flex;
      flex-direction: column;
      gap: 15px;
    }

    .message {
      display: flex;
      gap: 10px;
      max-width: 80%;
      align-items: flex-end;
    }

    .user-message {
      align-self: flex-end;
      flex-direction: row-reverse;
    }

    .bot-message {
      align-self: flex-start;
    }

    .avatar {
      width: 30px;
      height: 30px;
      border-radius: 50%;
      background: var(--color-primary, #009688);
      color: white;
      display: flex;
      align-items: center;
      justify-content: center;
      font-size: 14px;
      flex-shrink: 0;
    }

    .bubble {
      padding: 10px 15px;
      border-radius: 15px;
      font-size: 14px;
      line-height: 1.4;
      box-shadow: 0 1px 2px rgba(0,0,0,0.1);
    }

    .bot-message .bubble, .system-message .bubble {
      background: white;
      color: #333;
      border-bottom-left-radius: 2px;
    }

    .user-message .bubble {
      background: var(--color-primary, #009688);
      color: white;
      border-bottom-right-radius: 2px;
    }

    /* Loading Animation */
    .typing {
      display: flex;
      gap: 5px;
      padding: 15px 10px !important;
    }

    .typing span {
      width: 6px;
      height: 6px;
      background: #ccc;
      border-radius: 50%;
      animation: bounce 1.4s infinite ease-in-out both;
    }

    .typing span:nth-child(1) { animation-delay: -0.32s; }
    .typing span:nth-child(2) { animation-delay: -0.16s; }

    @keyframes bounce {
      0%, 80%, 100% { transform: scale(0); }
      40% { transform: scale(1); }
    }

    /* Input Area */
    .chat-input-area {
      padding: 15px;
      background: white;
      border-top: 1px solid #eee;
      display: flex;
      gap: 10px;
    }

    .chat-input-area input {
      flex: 1;
      padding: 10px;
      border: 1px solid #ddd;
      border-radius: 20px;
      outline: none;
      font-size: 14px;
    }

    .chat-input-area input:focus {
      border-color: var(--color-primary, #009688);
    }

    .chat-input-area button {
      background: var(--color-primary, #009688);
      color: white;
      border: none;
      width: 40px;
      height: 40px;
      border-radius: 50%;
      cursor: pointer;
      display: flex;
      align-items: center;
      justify-content: center;
      transition: background 0.3s;
    }

    .chat-input-area button:disabled {
      background: #ccc;
      cursor: not-allowed;
    }

    .chat-input-area button:hover:not(:disabled) {
      background: var(--color-primary-dark, #00796b);
    }
  `]
})
export class ChatbotComponent implements AfterViewChecked {
  isOpen = false;
  messages: ChatMessage[] = [];
  newMessage = '';
  isLoading = false;

  @ViewChild('scrollContainer') private scrollContainer!: ElementRef;

  constructor(
    private chatService: ChatService,
    private cdr: ChangeDetectorRef
  ) { }

  toggleChat() {
    this.isOpen = !this.isOpen;
  }

  sendMessage() {
    if (!this.newMessage.trim() || this.isLoading) return;

    const userMsg = this.newMessage.trim();
    this.messages.push({
      text: userMsg,
      isUser: true,
      timestamp: new Date()
    });
    this.newMessage = '';
    this.isLoading = true;
    this.scrollToBottom();

    this.chatService.sendMessage(userMsg).subscribe({
      next: (response: { reply: string }) => {
        this.messages.push({
          text: response.reply,
          isUser: false,
          timestamp: new Date()
        });
        this.isLoading = false;
        this.cdr.markForCheck();
        this.scrollToBottom();
      },
      error: (error: any) => {
        console.error('Chat error:', error);
        this.messages.push({
          text: 'Lo siento, tuve un problema al procesar tu mensaje. Por favor intenta más tarde.',
          isUser: false,
          timestamp: new Date()
        });
        this.isLoading = false;
        this.cdr.markForCheck();
        this.scrollToBottom();
      }
    });

    this.cdr.markForCheck();
  }

  ngAfterViewChecked() {
    this.scrollToBottom();
  }

  private scrollToBottom(): void {
    try {
      if (this.scrollContainer) {
        this.scrollContainer.nativeElement.scrollTop = this.scrollContainer.nativeElement.scrollHeight;
      }
    } catch (err) { }
  }
}
