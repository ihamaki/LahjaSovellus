INSERT INTO Account (username, password) VALUES ('MikkoMallikas', 'Mallikas');
INSERT INTO Account (username, password) VALUES ('Urpo', 'Turpo');

INSERT INTO Person (name, birthday, description, account_id) 
    VALUES ('Iines', '1990-02-10', 'Tykkää sisustamisesta.', 1);
INSERT INTO Person (name, birthday, description, account_id) 
    VALUES ('Aku', '1985-07-07', 'Toivoi lahjaksi sukkia. Tykkää punaisesta.', 1);

INSERT INTO Gift (name, added, description, account_id, person_id)
    VALUES ('Maljakko', NOW(), 'Iittalan uusi maljakko on valmistettu lasista.', 1, 1);
INSERT INTO Gift (name, added, description, account_id, person_id)
    VALUES ('Sukat', NOW(), 'Hauskat raidalliset sukat.', 1, 2);
INSERT INTO Gift (name, status, added, description, account_id, person_id)
    VALUES ('Nintendo Switch', true, NOW(), 'Nintendo Switch on Nintendon pelikonsoli, joka julkaistiin 3. maaliskuuta 2017. Pelikonsolia voi käyttää sekä kannettavana käsikonsolina että telakoituna kotikonsolina, joka kytketään televisioon. Laitteessa on kaksi irrotettavaa Joy-Con-ohjainta.', 1, 2);

INSERT INTO Tag (name, account_id) VALUES ('Syntymäpäivälahja', 1);
INSERT INTO Tag (name, account_id) VALUES ('Särkyvä', 1);
INSERT INTO Tag (name, account_id) VALUES ('Yleinen', 1);
INSERT INTO Tag (name, account_id) VALUES ('Elektroniikka', 1);

INSERT INTO GiftTag (gift_id, tag_id) VALUES (1, 1);
INSERT INTO GiftTag (gift_id, tag_id) VALUES (1, 2);
INSERT INTO GiftTag (gift_id, tag_id) VALUES (2, 1);
INSERT INTO GiftTag (gift_id, tag_id) VALUES (3, 4);