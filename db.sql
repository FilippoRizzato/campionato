use campionato;

-- Tabella CasaAutomobilistica

CREATE TABLE campionato.CasaAutomobilistica (

                                                CasaID INT AUTO_INCREMENT PRIMARY KEY,

                                                Nome VARCHAR(100) NOT NULL,

                                                ColoreLivrea VARCHAR(50) NOT NULL

);

-- Tabella Piloti

CREATE TABLE campionato.Piloti (

                                   PilotaID INT AUTO_INCREMENT PRIMARY KEY,

                                   Nome VARCHAR(50) NOT NULL,

                                   Cognome VARCHAR(50) NOT NULL,

                                   Nazionalità VARCHAR(50) NOT NULL,

                                   Numero INT UNIQUE NOT NULL,

                                   CasaID INT,

                                   FOREIGN KEY (CasaID) REFERENCES CasaAutomobilistica(CasaID)

);

-- Tabella Gara

CREATE TABLE campionato.Gara (

                                 GaraID INT AUTO_INCREMENT PRIMARY KEY,

                                 Data DATE NOT NULL,

                                 Circuito VARCHAR(100) NOT NULL,

                                 PilotaID INT NOT NULL,

                                 Posizione INT NOT NULL,

                                 TempoMigliore TIME,

                                 FOREIGN KEY (PilotaID) REFERENCES Piloti(PilotaID)

);