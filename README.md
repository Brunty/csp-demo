# Project for demo of CSP

This uses docker to get up and running. Add a host to your hosts file for `csp.dev` and the relevant IP for your docker machine.

Then run:

`docker-compose up --build -d`

If you wish to re-create the things shown in the live demo I've done - here are the various pieces to the pizzle:

`app/src/Middleware/CspMiddleware/.php` is the class that adds middleware to a response in the app. It has the policy passed in as it's first constructor argument - the middleware is attached to routes for the application in `app/resources/config/routing.php`

Alternatively if you want to activate Report-Only mode, use: `app/src/Middleware/CspReportOnlyMiddleware/.php`
