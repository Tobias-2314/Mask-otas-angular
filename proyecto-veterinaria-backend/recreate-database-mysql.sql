-- =============================================
-- RECREAR TABLAS PARA MYSQL
-- =============================================

SET FOREIGN_KEY_CHECKS = 0;

-- ELIMINAR TABLAS EXISTENTES
DROP TABLE IF EXISTS appointments;
DROP TABLE IF EXISTS newsletter_subscriptions;
DROP TABLE IF EXISTS contacts;
DROP TABLE IF EXISTS users;
DROP TABLE IF EXISTS cities;
DROP TABLE IF EXISTS countries;

SET FOREIGN_KEY_CHECKS = 1;

-- =============================================
-- CREAR TABLAS
-- =============================================

-- Tabla: countries
CREATE TABLE countries (
    code VARCHAR(3) PRIMARY KEY,
    name VARCHAR(255) NOT NULL
);

-- Tabla: cities
CREATE TABLE cities (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    country_code VARCHAR(3) NOT NULL,
    CONSTRAINT fk_country FOREIGN KEY (country_code) 
        REFERENCES countries(code) 
        ON DELETE CASCADE
);

CREATE INDEX idx_cities_country ON cities(country_code);

-- Tabla: users
CREATE TABLE users (
    id CHAR(36) PRIMARY KEY DEFAULT (UUID()),
    email VARCHAR(255) UNIQUE NOT NULL,
    username VARCHAR(255) NOT NULL,
    password VARCHAR(255) NOT NULL,
    country_code VARCHAR(3),
    city_id INT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    last_login TIMESTAMP NULL,
    CONSTRAINT fk_user_city FOREIGN KEY (city_id) 
        REFERENCES cities(id) 
        ON DELETE SET NULL
);

CREATE INDEX idx_users_email ON users(email);
CREATE INDEX idx_users_city ON users(city_id);

-- Tabla: appointments
CREATE TABLE appointments (
    id CHAR(36) PRIMARY KEY DEFAULT (UUID()),
    owner_name VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL,
    phone VARCHAR(50) NOT NULL,
    pet_name VARCHAR(255) NOT NULL,
    pet_type VARCHAR(50) NOT NULL,
    service_type VARCHAR(100) NOT NULL,
    preferred_date DATE NOT NULL,
    preferred_time TIME NOT NULL,
    notes TEXT,
    status VARCHAR(20) DEFAULT 'pending',
    user_id CHAR(36),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    CONSTRAINT fk_appointment_user FOREIGN KEY (user_id) 
        REFERENCES users(id) 
        ON DELETE SET NULL
);

CREATE INDEX idx_appointments_user ON appointments(user_id);
CREATE INDEX idx_appointments_date ON appointments(preferred_date);
CREATE INDEX idx_appointments_status ON appointments(status);

-- Tabla: newsletter_subscriptions
CREATE TABLE newsletter_subscriptions (
    id CHAR(36) PRIMARY KEY DEFAULT (UUID()),
    email VARCHAR(255) UNIQUE NOT NULL,
    is_active TINYINT(1) DEFAULT 1,
    subscribed_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE INDEX idx_newsletter_email ON newsletter_subscriptions(email);
CREATE INDEX idx_newsletter_active ON newsletter_subscriptions(is_active);

-- Tabla: contacts
CREATE TABLE contacts (
    id CHAR(36) PRIMARY KEY DEFAULT (UUID()),
    name VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL,
    phone VARCHAR(50),
    subject VARCHAR(255) NOT NULL,
    message TEXT NOT NULL,
    status VARCHAR(20) DEFAULT 'pending',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE INDEX idx_contacts_status ON contacts(status);
CREATE INDEX idx_contacts_created ON contacts(created_at);

-- Tabla: reviews
CREATE TABLE reviews (
    id CHAR(36) PRIMARY KEY DEFAULT (UUID()),
    customer_name VARCHAR(255) NOT NULL,
    rating INTEGER NOT NULL,
    comment TEXT NOT NULL,
    pet_name VARCHAR(255),
    service_type VARCHAR(50),
    is_approved TINYINT(1) DEFAULT 1,
    is_visible TINYINT(1) DEFAULT 1,
    user_id CHAR(36),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    CONSTRAINT chk_rating CHECK (rating >= 1 AND rating <= 5),
    CONSTRAINT fk_reviews_user FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE SET NULL
);

CREATE INDEX idx_reviews_visible ON reviews(is_visible, is_approved);
CREATE INDEX idx_reviews_created ON reviews(created_at);

-- =============================================
-- INSERTAR DATOS INICIALES
-- =============================================

-- Países
INSERT INTO countries (code, name) VALUES
('ESP', 'España'),
('USA', 'Estados Unidos'),
('MEX', 'México'),
('ARG', 'Argentina'),
('COL', 'Colombia'),
('FRA', 'Francia'),
('GBR', 'Reino Unido'),
('DEU', 'Alemania'),
('ITA', 'Italia'),
('PRT', 'Portugal');

-- Ciudades de España
INSERT INTO cities (name, country_code) VALUES
('Madrid', 'ESP'),
('Barcelona', 'ESP'),
('Valencia', 'ESP'),
('Sevilla', 'ESP'),
('Zaragoza', 'ESP'),
('Málaga', 'ESP'),
('Murcia', 'ESP'),
('Bilbao', 'ESP'),
('Alicante', 'ESP'),
('Córdoba', 'ESP');

-- Ciudades de Estados Unidos
INSERT INTO cities (name, country_code) VALUES
('New York', 'USA'),
('Los Angeles', 'USA'),
('Chicago', 'USA'),
('Houston', 'USA'),
('Phoenix', 'USA'),
('Philadelphia', 'USA'),
('San Antonio', 'USA'),
('San Diego', 'USA'),
('Dallas', 'USA'),
('San Jose', 'USA');

-- Ciudades de México
INSERT INTO cities (name, country_code) VALUES
('Ciudad de México', 'MEX'),
('Guadalajara', 'MEX'),
('Monterrey', 'MEX'),
('Puebla', 'MEX'),
('Tijuana', 'MEX'),
('León', 'MEX'),
('Juárez', 'MEX'),
('Zapopan', 'MEX'),
('Mérida', 'MEX'),
('Cancún', 'MEX');

-- Ciudades de Argentina
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
('San Juan', 'ARG');

-- Ciudades de Colombia
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
('Ibagué', 'COL');

-- Ciudades de Francia
INSERT INTO cities (name, country_code) VALUES
('París', 'FRA'),
('Marsella', 'FRA'),
('Lyon', 'FRA'),
('Toulouse', 'FRA'),
('Niza', 'FRA'),
('Nantes', 'FRA'),
('Estrasburgo', 'FRA'),
('Montpellier', 'FRA'),
('Burdeos', 'FRA'),
('Lille', 'FRA');

-- Ciudades de Reino Unido
INSERT INTO cities (name, country_code) VALUES
('Londres', 'GBR'),
('Birmingham', 'GBR'),
('Manchester', 'GBR'),
('Glasgow', 'GBR'),
('Liverpool', 'GBR'),
('Leeds', 'GBR'),
('Newcastle', 'GBR'),
('Sheffield', 'GBR'),
('Bristol', 'GBR'),
('Edimburgo', 'GBR');

-- Ciudades de Alemania
INSERT INTO cities (name, country_code) VALUES
('Berlín', 'DEU'),
('Hamburgo', 'DEU'),
('Múnich', 'DEU'),
('Colonia', 'DEU'),
('Fráncfort', 'DEU'),
('Stuttgart', 'DEU'),
('Düsseldorf', 'DEU'),
('Dortmund', 'DEU'),
('Essen', 'DEU'),
('Leipzig', 'DEU');

-- Ciudades de Italia
INSERT INTO cities (name, country_code) VALUES
('Roma', 'ITA'),
('Milán', 'ITA'),
('Nápoles', 'ITA'),
('Turín', 'ITA'),
('Palermo', 'ITA'),
('Génova', 'ITA'),
('Bolonia', 'ITA'),
('Florencia', 'ITA'),
('Venecia', 'ITA'),
('Verona', 'ITA');

-- Ciudades de Portugal
INSERT INTO cities (name, country_code) VALUES
('Lisboa', 'PRT'),
('Oporto', 'PRT'),
('Braga', 'PRT'),
('Coímbra', 'PRT'),
('Funchal', 'PRT'),
('Setúbal', 'PRT'),
('Almada', 'PRT'),
('Aveiro', 'PRT'),
('Évora', 'PRT'),
('Faro', 'PRT');

-- Resumen
SELECT 'Countries' as tabla, COUNT(*) as registros FROM countries
UNION ALL
SELECT 'Cities', COUNT(*) FROM cities
UNION ALL
SELECT 'Users', COUNT(*) FROM users
UNION ALL
SELECT 'Appointments', COUNT(*) FROM appointments
UNION ALL
SELECT 'Newsletter', COUNT(*) FROM newsletter_subscriptions
UNION ALL
SELECT 'Contacts', COUNT(*) FROM contacts
UNION ALL
SELECT 'Reviews', COUNT(*) FROM reviews;
