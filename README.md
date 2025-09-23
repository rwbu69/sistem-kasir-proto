# 🛒 Sistem Kasir - Point of Sale (POS) System

## 📋 Daftar Isi
- [Pengenalan](#pengenalan)
- [Panduan Instalasi](#panduan-instalasi)
- [Konfigurasi Database](#konfigurasi-database)
- [Cara Kerja Software](#cara-kerja-software)
- [Entity Relationship Diagram (ERD)](#entity-relationship-diagram-erd)
- [Flowchart Sistem](#flowchart-sistem)
- [Penjelasan CRUD Operations](#penjelasan-crud-operations)
- [Fitur-Fitur](#fitur-fitur)
- [Teknologi yang Digunakan](#teknologi-yang-digunakan)

## 🎯 Pengenalan

Sistem Kasir adalah aplikasi Point of Sale (POS) berbasis web yang dibangun dengan Laravel Framework. Aplikasi ini dirancang untuk membantu usaha kecil dan menengah dalam mengelola penjualan, inventory produk, dan laporan transaksi dengan antarmuka yang sederhana dan mudah digunakan.

### Fitur Utama:
- ✅ **Manajemen Produk** - Tambah, edit, hapus, dan lihat produk
- ✅ **Sistem Kasir** - Proses transaksi penjualan real-time
- ✅ **Riwayat Penjualan** - Laporan dan tracking semua transaksi
- ✅ **Interface Responsif** - Sidebar navigation yang mobile-friendly
- ✅ **Bahasa Indonesia** - Interface dan validasi dalam Bahasa Indonesia

---

## 🚀 Panduan Instalasi

### Prasyarat Sistem:
- PHP >= 8.1
- Composer
- Node.js & NPM
- MySQL/MariaDB
- Git

### Langkah-langkah Instalasi:

#### 1. Clone Repository
```bash
git clone <repository-url>
cd jokisatu
```

#### 2. Install Dependencies PHP
```bash
composer install
```

#### 3. Install Dependencies Node.js
```bash
npm install
```

#### 4. Konfigurasi Environment
```bash
cp .env.example .env
php artisan key:generate
```

#### 5. Konfigurasi Database (Lihat bagian selanjutnya)

#### 6. Migrate Database
```bash
php artisan migrate
```

#### 7. Seed Data Awal
```bash
php artisan db:seed
```

#### 8. Build Assets
```bash
npm run build
# atau untuk development:
npm run dev
```

#### 9. Jalankan Server
```bash
php artisan serve
```

Aplikasi akan tersedia di: `http://localhost:8000`

---

## 🗄️ Konfigurasi Database

### Setup File .env

Buka file `.env` dan konfigurasikan pengaturan database sebagai berikut:

```properties
# Konfigurasi Database MySQL
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=sistem_kasir
DB_USERNAME=root
DB_PASSWORD=
```

### Penjelasan Konfigurasi:

| Parameter | Nilai | Penjelasan |
|-----------|-------|------------|
| `DB_CONNECTION` | `mysql` | Jenis database yang digunakan |
| `DB_HOST` | `127.0.0.1` | Alamat server database (localhost) |
| `DB_PORT` | `3306` | Port MySQL default |
| `DB_DATABASE` | `sistem_kasir` | Nama database yang akan dibuat |
| `DB_USERNAME` | `root` | Username MySQL (sesuaikan dengan setup Anda) |
| `DB_PASSWORD` | `""` | Password MySQL (kosong untuk XAMPP default) |

### Setup Database:

#### Menggunakan MySQL Command Line:
```sql
CREATE DATABASE sistem_kasir;
```

#### Menggunakan phpMyAdmin:
1. Buka phpMyAdmin di browser: `http://localhost/phpmyadmin`
2. Klik "New" di sidebar kiri
3. Masukkan nama database: `sistem_kasir`
4. Klik "Create"

#### Menggunakan XAMPP/WAMP:
1. Start Apache dan MySQL di XAMPP Control Panel
2. Pastikan MySQL berjalan di port 3306
3. Username default: `root`, Password: kosong

---

## ⚙️ Cara Kerja Software

### Alur Kerja Umum:

1. **Login ke Sistem** → Akses aplikasi melalui web browser
2. **Manajemen Produk** → Kelola inventory dan informasi produk
3. **Proses Transaksi** → Gunakan fitur kasir untuk melakukan penjualan
4. **Laporan** → Lihat riwayat dan analisis penjualan

### Struktur Navigasi:

#### 📦 **Halaman Produk**
- Menampilkan daftar semua produk
- Fitur tambah, edit, dan hapus produk
- Informasi: nama, harga, stok, deskripsi

#### 💰 **Halaman Kasir**
- Interface point of sale untuk transaksi
- Pemilihan produk dan quantity
- Kalkulasi total otomatis
- Cetak receipt/struk

#### 📊 **Riwayat Penjualan**
- Daftar semua transaksi yang pernah dilakukan
- Detail setiap transaksi
- Total penjualan dan statistik

---

## 🗂️ Entity Relationship Diagram (ERD)

```
┌─────────────────┐       ┌─────────────────┐       ┌─────────────────┐
│    PRODUCTS     │       │   SALE_ITEMS    │       │     SALES       │
├─────────────────┤       ├─────────────────┤       ├─────────────────┤
│ id (PK)         │◄──────┤ product_id (FK) │       │ id (PK)         │
│ name            │       │ sale_id (FK)    ├──────►│ total_amount    │
│ price           │       │ quantity        │       │ created_at      │
│ stock           │       │ price           │       │ updated_at      │
│ description     │       │ created_at      │       └─────────────────┘
│ created_at      │       │ updated_at      │
│ updated_at      │       └─────────────────┘
└─────────────────┘
```

### Penjelasan Relasi:

#### 1. **PRODUCTS (Produk)**
- **Primary Key**: `id`
- **Atribut**: nama, harga, stok, deskripsi
- **Relasi**: One-to-Many dengan SALE_ITEMS

#### 2. **SALES (Penjualan)**
- **Primary Key**: `id`
- **Atribut**: total_amount (total penjualan)
- **Relasi**: One-to-Many dengan SALE_ITEMS

#### 3. **SALE_ITEMS (Item Penjualan)**
- **Primary Key**: `id`
- **Foreign Keys**: 
  - `product_id` → references `products.id`
  - `sale_id` → references `sales.id`
- **Atribut**: quantity (jumlah), price (harga saat transaksi)
- **Relasi**: Many-to-One dengan PRODUCTS dan SALES

### Konsep Relasi:
- Satu **Produk** dapat terjual dalam banyak **Item Penjualan**
- Satu **Penjualan** dapat memiliki banyak **Item Penjualan**
- Setiap **Item Penjualan** terhubung ke satu **Produk** dan satu **Penjualan**

---

## 📊 Flowchart Sistem

### 1. Flowchart Manajemen Produk
```
[START] → [Tampilkan Daftar Produk] → [Pilih Aksi]
                                           ↓
┌─────────────────┬─────────────────┬─────────────────┐
│   TAMBAH PRODUK │   EDIT PRODUK   │   HAPUS PRODUK  │
│        ↓        │        ↓        │        ↓        │
│ [Form Input]    │ [Form Edit]     │ [Konfirmasi]    │
│        ↓        │        ↓        │        ↓        │
│ [Validasi]      │ [Validasi]      │ [Hapus Data]    │
│        ↓        │        ↓        │        ↓        │
│ [Simpan ke DB]  │ [Update DB]     │ [Update DB]     │
└─────────────────┴─────────────────┴─────────────────┘
                           ↓
                [Redirect ke Daftar Produk] → [END]
```

### 2. Flowchart Proses Kasir
```
[START] → [Tampilkan Daftar Produk] → [Pilih Produk]
                                           ↓
                                    [Input Quantity]
                                           ↓
                                    [Tambah ke Keranjang]
                                           ↓
                                    [Hitung Subtotal]
                                           ↓
                              [Lanjut Belanja?] ──YES→ [Kembali ke Pilih Produk]
                                           │
                                          NO
                                           ↓
                                    [Hitung Total]
                                           ↓
                                    [Konfirmasi Transaksi]
                                           ↓
                                    [Simpan ke Database]
                                           ↓
                                    [Update Stok Produk]
                                           ↓
                                    [Generate Receipt]
                                           ↓
                                         [END]
```

### 3. Flowchart Riwayat Penjualan
```
[START] → [Query Database Sales] → [Tampilkan Daftar Transaksi]
                                           ↓
                                    [Pilih Detail Transaksi?]
                                           ↓
                                          YES
                                           ↓
                                    [Query Sale Items]
                                           ↓
                                    [Tampilkan Detail]
                                           ↓
                                         [END]
```

---

## 🔧 Penjelasan CRUD Operations

### 1. **CREATE (Tambah Data)**

#### ProductController::store()
```php
public function store(Request $request)
{
    // 1. Validasi Input
    $request->validate([
        'name' => 'required|string|max:255',
        'price' => 'required|numeric|min:0',
        'stock' => 'required|integer|min:0',
        'description' => 'nullable|string'
    ]);

    // 2. Simpan ke Database
    Product::create($request->all());

    // 3. Redirect dengan Pesan Sukses
    return redirect()->route('products.index')
        ->with('success', 'Produk berhasil ditambahkan.');
}
```

**Cara Kerja:**
- User mengisi form di `/products/create`
- Data divalidasi sesuai rules yang ditetapkan
- Jika valid, data disimpan ke tabel `products`
- User diarahkan kembali ke halaman produk dengan notifikasi sukses

#### SaleController::store() - Proses Transaksi
```php
public function store(Request $request)
{
    // 1. Mulai Database Transaction
    DB::beginTransaction();
    
    try {
        // 2. Buat Record Sale Baru
        $sale = Sale::create([
            'total_amount' => $request->total_amount
        ]);

        // 3. Simpan Setiap Item yang Dibeli
        foreach ($request->items as $item) {
            SaleItem::create([
                'sale_id' => $sale->id,
                'product_id' => $item['product_id'],
                'quantity' => $item['quantity'],
                'price' => $item['price']
            ]);
            
            // 4. Update Stok Produk
            $product = Product::find($item['product_id']);
            $product->stock -= $item['quantity'];
            $product->save();
        }
        
        // 5. Commit Transaction
        DB::commit();
        
    } catch (Exception $e) {
        // Rollback jika ada error
        DB::rollBack();
        return back()->with('error', 'Transaksi gagal');
    }
}
```

### 2. **READ (Baca Data)**

#### ProductController::index()
```php
public function index()
{
    // Ambil semua data produk dari database
    $products = Product::all();
    
    // Kirim data ke view
    return view('products.index', compact('products'));
}
```

#### SaleController::index()
```php
public function index()
{
    // Ambil data penjualan dengan relasi
    $sales = Sale::with('saleItems.product')
                 ->orderBy('created_at', 'desc')
                 ->get();
    
    return view('sales.index', compact('sales'));
}
```

**Cara Kerja:**
- Controller mengambil data dari Model
- Model melakukan query ke database
- Data dikirim ke View untuk ditampilkan
- View merender HTML dengan data yang diterima

### 3. **UPDATE (Perbarui Data)**

#### ProductController::update()
```php
public function update(Request $request, Product $product)
{
    // 1. Validasi Input
    $request->validate([
        'name' => 'required|string|max:255',
        'price' => 'required|numeric|min:0',
        'stock' => 'required|integer|min:0',
        'description' => 'nullable|string'
    ]);

    // 2. Update Data di Database
    $product->update($request->all());

    // 3. Redirect dengan Pesan Sukses
    return redirect()->route('products.index')
        ->with('success', 'Produk berhasil diperbarui.');
}
```

**Cara Kerja:**
- User mengakses form edit di `/products/{id}/edit`
- Form sudah terisi dengan data lama
- User mengubah data yang diperlukan
- Data divalidasi dan diupdate di database
- User diarahkan kembali dengan notifikasi

### 4. **DELETE (Hapus Data)**

#### ProductController::destroy()
```php
public function destroy(Product $product)
{
    // Hapus produk dari database
    $product->delete();

    // Redirect dengan pesan sukses
    return redirect()->route('products.index')
        ->with('success', 'Produk berhasil dihapus.');
}
```

**Cara Kerja:**
- User klik tombol hapus di halaman produk
- Sistem menampilkan konfirmasi (optional)
- Jika dikonfirmasi, data dihapus dari database
- User diarahkan kembali dengan notifikasi

### Model Relationships
```php
// Sale.php
public function saleItems()
{
    return $this->hasMany(SaleItem::class);
}

// SaleItem.php
public function sale()
{
    return $this->belongsTo(Sale::class);
}

public function product()
{
    return $this->belongsTo(Product::class);
}
```

**Penjelasan Relasi:**
- `hasMany()`: Satu Sale memiliki banyak SaleItem
- `belongsTo()`: SaleItem dimiliki oleh satu Sale dan satu Product
- Eloquent ORM otomatis menangani JOIN query untuk relasi

---

## ✨ Fitur-Fitur

### 🎨 **Interface & UX**
- **Responsive Design**: Tampilan optimal di desktop dan mobile
- **Sidebar Navigation**: Menu navigasi yang mudah diakses
- **Color Scheme**: Palet warna yang konsisten dan professional
- **Bootstrap Framework**: UI components yang modern dan clean

### 📱 **Mobile-Friendly**
- **Hamburger Menu**: Menu sidebar yang dapat disembunyikan di mobile
- **Touch-Friendly**: Button dan input yang mudah di-tap
- **Responsive Tables**: Tabel yang adapt dengan ukuran layar kecil

### 🔒 **Data Management**
- **Validasi Input**: Semua input divalidasi sebelum disimpan
- **Error Handling**: Penanganan error yang informatif
- **Database Transactions**: Konsistensi data terjamin
- **Soft Deletes**: Opsi untuk soft delete (opsional)

### 📊 **Reporting**
- **Sales History**: Riwayat semua transaksi
- **Transaction Details**: Detail setiap item yang terjual
- **Inventory Tracking**: Monitoring stok produk real-time

---

## 🛠️ Teknologi yang Digunakan

### Backend:
- **Laravel 12.x** - PHP Framework
- **PHP 8.1+** - Programming Language
- **MySQL** - Database Management System
- **Eloquent ORM** - Database Object-Relational Mapping

### Frontend:
- **Blade Templates** - Laravel Templating Engine
- **Bootstrap 5.3** - CSS Framework
- **JavaScript ES6** - Client-side Scripting
- **Vite** - Asset Bundling

### Development Tools:
- **Composer** - PHP Dependency Manager
- **NPM** - Node Package Manager
- **Git** - Version Control System
- **VS Code** - Code Editor (Recommended)

### Database Structure:
```sql
-- Struktur Tabel Products
CREATE TABLE products (
    id BIGINT PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(255) NOT NULL,
    price DECIMAL(10,2) NOT NULL,
    stock INT DEFAULT 0,
    description TEXT NULL,
    created_at TIMESTAMP,
    updated_at TIMESTAMP
);

-- Struktur Tabel Sales
CREATE TABLE sales (
    id BIGINT PRIMARY KEY AUTO_INCREMENT,
    total_amount DECIMAL(10,2) NOT NULL,
    created_at TIMESTAMP,
    updated_at TIMESTAMP
);

-- Struktur Tabel Sale Items
CREATE TABLE sale_items (
    id BIGINT PRIMARY KEY AUTO_INCREMENT,
    sale_id BIGINT,
    product_id BIGINT,
    quantity INT NOT NULL,
    price DECIMAL(10,2) NOT NULL,
    created_at TIMESTAMP,
    updated_at TIMESTAMP,
    FOREIGN KEY (sale_id) REFERENCES sales(id) ON DELETE CASCADE,
    FOREIGN KEY (product_id) REFERENCES products(id) ON DELETE CASCADE
);
```

---

## 🚨 Troubleshooting

### Masalah Umum:

#### 1. **Database Connection Error**
```bash
# Pastikan MySQL berjalan
sudo systemctl start mysql

# Cek konfigurasi .env
php artisan config:clear
```

#### 2. **Permission Error**
```bash
# Set permission untuk storage dan cache
chmod -R 775 storage bootstrap/cache
```

#### 3. **Composer Dependencies**
```bash
# Update dependencies
composer update
composer dump-autoload
```

#### 4. **Node.js Assets**
```bash
# Clear cache dan rebuild
npm run build
php artisan view:clear
```

---

## 📞 Support

Jika mengalami masalah atau membutuhkan bantuan:

1. **Cek Log Laravel**: `storage/logs/laravel.log`
2. **Cek Console Browser**: untuk error JavaScript
3. **Verifikasi Database**: pastikan semua tabel ter-migrate
4. **Restart Server**: `php artisan serve`

---

## 📝 Lisensi

Project ini dibuat untuk tujuan edukasi dan pembelajaran. Silakan gunakan dan modifikasi sesuai kebutuhan Anda.

---

**Dibuat dengan ❤️ menggunakan Laravel Framework**
