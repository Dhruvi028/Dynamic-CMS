# **📌 Fullstack CMS - Vue 3 & Laravel**  
🚀 A **Dynamic CMS** built with **Vue 3 (Frontend) & Laravel (Backend)**, supporting **nested pages, full CRUD operations, real-time updates, and API integration.**  

---

## **📜 Table of Contents**
- [🌟 Features](#-features)
- [🛠 System Architecture](#-system-architecture)
- [📌 Installation Guide](#-installation-guide)
  - [🔹 Backend (Laravel)](#-backend-laravel)
  - [🔹 Frontend (Vue 3)](#-frontend-vue-3)
- [🌍 API Endpoints](#-api-endpoints)
- [✅ Running Tests](#-running-tests)
- [🚀 Next Steps](#-next-steps)

---

## **🌟 Features**
✔️ **Dynamic Nested Page Structure** (Unlimited depth)  
✔️ **CRUD Operations** (Create, Read, Update, Delete)  
✔️ **Real-time Updates** (Auto-refresh without page reload)  
✔️ **Vue Router Navigation** (SEO-friendly URLs)  
✔️ **Laravel API with MySQL Database**  
✔️ **Modern UI with TailwindCSS**  

---

## **🛠 System Architecture**
```plaintext
+----------------------+    +----------------------+
|  Vue 3 Frontend     |    |  Laravel Backend     |
|  (Vite, TypeScript) |    |  (PHP, MySQL)        |
+----------------------+    +----------------------+
           |                         |
  1. Fetch Pages                     |
           |                         |
           v                         v
  +-----------------+        +-----------------+
  |  PageManager   |        |  PageController |
  |  (CRUD Pages)  |<------>|  (API Routes)   |
  +-----------------+        +-----------------+
           |                         |
  2. Create/Edit/Delete Page         |
           |                         |
           v                         v
  +-----------------+        +-----------------+
  |   TreeView     |        |  Pages Table    |
  |  (Nested UI)   |        |  (MySQL DB)     |
  +-----------------+        +-----------------+
           |
  3. Real-time Update
           |
           v
  +-----------------+
  |   Vue Router   |
  |  (Navigation)  |
  +-----------------+
```

---

# **📌 Installation Guide**
### **🔹 Backend (Laravel)**
#### **1️⃣ Clone the Repository**
```sh
git clone https://github.com/Dhruvi028/Dynamic-CMS.git
cd backend-cms
```

#### **2️⃣ Install Dependencies**
```sh
composer install
```

#### **3️⃣ Configure `.env` File**
```sh
cp .env.example .env
```
Set up database credentials:
```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=cms_db
DB_USERNAME=root
DB_PASSWORD=
```

#### **4️⃣ Generate App Key & Run Migrations**
```sh
php artisan key:generate
php artisan migrate --seed
```

#### **5️⃣ Start Laravel Server**
```sh
php artisan serve
```
✅ **API running at** `http://127.0.0.1:8000/api`.

---

### **🔹 Frontend (Vue 3)**
#### **1️⃣ Navigate to Frontend**
```sh
cd ../frontend-cms
```

#### **2️⃣ Install Dependencies**
```sh
npm install
```

#### **3️⃣ Configure `.env` File**
```sh
cp .env.example .env
```
Set API URL:
```
VITE_API_URL=http://127.0.0.1:8000/api
```

#### **4️⃣ Start Vue Development Server**
```sh
npm run dev
```
✅ **App available at** `http://localhost:5173`.

---

# **🌍 API Endpoints**
| Method | Endpoint | Description |
|--------|----------|-------------|
| **GET** | `/api/pages` | Fetch all pages with children |
| **POST** | `/api/pages` | Create a new page |
| **GET** | `/api/pages/{slug}` | Get a specific page |
| **PUT** | `/api/pages/{id}` | Update a page |
| **DELETE** | `/api/pages/{id}` | Delete a page & its children |

### **Example API Request (Create Page)**
```sh
curl -X POST http://127.0.0.1:8000/api/pages \
  -H "Content-Type: application/json" \
  -d '{
    "title": "New Page",
    "slug": "new-page",
    "content": "This is a new page",
    "parent_id": null
  }'
```

---

# **✅ Running Tests**
## **🔹 Backend Tests (Laravel)**
Run Laravel **feature tests**:
```sh
php artisan test
```
✅ **Tests for CRUD operations, validation, and API responses.**

## **🔹 Frontend Tests (Vue)**
Run **unit tests**:
```sh
npm run test
```
✅ **Ensures Vue components work correctly.**

---

# **🚀 Next Steps**
- **Deploy Laravel Backend** (`PHP 8 + MySQL`)  
- **Deploy Vue 3 Frontend** (`Vite + Netlify/Vercel`)  
- **Add Authentication (JWT Token)** for secure access
