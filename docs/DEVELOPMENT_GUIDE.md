# Laravel with React Development Guide

## Table of Contents
1. [Project Structure](#project-structure)
2. [Frontend Development](#frontend-development)
   - [React Components](#react-components)
   - [State Management](#state-management)
   - [Styling](#styling)
3. [Backend Development](#backend-development)
   - [Controllers](#controllers)
   - [Routes](#routes)
   - [Models & Migrations](#models--migrations)
4. [Frontend-Backend Interaction](#frontend-backend-interaction)
   - [API Endpoints](#api-endpoints)
   - [Authentication](#authentication)
   - [Form Handling](#form-handling)
5. [Development Workflow](#development-workflow)
   - [Local Development](#local-development)
   - [Building for Production](#building-for-production)

## Project Structure

```
backoffice/
├── app/                  # Laravel application code
│   ├── Http/            # Controllers, Middleware
│   ├── Models/          # Eloquent models
│   └── ...
├── config/              # Configuration files
├── database/            # Migrations, seeders
├── public/              # Publicly accessible files
├── resources/
│   ├── js/              # React components and frontend code
│   │   ├── components/  # Reusable React components
│   │   ├── layouts/     # Layout components
│   │   ├── pages/       # Page components
│   │   └── app.tsx      # Main React application
│   └── views/          # Blade templates
├── routes/             # Application routes
│   ├── web.php         # Web routes
│   └── api.php         # API routes
└── ...
```

## Frontend Development

### React Components

#### Creating a New Component
1. Create a new `.tsx` file in `resources/js/components/`
2. Use the following template:

```tsx
import React from 'react';

interface MyComponentProps {
  // Define your props here
  title: string;
  onAction?: () => void;
}

export function MyComponent({ title, onAction }: MyComponentProps) {
  return (
    <div className="my-component">
      <h2>{title}</h2>
      <button onClick={onAction}>Click me</button>
    </div>
  );
}
```

### State Management

#### Using React Context

```tsx
// Create a context
const MyContext = React.createContext<MyContextType | undefined>(undefined);

// Create a provider
function MyProvider({ children }: { children: React.ReactNode }) {
  const [state, setState] = React.useState(initialState);
  
  const value = {
    state,
    updateState: (newState: Partial<StateType>) => 
      setState(prev => ({ ...prev, ...newState }))
  };
  
  return (
    <MyContext.Provider value={value}>
      {children}
    </MyContext.Provider>
  );
}

// Custom hook to use the context
function useMyContext() {
  const context = React.useContext(MyContext);
  if (!context) {
    throw new Error('useMyContext must be used within a MyProvider');
  }
  return context;
}
```

## Backend Development

### Controllers

#### Creating a Controller

```bash
php artisan make:controller Api/UserController --api
```

#### Example API Controller

```php
<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class UserController extends Controller
{
    public function index()
    {
        return response()->json([
            'data' => User::all()
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:8',
        ]);

        $user = User::create($validated);

        return response()->json([
            'message' => 'User created successfully',
            'data' => $user
        ], Response::HTTP_CREATED);
    }
}
```

### Routes

#### API Routes (routes/api.php)

```php
use App\Http\Controllers\Api\UserController;

Route::middleware('auth:sanctum')->group(function () {
    Route::apiResource('users', UserController::class);
});
```

## Frontend-Backend Interaction

### Making API Requests

Using Axios (pre-configured in the starter kit):

```tsx
import axios from '@/lib/axios';

// GET request
const fetchUsers = async () => {
  try {
    const response = await axios.get('/api/users');
    return response.data;
  } catch (error) {
    console.error('Error fetching users:', error);
    throw error;
  }
};

// POST request
const createUser = async (userData) => {
  try {
    const response = await axios.post('/api/users', userData);
    return response.data;
  } catch (error) {
    console.error('Error creating user:', error);
    throw error;
  }
};
```

### Authentication

The starter kit comes with Laravel Sanctum for API authentication.

#### Login Example

```tsx
import axios from '@/lib/axios';

const login = async (email: string, password: string) => {
  try {
    const response = await axios.post('/login', {
      email,
      password,
    });
    
    // The response will include the token in a cookie
    return response.data;
  } catch (error) {
    console.error('Login failed:', error);
    throw error;
  }
};
```

## Development Workflow

### Local Development

1. Start the Laravel development server:
   ```bash
   php artisan serve
   ```

2. Start the Vite development server:
   ```bash
   npm run dev
   ```

3. Access the application at `http://localhost:8000`

### Building for Production

1. Build the frontend assets:
   ```bash
   npm run build
   ```

2. Cache the configuration and routes:
   ```bash
   php artisan config:cache
   php artisan route:cache
   ```

3. Run the production server:
   ```bash
   php artisan serve --env=production
   ```

## Best Practices

1. **Component Organization**:
   - Keep components small and focused
   - Group related components in feature folders
   - Use TypeScript interfaces for props and state

2. **API Design**:
   - Follow RESTful conventions
   - Use resource collections for consistent API responses
   - Implement proper error handling

3. **State Management**:
   - Use React Context for global state
   - Consider using a state management library (Redux, Zustand) for complex state

4. **Performance**:
   - Use React.memo for expensive components
   - Implement code splitting
   - Optimize images and assets

5. **Security**:
   - Always validate and sanitize user input
   - Use CSRF protection
   - Implement proper authentication and authorization

## Additional Resources

- [Laravel Documentation](https://laravel.com/docs)
- [React Documentation](https://react.dev/learn)
- [TypeScript Handbook](https://www.typescriptlang.org/docs/)
- [Vite Documentation](https://vitejs.dev/guide/)

---

This guide provides a foundation for developing with Laravel and React. For more specific use cases, refer to the official documentation or consult with the development team.
