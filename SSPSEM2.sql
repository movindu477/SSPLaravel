CREATE DATABASE SSPSEM2;

USE SSPSEM2;

CREATE TABLE [User] (
    id INT IDENTITY(1,1) PRIMARY KEY,
    name NVARCHAR(100) NOT NULL,
    address NVARCHAR(255) NOT NULL,
    phonenumber NVARCHAR(15) NOT NULL,
    email NVARCHAR(100) UNIQUE NOT NULL,
    password NVARCHAR(100) NOT NULL,
    confirm_password NVARCHAR(100) NOT NULL,
    role NVARCHAR(50) DEFAULT 'user',
    created_at DATETIME NULL
);

CREATE TABLE dbo.favorites (
    id INT IDENTITY(1,1) PRIMARY KEY,
    user_id INT NOT NULL,
    pet_id INT NOT NULL,
    created_at DATETIME DEFAULT GETDATE(),

    CONSTRAINT fk_fav_user
        FOREIGN KEY (user_id)
        REFERENCES dbo.[User](id),

    CONSTRAINT fk_fav_pet
        FOREIGN KEY (pet_id)
        REFERENCES dbo.Pets(id),

    CONSTRAINT uq_user_pet
        UNIQUE (user_id, pet_id)
);

CREATE TABLE cart_items (
    id INT IDENTITY(1,1) PRIMARY KEY,
    cart_id INT NOT NULL,
    pet_id INT NOT NULL,
    quantity INT DEFAULT 1,
    created_at DATETIME DEFAULT GETDATE(),
    updated_at DATETIME DEFAULT GETDATE(),

    CONSTRAINT fk_cart_items_cart
        FOREIGN KEY (cart_id) REFERENCES cart(id)
        ON DELETE CASCADE,

    CONSTRAINT fk_cart_items_pet
        FOREIGN KEY (pet_id) REFERENCES Pets(id),

    CONSTRAINT uq_cart_item UNIQUE (cart_id, pet_id)
);


CREATE TABLE cart (
    id INT IDENTITY(1,1) PRIMARY KEY,
    user_id INT NOT NULL,
    created_at DATETIME DEFAULT GETDATE(),
    updated_at DATETIME DEFAULT GETDATE(),

    CONSTRAINT fk_cart_user
        FOREIGN KEY (user_id) REFERENCES [User](id)
);


ALTER TABLE cart
ADD CONSTRAINT fk_cart_user
FOREIGN KEY (user_id) REFERENCES [User](id);

ALTER TABLE cart
ADD CONSTRAINT fk_cart_pet
FOREIGN KEY (pet_id) REFERENCES Pets(id);

ALTER TABLE favorites
ADD updated_at DATETIME NULL;


ALTER TABLE favorites
ADD created_at DATETIME NULL,
    updated_at DATETIME NULL;

SELECT COLUMN_NAME
FROM INFORMATION_SCHEMA.COLUMNS
WHERE TABLE_NAME = 'favorites';


SELECT
    fk.name AS ForeignKey,
    tp.name AS ParentTable,
    tr.name AS ReferencedTable
FROM sys.foreign_keys fk
JOIN sys.tables tp ON fk.parent_object_id = tp.object_id
JOIN sys.tables tr ON fk.referenced_object_id = tr.object_id
WHERE tp.name = 'cart';

SELECT TABLE_SCHEMA, TABLE_NAME
FROM INFORMATION_SCHEMA.TABLES
WHERE TABLE_NAME LIKE '%cart%';

CREATE TABLE Pets (
    id INT IDENTITY(1,1) PRIMARY KEY,
    pet_type VARCHAR(50) NOT NULL,
    accessories_type VARCHAR(50) NOT NULL,
    price DECIMAL(10,2) NOT NULL,
    image_url VARCHAR(255),
    product_name VARCHAR(100) NOT NULL,
    created_at DATETIME NULL
);

CREATE TABLE orders (
    id INT IDENTITY PRIMARY KEY,
    user_id INT NOT NULL,
    status VARCHAR(50),
    created_at DATETIME,
    updated_at DATETIME
);

CREATE TABLE order_items (
    id INT IDENTITY PRIMARY KEY,
    order_id INT NOT NULL,
    pet_id INT NOT NULL,
    quantity INT NOT NULL,
    price DECIMAL(10,2) NOT NULL,
    created_at DATETIME,
    updated_at DATETIME
);



INSERT INTO Pets (pet_type, accessories_type, price, image_url, product_name)
VALUES
('Dog', 'Food', 1500.00, 'images/dog_food1.jpg', 'Pedigree Puppy Chicken & Milk'),
('Dog', 'Food', 1800.00, 'images/dog_food2.jpg', 'Royal Canin Maxi Adult'),
('Dog', 'Food', 2200.00, 'images/dog_food3.jpg', 'Drools Chicken & Egg Puppy Food'),
('Dog', 'Food', 1700.00, 'images/dog_food4.jpg', 'Purepet Meat & Rice Adult Dog Food'),
('Dog', 'Food', 2500.00, 'images/dog_food5.jpg', 'Farmina N&D Chicken & Pomegranate'),
('Dog', 'Food', 2000.00, 'images/dog_food6.jpg', 'SmartHeart Chicken & Liver Flavour'),
('Dog', 'Food', 1900.00, 'images/dog_food7.jpg', 'Canine Creek Starter Puppy Food'),
('Dog', 'Food', 2300.00, 'images/dog_food8.jpg', 'Meat Up Dry Puppy Food'),
('Dog', 'Food', 2100.00, 'images/dog_food9.jpg', 'Orijen Puppy Large Breed Dog Food');

INSERT INTO Pets (pet_type, accessories_type, price, image_url, product_name)
VALUES
('Dog', 'Toy', 1200.00, 'images/dog_toy1.jpg', 'Chew Bone Rubber Toy'),
('Dog', 'Toy', 1500.00, 'images/dog_toy2.webp', 'Squeaky Plush Dog Toy'),
('Dog', 'Toy', 1800.00, 'images/dog_toy3.webp', 'Rope Tug Toy for Dogs'),
('Dog', 'Toy', 2000.00, 'images/dog_toy4.webp', 'Interactive Treat Dispenser Ball'),
('Dog', 'Toy', 1600.00, 'images/dog_toy5.jpg', 'Frisbee Flying Disc'),
('Dog', 'Toy', 1750.00, 'images/dog_toy6.jpg', 'Tough Rubber Chew Ring'),
('Dog', 'Toy', 1400.00, 'images/dog_toy7.jpg', 'Plush Duck Squeaker Toy'),
('Dog', 'Toy', 1900.00, 'images/dog_toy8.webp', 'Dental Chew Toy'),
('Dog', 'Toy', 2200.00, 'images/dog_toy9.jpg', 'Interactive Puzzle Toy');

INSERT INTO Pets (pet_type, accessories_type, price, image_url, product_name)
VALUES
('Cat', 'Food', 850.00, 'images/catfood1.jpg', 'Whiskas Chicken Dry Food 1kg'),
('Cat', 'Food', 920.00, 'images/catfood2.jpg', 'Me-O Tuna Cat Food 1.2kg'),
('Cat', 'Food', 1100.00, 'images/catfood3.jpg', 'Purina Friskies Seafood Sensations 1kg'),
('Cat', 'Food', 990.00, 'images/catfood4.webp', 'Royal Canin Kitten Dry Food 400g'),
('Cat', 'Food', 1300.00, 'images/catfood5.webp', 'Drools Ocean Fish Adult Cat Food 1.2kg'),
('Cat', 'Food', 870.00, 'images/catfood6.webp', 'Sheba Melty Tuna Stick Cat Treats 12pcs'),
('Cat', 'Food', 1150.00, 'images/catfood7.webp', 'Farmina Matisse Salmon Cat Food 1kg'),
('Cat', 'Food', 980.00, 'images/catfood8.png', 'Whiskas Ocean Fish Adult Cat Food 1.1kg'),
('Cat', 'Food', 1250.00, 'images/catfood9.webp', 'Royal Canin Persian Adult Cat Food 400g');

INSERT INTO Pets (pet_type, accessories_type, price, image_url, product_name)
VALUES
('Cat', 'Toy', 650.00, 'images/cattoy1.webp', 'Feather Wand Cat Teaser'),
('Cat', 'Toy', 720.00, 'images/cattoy2.jpg', 'Catnip Plush Mouse Toy'),
('Cat', 'Toy', 950.00, 'images/cattoy3.jpg', 'Interactive Ball Toy'),
('Cat', 'Toy', 800.00, 'images/cattoy4.jpg', 'Cat Tunnel Play Tube'),
('Cat', 'Toy', 1100.00, 'images/cattoy5.jpg', 'Scratching Post Tower'),
('Cat', 'Toy', 780.00, 'images/cattoy6.jpg', 'Laser Pointer Toy'),
('Cat', 'Toy', 890.00, 'images/cattoy7.jpg', 'Spring Jumping Cat Toy'),
('Cat', 'Toy', 970.00, 'images/cattoy8.webp', 'Interactive Puzzle Feeder'),
('Cat', 'Toy', 1200.00, 'images/cattoy9.jpg', 'Hanging Door Cat Toy');

select * from Pets;
select * from [User];
SELECT * FROM dbo.favorites;
SELECT * FROM favorites;
select * from cart;
select * from cart_items;
select * from orders;

SELECT * FROM cart_items WHERE user_id = 1;
SELECT * FROM favorites WHERE user_id = 1;

DELETE FROM favorites;
DELETE FROM cart_items;
DELETE FROM personal_access_tokens;
DELETE FROM [User];

DELETE FROM personal_access_tokens;
DELETE FROM favorites;
DELETE FROM cart_items;
DELETE FROM cart;
DELETE FROM [User];

DBCC CHECKIDENT ('[User]', RESEED, 0);

SELECT COLUMN_NAME, IS_NULLABLE
FROM INFORMATION_SCHEMA.COLUMNS
WHERE TABLE_NAME = 'cart';

ALTER TABLE cart
DROP COLUMN pet_id;

SELECT COLUMN_NAME
FROM INFORMATION_SCHEMA.COLUMNS
WHERE TABLE_NAME = 'cart_items';

ALTER TABLE cart_items
ADD cart_id INT NULL;

ALTER TABLE cart_items
ADD CONSTRAINT fk_cart_items_cart
FOREIGN KEY (cart_id) REFERENCES cart(id)
ON DELETE CASCADE;

ALTER TABLE cart_items
ADD CONSTRAINT fk_cart_items_pet
FOREIGN KEY (pet_id) REFERENCES Pets(id);

ALTER TABLE orders ADD
    shipping_address NVARCHAR(255) NULL,
    shipping_city NVARCHAR(100) NULL,
    shipping_province NVARCHAR(100) NULL,
    shipping_zip NVARCHAR(20) NULL,
    shipping_phone NVARCHAR(20) NULL,
    payment_method NVARCHAR(50) NULL,
    subtotal DECIMAL(10,2) NULL,
    tax DECIMAL(10,2) NULL,
    total DECIMAL(10,2) NULL;


SELECT COLUMN_NAME
FROM INFORMATION_SCHEMA.COLUMNS
WHERE TABLE_NAME = 'orders';

DBCC CHECKIDENT ('[User]', RESEED, 0);


SELECT email, password FROM [User]
WHERE email = 'movinduweerabahu314@gmail.com';

DELETE FROM personal_access_tokens;


DROP TABLE dbo.users;

ALTER TABLE favorites
ADD CONSTRAINT fk_fav_user
FOREIGN KEY (user_id)
REFERENCES [User](id);

UPDATE [User]
SET password = '$2y$10$z2Xl5Qe8uJ8jX9YzYtB6XOgxYJH9C1uXzJt7xU9H1nq9Q3o7d9Y1G'
WHERE email = 'movinduweerabahu314@gmail.com';



SELECT name, parent_object_id
FROM sys.foreign_keys
WHERE name = 'fk_fav_user';

ALTER TABLE favorites
DROP CONSTRAINT fk_fav_user;


ALTER TABLE favorites
DROP CONSTRAINT fk_fav_user;

DELETE FROM [User];
DBCC CHECKIDENT ('[User]', RESEED, 0);


DELETE FROM favorites;
DBCC CHECKIDENT ('favorites', RESEED, 0);



SELECT TABLE_SCHEMA, TABLE_NAME
FROM INFORMATION_SCHEMA.TABLES
WHERE TABLE_NAME = 'User';
EXEC sp_help '[dbo].[User]';
EXEC sp_help '[User]';
EXEC sp_help favorites;
EXEC sp_help favorites;

DROP TABLE IF EXISTS cart_items;
DROP TABLE IF EXISTS cart;


ALTER TABLE [User]
ALTER COLUMN password NVARCHAR(255) NOT NULL;

ALTER TABLE [User]
ALTER COLUMN confirm_password NVARCHAR(255) NOT NULL;
