-- ==========================================
-- 1. PERSIAPAN SISTEM
-- ==========================================
CREATE EXTENSION IF NOT EXISTS "pgcrypto"; -- Biar UUID (gen_random_uuid) jalan

-- Hapus jika sudah ada (Biar bisa di-reset berkali-kali)
DROP TABLE IF EXISTS users CASCADE;
DROP TABLE IF EXISTS villages CASCADE;
DROP TABLE IF EXISTS districts CASCADE;
DROP TABLE IF EXISTS regencies CASCADE;
DROP TABLE IF EXISTS provinces CASCADE;
DROP TYPE IF EXISTS user_level CASCADE;

-- ==========================================
-- 2. STRUKTUR TABEL (PONDASI)
-- ==========================================
CREATE TABLE provinces (
    id CHAR(2) PRIMARY KEY,
    name VARCHAR(100) NOT NULL
);

CREATE TABLE regencies (
    id CHAR(4) PRIMARY KEY,
    province_id CHAR(2) REFERENCES provinces(id),
    name VARCHAR(100) NOT NULL
);

CREATE TABLE districts (
    id CHAR(6) PRIMARY KEY,
    regency_id CHAR(4) REFERENCES regencies(id),
    name VARCHAR(100) NOT NULL
);

CREATE TABLE villages (
    id CHAR(10) PRIMARY KEY,
    district_id CHAR(6) REFERENCES districts(id),
    name VARCHAR(100) NOT NULL
);

CREATE TYPE user_level AS ENUM ('nasional', 'provinsi', 'kabupaten', 'kecamatan', 'desa');

CREATE TABLE users (
    id UUID PRIMARY KEY DEFAULT gen_random_uuid(),
    username VARCHAR(50) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL, -- Ingat: Nanti pakai password_hash di PHP
    full_name VARCHAR(100),
    level user_level NOT NULL,
    kode_wilayah VARCHAR(10), -- Bisa NULL untuk level nasional
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- ==========================================
-- 3. ISI DATA AWAL (BAHAN TES)
-- ==========================================

-- Masukkan 1 Provinsi (Aceh sesuai kodemu)
INSERT INTO provinces (id, name) VALUES ('11', 'ACEH');

-- Masukkan 1 Kabupaten
INSERT INTO regencies (id, province_id, name) VALUES ('1103', '11', 'KAB. ACEH TIMUR');

-- Masukkan 1 Kecamatan
INSERT INTO districts (id, regency_id, name) VALUES ('110314', '1103', 'IDY RAYEUK');

-- Masukkan 2 Desa buat simulasi Multi-tenant
INSERT INTO villages (id, district_id, name) VALUES ('1103142020', '110314', 'DESA BUKET ITAM');
INSERT INTO villages (id, district_id, name) VALUES ('1103142022', '110314', 'DESA TITI BARO');

-- ==========================================
-- 4. BUAT USER ADMIN PERTAMA
-- ==========================================
-- Password sementara: 'Andesbar123' (Ini teks asli, nanti di PHP harus di-hash)
INSERT INTO users (username, password, full_name, level, kode_wilayah)
VALUES ('admin_pusat', 'Andesbar123', 'Super Admin ANDESBAR', 'nasional', NULL);

INSERT INTO users (username, password, full_name, level, kode_wilayah)
VALUES ('admin_desa', 'Desa123', 'Operator Desa Buket Itam', 'desa', '1103142020');
