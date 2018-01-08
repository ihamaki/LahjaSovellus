<?php

  $routes->get('/', function() {
    DefaultController::home();
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

  $routes->get('/gifts/new', function() {
    GiftController::new();
  });

  $routes->get('/testgifts', function() {
    HelloWorldController::gift_list();
  });

  $routes->get('/gifts/:id', function($id) {
    GiftController::show($id);
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

  $routes->get('/people/new', function() {
    PersonController::new();
  });

  $routes->post('/people/new', function() {
    PersonController::create();
  });

  $routes->get('/people/:id', function($id) {
    PersonController::show($id);
  });

  $routes->get('/people/:id/edit', function($id) {
    PersonController::edit($id);
  });

  $routes->post('/people/:id/edit', function($id) {
    PersonController::update($id);
  });

  $routes->post('/people/:id/destroy', function($id) {
    PersonController::destroy($id);
  });

  $routes->get('/tags/1/edit', function() {
    HelloWorldController::tag_edit();
  });

  $routes->get('/login', function() {
    UserController::login();
  });

  $routes->post('/login', function() {
    UserController::handle_login();
  });

  $routes->get('/register', function() {
    HelloWorldController::register();
  });