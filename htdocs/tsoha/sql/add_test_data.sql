-- Lisää INSERT INTO lauseet tähän tiedostoon
INSERT INTO Opiskelija (nimi, osoite, syntymaAika, tiedekunta, aloitusvuosi, salasana)
VALUES ('Matti Nieminen', 'Hyvinkaa', '1983-05-26', 'Matematiikka', '2007', 'sljsdljfieerrd');

INSERT INTO OpintoOhjaaja (nimi, osoite, syntymaAika, salasana)
VALUES ('Keijo Miettinen', 'Helsinginkatu 5 A', '1973-08-14', 'sljdfdhkiuyy654rf');

INSERT INTO Aihepiiri (aihe)
VALUES ('opintotuki');

INSERT INTO Kysymys (aiheID, kysyja, vastaaja, kysymys)
VALUES ('1', '1', '1', 'mitä kuuluu?');