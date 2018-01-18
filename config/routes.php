<?php

  ## General

  function check_logged_in(){
    BaseController::check_logged_in();
  }

  $routes->get('/', function(){
    DefaultController::home();
  });

  $routes->get('/hiekkalaatikko', function(){
    HelloWorldController::sandbox();
  });

  $routes->get('/login', function(){
    UserController::login();
  });

  $routes->post('/login', function(){
    UserController::handle_login();
  });

  $routes->post('/logout', function(){
    UserController::logout();
  });

  $routes->get('/register', function(){
    UserController::register();
  });

  $routes->post('/register', function(){
    UserController::handle_register();
  });

  ## Gifts

  $routes->get('/gifts', 'check_logged_in', function(){
    GiftController::list();
  });

  $routes->get('/gifts/new', 'check_logged_in', function(){
    GiftController::new();
  });

  $routes->post('/gifts/new', 'check_logged_in', function(){
    GiftController::create();
  });

  $routes->get('/gifts/:id', 'check_logged_in', function($id){
    GiftController::show($id);
  });

  $routes->post('/gifts/:id/destroy', 'check_logged_in', function($id){
    GiftController::destroy($id);
  });

  $routes->get('/gifts/:id/edit', 'check_logged_in', function($id){
    GiftController::edit($id);
  });

  $routes->post('/gifts/:id/edit', 'check_logged_in', function($id){
    GiftController::update($id);
  });

  ## People

  $routes->get('/people', 'check_logged_in', function(){
    PersonController::list();
  });

  $routes->get('/people/new', 'check_logged_in', function(){
    PersonController::new();
  });

  $routes->post('/people/new', 'check_logged_in', function(){
    PersonController::create();
  });

  $routes->get('/people/:id', 'check_logged_in', function($id){
    PersonController::show($id);
  });

  $routes->get('/people/:id/edit', 'check_logged_in', function($id){
    PersonController::edit($id);
  });

  $routes->post('/people/:id/edit', 'check_logged_in', function($id){
    PersonController::update($id);
  });

  $routes->post('/people/:id/destroy', 'check_logged_in', function($id){
    PersonController::destroy($id);
  });

  ## Tags

  $routes->get('/tags', 'check_logged_in', function() {
    TagController::list();
  });

  $routes->get('/tags/new', 'check_logged_in', function() {
    TagController::new();
  });

  $routes->post('/tags/new', 'check_logged_in', function() {
    TagController::create();
  });

  $routes->get('/tags/:id', 'check_logged_in', function($id) {
    TagController::show($id);
  });

  $routes->get('/tags/:id/edit', 'check_logged_in', function($id) {
    TagController::edit($id);
  });

  $routes->post('/tags/:id/edit', 'check_logged_in', function($id) {
    TagController::update($id);
  });

  $routes->post('/tags/:id/destroy', 'check_logged_in', function($id) {
    TagController::destroy($id);
  });