# NSLS PHP Assessment
## Table of content
* [General Information](#general-info)
* [Technologies](#technologies)
* [Setup](#setup)

## General Information
**Acceptance Criteria:**
* Create an API endpoint - /api/weather/office/forecast
* Consume the following URL for weather information - https://api.weather.gov/gridpoints/OKX/31,34/forecast
* Validate token via an “Api-Token” header
* Give access to the following tokens: 
    * QkgAVGXuebE9beJEV6iaMKRWApif4eDAtALwi9FibuXvR37HYqEJuQKmVdv9eUEyx88
    * 3o2fQgpAfxmQhPDsvhDThhyDMZZ7bRh7VcUGAn24UYJWnjVFDtnfZk77Go6NxB62
* Display **401 Unauthorized** error if Api-Token is missing or doesn't have access
* If successfully authorized, return 200 OK with JSON Content-Type
* The collection must return the following properties:
    * name
    * startTime
    * endTime
    * temperature
    * temperatureUnit
    * temperatureTrend
    * icon
    * shortForecast
* The above tokens should be available in a “ApiToken” model that’s persisted in a database table with, at least, the following properties: Token, UsageCount, LastUsedOn; and every time the /api/weather/office/forecast is successfully called with one of those tokens the model should be updated by increasing the UsageCount and setting the LastUsedOn to the current date/time.

## Technologies
* PHP 7
* fopen wrappers must be enabled (I think it's enabled by default)
* Apache2
* MySql

## Setup
Make sure that apache is up and running. Navigate to where your apache folder get served.
For me, it would be **/var/www/** since I'm using linux environment.

**Clone the repo to your local environment**
```
$ git clone https://github.com/tiger2380/WeatherAPI.git
```
**Navigate into the newly created folder**
```
$ cd WeatherAPI
```
**Edit the App/Settings.php file -> db stanza to match your local database settings**
```
$ vi App/Settings.php
...
'db'   => [
        'host'     => '', # hostname of your database e.g. 'localhost'
        'database' => '', # database name 'WeatherAPI'
        'username' => '', # username of your database e.g. 'root'
        'password' => '', # password of the user
        'charset' => 'utf8mb4',
        'collation' => 'utf8mb4_unicode_ci',
        'prefix' => '',
    ]
...
```
* I included the dump of the database (WeatherAPI.sql)
* To save time, you can import the dump file into your database. Create a new database and name it to "WeatherAPI". Then inport the file into that created database

### That's it. You should now be ready to test the API


In the brower, you can navigate to e.g. http://localhost/WeatherAPI/api/weather/office/forecast and you will see a 401 Unauthorized message. That is because the Api-Token key must be set in the header.

The tool that I used to test the API route is called PostMan. You can set the Api-Token key in the header request and you will be able to see the forecast data.
You can also test the API from the command line: e.g. (linux)

```
$ curl -H "Api-Token: QkgAVGXuebE9beJEV6iaMKRWf4eDAtALwi9FibuXvR37HYqEJuQKmVdv9eUEyx88" http://localhost/WeatherAPI/api/weather/office/forecast
```