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
GO

CREATE TABLE Pets (
    id INT IDENTITY(1,1) PRIMARY KEY,
    pet_type VARCHAR(50) NOT NULL,
    accessories_type VARCHAR(50) NOT NULL,
    price DECIMAL(10,2) NOT NULL,
    image_url VARCHAR(255),
    product_name VARCHAR(100) NOT NULL,
    created_at DATETIME NULL
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
