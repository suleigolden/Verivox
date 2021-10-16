
# Tariff comparison

## Description

Develop a model to build up the following two products and to compare these products based on their annual costs. The comparison should accept the following input parameter:

Consumption (kWh/year)
and create a list of these products with the columns

Tariff name
Annual costs (€/year)
The list should be sorted by costs in ascending order.

## Products

1. Product A
Name: “basic electricity tariff”

Calculation model: base costs per month 5 € + consumption costs 22 cent/kWh

Examples:

Consumption = 3500 kWh/year => Annual costs = 830 €/year (5€ * 12 months = 60 € base costs + 3500 kWh/year * 22 cent/kWh = 770 € consumption costs)
Consumption = 4500 kWh/year => Annual costs = 1050 €/year (5€ * 12 months = 60 € base costs + 4500 kWh/year * 22 cent/kWh = 990 € consumption costs)
Consumption = 6000 kWh/year => Annual costs = 1380 €/year (5€ * 12 months = 60 € base costs + 6000 kWh/year * 22 cent/kWh = 1320 € consumption costs)
2. Product B
Name: “Packaged tariff”

Calculation model: 800 € for up to 4000 kWh/year and above 4000 kWh/year additionally 30 cent/kWh.

Examples:

Consumption = 3500 kWh/year => Annual costs = 800 €/year
Consumption = 4500 kWh/year => Annual costs = 950 €/year (800€ + 500 kWh * 30 cent/kWh = 150 € additional consumption costs)
Consumption = 6000 kWh/year => Annual costs = 1400 €/year (800€ + 2000 kWh * 30 cent/kWh = 600 € additional consumption costs)
Notes
Please implement this task in C#, C++ or Java or any other object oriented language. If you write tests for your implementation please provide them with your implementation. Please develop only the logic described above, and no UI (webpage, etc.). You do not need a data base. All sample data can be hardcoded or added to the implementation by any other method of your choice.

## APi Rest Endpoints

- http://127.0.0.1:8000/get/tariff  //GET
- http://127.0.0.1:8000/calculate/tariff     //POST tariffName, yearlyConsumption



## Running tests

* Clone the repository to your local machine.
* Open terminal and navigate to back-end directory, and run composer install, then set up your .env file, set update your database coneection in the .env file and run php artisan migrate. Run php artisan serve to start the server.
* Open another terminal and navigate to front-end. Run npm install and the run npm start.
* NOTE: Make sure your backend server address is the same with the API_BASE_URL in front-end/src/component/config.js file.





