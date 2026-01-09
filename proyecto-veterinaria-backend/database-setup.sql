-- ================================================
-- MASK!OTAS - Veterinary Clinic Database Setup
-- PostgreSQL Version
-- ================================================
-- This script creates all necessary tables and populates
-- countries and cities with initial data.
-- ================================================

-- ================================================
-- 1. COUNTRIES TABLE
-- ================================================
CREATE TABLE IF NOT EXISTS countries (
    code VARCHAR(3) PRIMARY KEY,
    name VARCHAR(255) NOT NULL
);

-- Populate countries with Spanish-speaking countries and popular countries
INSERT INTO countries (code, name) VALUES
    ('ESP', 'España'),
    ('ARG', 'Argentina'),
    ('MEX', 'México'),
    ('COL', 'Colombia'),
    ('CHI', 'Chile'),
    ('PER', 'Perú'),
    ('VEN', 'Venezuela'),
    ('ECU', 'Ecuador'),
    ('URU', 'Uruguay'),
    ('BOL', 'Bolivia'),
    ('PAR', 'Paraguay'),
    ('CRI', 'Costa Rica'),
    ('PAN', 'Panamá'),
    ('DOM', 'República Dominicana'),
    ('CUB', 'Cuba'),
    ('GTM', 'Guatemala'),
    ('HON', 'Honduras'),
    ('SLV', 'El Salvador'),
    ('NIC', 'Nicaragua'),
    ('PRI', 'Puerto Rico'),
    ('USA', 'Estados Unidos'),
    ('CAN', 'Canadá'),
    ('BRA', 'Brasil'),
    ('POR', 'Portugal'),
    ('FRA', 'Francia'),
    ('ITA', 'Italia'),
    ('GER', 'Alemania'),
    ('UK', 'Reino Unido')
ON CONFLICT (code) DO NOTHING;

-- ================================================
-- 2. CITIES TABLE
-- ================================================
CREATE TABLE IF NOT EXISTS cities (
    id SERIAL PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    country_code VARCHAR(3) NOT NULL,
    FOREIGN KEY (country_code) REFERENCES countries(code) ON DELETE CASCADE
);

-- Populate cities by country
-- España (ESP)
INSERT INTO cities (name, country_code) VALUES
    ('Madrid', 'ESP'),
    ('Barcelona', 'ESP'),
    ('Valencia', 'ESP'),
    ('Sevilla', 'ESP'),
    ('Zaragoza', 'ESP'),
    ('Málaga', 'ESP'),
    ('Murcia', 'ESP'),
    ('Palma de Mallorca', 'ESP'),
    ('Las Palmas de Gran Canaria', 'ESP'),
    ('Bilbao', 'ESP'),
    ('Alicante', 'ESP'),
    ('Córdoba', 'ESP'),
    ('Valladolid', 'ESP'),
    ('Vigo', 'ESP'),
    ('Gijón', 'ESP'),
    ('A Coruña', 'ESP'),
    ('Granada', 'ESP'),
    ('Vitoria', 'ESP'),
    ('Elche', 'ESP'),
    ('Oviedo', 'ESP')
ON CONFLICT DO NOTHING;

-- Argentina (ARG)
INSERT INTO cities (name, country_code) VALUES
    ('Buenos Aires', 'ARG'),
    ('Córdoba', 'ARG'),
    ('Rosario', 'ARG'),
    ('Mendoza', 'ARG'),
    ('La Plata', 'ARG'),
    ('San Miguel de Tucumán', 'ARG'),
    ('Mar del Plata', 'ARG'),
    ('Salta', 'ARG'),
    ('Santa Fe', 'ARG'),
    ('San Juan', 'ARG')
ON CONFLICT DO NOTHING;

-- México (MEX)
INSERT INTO cities (name, country_code) VALUES
    ('Ciudad de México', 'MEX'),
    ('Guadalajara', 'MEX'),
    ('Monterrey', 'MEX'),
    ('Puebla', 'MEX'),
    ('Tijuana', 'MEX'),
    ('León', 'MEX'),
    ('Juárez', 'MEX'),
    ('Mérida', 'MEX'),
    ('Cancún', 'MEX'),
    ('Querétaro', 'MEX')
ON CONFLICT DO NOTHING;

-- Colombia (COL)
INSERT INTO cities (name, country_code) VALUES
    ('Bogotá', 'COL'),
    ('Medellín', 'COL'),
    ('Cali', 'COL'),
    ('Barranquilla', 'COL'),
    ('Cartagena', 'COL'),
    ('Cúcuta', 'COL'),
    ('Bucaramanga', 'COL'),
    ('Pereira', 'COL'),
    ('Santa Marta', 'COL'),
    ('Ibagué', 'COL')
ON CONFLICT DO NOTHING;

-- Chile (CHI)
INSERT INTO cities (name, country_code) VALUES
    ('Santiago', 'CHI'),
    ('Valparaíso', 'CHI'),
    ('Concepción', 'CHI'),
    ('La Serena', 'CHI'),
    ('Antofagasta', 'CHI'),
    ('Temuco', 'CHI'),
    ('Rancagua', 'CHI'),
    ('Talca', 'CHI'),
    ('Arica', 'CHI'),
    ('Iquique', 'CHI')
ON CONFLICT DO NOTHING;

-- Perú (PER)
INSERT INTO cities (name, country_code) VALUES
    ('Lima', 'PER'),
    ('Arequipa', 'PER'),
    ('Trujillo', 'PER'),
    ('Chiclayo', 'PER'),
    ('Piura', 'PER'),
    ('Cusco', 'PER'),
    ('Iquitos', 'PER'),
    ('Huancayo', 'PER'),
    ('Tacna', 'PER'),
    ('Pucallpa', 'PER')
ON CONFLICT DO NOTHING;

-- Venezuela (VEN)
INSERT INTO cities (name, country_code) VALUES
    ('Caracas', 'VEN'),
    ('Maracaibo', 'VEN'),
    ('Valencia', 'VEN'),
    ('Barquisimeto', 'VEN'),
    ('Maracay', 'VEN'),
    ('Ciudad Guayana', 'VEN'),
    ('Barcelona', 'VEN'),
    ('Maturín', 'VEN'),
    ('Puerto La Cruz', 'VEN'),
    ('Mérida', 'VEN')
ON CONFLICT DO NOTHING;

-- Ecuador (ECU)
INSERT INTO cities (name, country_code) VALUES
    ('Quito', 'ECU'),
    ('Guayaquil', 'ECU'),
    ('Cuenca', 'ECU'),
    ('Santo Domingo', 'ECU'),
    ('Machala', 'ECU'),
    ('Manta', 'ECU'),
    ('Portoviejo', 'ECU'),
    ('Ambato', 'ECU'),
    ('Loja', 'ECU'),
    ('Esmeraldas', 'ECU')
ON CONFLICT DO NOTHING;

-- Uruguay (URU)
INSERT INTO cities (name, country_code) VALUES
    ('Montevideo', 'URU'),
    ('Salto', 'URU'),
    ('Paysandú', 'URU'),
    ('Las Piedras', 'URU'),
    ('Rivera', 'URU'),
    ('Maldonado', 'URU'),
    ('Tacuarembó', 'URU'),
    ('Melo', 'URU'),
    ('Mercedes', 'URU'),
    ('Artigas', 'URU')
ON CONFLICT DO NOTHING;

-- Bolivia (BOL)
INSERT INTO cities (name, country_code) VALUES
    ('La Paz', 'BOL'),
    ('Santa Cruz de la Sierra', 'BOL'),
    ('Cochabamba', 'BOL'),
    ('Sucre', 'BOL'),
    ('Oruro', 'BOL'),
    ('Tarija', 'BOL'),
    ('Potosí', 'BOL'),
    ('Trinidad', 'BOL'),
    ('Cobija', 'BOL'),
    ('Riberalta', 'BOL')
ON CONFLICT DO NOTHING;

-- Paraguay (PAR)
INSERT INTO cities (name, country_code) VALUES
    ('Asunción', 'PAR'),
    ('Ciudad del Este', 'PAR'),
    ('San Lorenzo', 'PAR'),
    ('Luque', 'PAR'),
    ('Capiatá', 'PAR'),
    ('Lambaré', 'PAR'),
    ('Fernando de la Mora', 'PAR'),
    ('Limpio', 'PAR'),
    ('Ñemby', 'PAR'),
    ('Encarnación', 'PAR')
ON CONFLICT DO NOTHING;

-- Costa Rica (CRI)
INSERT INTO cities (name, country_code) VALUES
    ('San José', 'CRI'),
    ('Alajuela', 'CRI'),
    ('Cartago', 'CRI'),
    ('Heredia', 'CRI'),
    ('Puntarenas', 'CRI'),
    ('Limón', 'CRI'),
    ('Liberia', 'CRI'),
    ('Pérez Zeledón', 'CRI'),
    ('San Isidro', 'CRI'),
    ('Quepos', 'CRI')
ON CONFLICT DO NOTHING;

-- Panamá (PAN)
INSERT INTO cities (name, country_code) VALUES
    ('Ciudad de Panamá', 'PAN'),
    ('San Miguelito', 'PAN'),
    ('Tocumen', 'PAN'),
    ('David', 'PAN'),
    ('Colón', 'PAN'),
    ('La Chorrera', 'PAN'),
    ('Pacora', 'PAN'),
    ('Santiago', 'PAN'),
    ('Chitré', 'PAN'),
    ('Arraiján', 'PAN')
ON CONFLICT DO NOTHING;

-- Estados Unidos (USA)
INSERT INTO cities (name, country_code) VALUES
    ('Nueva York', 'USA'),
    ('Los Ángeles', 'USA'),
    ('Chicago', 'USA'),
    ('Houston', 'USA'),
    ('Miami', 'USA'),
    ('San Francisco', 'USA'),
    ('Boston', 'USA'),
    ('Seattle', 'USA'),
    ('Washington D.C.', 'USA'),
    ('Atlanta', 'USA')
ON CONFLICT DO NOTHING;

-- Canadá (CAN)
INSERT INTO cities (name, country_code) VALUES
    ('Toronto', 'CAN'),
    ('Montreal', 'CAN'),
    ('Vancouver', 'CAN'),
    ('Calgary', 'CAN'),
    ('Edmonton', 'CAN'),
    ('Ottawa', 'CAN'),
    ('Winnipeg', 'CAN'),
    ('Quebec', 'CAN'),
    ('Hamilton', 'CAN'),
    ('Victoria', 'CAN')
ON CONFLICT DO NOTHING;

-- Brasil (BRA)
INSERT INTO cities (name, country_code) VALUES
    ('São Paulo', 'BRA'),
    ('Río de Janeiro', 'BRA'),
    ('Brasilia', 'BRA'),
    ('Salvador', 'BRA'),
    ('Fortaleza', 'BRA'),
    ('Belo Horizonte', 'BRA'),
    ('Manaos', 'BRA'),
    ('Curitiba', 'BRA'),
    ('Recife', 'BRA'),
    ('Porto Alegre', 'BRA')
ON CONFLICT DO NOTHING;

-- ================================================
-- 3. USERS TABLE
-- ================================================
CREATE TABLE IF NOT EXISTS users (
    id UUID PRIMARY KEY DEFAULT gen_random_uuid(),
    email VARCHAR(255) UNIQUE NOT NULL,
    username VARCHAR(255) NOT NULL,
    password VARCHAR(255) NOT NULL,
    country_code VARCHAR(3),
    city_id INT,
    created_at TIMESTAMPTZ DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMPTZ DEFAULT CURRENT_TIMESTAMP,
    last_login TIMESTAMPTZ NULL,
    FOREIGN KEY (city_id) REFERENCES cities(id) ON DELETE SET NULL
);

-- ================================================
-- 4. APPOINTMENTS TABLE
-- ================================================
CREATE TABLE IF NOT EXISTS appointments (
    id UUID PRIMARY KEY DEFAULT gen_random_uuid(),
    owner_name VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL,
    phone VARCHAR(255) NOT NULL,
    pet_name VARCHAR(255) NOT NULL,
    pet_type VARCHAR(50) NOT NULL,
    service_type VARCHAR(100) NOT NULL,
    preferred_date DATE NOT NULL,
    preferred_time TIME NOT NULL,
    notes TEXT,
    status VARCHAR(20) DEFAULT 'pending',
    user_id UUID,
    created_at TIMESTAMPTZ DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE SET NULL
);

-- ================================================
-- 5. TIME SLOTS TABLE
-- ================================================
CREATE TABLE IF NOT EXISTS time_slots (
    id UUID PRIMARY KEY DEFAULT gen_random_uuid(),
    slot_date DATE NOT NULL,
    slot_time TIME NOT NULL,
    max_capacity INT DEFAULT 3,
    current_bookings INT DEFAULT 0,
    doctor_name VARCHAR(100),
    created_at TIMESTAMPTZ DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMPTZ DEFAULT CURRENT_TIMESTAMP,
    UNIQUE (slot_date, slot_time)
);

-- ================================================
-- 6. CONTACTS TABLE
-- ================================================
CREATE TABLE IF NOT EXISTS contacts (
    id UUID PRIMARY KEY DEFAULT gen_random_uuid(),
    name VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL,
    subject VARCHAR(255) NOT NULL,
    message TEXT NOT NULL,
    status VARCHAR(50) DEFAULT 'pending',
    created_at TIMESTAMPTZ DEFAULT CURRENT_TIMESTAMP
);

-- ================================================
-- 7. NEWSLETTER SUBSCRIPTIONS TABLE
-- ================================================
CREATE TABLE IF NOT EXISTS newsletter_subscriptions (
    id UUID PRIMARY KEY DEFAULT gen_random_uuid(),
    email VARCHAR(255) UNIQUE NOT NULL,
    is_active BOOLEAN DEFAULT TRUE,
    subscribed_at TIMESTAMPTZ DEFAULT CURRENT_TIMESTAMP
);

-- ================================================
-- 8. REVIEWS TABLE
-- ================================================
CREATE TABLE IF NOT EXISTS reviews (
    id UUID PRIMARY KEY DEFAULT gen_random_uuid(),
    customer_name VARCHAR(255) NOT NULL,
    rating INT NOT NULL CHECK (rating >= 1 AND rating <= 5),
    comment TEXT NOT NULL,
    pet_name VARCHAR(255),
    service_type VARCHAR(50),
    is_approved BOOLEAN DEFAULT FALSE,
    is_visible BOOLEAN DEFAULT TRUE,
    user_id UUID,
    created_at TIMESTAMPTZ DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE SET NULL
);

-- ================================================
-- INDEXES FOR PERFORMANCE
-- ================================================
CREATE INDEX IF NOT EXISTS idx_users_email ON users(email);
CREATE INDEX IF NOT EXISTS idx_appointments_status ON appointments(status);
CREATE INDEX IF NOT EXISTS idx_appointments_date ON appointments(preferred_date);
CREATE INDEX IF NOT EXISTS idx_appointments_user ON appointments(user_id);
CREATE INDEX IF NOT EXISTS idx_time_slots_date ON time_slots(slot_date);
CREATE INDEX IF NOT EXISTS idx_contacts_status ON contacts(status);
CREATE INDEX IF NOT EXISTS idx_reviews_approved ON reviews(is_approved);
CREATE INDEX IF NOT EXISTS idx_reviews_visible ON reviews(is_visible);
CREATE INDEX IF NOT EXISTS idx_cities_country ON cities(country_code);

-- ================================================
-- END OF DATABASE SETUP
-- ================================================
