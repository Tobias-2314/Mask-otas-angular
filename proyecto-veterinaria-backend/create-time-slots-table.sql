-- Crear tabla time_slots para gestionar capacidad de horarios
CREATE TABLE IF NOT EXISTS time_slots (
    id UUID PRIMARY KEY DEFAULT uuid_generate_v4(),
    slot_date DATE NOT NULL,
    slot_time TIME NOT NULL,
    max_capacity INTEGER NOT NULL DEFAULT 3,
    current_bookings INTEGER NOT NULL DEFAULT 0,
    doctor_name VARCHAR(100),
    created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    CONSTRAINT unique_slot UNIQUE (slot_date, slot_time),
    CONSTRAINT check_bookings CHECK (current_bookings >= 0 AND current_bookings <= max_capacity)
);

-- Crear índice para búsquedas rápidas por fecha
CREATE INDEX IF NOT EXISTS idx_time_slots_date ON time_slots(slot_date);

-- Crear índice para búsquedas por fecha y hora
CREATE INDEX IF NOT EXISTS idx_time_slots_date_time ON time_slots(slot_date, slot_time);
