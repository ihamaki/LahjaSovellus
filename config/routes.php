<?php

  function check_logged_in(){
    BaseController::check_logged_in();
  }

  $routes->get('/login', function() {
    UserController::login();
  });

  $routes->post('/login', function() {
    UserController::handle_login();
  });

  $routes->post('/logout', function() {
    UserController::logout();
  });

  $routes->get('/register', function() {
    HelloWorldController::register();
  });

  $routes->get('/', function() {
    DefaultController::home();
  });

  $routes->get('/hiekkalaatikko', function() {
    HelloWorldController::sandbox();
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

  $routes->get('/people', 'check_logged_in', function() {
    PersonController::list();
  });

  $routes->get('/people/new', 'check_logged_in', function() {
    PersonController::new();
  });

  $routes->post('/people/new', 'check_logged_in', function() {
    PersonController::create();
  });

  $routes->get('/people/:id', 'check_logged_in', function($id) {
    PersonController::show($id);
  });

  $routes->get('/people/:id/edit', 'check_logged_in', function($id) {
    PersonController::edit($id);
  });

  $routes->post('/people/:id/edit', 'check_logged_in', function($id) {
    PersonController::update($id);
  });

  $routes->post('/people/:id/destroy', 'check_logged_in', function($id) {
    PersonController::destroy($id);
  });

  $routes->get('/tags/1/edit', function() {
    HelloWorldController::tag_edit();
  });