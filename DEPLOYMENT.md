# Deployment Guide

This application can be deployed to Vercel as a static site. Here's how to do it:

1. Install dependencies:
```bash
# Install PHP dependencies
composer install

# Install Vercel CLI globally
npm install -g vercel
```

2. Build the static files:
```bash
php scripts/build.php
```

This will create a `dist` directory with all the static files.

3. Deploy to Vercel:
```bash
vercel
```

Follow the prompts from Vercel CLI to:
- Log in to your Vercel account (if not already logged in)
- Set up the project
- Choose your team/account
- Confirm the deployment

The deployment process will:
1. Upload the static files from the `dist` directory
2. Configure the routing based on `vercel.json`
3. Provide you with a deployment URL

## Important Notes

- This is a static site deployment, which means all server-side logic has been converted to client-side JavaScript
- Authentication and data storage use localStorage
- All routing is handled client-side
- The application remains fully functional with the same features as the local version

## Environment Variables

No environment variables are needed for this deployment since all data is stored in the browser's localStorage.

## Updating the Deployment

To update your deployment:

1. Make your changes
2. Rebuild the static files:
```bash
php scripts/build.php
```

3. Deploy the updates:
```bash
vercel
```

## Custom Domains

To use a custom domain:

1. Go to your project settings in the Vercel dashboard
2. Navigate to the "Domains" section
3. Add your domain and follow the DNS configuration instructions

## Troubleshooting

If you encounter any issues:

1. Check the build output in the Vercel dashboard
2. Ensure all static assets are being properly included in the build
3. Verify that the routes in `vercel.json` match your application's routes
4. Clear your browser's localStorage if you experience any data-related issues