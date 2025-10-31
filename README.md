# TicketFlow — Twig Implementation

This repository contains the Twig implementation of the TicketFlow frontend for the multi-framework ticket management challenge.

## Summary of Features

- Landing page with wave hero, decorative circles, and responsive layout (max-width: 1440px centered via container classes)
- Authentication (Login & Signup) simulated via `localStorage` with key `ticketapp_session`
- Dashboard showing ticket stats and links to the Ticket Management screen
- Full Ticket Management page with Create, Read, Update, Delete (CRUD), validation, and local persistence (`localStorage` with key `ticketapp_tickets`)
- Toast/snackbar notifications
- Responsive design using Tailwind CSS

## Demo Credentials

- Email: `demo@ticketapp.com`
- Password: `Demo123!`

## Frameworks & Libraries Used

- Twig templating engine
- Slim PHP framework for routing
- Tailwind CSS (via CDN)
- Lucide Icons

## Project Structure

```
├── public/
│   ├── css/
│   │   └── style.css
│   ├── js/
│   │   └── app.js
│   └── index.php
├── templates/
│   ├── components/
│   │   ├── header.html.twig
│   │   └── footer.html.twig
│   ├── layouts/
│   │   └── base.html.twig
│   └── pages/
│       ├── auth/
│       │   ├── login.html.twig
│       │   └── signup.html.twig
│       ├── dashboard.html.twig
│       ├── landing.html.twig
│       └── tickets.html.twig
└── routes/
    └── web.php
```

## How to Run

1. Install dependencies:

```bash
composer install
```

2. Start PHP development server:

```bash
php -S localhost:8000 -t public
```

3. Open http://localhost:8000 in your browser

## Features

- **Authentication**
  - Login and signup pages with client-side validation
  - Session management using localStorage
  - Protected routes with authentication checks
- **Dashboard**
  - Overview of ticket statistics
  - Quick access to ticket management features
  - Real-time updates when tickets change
- **Ticket Management**
  - Create, view, edit, and delete tickets
  - Status tracking (Open, In Progress, Closed)
  - Priority levels (Low, Medium, High)
  - Form validation
  - Local storage persistence
- **Responsive Design**
  - Mobile-first approach
  - Adaptive layouts for different screen sizes
  - Touch-friendly interface elements

## Notes on Implementation

- This implementation uses Twig for templating and PHP/Slim for routing
- All data is stored in the browser's localStorage for simplicity
- The UI is built with Tailwind CSS for consistent styling
- JavaScript is used for client-side interactivity and data management

## What's Next

1. Add server-side validation and data persistence
2. Implement real user authentication
3. Add more advanced features like ticket filtering and sorting
4. Enhance the mobile experience
5. Add more comprehensive error handling
6. Implement real-time updates with WebSocket

## License

MIT
