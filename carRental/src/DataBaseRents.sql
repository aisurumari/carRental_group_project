CREATE TABLE Rents
    ( rentID INT PRIMARY KEY ,
      user_ID INT,
      carID INT(11),
      price INT,
      date_of_start DATE,
      date_of_end DATE,
      status_of_rent VARCHAR (20)
    );

ALTER TABLE rents ADD FOREIGN KEY (user_ID) REFERENCES users(user_id) ON DELETE RESTRICT ON UPDATE RESTRICT;

ALTER TABLE rents ADD FOREIGN KEY (carID) REFERENCES car(idSamochodu) ON DELETE RESTRICT ON UPDATE RESTRICT;