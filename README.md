# Expense-Calculator

Application to parse CSV files and calculate total amounts spent per category.   
Developed in PHP and React-Typescript   

## Running the application  
To run this application you need to have php installed  

### Build the backend  
There are no php dependencies except for phpunit   
but composer is used for autoloading. 

```bash  
cd backend
composer install
composer dump-autoload -o
```

### Start the server
```bash  
php -S localhost:8080 -t public
```

### Build the app
In case you do not have a built version of the frontend you may need to build it  

```bash
cd frontend
npm install
npm run build
```  

### Start the app
Serve the dist folder of the frontend using whatever server you prefer.   

```bash
npx serve dist
```



## Testing
The backend does include some tests that use phpunit 

Install dependencies (phpunit) if not already installed   

```bash
composer install
```

Run the tests

```bash
composer test
```

