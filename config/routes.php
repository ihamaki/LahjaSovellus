<?php

  $routes->get('/', function() {
    HelloWorldController::index();
  });

  $routes->get('/hiekkalaatikko', function() {
    HelloWorldController::sandbox();
  });

  $routes->get('/frontpage', function() {
    HelloWorldController::frontpage();
  });

  $routes->get('/gifts', function() {
    HelloWorldController::gift_list();
  });

  $routes->get('/gifts/1', function() {
    HelloWorldController::gift_show();
  });

  $routes->get('/gifts/1/edit', function() {
    HelloWorldController::gift_edit();
  });

  $routes->get('/gifts/person/1', function() {
    HelloWorldController::person_gifts();
  });

  $routes->get('/people', function() {
    HelloWorldController::person_list();
  });

  $routes->get('/people/1', function() {
    HelloWorldController::person_show();
  });

  $routes->get('/people/1/edit', function() {
    HelloWorldController::person_edit();
  });

  $routes->get('/login', function() {
    HelloWorldController::login();
  });

  $routes->get('/register', function() {
    HelloWorldController::register();
  });