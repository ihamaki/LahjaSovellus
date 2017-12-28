-- Lisää CREATE TABLE lauseet tähän tiedostoon

CREATE TABLE GiftUser(
  id SERIAL PRIMARY KEY,
  username varchar(30) NOT NULL,
  password varchar(30) NOT NULL
);

CREATE TABLE Person(
  id SERIAL PRIMARY KEY,
  name varchar(50) NOT NULL,
  birthday DATE,
  description varchar(500),
  giftuser_id INTEGER REFERENCES GiftUser(id)
);

CREATE TABLE Gift(
  id SERIAL PRIMARY KEY,
  name varchar(100) NOT NULL,
  status boolean DEFAULT FALSE,
  dateAdded DATE, 
  description varchar(500),
  giftuser_id INTEGER REFERENCES GiftUser(id),
  person_id INTEGER REFERENCES Person(id)
);

CREATE TABLE Tag(
  id SERIAL PRIMARY KEY,
  name varchar(50)
);

CREATE TABLE GiftTag(
  gift_id INTEGER REFERENCES Gift(id),
  tag_id INTEGER REFERENCES Tag(id)
);