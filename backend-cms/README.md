
# **📌 Fullstack CMS - README**

---

# **🛠 Backend (Laravel 11)**
### **🚀 Features**
✅ REST API for managing pages (CRUD)
✅ Supports nested pages with parent-child relationships
✅ Laravel API with **feature tests**
✅ MySQL Database

---

## **🔹 1. Installation**
### **🔹 Step 1: Clone the Repository**
```sh
git clone https://github.com/your-repo/fullstack-cms.git
cd fullstack-cms/backend
```

### **🔹 Step 2: Install Dependencies**
```sh
composer install
```

### **🔹 Step 3: Configure `.env` File**
Copy the `.env.example` file and set up database credentials:
```sh
cp .env.example .env
```
Then update these fields in `.env`:
```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=cms_db
DB_USERNAME=root
DB_PASSWORD=
```

### **🔹 Step 4: Generate App Key**
```sh
php artisan key:generate
```

### **🔹 Step 5: Run Migrations & Seeders**
```sh
php artisan migrate --seed
```
✅ **Creates the database tables and sample data.**

### **🔹 Step 6: Start Laravel Server**
```sh
php artisan serve
```
✅ **API is now running at** `http://127.0.0.1:8000/api`.

---

## **🔹 2. API Endpoints**
| Method | Endpoint | Description |
|--------|----------|-------------|
| **GET** | `/api/pages` | Get all pages with nested children |
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

## **🔹 3. Run Tests**
To run **backend tests**, execute:
```sh
php artisan test
```
✅ **Ensures that all API endpoints work correctly.**