DROP DATABASE IF EXISTS pizza_new;
CREATE DATABASE pizza_new;
USE pizza_new;

CREATE TABLE IF NOT EXISTS p_pizza_sizes(
  size_id int(11) NOT NULL,
  size_desc varchar(255) NOT NULL,
  active_sw enum('Y', 'N') NOT NULL DEFAULT 'Y',
  PRIMARY KEY (size_id)
);

CREATE TABLE IF NOT EXISTS p_pizza(
  pizza_id int(11) NOT NULL AUTO_INCREMENT,
  pizza_desc varchar(255) NOT NULL,
  price decimal (8,2) NOT NULL DEFAULT 0.00,
  active_sw enum('Y', 'N') NOT NULL DEFAULT 'Y',
  lastmod timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP,
  PRIMARY KEY (pizza_id)
);

CREATE TABLE IF NOT EXISTS p_topping_categories(
  topping_category_id int(11) NOT NULL AUTO_INCREMENT,
  topping_category_desc varchar(255) NOT NULL,
  active_sw enum('Y', 'N') NOT NULL DEFAULT 'Y',
  lastmod timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP,
  PRIMARY KEY (topping_category_id)
);

CREATE TABLE IF NOT EXISTS p_toppings(
  topping_id int(11) NOT NULL AUTO_INCREMENT,
  topping_category_id int(11) NOT NULL,
  topping_desc varchar(255) NOT NULL,
  topping_price decimal(8,2) NOT NULL DEFAULT 0.00,
  active_sw enum('Y', 'N') NOT NULL DEFAULT 'Y',
  lastmod timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP,
  PRIMARY KEY (topping_id),
  FOREIGN KEY (topping_category_id) REFERENCES p_topping_categories(topping_category_id)
);

CREATE TABLE IF NOT EXISTS p_customer(
  customer_id int(11) NOT NULL AUTO_INCREMENT,
  first_name varchar(255) NOT NULL,
  last_name varchar(255) NOT NULL,
  email_id varchar(255) NOT NULL,
  pri_phone varchar(255) NULL,
  alt_phone varchar(255) NULL,
  lastmod timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP,
  PRIMARY KEY (customer_id),
  UNIQUE KEY (email_id)
);

CREATE TABLE IF NOT EXISTS p_address_types(
  address_type_cd int(11) NOT NULL,
  address_type_cd_desc varchar(255) NOT NULL,
  active_sw enum('Y', 'N') NOT NULL DEFAULT 'Y',
  PRIMARY KEY (address_type_cd)
);

CREATE TABLE IF NOT EXISTS p_addresses(
  address_id int(11) NOT NULL AUTO_INCREMENT,
  customer_id int(11) NOT NULL,
  address_type_cd int(11) NOT NULL,
  address_line_one varchar(255) NOT NULL,
  address_line_two varchar(255) NULL,
  city_name varchar(255) NOT NULL,
  state_cd char(2) NOT NULL DEFAULT 'GA',
  postal_cd varchar(32) NOT NULL,
  active_sw enum('Y', 'N') NOT NULL DEFAULT 'Y',
  lastmod timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP,
  PRIMARY KEY (address_id),
  FOREIGN KEY (customer_id) REFERENCES p_customer(customer_id)
);

CREATE TABLE IF NOT EXISTS p_credit_card_types(
  credit_card_type_cd varchar(32) NOT NULL,
  credit_card_type_cd_desc varchar(255) NOT NULL,
  active_sw enum('Y', 'N') NOT NULL DEFAULT 'Y',
  PRIMARY KEY (credit_card_type_cd)
);

CREATE TABLE IF NOT EXISTS p_payment_profiles(
  payment_profile_id int(11) NOT NULL AUTO_INCREMENT,
  customer_id int(11) NOT NULL,
  address_id int(11) NOT NULL,
  credit_card_type_cd varchar(32) NOT NULL,
  credit_card_number varchar(64) NOT NULL,
  credit_card_name varchar(255) NOT NULL,
  expiration_month int(2) NOT NULL,
  expiration_year year(4) NOT NULL,
  security_code char(3) NOT NULL,
  active_sw enum('Y', 'N') NOT NULL DEFAULT 'Y',
  lastmod timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP,
  PRIMARY KEY (payment_profile_id),
  FOREIGN KEY (customer_id) REFERENCES p_customer(customer_id),
  FOREIGN KEY (address_id) REFERENCES p_addresses(address_id),
  FOREIGN KEY (credit_card_type_cd) REFERENCES p_credit_card_types(credit_card_type_cd)
);

CREATE TABLE IF NOT EXISTS p_order_types(
  order_type_cd int(11) NOT NULL,
  order_type_cd_desc varchar(255) NOT NULL,
  active_sw enum('Y', 'N') NOT NULL DEFAULT 'Y',
  lastmod timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP,
  PRIMARY KEY (order_type_cd)
);

CREATE TABLE IF NOT EXISTS p_order_status_codes(
  order_status_cd int(11) NOT NULL,
  order_status_cd_desc varchar(255) NOT NULL,
  active_sw enum('Y', 'N') NOT NULL DEFAULT 'Y',
  lastmod timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP,
  PRIMARY KEY (order_status_cd)
);

CREATE TABLE IF NOT EXISTS p_discount_codes(
  discount_cd varchar(32) NOT NULL,
  discount_cd_desc varchar(255) NOT NULL,
  amount decimal(8,2) NOT NULL DEFAULT 0.00,
  valid_thru_date date NOT NULL DEFAULT '2020-12-31',
  active_sw enum('Y', 'N') NOT NULL DEFAULT 'Y',
  lastmod timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP,
  PRIMARY KEY (discount_cd)
);

CREATE TABLE IF NOT EXISTS p_orders(
  order_id int(11) NOT NULL AUTO_INCREMENT,
  order_date date NOT NULL DEFAULT '0000-00-00',
  customer_id int(11) NOT NULL,
  order_type_cd int(11) NOT NULL,
  order_status_cd int(11) NOT NULL,
  discount_cd varchar(32) NULL,
  remarks text NULL,
  lastmod timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP,
  PRIMARY KEY (order_id),
  FOREIGN KEY (customer_id) REFERENCES p_customer(customer_id),
  FOREIGN KEY (order_type_cd) REFERENCES p_order_types(order_type_cd),
  FOREIGN KEY (order_status_cd) REFERENCES p_order_status_codes(order_status_cd)
);

CREATE TABLE IF NOT EXISTS p_order_details(
  order_detail_id int(11) NOT NULL AUTO_INCREMENT,
  order_id int(11) NOT NULL,
  pizza_id int(11) NOT NULL,
  size_id int(11) NOT NULL,
  pizza_price decimal(8,2) NOT NULL DEFAULT 0.00,
  topping_id int(11) NOT NULL,
  topping_price decimal(8,2) NOT NULL DEFAULT 0.00,
  lastmod timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP,
  PRIMARY KEY (order_detail_id),
  FOREIGN KEY (order_id) REFERENCES p_orders(order_id),
  FOREIGN KEY (pizza_id) REFERENCES p_pizza(pizza_id),
  FOREIGN KEY (size_id) REFERENCES p_pizza_sizes(size_id),
  FOREIGN KEY (topping_id) REFERENCES p_toppings(topping_id)
);

INSERT INTO p_topping_categories
  (topping_category_desc)
  VALUES
  ('Cheeses'),
  ('Sauces'),
  ('Meats'),
  ('Vegetables'),
  ('Fruits');
