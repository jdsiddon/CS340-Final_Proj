-- Create color table.
CREATE TABLE fp_color (
  id INT NOT NULL AUTO_INCREMENT,
  name VARCHAR(255),
  PRIMARY KEY(id)
);
--
-- INSERT INTO  `siddonj-db`.`fp_color` (
-- `id` ,
-- `name`
-- )
-- VALUES (
-- NULL ,  'red'
-- );

-- Create card table.
CREATE TABLE fp_card (
  id INT NOT NULL AUTO_INCREMENT,
  name VARCHAR(255),
  color INT NOT NULL,
  type INT NOT NULL,
  ability TEXT NOT NULL,
  power INT,
  toughness INT,
  flavor_text TEXT,
  casting_cost INT,
  PRIMARY KEY(id)
);

-- Create owner table
CREATE TABLE fp_owner (
  id INT NOT NULL AUTO_INCREMENT,
  fname VARCHAR(255),
  lname VARCHAR(255),
  PRIMARY KEY(id)
);

-- Create collection table
CREATE TABLE fp_collection (
  id INT NOT NULL AUTO_INCREMENT,
  owner_id INT NOT NULL,
  card_id INT NOT NULL,
  FOREIGN KEY(owner_id) REFERENCES fp_owner(id),
  FOREIGN KEY(card_id) REFERENCES fp_card(id),
  PRIMARY KEY(id)
);

-- Create card to collection relation
CREATE TABLE fp_card_collection(
  id INT NOT NULL AUTO_INCREMENT,
  color_id INT NOT NULL,
  card_id INT NOT NULL,
  FOREIGN KEY ( color_id ) REFERENCES fp_color( id ),
  FOREIGN KEY ( card_id ) REFERENCES fp_card( id ),
  PRIMARY KEY(id)
);

-- Create type table.
CREATE TABLE fp_type (
  id INT NOT NULL AUTO_INCREMENT,
  name VARCHAR(255),
  PRIMARY KEY(id)
);

-- Create card to type relation
CREATE TABLE fp_card_type (
  id INT NOT NULL AUTO_INCREMENT,
  type_id INT NOT NULL,
  card_id INT NOT NULL,
  FOREIGN KEY(type_id) REFERENCES fp_type(id),
  FOREIGN KEY(card_id) REFERENCES fp_card(id),
  PRIMARY KEY(id)
);

-- Create deck table.
CREATE TABLE fp_deck (
  id INT NOT NULL AUTO_INCREMENT,
  name VARCHAR(255),
  PRIMARY KEY(id)
);


-- Create deck to cards relation
CREATE TABLE fp_deck_card (
  id INT NOT NULL AUTO_INCREMENT,
  deck_id INT NOT NULL,
  card_id INT NOT NULL,
  FOREIGN KEY(deck_id) REFERENCES fp_deck(id),
  FOREIGN KEY(card_id) REFERENCES fp_card(id),
  PRIMARY KEY(id)
);
