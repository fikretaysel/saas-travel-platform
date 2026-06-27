# SaaS Travel Platform - Architecture

## 1. Project Goal

SaaS Travel Platform is a backend-focused portfolio project for managing travel agencies, their users, customers and bookings.

The goal of this project is to demonstrate a modern backend architecture using Laravel, REST APIs, layered architecture, validation, API resources and a multi-tenant SaaS data model.

This project is designed as a practical example for Senior Backend Engineer roles.

---

## 2. Domain Model

The main domain object is `Agency`.

Each agency can have multiple users, multiple customers and multiple bookings.

```text
Agency
 ├── Users
 ├── Customers
 └── Bookings
```

### Relationships

```text
Agency hasMany Users
Agency hasMany Customers
Agency hasMany Bookings

User belongsTo Agency

Customer belongsTo Agency
Customer hasMany Bookings

Booking belongsTo Agency
Booking belongsTo Customer
```

---

## 3. Multi-Tenant Strategy

This project follows a simple multi-tenant structure based on `agency_id`.

Each important business table contains an `agency_id` column.

```text
users.agency_id
customers.agency_id
bookings.agency_id
```

This ensures that data belongs to a specific agency.

In later steps, middleware will be added to automatically resolve the current agency and prevent users from accessing data from another agency.

---

## 4. Layered Architecture

The project uses a layered backend architecture.

```text
HTTP Request
   ↓
Route
   ↓
Form Request
   ↓
Controller
   ↓
Service
   ↓
Repository
   ↓
Model / Eloquent
   ↓
Database
```

The response flow is:

```text
Model / Collection
   ↓
API Resource
   ↓
JSON Response
```

---

## 5. Layer Responsibilities

### Route

Routes define which URL points to which controller method.

Example:

```php
Route::apiResource('agencies', AgencyController::class);
```

---

### Form Request

Form Requests validate incoming data before it reaches the controller.

Example:

```php
$request->validated();
```

This helps keep controllers clean and prevents invalid data from entering the business layer.

---

### Controller

Controllers receive HTTP requests and return HTTP responses.

Controllers should stay thin and should not contain database queries or complex business logic.

---

### Service

Services contain business logic.

Examples:

```text
Create agency
Check if agency is active
Validate agency limits
Prevent deletion if bookings exist
```

---

### Repository

Repositories handle database access.

Examples:

```text
Find agency
Create agency
Update agency
Delete agency
List agencies
```

The controller does not directly use Eloquent.

---

### Model

Models represent database tables in PHP.

Example:

```php
Agency::class
```

The model defines fillable fields and relationships.

---

### API Resource

API Resources define how models are transformed into JSON responses.

They prevent internal database fields from being exposed directly to API clients.

---

## 6. Current Modules

### Agency

Represents a travel agency using the platform.

Fields:

```text
id
name
email
phone
country
active
created_at
updated_at
```

---

### User

Represents a user who belongs to an agency.

Important fields:

```text
id
agency_id
name
email
password
role
created_at
updated_at
```

---

### Customer

Represents a customer of an agency.

Important fields:

```text
id
agency_id
first_name
last_name
email
phone
created_at
updated_at
```

---

### Booking

Represents a travel booking or ticket.

Important fields:

```text
id
agency_id
customer_id
booking_reference
provider
origin
destination
departure_date
return_date
price
currency
status
created_at
updated_at
```

---

## 7. Planned API Endpoints

### Agencies

```text
GET    /api/agencies
POST   /api/agencies
GET    /api/agencies/{id}
PUT    /api/agencies/{id}
DELETE /api/agencies/{id}
```

### Customers

```text
GET    /api/customers
POST   /api/customers
GET    /api/customers/{id}
PUT    /api/customers/{id}
DELETE /api/customers/{id}
```

### Bookings

```text
GET    /api/bookings
POST   /api/bookings
GET    /api/bookings/{id}
PUT    /api/bookings/{id}
DELETE /api/bookings/{id}
```

---

## 8. Planned Technical Features

The project will gradually include:

```text
REST API
Form Request Validation
API Resources
Service Layer
Repository Pattern
Authentication
Role-based Authorization
Agency-based Middleware
Queue Processing
Redis
Docker
API Documentation
Automated Tests
GitHub Actions
NestJS Notification Service
```

---

## 9. Why This Architecture?

This architecture was chosen to keep the codebase clean, testable and maintainable.

Instead of placing all logic inside controllers, the project separates responsibilities:

```text
Controller → HTTP handling
Service → Business logic
Repository → Database access
Resource → API response formatting
Request → Validation
```

This structure is useful in larger backend systems and reflects practices commonly used in professional software teams.
