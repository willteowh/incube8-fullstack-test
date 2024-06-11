# Incube8 - Simple Bus Service App, by Will T.

## Installation

### Backend (Laravel)
After git clone the project to the local, run terminal at the project directory, and navigate to Backend project folder with:

`cd backend/busservice-api`

Run installation with:

`composer install && php artisan key:generate`

Then, update your *.env* file with your database configuration. 

<code>
DB_DATABASE=your_db_name<br>
DB_USERNAME=your_db_username<br>
DB_PASSWORD=your_db_password<br>
</code>

You may want your API to be guarded behind an API key, it can be defined in the *.env* as well:

`SERVICE_API_KEY=decide_an_API_Key_for_your_endpoint`

Then, run php migration with database seeding 

`php artisan migrate:refresh --seed`

Lastly, serve the php application by 

`php artisan serve`

By default, the URL and port should be *127.0.0.1:8000*


### Frontend (React)
Navigate to Frontend project folder with:

`cd frontend/busservice-client`

And run installation with:

`npm install`

After that, create `.env` based on `.env.example`, and fill in API key and API URL that defined during Laravel Installation

<code>
REACT_APP_API_URL=LARAVEL_API_ENDPOINT<br>
REACT_APP_API_KEY=SERVICE)API_KEY<br>

Next, serve the React application

`npm start` 
