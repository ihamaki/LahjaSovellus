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
    GiftController::list();
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
    PersonController::list();
  });

  $routes->post('/people', function() {
    PersonController::create();
  });

  $routes->get('/people/new', function() {
    PersonController::new();
  });

  $routes->get('/people/:id', function($id) {
    PersonController::show($id);
  });

  $routes->get('/people/1/edit', function() {
    HelloWorldController::person_edit();
  });

  $routes->get('/tags/1/edit', function() {
    HelloWorldController::tag_edit();
  });

  $routes->get('/login', function() {
    HelloWorldController::login();
  });

  $routes->get('/register', function() {
    HelloWorldController::register();
  });