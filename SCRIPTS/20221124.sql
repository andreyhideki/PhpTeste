--postgres
create table Coach (
	id uuid DEFAULT gen_random_uuid() PRIMARY KEY,
	name varchar(100),
	city varchar(50),
	state varchar(2),
	country varchar(50),
	status bool,
	godfather uuid FOREIGN KEY
);

create table Pokemon (
	id uuid DEFAULT gen_random_uuid() PRIMARY KEY,
	name varchar(100),
	description varchar(255)
);

--select gen_random_uuid()

--mysql
-- poke.pokemon definition
CREATE TABLE `pokemon` (
  `id` varchar(40) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

CREATE TRIGGER before_insert_pokemon
  BEFORE INSERT ON poke.pokemon 
  FOR EACH ROW
  SET new.id = uuid();