# NSLS PHP Assessment
## Table of content
* [General Information](#general-info)
* [Technologies](#technologies)
* [Setup](#setup)

## General Information
Acceptance Criteria:
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
* 