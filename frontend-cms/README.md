---

# **🌐 Frontend (Vue 3 + Vite + TypeScript)**
### **🚀 Features**
✅ Dynamic **nested pages** with Tree View
✅ **CRUD Operations** for parent & child pages
✅ Vue Router **dynamic page navigation**
✅ **Beautiful UI with Tailwind CSS**

---

## **🔹 1. Installation**
### **🔹 Step 1: Navigate to Frontend Folder**
```sh
cd ../frontend
```

### **🔹 Step 2: Install Dependencies**
```sh
npm install
```

### **🔹 Step 3: Configure Environment Variables**
Create a `.env` file:
```sh
cp .env.example .env
```
Update:
```
VITE_API_URL=http://127.0.0.1:8000/api
```

### **🔹 Step 4: Start Frontend Server**
```sh
npm run dev
```
✅ **App will be available at** `http://localhost:5173`.

---

## **🔹 2. Project Structure**
```
frontend/
│── src/
│   ├── components/      # Vue components
│   ├── views/           # Page views
│   ├── router/          # Vue Router setup
│   ├── api.ts           # API service
│   ├── main.ts          # Main Vue entry point
│   ├── App.vue          # Main App component
│── public/              # Static assets
│── package.json         # NPM dependencies
```

---

## **🔹 3. Features & Navigation**
### **🌳 Tree View (Dynamic Page Navigation)**
- Click a page in the **Tree View** to navigate to that page.
- Nested pages will expand/collapse dynamically.
- UI updates **in real-time** after creating, editing, or deleting pages.

### **📝 Manage Pages (CRUD)**
| **Action** | **Steps** |
|------------|-----------|
| **Create Page** | Enter title, slug, and content, then click "Add Page". |
| **Edit Page** | Click "Edit", modify fields, and click "Save". |
| **Delete Page** | Click "Delete" and confirm the deletion. |

---

## **🔹 4. Run Frontend Tests**
```sh
npm run test
```
✅ **Ensures all Vue components work properly.**

---

# **🚀 Final Steps**
✅ **Start the frontend (`npm run dev`)**
✅ **Open `http://localhost:5173` and test CRUD operations!**