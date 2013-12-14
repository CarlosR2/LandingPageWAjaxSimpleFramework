LandingPageWAjaxSimpleFramework
===============================

Landing Page w AJAX Simple Framework (PHP+MySQL+JS+AJAX)

A skeleton for a single Landing Page that performs AJAX calls through a local API. It can be easily extended

index.php
  --> Load data and then the view

model.php
  --> Here you can include functions to interact with database
  
view.php
  --> The actual html code
  
api.php
  --> Here you can include calls to the api. Through the index.js you'll call these functions and get the results.
  
index.js
  --> Simple JS framework to interact with the api. You have the calls to interact with api.php
  
functions.php
  --> Auxiliar functions
  
libraries
  --> You can include here libraries such as mailer
