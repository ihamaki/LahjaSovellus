CREATE TABLE Account(
  id SERIAL PRIMARY KEY,
  username varchar(30) NOT NULL,
  password varchar(30) NOT NULL
);

CREATE TABLE Person(
  id SERIAL PRIMARY KEY,
  account_id INTEGER REFERENCES Account(id),
  name varchar(50) NOT NULL,
  birthday DATE,
  description varchar(500)
);

CREATE TABLE Gift(
  id SERIAL PRIMARY KEY,
  account_id INTEGER REFERENCES Account(id),
  person_id INTEGER REFERENCES Person(id),
  name varchar(100) NOT NULL,
  status boolean DEFAULT FALSE,
  description varchar(500),
  added DATE
);

CREATE TABLE Tag(
  id SERIAL PRIMARY KEY,
  account_id INTEGER REFERENCES Account(id),
  name varchar(50)
);

CREATE TABLE GiftTag(
  gift_id INTEGER REFERENCES Gift(id),
  tag_id INTEGER REFERENCES Tag(id)
);