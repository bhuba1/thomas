ALTER TABLE ugyfel ADD egyenleg INT;
COMMIT;

UPDATE ugyfel SET egyenleg = 100000;
COMMIT;