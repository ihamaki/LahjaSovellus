<?php

  function check_logged_in(){
    BaseController::check_logged_in();
  }

  $routes->get('/', function() {
    DefaultController::home();
  });

  $routes->get('/hiekkalaatikko', function() {
    HelloWorldController::sandbox();
  });

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
    UserController::register();
  });

  $routes->post('/register', function() {
    UserController::handle_register();
  });

  $routes->get('/gifts', 'check_logged_in', function() {
    GiftController::list();
  });

  $routes->get('/gifts/new', 'check_logged_in', function() {
    GiftController::new();
  });

  $routes->post('/gifts/new', 'check_logged_in', function() {
    GiftController::create();
  });

  $routes->get('/testgifts', function() {
    HelloWorldController::gift_list();
  });

  $routes->get('/gifts/:id', 'check_logged_in', function($id) {
    GiftController::show($id);
  });

  $routes->post('/gifts/:id/destroy', 'check_logged_in', function($id) {
    GiftController::destroy($id);
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