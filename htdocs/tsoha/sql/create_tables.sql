-- Lisää CREATE TABLE lauseet tähän tiedostoon
CREATE TABLE Opiskelija(
    opiskelijaNro SERIAL PRIMARY KEY,
    nimi varchar(100) NOT NULL,
    osoite varchar(255) NOT NULL,
    syntymaAika DATE NOT NULL,
    tiedekunta varchar(100) NOT NULL,
    aloitusvuosi INTEGER NOT NULL,
    salasana varchar(50) NOT NULL
);

CREATE TABLE OpintoOhjaaja(
    ID SERIAL PRIMARY KEY,
    nimi varchar(100) NOT NULL,
    osoite varchar(255) NOT NULL,
    syntymaAika DATE NOT NULL,
    salasana varchar(50) NOT NULL
);

CREATE TABLE Aihepiiri(
    ID SERIAL PRIMARY KEY,
    aihe varchar(100) NOT NULL
);

CREATE TABLE Kysymys(
    ID SERIAL PRIMARY KEY,
    aiheID INTEGER REFERENCES Aihepiiri(ID),
    kysyja INTEGER REFERENCES Opiskelija(opiskelijaNro),
    vastaaja INTEGER REFERENCES OpintoOhjaaja(ID),
    kysymys varchar(2000),
    kysymysPvm TIMESTAMP,
    status boolean DEFAULT FALSE,
    vastaus varchar(2000),
    vastausPvm TIMESTAMP    
);
