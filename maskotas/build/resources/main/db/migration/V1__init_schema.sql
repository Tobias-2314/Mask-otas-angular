CREATE TABLE usuarios (
    id          BIGSERIAL PRIMARY KEY,
    nombre      VARCHAR(255),
    email       VARCHAR(255) NOT NULL UNIQUE,
    contrasena  VARCHAR(255),
    role        VARCHAR(50),
    foto_perfil VARCHAR(255),
    configuracion TEXT
);

CREATE TABLE mascotas (
    id            BIGSERIAL PRIMARY KEY,
    nombre        VARCHAR(255),
    tipo          VARCHAR(255),
    raza          VARCHAR(255),
    edad          INTEGER,
    peso          DOUBLE PRECISION,
    genero        VARCHAR(50),
    notas_medicas TEXT,
    usuario_id    BIGINT REFERENCES usuarios(id)
);

CREATE TABLE productos (
    id          BIGSERIAL PRIMARY KEY,
    nombre      VARCHAR(255),
    descripcion TEXT,
    precio      DOUBLE PRECISION,
    stock       INTEGER,
    imagen      VARCHAR(255),
    categoria   VARCHAR(255)
);

CREATE TABLE orders (
    id         BIGSERIAL PRIMARY KEY,
    fecha      TIMESTAMP,
    usuario_id BIGINT REFERENCES usuarios(id),
    total      DOUBLE PRECISION
);

CREATE TABLE order_items (
    id          BIGSERIAL PRIMARY KEY,
    order_id    BIGINT REFERENCES orders(id),
    producto_id BIGINT REFERENCES productos(id),
    cantidad    INTEGER,
    subtotal    DOUBLE PRECISION
);

CREATE TABLE citas (
    id              BIGSERIAL PRIMARY KEY,
    tipo_servicio   VARCHAR(255),
    fecha_preferida DATE,
    hora_preferida  VARCHAR(50),
    notas           TEXT,
    nombre_dueno    VARCHAR(255),
    email           VARCHAR(255),
    telefono        VARCHAR(50),
    nombre_mascota  VARCHAR(255),
    tipo_mascota    VARCHAR(255),
    estado          VARCHAR(50),
    diagnostico     TEXT,
    tratamiento     TEXT,
    notas_internas  TEXT,
    usuario_id      BIGINT REFERENCES usuarios(id),
    mascota_id      BIGINT REFERENCES mascotas(id),
    veterinario_id  BIGINT REFERENCES usuarios(id)
);

CREATE TABLE historial_medico (
    id             BIGSERIAL PRIMARY KEY,
    descripcion    TEXT,
    fecha          DATE,
    tipo           VARCHAR(255),
    mascota_id     BIGINT REFERENCES mascotas(id),
    veterinario_id BIGINT REFERENCES usuarios(id)
);

CREATE TABLE resenas (
    id          BIGSERIAL PRIMARY KEY,
    titulo      VARCHAR(255),
    comentario  TEXT,
    valoracion  INTEGER,
    usuario_id  BIGINT REFERENCES usuarios(id),
    producto_id BIGINT REFERENCES productos(id),
    fecha       TIMESTAMP
);

CREATE TABLE site_settings (
    id    BIGSERIAL PRIMARY KEY,
    clave VARCHAR(255),
    valor TEXT
);
