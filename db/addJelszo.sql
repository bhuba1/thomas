ALTER TABLE ugyfel ADD jelszo VARCHAR(50);
COMMIT;

UPDATE ugyfel SET jelszo = 'asd123';
COMMIT;