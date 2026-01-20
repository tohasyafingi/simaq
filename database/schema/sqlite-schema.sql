CREATE TABLE IF NOT EXISTS "migrations"(
  "id" integer primary key autoincrement not null,
  "migration" varchar not null,
  "batch" integer not null
);
CREATE TABLE IF NOT EXISTS "password_reset_tokens"(
  "email" varchar not null,
  "token" varchar not null,
  "created_at" datetime,
  primary key("email")
);
CREATE TABLE IF NOT EXISTS "sessions"(
  "id" varchar not null,
  "user_id" integer,
  "ip_address" varchar,
  "user_agent" text,
  "payload" text not null,
  "last_activity" integer not null,
  primary key("id")
);
CREATE INDEX "sessions_user_id_index" on "sessions"("user_id");
CREATE INDEX "sessions_last_activity_index" on "sessions"("last_activity");
CREATE TABLE IF NOT EXISTS "cache"(
  "key" varchar not null,
  "value" text not null,
  "expiration" integer not null,
  primary key("key")
);
CREATE TABLE IF NOT EXISTS "cache_locks"(
  "key" varchar not null,
  "owner" varchar not null,
  "expiration" integer not null,
  primary key("key")
);
CREATE TABLE IF NOT EXISTS "jobs"(
  "id" integer primary key autoincrement not null,
  "queue" varchar not null,
  "payload" text not null,
  "attempts" integer not null,
  "reserved_at" integer,
  "available_at" integer not null,
  "created_at" integer not null
);
CREATE INDEX "jobs_queue_index" on "jobs"("queue");
CREATE TABLE IF NOT EXISTS "job_batches"(
  "id" varchar not null,
  "name" varchar not null,
  "total_jobs" integer not null,
  "pending_jobs" integer not null,
  "failed_jobs" integer not null,
  "failed_job_ids" text not null,
  "options" text,
  "cancelled_at" integer,
  "created_at" integer not null,
  "finished_at" integer,
  primary key("id")
);
CREATE TABLE IF NOT EXISTS "failed_jobs"(
  "id" integer primary key autoincrement not null,
  "uuid" varchar not null,
  "connection" text not null,
  "queue" text not null,
  "payload" text not null,
  "exception" text not null,
  "failed_at" datetime not null default CURRENT_TIMESTAMP
);
CREATE UNIQUE INDEX "failed_jobs_uuid_unique" on "failed_jobs"("uuid");
CREATE TABLE IF NOT EXISTS "tahun_ajarans"(
  "id" integer primary key autoincrement not null,
  "tahun" varchar not null,
  "semester" varchar check("semester" in('Ganjil', 'Genap')) not null,
  "status" tinyint(1) not null default '0',
  "created_at" datetime,
  "updated_at" datetime
);
CREATE TABLE IF NOT EXISTS "tingkat_kelas"(
  "id" integer primary key autoincrement not null,
  "tingkat" varchar not null,
  "urutan" integer not null,
  "status" tinyint(1) not null default '1',
  "created_at" datetime,
  "updated_at" datetime
);
CREATE UNIQUE INDEX "tingkat_kelas_urutan_unique" on "tingkat_kelas"("urutan");
CREATE TABLE IF NOT EXISTS "jurusans"(
  "id" integer primary key autoincrement not null,
  "kode" varchar not null,
  "nama" varchar not null,
  "status" tinyint(1) not null default '1',
  "created_at" datetime,
  "updated_at" datetime
);
CREATE TABLE IF NOT EXISTS "ruang_kelas"(
  "id" integer primary key autoincrement not null,
  "nama" varchar not null,
  "status" tinyint(1) not null default '1',
  "created_at" datetime,
  "updated_at" datetime
);
CREATE TABLE IF NOT EXISTS "pelajarans"(
  "id" integer primary key autoincrement not null,
  "kd_pelajaran" varchar not null,
  "nama" varchar not null,
  "jurusan_id" integer not null,
  "tingkat_kelas_id" integer not null,
  "status" tinyint(1) not null default '1',
  "created_at" datetime,
  "updated_at" datetime,
  foreign key("jurusan_id") references "jurusans"("id") on delete cascade,
  foreign key("tingkat_kelas_id") references "tingkat_kelas"("id") on delete cascade
);
CREATE UNIQUE INDEX "pelajarans_kd_pelajaran_unique" on "pelajarans"(
  "kd_pelajaran"
);
CREATE TABLE IF NOT EXISTS "moduls"(
  "id" integer primary key autoincrement not null,
  "nama" varchar not null,
  "pelajaran_id" integer not null,
  "link" varchar,
  "file" varchar,
  "status" tinyint(1) not null default '1',
  "created_at" datetime,
  "updated_at" datetime,
  foreign key("pelajaran_id") references "pelajarans"("id") on delete cascade
);
CREATE TABLE IF NOT EXISTS "gurus"(
  "id" integer primary key autoincrement not null,
  "kd_guru" varchar not null,
  "name" varchar not null,
  "email" varchar not null,
  "no_hp" varchar not null,
  "img" varchar,
  "status" tinyint(1) not null default '1',
  "created_at" datetime,
  "updated_at" datetime
);
CREATE UNIQUE INDEX "gurus_kd_guru_unique" on "gurus"("kd_guru");
CREATE UNIQUE INDEX "gurus_email_unique" on "gurus"("email");
CREATE TABLE IF NOT EXISTS "siswas"(
  "id" integer primary key autoincrement not null,
  "nis" varchar not null,
  "name" varchar not null,
  "email" varchar not null,
  "no_hp" varchar not null,
  "jenis_kelamin" varchar check("jenis_kelamin" in('L', 'P')) not null,
  "tempat_lahir" varchar not null,
  "tanggal_lahir" date not null,
  "alamat" text not null,
  "kk" varchar,
  "akta" varchar,
  "ijazah_terakhir" varchar,
  "img" varchar,
  "status" varchar check("status" in('aktif', 'tidak_aktif', 'lulus')) not null,
  "created_at" datetime,
  "updated_at" datetime
);
CREATE UNIQUE INDEX "siswas_nis_unique" on "siswas"("nis");
CREATE UNIQUE INDEX "siswas_email_unique" on "siswas"("email");
CREATE TABLE IF NOT EXISTS "bendaharas"(
  "id" integer primary key autoincrement not null,
  "kd_bendahara" varchar not null,
  "name" varchar not null,
  "email" varchar not null,
  "no_hp" varchar not null,
  "img" varchar,
  "status" tinyint(1) not null default '1',
  "created_at" datetime,
  "updated_at" datetime
);
CREATE UNIQUE INDEX "bendaharas_kd_bendahara_unique" on "bendaharas"(
  "kd_bendahara"
);
CREATE UNIQUE INDEX "bendaharas_email_unique" on "bendaharas"("email");
CREATE TABLE IF NOT EXISTS "tata_usahas"(
  "id" integer primary key autoincrement not null,
  "kd_tu" varchar not null,
  "name" varchar not null,
  "email" varchar not null,
  "no_hp" varchar not null,
  "img" varchar,
  "status" tinyint(1) not null default '1',
  "created_at" datetime,
  "updated_at" datetime
);
CREATE UNIQUE INDEX "tata_usahas_kd_tu_unique" on "tata_usahas"("kd_tu");
CREATE UNIQUE INDEX "tata_usahas_email_unique" on "tata_usahas"("email");
CREATE TABLE IF NOT EXISTS "siswa_kelas"(
  "id" integer primary key autoincrement not null,
  "siswa_id" integer not null,
  "ruang_kelas_id" integer not null,
  "tingkat_kelas_id" integer not null,
  "jurusan_id" integer not null,
  "tahun_ajaran_id" integer not null,
  "status" tinyint(1) not null default '1',
  "created_at" datetime,
  "updated_at" datetime,
  foreign key("siswa_id") references "siswas"("id") on delete cascade,
  foreign key("ruang_kelas_id") references "ruang_kelas"("id") on delete cascade,
  foreign key("tingkat_kelas_id") references "tingkat_kelas"("id") on delete cascade,
  foreign key("jurusan_id") references "jurusans"("id") on delete cascade,
  foreign key("tahun_ajaran_id") references "tahun_ajarans"("id") on delete cascade
);
CREATE TABLE IF NOT EXISTS "guru_pelajarans"(
  "id" integer primary key autoincrement not null,
  "guru_id" integer not null,
  "pelajaran_id" integer not null,
  "tahun_ajaran_id" integer not null,
  "status" tinyint(1) not null default '1',
  "created_at" datetime,
  "updated_at" datetime,
  foreign key("guru_id") references "gurus"("id") on delete cascade,
  foreign key("pelajaran_id") references "pelajarans"("id") on delete cascade,
  foreign key("tahun_ajaran_id") references "tahun_ajarans"("id") on delete cascade
);
CREATE TABLE IF NOT EXISTS "kat_beritas"(
  "id" integer primary key autoincrement not null,
  "nama" varchar not null,
  "slug" varchar not null,
  "created_at" datetime,
  "updated_at" datetime
);
CREATE UNIQUE INDEX "kat_beritas_slug_unique" on "kat_beritas"("slug");
CREATE TABLE IF NOT EXISTS "kat_karya_ilmiahs"(
  "id" integer primary key autoincrement not null,
  "nama" varchar not null,
  "slug" varchar not null,
  "created_at" datetime,
  "updated_at" datetime
);
CREATE UNIQUE INDEX "kat_karya_ilmiahs_slug_unique" on "kat_karya_ilmiahs"(
  "slug"
);
CREATE TABLE IF NOT EXISTS "beritas"(
  "id" integer primary key autoincrement not null,
  "judul" varchar not null,
  "slug" varchar not null,
  "thumbnail" varchar not null,
  "kat_berita_id" integer not null,
  "status" tinyint(1) not null default '0',
  "isi" text not null,
  "created_at" datetime,
  "updated_at" datetime,
  foreign key("kat_berita_id") references "kat_beritas"("id") on delete cascade
);
CREATE TABLE IF NOT EXISTS "karya_ilmiahs"(
  "id" integer primary key autoincrement not null,
  "judul" varchar not null,
  "author" varchar not null,
  "slug" varchar not null,
  "thumbnail" varchar not null,
  "kat_karya_ilmiah_id" integer not null,
  "status" tinyint(1) not null default '0',
  "isi" text not null,
  "created_at" datetime,
  "updated_at" datetime,
  foreign key("kat_karya_ilmiah_id") references "kat_karya_ilmiahs"("id") on delete cascade
);
CREATE TABLE IF NOT EXISTS "rombels"(
  "id" integer primary key autoincrement not null,
  "nama" varchar not null,
  "tingkat_kelas_id" integer not null,
  "jurusan_id" integer,
  "ruang_kelas_id" integer,
  "tahun_ajaran_id" integer not null,
  "status" tinyint(1) not null default '1',
  "created_at" datetime,
  "updated_at" datetime,
  foreign key("tingkat_kelas_id") references "tingkat_kelas"("id") on delete restrict,
  foreign key("jurusan_id") references "jurusans"("id") on delete set null,
  foreign key("ruang_kelas_id") references "ruang_kelas"("id") on delete set null,
  foreign key("tahun_ajaran_id") references "tahun_ajarans"("id") on delete restrict
);
CREATE TABLE IF NOT EXISTS "rombel_siswa"(
  "id" integer primary key autoincrement not null,
  "rombel_id" integer not null,
  "siswa_id" integer not null,
  "status" tinyint(1) not null default '1',
  "created_at" datetime,
  "updated_at" datetime,
  foreign key("rombel_id") references "rombels"("id") on delete cascade,
  foreign key("siswa_id") references "siswas"("id") on delete cascade
);
CREATE UNIQUE INDEX "rombel_siswa_rombel_id_siswa_id_unique" on "rombel_siswa"(
  "rombel_id",
  "siswa_id"
);
CREATE TABLE IF NOT EXISTS "materis"(
  "id" integer primary key autoincrement not null,
  "guru_pelajaran_id" integer not null,
  "rombel_id" integer not null,
  "judul" varchar not null,
  "deskripsi" text,
  "tanggal" date not null,
  "jam" time not null,
  "file" varchar,
  "status" tinyint(1) not null default '1',
  "created_at" datetime,
  "updated_at" datetime,
  foreign key("guru_pelajaran_id") references "guru_pelajarans"("id") on delete cascade,
  foreign key("rombel_id") references "rombels"("id") on delete cascade
);
CREATE TABLE IF NOT EXISTS "absensis"(
  "id" integer primary key autoincrement not null,
  "materi_id" integer not null,
  "siswa_id" integer not null,
  "status_kehadiran" varchar check("status_kehadiran" in('Hadir', 'Izin', 'Sakit', 'Alfa')),
  "status" tinyint(1) not null default '1',
  "created_at" datetime,
  "updated_at" datetime,
  foreign key("materi_id") references "materis"("id") on delete cascade,
  foreign key("siswa_id") references "siswas"("id") on delete cascade
);
CREATE TABLE IF NOT EXISTS "users"(
  "id" integer primary key autoincrement not null,
  "name" varchar not null,
  "email" varchar not null,
  "password" varchar not null,
  "role" varchar not null,
  "img" varchar,
  "status" tinyint(1) not null default('1'),
  "remember_token" varchar,
  "created_at" datetime,
  "updated_at" datetime,
  "guru_id" integer,
  "siswa_id" integer,
  "bendahara_id" integer,
  "tata_usaha_id" integer,
  foreign key("guru_id") references "gurus"("id") on delete set null,
  foreign key("siswa_id") references "siswas"("id") on delete set null,
  foreign key("bendahara_id") references "bendaharas"("id") on delete set null,
  foreign key("tata_usaha_id") references "tata_usahas"("id") on delete set null
);
CREATE UNIQUE INDEX "users_email_unique" on "users"("email");
CREATE TABLE IF NOT EXISTS "profiles"(
  "id" integer primary key autoincrement not null,
  "type" varchar check("type" in('tentang', 'sejarah', 'visi', 'misi', 'jurusan', 'ekstrakurikuler', 'osis', 'pramuka', 'tahfidz', 'ppdb')) not null,
  "judul" varchar,
  "image" varchar,
  "content" text,
  "link" varchar,
  "status" tinyint(1) not null default '1',
  "created_at" datetime,
  "updated_at" datetime
);
CREATE TABLE IF NOT EXISTS "books"(
  "id" integer primary key autoincrement not null,
  "judul" varchar,
  "image" varchar,
  "description" text,
  "file" varchar,
  "link" varchar,
  "status" tinyint(1) not null default '1',
  "created_at" datetime,
  "updated_at" datetime
);
CREATE TABLE IF NOT EXISTS "downloads"(
  "id" integer primary key autoincrement not null,
  "judul" varchar,
  "image" varchar,
  "description" text,
  "file" varchar,
  "status" tinyint(1) not null default '1',
  "created_at" datetime,
  "updated_at" datetime
);
CREATE TABLE IF NOT EXISTS "struktur"(
  "id" integer primary key autoincrement not null,
  "jabatan" varchar,
  "urutan" varchar,
  "user_id" integer,
  "status" tinyint(1) not null default '1',
  "created_at" datetime,
  "updated_at" datetime,
  foreign key("user_id") references "users"("id") on delete set null
);
CREATE TABLE IF NOT EXISTS "galleries"(
  "id" integer primary key autoincrement not null,
  "judul" varchar,
  "deskripsi" text,
  "thumbnail" varchar,
  "status" tinyint(1) not null default '1',
  "created_at" datetime,
  "updated_at" datetime
);
CREATE TABLE IF NOT EXISTS "gallery_details"(
  "id" integer primary key autoincrement not null,
  "gallery_id" integer not null,
  "image_path" varchar,
  "created_at" datetime,
  "updated_at" datetime,
  foreign key("gallery_id") references "galleries"("id") on delete cascade
);
CREATE TABLE IF NOT EXISTS "kontaks"(
  "id" integer primary key autoincrement not null,
  "alamat" text,
  "telepon" text,
  "email" text,
  "location_name" varchar,
  "location_address" text,
  "latitude" numeric,
  "longitude" numeric,
  "google_map_embed" text,
  "message_name" varchar,
  "message_email" varchar,
  "message_subject" varchar,
  "message_content" text,
  "facebook" varchar,
  "twitter" varchar,
  "instagram" varchar,
  "youtube" varchar,
  "about" text,
  "quick_links" text,
  "copyright" text,
  "created_at" datetime,
  "updated_at" datetime
);

INSERT INTO migrations VALUES(1,'0001_01_01_000000_create_users_table',1);
INSERT INTO migrations VALUES(2,'0001_01_01_000001_create_cache_table',1);
INSERT INTO migrations VALUES(3,'0001_01_01_000002_create_jobs_table',1);
INSERT INTO migrations VALUES(4,'2025_07_09_171550_create_tahun_ajarans_table',1);
INSERT INTO migrations VALUES(5,'2025_07_09_171552_create_tingkat_kelas_table',1);
INSERT INTO migrations VALUES(6,'2025_07_09_171553_create_jurusans_table',1);
INSERT INTO migrations VALUES(7,'2025_07_09_171553_create_ruang_kelas_table',1);
INSERT INTO migrations VALUES(8,'2025_07_09_171554_create_pelajarans_table',1);
INSERT INTO migrations VALUES(9,'2025_07_09_171555_create_moduls_table',1);
INSERT INTO migrations VALUES(10,'2025_07_09_171556_create_gurus_table',1);
INSERT INTO migrations VALUES(11,'2025_07_09_171557_create_siswas_table',1);
INSERT INTO migrations VALUES(12,'2025_07_09_171558_create_bendaharas_table',1);
INSERT INTO migrations VALUES(13,'2025_07_09_171559_create_tata_usahas_table',1);
INSERT INTO migrations VALUES(14,'2025_07_09_171600_create_siswa_kelas_table',1);
INSERT INTO migrations VALUES(15,'2025_07_09_171602_create_guru_pelajarans_table',1);
INSERT INTO migrations VALUES(16,'2025_09_27_045314_create_kat_beritas_table',1);
INSERT INTO migrations VALUES(17,'2025_09_27_045332_create_kat_karya_ilmiahs_table',1);
INSERT INTO migrations VALUES(18,'2025_09_27_045529_create_beritas_table',1);
INSERT INTO migrations VALUES(19,'2025_09_27_045541_create_karya_ilmiahs_table',1);
INSERT INTO migrations VALUES(20,'2025_10_12_073559_create_rombels_table',1);
INSERT INTO migrations VALUES(21,'2025_10_12_073638_create_rombel_siswa_table',1);
INSERT INTO migrations VALUES(22,'2025_10_25_113942_create_materis_table',1);
INSERT INTO migrations VALUES(23,'2025_10_25_113943_create_absensis_table',1);
INSERT INTO migrations VALUES(24,'2025_10_26_143905_add_siswa_id_to_users_table',1);
INSERT INTO migrations VALUES(25,'2026_01_11_152608_create_profiles',1);
INSERT INTO migrations VALUES(26,'2026_01_11_153321_create_books',1);
INSERT INTO migrations VALUES(27,'2026_01_11_153323_create_downloads',1);
INSERT INTO migrations VALUES(28,'2026_01_12_120311_create_struktur',1);
INSERT INTO migrations VALUES(29,'2026_01_19_135511_create_galleries_table',1);
INSERT INTO migrations VALUES(30,'2026_01_19_135538_create_gallery_details_table',1);
INSERT INTO migrations VALUES(31,'2026_01_20_081025_create_kontaks_table',1);
