-- Lisää INSERT INTO lauseet tähän tiedostoon
INSERT INTO Opiskelija (opiskelijaNro, nimi, osoite, syntymaAika, tiedekunta, aloitusvuosi, salasana)
VALUES ('1002344', 'Matti Nykanen', 'Hyvinkaa', '1973-12-05', 'Matematiikka', '2007', 'saskijrcdsesa');

INSERT INTO OpintoOhjaaja (ID, nimi, osoite, syntymaAika, salasana)
VALUES ('50001', 'Keijo Miettinen', 'Helsinginkatu 5', '1960-06-23', 'fr4FGE5guugb');

INSERT INTO Aihepiiri (ID, aihe) VALUES ('1', 'Opintotuki');
INSERT INTO Aihepiiri (ID, aihe) VALUES ('2', 'Joo-opinnot');


INSERT INTO Kysymys (ID, opiskelijaNro, sisalto, pvm, status)
VALUES ('1', '1002344', 'Kuinka paljon opintopisteita tarvitaan, jotta saa opintotukea?', '2015-01-10', TRUE);

INSERT INTO Vastaus (ID, vastaaja, kysymys, aihe, sisalto, pvm)
VALUES ('1', '50001', '1', '1', 'Opistotukeen tarvitsee vähintään 20 opintopistettä lukakaudessa.', '2015-01-15');