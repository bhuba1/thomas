CREATE TABLE Megallok (
  nev varchar(50) NOT NULL,
  megye varchar(50) DEFAULT NULL,
  varos varchar(50) DEFAULT NULL
  
); /*ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_hungarian_ci;*/


INSERT INTO megallok (nev,megye,varos ) VALUES ('Abony VA','Abony', 'Pest');
INSERT INTO megallok (nev,megye,varos ) VALUES ('Budapest Keleti', 'Pest', 'Budapest');
INSERT INTO megallok (nev,megye,varos ) VALUES ('Budapest Nyugati', 'Pest', 'Budapest');
INSERT INTO megallok (nev,megye,varos ) VALUES ('Cegled VA', 'Pest', 'Cegled');
INSERT INTO megallok (nev,megye,varos ) VALUES ('Debrecen VA', 'Hajdú-Bihar', 'Debrecen');
INSERT INTO megallok (nev,megye,varos ) VALUES ('Eger VA', 'Heves', 'Eger');
INSERT INTO megallok (nev,megye,varos ) VALUES ('Gyor VA', 'Gyõr-Moson-Sopron', 'Gyor');
INSERT INTO megallok (nev,megye,varos ) VALUES ('Kaposvar VA', 'Somogy', 'Kaposvar');
INSERT INTO megallok (nev,megye,varos ) VALUES ('Miskolc VA', 'Borsod-Abaúj-Zemplén', 'Miskolc');
INSERT INTO megallok (nev,megye,varos ) VALUES ('Pecs VA', 'Baranya', 'Pecs');
INSERT INTO megallok (nev,megye,varos ) VALUES ('Szeged Rokusi Palyaudvar', 'Csongrád', 'Szeged');
INSERT INTO megallok (nev,megye,varos ) VALUES ('Szeged Szemelyi Palyaudvar', 'Csongrád', 'Szeged');
INSERT INTO megallok (nev,megye,varos ) VALUES ('Zalaegerszeg VA','Zala', 'Zalaegerszeg');

CREATE TABLE Varostav (
	Varos1 varchar(50) NOT NULL,
	Varos2 varchar(50) NOT NULL,
	Tavolsag INT NOT NULL
	
);/* ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_hungarian_ci; */

CREATE TABLE Jarmu (
	Jarmuszam VARCHAR(50) NOT NULL,
	
	Ferohely INT NOT NULL,
	Osztaly INT NOT NULL,
	
	PRIMARY KEY (Jarmuszam)
);/*ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_hungarian_ci; */

INSERT INTO Jarmu (Jarmuszam, Ferohely, Osztaly) VALUES ('A1',  300, 1);
INSERT INTO Jarmu (Jarmuszam, Ferohely, Osztaly) VALUES ('A2',  280, 2);
INSERT INTO Jarmu (Jarmuszam, Ferohely, Osztaly) VALUES ('B1', 50, 2);
INSERT INTO Jarmu (Jarmuszam, Ferohely, Osztaly) VALUES ('B2',  55, 2);
INSERT INTO Jarmu (Jarmuszam, Ferohely, Osztaly) VALUES ('B3',  45, 1);
INSERT INTO Jarmu (Jarmuszam, Ferohely, Osztaly) VALUES ('V2',  80, 1);
INSERT INTO Jarmu (Jarmuszam, Ferohely, Osztaly) VALUES ('V8',  90, 2);



INSERT INTO Varostav (Varos1, Varos2, Tavolsag) VALUES ('Abony VA', 'Budapest Keleti', 177);
INSERT INTO Varostav (Varos1, Varos2, Tavolsag) VALUES ('Abony VA', 'Cegled VA', 17);
INSERT INTO Varostav (Varos1, Varos2, Tavolsag) VALUES ('Abony VA', 'Debrecen VA', 145);
INSERT INTO Varostav (Varos1, Varos2, Tavolsag) VALUES ('Abony VA', 'Eger VA', 102);
INSERT INTO Varostav (Varos1, Varos2, Tavolsag) VALUES ('Abony VA', 'Gyor VA', 208);
INSERT INTO Varostav (Varos1, Varos2, Tavolsag) VALUES ('Abony VA', 'Kaposvar VA', 265);
INSERT INTO Varostav (Varos1, Varos2, Tavolsag) VALUES ('Abony VA', 'Miskolc VA', 149);
INSERT INTO Varostav (Varos1, Varos2, Tavolsag) VALUES ('Abony VA', 'Pecs VA', 251);
INSERT INTO Varostav (Varos1, Varos2, Tavolsag) VALUES ('Abony VA', 'Szeged Szemelyi Palyaudvar',137);
INSERT INTO Varostav (Varos1, Varos2, Tavolsag) VALUES ('Abony VA', 'Zalaegerszeg VA', 310);
INSERT INTO Varostav (Varos1, Varos2, Tavolsag) VALUES ('Budapest Keleti', 'Cegled VA', 17);
INSERT INTO Varostav (Varos1, Varos2, Tavolsag) VALUES ('Budapest Keleti', 'Debrecen VA', 231);
INSERT INTO Varostav (Varos1, Varos2, Tavolsag) VALUES ('Budapest Keleti', 'Eger VA', 139);
INSERT INTO Varostav (Varos1, Varos2, Tavolsag) VALUES ('Budapest Keleti', 'Gyor VA', 121);
INSERT INTO Varostav (Varos1, Varos2, Tavolsag) VALUES ('Budapest Keleti', 'Kaposvar VA', 181);
INSERT INTO Varostav (Varos1, Varos2, Tavolsag) VALUES ('Budapest Keleti', 'Miskolc VA', 185);
INSERT INTO Varostav (Varos1, Varos2, Tavolsag) VALUES ('Budapest Keleti', 'Pecs VA', 238);
INSERT INTO Varostav (Varos1, Varos2, Tavolsag) VALUES ('Budapest Keleti', 'Szeged Szemelyi Palyaudvar', 165);
INSERT INTO Varostav (Varos1, Varos2, Tavolsag) VALUES ('Budapest Keleti', 'Zalaegerszeg VA', 227);
INSERT INTO Varostav (Varos1, Varos2, Tavolsag) VALUES ('Cegled VA', 'Debrecen VA', 231);
INSERT INTO Varostav (Varos1, Varos2, Tavolsag) VALUES ('Cegled VA', 'Eger VA', 118);
INSERT INTO Varostav (Varos1, Varos2, Tavolsag) VALUES ('Cegled VA', 'Gyor VA', 196);
INSERT INTO Varostav (Varos1, Varos2, Tavolsag) VALUES ('Cegled VA', 'Kaposvar VA', 252);
INSERT INTO Varostav (Varos1, Varos2, Tavolsag) VALUES ('Cegled VA', 'Miskolc VA', 165);
INSERT INTO Varostav (Varos1, Varos2, Tavolsag) VALUES ('Cegled VA', 'Pecs VA', 244);
INSERT INTO Varostav (Varos1, Varos2, Tavolsag) VALUES ('Cegled VA', 'Szeged Szemelyi Palyaudvar', 134);
INSERT INTO Varostav (Varos1, Varos2, Tavolsag) VALUES ('Cegled VA', 'Zalaegerszeg VA', 298);
INSERT INTO Varostav (Varos1, Varos2, Tavolsag) VALUES ('Debrecen VA', 'Eger VA', 118);
INSERT INTO Varostav (Varos1, Varos2, Tavolsag) VALUES ('Debrecen VA', 'Gyor VA', 377);
INSERT INTO Varostav (Varos1, Varos2, Tavolsag) VALUES ('Debrecen VA', 'Kaposvar VA', 434);
INSERT INTO Varostav (Varos1, Varos2, Tavolsag) VALUES ('Debrecen VA', 'Miskolc VA', 114);
INSERT INTO Varostav (Varos1, Varos2, Tavolsag) VALUES ('Debrecen VA', 'Pecs VA', 474);
INSERT INTO Varostav (Varos1, Varos2, Tavolsag) VALUES ('Debrecen VA', 'Szeged Szemelyi Palyaudvar', 226);
INSERT INTO Varostav (Varos1, Varos2, Tavolsag) VALUES ('Debrecen VA', 'Zalaegerszeg VA', 479);
INSERT INTO Varostav (Varos1, Varos2, Tavolsag) VALUES ('Eger VA', 'Gyor VA', 377);
INSERT INTO Varostav (Varos1, Varos2, Tavolsag) VALUES ('Eger VA', 'Kaposvar VA', 341);
INSERT INTO Varostav (Varos1, Varos2, Tavolsag) VALUES ('Eger VA', 'Miskolc VA', 84);
INSERT INTO Varostav (Varos1, Varos2, Tavolsag) VALUES ('Eger VA', 'Pecs VA', 382);
INSERT INTO Varostav (Varos1, Varos2, Tavolsag) VALUES ('Eger VA', 'Szeged Szemelyi Palyaudvar', 301);
INSERT INTO Varostav (Varos1, Varos2, Tavolsag) VALUES ('Eger VA', 'Zalaegerszeg VA', 387);
INSERT INTO Varostav (Varos1, Varos2, Tavolsag) VALUES ('Gyor VA', 'Miskolc VA', 331);
INSERT INTO Varostav (Varos1, Varos2, Tavolsag) VALUES ('Gyor VA', 'Pecs VA', 330);
INSERT INTO Varostav (Varos1, Varos2, Tavolsag) VALUES ('Gyor VA', 'Szeged Szemelyi Palyaudvar', 288);
INSERT INTO Varostav (Varos1, Varos2, Tavolsag) VALUES ('Gyor VA', 'Zalaegerszeg VA', 140);
INSERT INTO Varostav (Varos1, Varos2, Tavolsag) VALUES ('Kaposvar VA', 'Miskolc VA', 392);
INSERT INTO Varostav (Varos1, Varos2, Tavolsag) VALUES ('Kaposvar VA', 'Pecs VA', 65);
INSERT INTO Varostav (Varos1, Varos2, Tavolsag) VALUES ('Kaposvar VA', 'Szeged Szemelyi Palyaudvar', 226);
INSERT INTO Varostav (Varos1, Varos2, Tavolsag) VALUES ('Kaposvar VA', 'Zalaegerszeg VA', 126);
INSERT INTO Varostav (Varos1, Varos2, Tavolsag) VALUES ('Miskolc VA', 'Pecs VA', 65);
INSERT INTO Varostav (Varos1, Varos2, Tavolsag) VALUES ('Miskolc VA', 'Szeged Szemelyi Palyaudvar', 346);
INSERT INTO Varostav (Varos1, Varos2, Tavolsag) VALUES ('Miskolc VA', 'Zalaegerszeg VA', 432);
INSERT INTO Varostav (Varos1, Varos2, Tavolsag) VALUES ('Pecs VA', 'Szeged Szemelyi Palyaudvar', 346);
INSERT INTO Varostav (Varos1, Varos2, Tavolsag) VALUES ('Pecs VA', 'Zalaegerszeg VA', 391);
INSERT INTO Varostav (Varos1, Varos2, Tavolsag) VALUES ('Szeged Szemelyi Palyaudvar', 'Zalaegerszeg VA', 192);

CREATE TABLE ugyfel (
	id INT NOT NULL,
	Nev VARCHAR(50) NOT NULL,
	Varos VARCHAR(50) NOT NULL,
	Utca VARCHAR(50) DEFAULT NULL,
	Hazszam VARCHAR(50) DEFAULT NULL
	
);/*ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_hungarian_ci;*/

INSERT INTO Ugyfel (id, Nev, Varos, Utca, Hazszam) VALUES (1, 'Biddy Skewis', 'Taltal', 'Fremont', 445);
INSERT INTO Ugyfel (id, Nev, Varos, Utca, Hazszam) VALUES (2, 'Elbert Kock', 'Laiyuan', 'Portage', 8);
INSERT INTO Ugyfel (id, Nev, Varos, Utca, Hazszam) VALUES (3, 'Ellsworth Cloonan', 'Toride', 'Chinook', 699);
INSERT INTO Ugyfel (id, Nev, Varos, Utca, Hazszam) VALUES (4, 'Darin Devinn', 'Idrinskoye', 'Mockingbird', 73);
INSERT INTO Ugyfel (id, Nev, Varos, Utca, Hazszam) VALUES (5, 'Nisse Jorissen', 'Töreboda', 'Sauthoff', 7);
INSERT INTO Ugyfel (id, Nev, Varos, Utca, Hazszam) VALUES (6, 'Sim Warland', 'Manukau City', 'Loomis', 372);
INSERT INTO Ugyfel (id, Nev, Varos, Utca, Hazszam) VALUES (7, 'Karolina Runnalls', 'Coripata', 'Anthes', 63);
INSERT INTO Ugyfel (id, Nev, Varos, Utca, Hazszam) VALUES (8, 'Klarrisa Pollastrino', 'Santa Elena', 'Meadow Valley', 668);
INSERT INTO Ugyfel (id, Nev, Varos, Utca, Hazszam) VALUES (9, 'Dick Ballefant', 'Segezha', 'Luster', 1);
INSERT INTO Ugyfel (id, Nev, Varos, Utca, Hazszam) VALUES (10, 'Tarah Leathers', 'Cuauhtemoc', 'Arkansas', 3);
INSERT INTO Ugyfel (id, Nev, Varos, Utca, Hazszam) VALUES (11, 'Rhoda Bavister', 'Huambo', 'Russell', '1');
INSERT INTO Ugyfel (id, Nev, Varos, Utca, Hazszam) VALUES (12, 'Cordelie Castanos', 'Akzhal', 'Autumn Leaf', 22);
INSERT INTO Ugyfel (id, Nev, Varos, Utca, Hazszam) VALUES (13, 'Bria Stickley', 'Bella Vista', 'Surrey', 349);
INSERT INTO Ugyfel (id, Nev, Varos, Utca, Hazszam) VALUES (14, 'Deane Brettel', 'Yangjiao', 'Lukken', 452);
INSERT INTO Ugyfel (id, Nev, Varos, Utca, Hazszam) VALUES (15, 'Baryram Graal', 'Oranmore', 'Lakewood', 40);

create table jarat (
	id INT NOT NULL,
	Honnan VARCHAR(50) NOT NULL,
	Hova VARCHAR(50) NOT NULL,
	Datum DATE NOT NULL,
	Indulas VARCHAR(50) NOT NULL,
	jarmuszam VARCHAR(50) NOT NULL,
	Menetido VARCHAR(50) NOT NULL,
	Hely INT NOT NULL
	
);/*ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_hungarian_ci;*/

INSERT INTO jarat (id, Honnan, Hova, Datum, Indulas, jarmuszam, Menetido, Hely) VALUES (1, 'Szeged Szemelyi Palyaudvar', 'Budapest Keleti', TO_DATE('2018-07-29','YYYY-MM-DD'), '16:47', 'A1', '7:41', 11);
INSERT INTO jarat (id, Honnan, Hova, Datum, Indulas, jarmuszam, Menetido, Hely) VALUES (2, 'Pecs VA', 'Szeged Szemelyi Palyaudvar',TO_DATE('2018-05-28','YYYY-MM-DD'), '21:14', 'B3', '4:26', 18);
INSERT INTO jarat (id, Honnan, Hova, Datum, Indulas, jarmuszam, Menetido, Hely) VALUES (3, 'Pecs VA', 'Szeged Szemelyi Palyaudvar', TO_DATE('2018-02-10','YYYY-MM-DD'), '06:01', 'V8', '3:59', 43);
INSERT INTO jarat (id, Honnan, Hova, Datum, Indulas, jarmuszam, Menetido, Hely) VALUES (4, 'Budapest Keleti', 'Debrecen VA', TO_DATE('2017-11-24','YYYY-MM-DD'), '15:52', 'A2', '08:10', 30);
INSERT INTO jarat (id, Honnan, Hova, Datum, Indulas, jarmuszam, Menetido, Hely) VALUES (5, 'Budapest Nyugati', 'Gyor VA', TO_DATE('2018-03-25','YYYY-MM-DD'), '22:18', 'A1', '09:04', 174);
INSERT INTO jarat (id, Honnan, Hova, Datum, Indulas, jarmuszam, Menetido, Hely) VALUES (6, 'Budapest Nyugati', 'Pecs VA', TO_DATE('2018-07-02','YYYY-MM-DD'), '6:49', 'V2', '01:09', 49);
INSERT INTO jarat (id, Honnan, Hova, Datum, Indulas, jarmuszam, Menetido, Hely) VALUES (7, 'Gyor VA', 'Pecs VA', TO_DATE('2018-03-08','YYYY-MM-DD'), '10:10', 'V2', '07:08', 19);
INSERT INTO jarat (id, Honnan, Hova, Datum, Indulas, jarmuszam, Menetido, Hely) VALUES (8, 'Szeged Szemelyi Palyaudvar', 'Pecs VA', TO_DATE('2018-02-21','YYYY-MM-DD'), '16:09', 'B2', '5:28', 62);
INSERT INTO jarat (id, Honnan, Hova, Datum, Indulas, jarmuszam, Menetido, Hely) VALUES (9, 'Szeged Szemelyi Palyaudvar', 'Debrecen VA', TO_DATE('2018-04-11','YYYY-MM-DD'), '12:05', 'B3', '9:09', 174);

INSERT INTO jarat (id, Honnan, Hova, Datum, Indulas, jarmuszam, Menetido, Hely) VALUES (10, 'Debrecen VA', 'Szeged Szemelyi Palyaudvar', TO_DATE('2018-07-19','YYYY-MM-DD'), '02:00', 'V8', '3:10', 78);
INSERT INTO jarat (id, Honnan, Hova, Datum, Indulas, jarmuszam, Menetido, Hely) VALUES (11, 'Debrecen VA', 'Budapest Keleti', TO_DATE('2018-07-08','YYYY-MM-DD'), '0:40', 'B1', '01:52', 54);
INSERT INTO jarat (id, Honnan, Hova, Datum, Indulas, jarmuszam, Menetido, Hely) VALUES (12, 'Budapest Keleti', 'Debrecen VA', TO_DATE('2018-05-29','YYYY-MM-DD'), '9:40', 'A2', '09:30', 173);
INSERT INTO jarat (id, Honnan, Hova, Datum, Indulas, jarmuszam, Menetido, Hely) VALUES (13, 'Gyor VA', 'Szeged Szemelyi Palyaudvar', TO_DATE('2018-07-19','YYYY-MM-DD'), '23:40', 'V2', '02:11', 15);
INSERT INTO jarat (id, Honnan, Hova, Datum, Indulas, jarmuszam, Menetido, Hely) VALUES (14, 'Szeged Szemelyi Palyaudvar', 'Budapest Keleti', TO_DATE('2018-05-22','YYYY-MM-DD'), '03:30', 'B1', '05:15', 17);
INSERT INTO jarat (id, Honnan, Hova, Datum, Indulas, jarmuszam, Menetido, Hely) VALUES (15, 'Gyor VA', 'Debrecen VA', TO_DATE('2018-05-19','YYYY-MM-DD'), '23:45', 'B1', '04:55', 31);
INSERT INTO jarat (id, Honnan, Hova, Datum, Indulas, jarmuszam, Menetido, Hely) VALUES (16, 'Szeged Szemelyi Palyaudvar', 'Zalaegerszeg VA', TO_DATE('2018-04-11','YYYY-MM-DD'), '12:05', 'B3', '5:45', 174);
INSERT INTO jarat (id, Honnan, Hova, Datum, Indulas, jarmuszam, Menetido, Hely) VALUES (17, 'Zalaegerszeg VA', 'Pecs VA', TO_DATE('2018-04-12','YYYY-MM-DD'), '12:05', 'B3', '6:45', 174);

CREATE TABLE foglalas (
	id INT NOT NULL,
	ugyfel INT NOT NULL,
	jarat INT NOT NULL,
	osztaly int default 0
	
);/*ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_hungarian_ci;*/

INSERT INTO foglalas (id,ugyfel, jarat, osztaly) VALUES (1,1,1,1);
INSERT INTO foglalas (id,ugyfel, jarat, osztaly) VALUES (2,4,6,2);
INSERT INTO foglalas (id,ugyfel, jarat, osztaly) VALUES (3,6,10,2);
INSERT INTO foglalas (id,ugyfel, jarat, osztaly) VALUES (4,2,2,1);
INSERT INTO foglalas (id,ugyfel, jarat, osztaly) VALUES (5,10,8,1);

/*------------------------------------------------------------------------------------*/

ALTER TABLE megallok
  ADD PRIMARY KEY (nev);
COMMIT;

ALTER TABLE Varostav
ADD PRIMARY KEY (Varos1,Varos2);

ALTER TABLE Varostav
ADD FOREIGN KEY (Varos1) REFERENCES megallok(nev);

ALTER TABLE Varostav
ADD FOREIGN KEY (Varos2) REFERENCES megallok(nev);

ALTER TABLE jarat
ADD PRIMARY KEY (id);

ALTER TABLE jarat
ADD FOREIGN KEY (Honnan) REFERENCES megallok(nev);

ALTER TABLE jarat
ADD FOREIGN KEY (Hova) REFERENCES megallok(nev);

ALTER TABLE jarat
ADD FOREIGN KEY (jarmuszam) REFERENCES Jarmu(jarmuszam);

ALTER TABLE ugyfel
ADD PRIMARY KEY (id);

ALTER TABLE foglalas
ADD PRIMARY KEY (id);

ALTER TABLE foglalas
ADD FOREIGN KEY (ugyfel) REFERENCES ugyfel(id);

ALTER TABLE foglalas
ADD FOREIGN KEY (jarat) REFERENCES jarat(id);

/*SELECT * FROM JARAT;

DROP TABLE foglalas; 
DROP TABLE jarat;
DROP TABLE jarmu;
DROP TABLE ugyfel; 
DROP TABLE varostav;
DROP TABLE megallok;*/