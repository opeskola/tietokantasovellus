-- Lisää CREATE TABLE lauseet tähän tiedostoon
CREATE TABLE Opiskelija(
    opiskelijaNro INTEGER PRIMARY KEY,
    nimi varchar(100) NOT NULL,
    osoite varchar(255) NOT NULL,
    syntymaAika DATE NOT NULL,
    tiedekunta varchar(100) NOT NULL,
    aloitusvuosi INTEGER NOT NULL,
    salasana varchar(50) NOT NULL
);

CREATE TABLE OpintoOhjaaja(
    id INTEGER PRIMARY KEY,
    nimi varchar(100) NOT NULL,
    osoite varchar(255) NOT NULL,
    syntymaAika DATE NOT NULL,
    salasana varchar(50) NOT NULL
);

CREATE TABLE Aihepiiri(
    id SERIAL PRIMARY KEY,
    aihe varchar(100) NOT NULL
);

CREATE TABLE Kysymys(
    id SERIAL PRIMARY KEY,
    opiskelijaNro INTEGER REFERENCES Opiskelija(opiskelijaNro),
    sisalto varchar(2000),
    pvm TIMESTAMP,
    status boolean DEFAULT FALSE   
);

CREATE TABLE Vastaus(
    id SERIAL PRIMARY KEY,
    vastaaja INTEGER REFERENCES OpintoOhjaaja(ID),
    kysymys INTEGER REFERENCES Kysymys(ID),
    aihe INTEGER REFERENCES Aihepiiri(ID),
    sisalto varchar(2000),
    pvm TIMESTAMP    
);
