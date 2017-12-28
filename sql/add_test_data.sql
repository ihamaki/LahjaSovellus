INSERT INTO GiftUser (username, password) VALUES ('MikkoMallikas', 'Mallikas');
INSERT INTO GiftUser (username, password) VALUES ('Urpo', 'Turpo');

INSERT INTO Person (name, birthday, description, giftuser_id) 
    VALUES ('Iines', '1990-02-10', 'Tykkää sisustamisesta.', 1);
INSERT INTO Person (name, birthday, description, giftuser_id) 
    VALUES ('Aku', '1985-07-07', 'Toivoi lahjaksi sukkia. Tykkää punaisesta.', 1);

INSERT INTO Gift (name, dateAdded, description, giftuser_id, person_id)
    VALUES ('Maljakko', NOW(), 'Iittalan uusi maljakko on valmistettu lasista.', 1, 1);
INSERT INTO Gift (name, dateAdded, description, giftuser_id, person_id)
    VALUES ('Sukat', NOW(), 'Hauskat raidalliset sukat.', 1, 2);

INSERT INTO Tag (name, giftuser_id) VALUES ('Syntymäpäivälahja', 1);
INSERT INTO Tag (name, giftuser_id) VALUES ('Särkyvä', 1);

INSERT INTO GiftTag (gift_id, tag_id) VALUES (1, 1);
INSERT INTO GiftTag (gift_id, tag_id) VALUES (1, 2);
INSERT INTO GiftTag (gift_id, tag_id) VALUES (2, 1);