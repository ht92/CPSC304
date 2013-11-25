drop table Users cascade constraints;
drop table Customer cascade constraints;
drop table Member cascade constraints;
drop table Student cascade constraints;
drop table Employee cascade constraints;
drop table Instructor cascade constraints;
drop table Baker cascade constraints;
drop table BakerTasks cascade constraints;
drop table Orders cascade constraints;
drop table Item cascade constraints;
drop table Supplier cascade constraints;
drop table EnrollsIn cascade constraints;
drop table BakingClass cascade constraints;
drop table ShippingDetails cascade constraints;

CREATE TABLE Users
	(userID CHAR(8),
	username VARCHAR(20) NOT NULL UNIQUE,
	password VARCHAR(16) NOT NULL,
	fname VARCHAR(20) NOT NULL,
	lname VARCHAR(20) NOT NULL,
	address VARCHAR(40) NOT NULL,
	phoneNumber VARCHAR(12) NOT NULL,
	PRIMARY KEY (userID),
	CONSTRAINT password_length
		CHECK (length(password) >= 8 AND length(password) <= 16));

-- Customer is-a User
CREATE TABLE Customer 
	(customerID CHAR(8),
	PRIMARY KEY(customerID),
	FOREIGN KEY(customerID) REFERENCES Users(userID));

-- Member is-a Customer
CREATE TABLE Member 
	(memberID CHAR(8),
	memberSince DATE NOT NULL,
	rewardPoints INTEGER NOT NULL,
	PRIMARY KEY (memberID),
	FOREIGN KEY (memberID) REFERENCES Customer(customerID),
	CONSTRAINT rewardPoints_min
		CHECK (rewardPoints >= 0));

CREATE TABLE Student
	(studentID CHAR(8),
	PRIMARY KEY (studentID),
	FOREIGN KEY (studentID) REFERENCES Customer(customerID));

-- Employee is-a User
CREATE TABLE Employee 
	(employeeID CHAR(8),
	salary FLOAT NOT NULL,
	PRIMARY KEY(employeeID),
	FOREIGN KEY(employeeID) REFERENCES Users(userID),
	CONSTRAINT salary_minimum
		CHECK (salary >= 0));
 
-- Instructor is-a Employee
CREATE TABLE Instructor 
	(instructorID CHAR(8),
	PRIMARY KEY (instructorID),
	FOREIGN KEY (instructorID) REFERENCES Employee(employeeID));

-- Baker is-a Employee
CREATE TABLE Baker 
	(bakerID CHAR(8),
	specialization VARCHAR(15) NOT NULL,
	PRIMARY KEY (bakerID),
	FOREIGN KEY (bakerID) REFERENCES Employee(employeeID));
	
-- item catalog
CREATE TABLE Item 
	(itemID CHAR(5),
	itemName VARCHAR(15) NOT NULL,
	itemType VARCHAR(15) NOT NULL,
	price FLOAT NOT NULL,
	PRIMARY KEY (itemID),
	CONSTRAINT price_minimum
		CHECK (price >= 0));
	
-- Baker assigned to Bake Items (relation captured here)
CREATE TABLE BakerTasks
	(taskID CHAR(5),
	bakerID CHAR(8) NOT NULL,
	itemID CHAR(5) NOT NULL,
	itemQuantity INTEGER NOT NULL,
	dateAssigned DATE NOT NULL,
	dateCompleted DATE,		
	PRIMARY KEY (taskID),
	FOREIGN KEY (bakerID) REFERENCES Baker(bakerID),	
	FOREIGN KEY (itemID) REFERENCES Item(itemID),
	CONSTRAINT assigned_completed_constraint
		CHECK (dateCompleted >= dateAssigned));	

-- to restock, we can simply get all items that have been completed (dateCompleted is not null) and haven`t been pushed (pushedToStock = false)
-- this will be done on the program (query data, then modify data)
		
CREATE TABLE ShippingDetails 
	(trackingID CHAR(8),
	shippingType VARCHAR(15) NOT NULL,
	shippingDate DATE,
	expectedDeliveryDate DATE,
	shippingCost FLOAT NOT NULL,
	PRIMARY KEY(trackingID),
	CONSTRAINT date_constraint
		CHECK (shippingDate <= expectedDeliveryDate),
	CONSTRAINT shippingCost_min
		CHECK (shippingCost >= 0));
		
CREATE TABLE Orders
	(orderID CHAR(5),
	orderDate DATE NOT NULL,
	customerID CHAR(8) NOT NULL,
	itemID CHAR(5),
	itemQuantity INTEGER NOT NULL,
	trackingID CHAR(8),
	completed CHAR(1),
	PRIMARY KEY(orderID, itemID),	
	FOREIGN KEY(customerID) REFERENCES Customer(customerID),
	FOREIGN KEY(itemID) REFERENCES Item(itemID),
	FOREIGN KEY(trackingID) REFERENCES ShippingDetails(trackingID),
	CONSTRAINT minimum_order_quantity
		CHECK (itemQuantity > 0),
	CONSTRAINT completed_status
		CHECK (completed = 'T' or completed is null));
	
CREATE TABLE Supplier 
	(supplierID CHAR(8), 
	companyName VARCHAR(20) NOT NULL,
	supplyType VARCHAR(20) NOT NULL,
	supplyCost FLOAT NOT NULL,
	supplyUnit VARCHAR(5) NOT NULL,	
	PRIMARY KEY(supplierID, supplyType),
	CONSTRAINT supplyCost_min
		CHECK (supplyCost >= 0)); 
	
-- we need supplyType as key because we may purchase multiple types from a supplier

CREATE TABLE BakingClass
	(classID CHAR(5),
	className VARCHAR(20) NOT NULL,
	instructorID CHAR(8) NOT NULL,
	max_enrolled INTEGER NOT NULL,
	startDate DATE NOT NULL,
	endDate DATE NOT NULL,
	PRIMARY KEY (classID),
	FOREIGN KEY (instructorID) REFERENCES Instructor(instructorID),
	CONSTRAINT start_end_date
		CHECK (endDate >= startDate));
	
CREATE TABLE EnrollsIn 
	(studentID CHAR(8),
	classID CHAR(5),
	PRIMARY KEY (studentID, classID),
	FOREIGN KEY (studentID) REFERENCES Student(studentID),
	FOREIGN KEY (classID) REFERENCES BakingClass(classID));	

-- TODO: Insert sample data

-- customer + member users
INSERT INTO Users VALUES ('00000000', 'ht92', '12345678', 'Henry', 'Tang', 'address', '000 000 0000');
INSERT INTO Users VALUES ('11111111', 'dleclerc', 'mypassword', 'Dallas', 'Leclerc', 'd address', '111 111 1111');
INSERT INTO Users VALUES ('22222222', 'testUser2', 'testpassword2', 'Test', '2', 'test address 2', '222 222 2222');
INSERT INTO Users VALUES ('33333333', 'testUser3', 'testpassword3', 'Test', '3', 'test address 3', '333 333 3333');
INSERT INTO Users VALUES ('44444444', 'testUser4', 'testpassword4', 'Test', '4', 'test address 4', '444 444 4444');
INSERT INTO Users VALUES ('55555555', 'testUser5', 'testpassword5', 'Test', '5', 'test address 5', '555 555 5555');
INSERT INTO Users VALUES ('66666666', 'testUser6', 'testpassword6', 'Test', '6', 'test address 6', '666 666 6666');
INSERT INTO Users VALUES ('77777777', 'testUser7', 'testpassword7', 'Test', '7', 'test address 7', '777 777 7777');
INSERT INTO Users VALUES ('88888888', 'testUser8', 'testpassword8', 'Test', '8', 'test address 8', '888 888 8888');
INSERT INTO Users VALUES ('99999999', 'testUser9', 'testpassword9', 'Test', '9', 'test address 9', '999 999 9999');

-- customer + student users
INSERT INTO Users VALUES ('00000001', '01', 'password1', 'Test', '01', 'test address 1', '111 111 1111');
INSERT INTO Users VALUES ('00000002', '02', 'password2', 'Test', '02', 'test address 2', '222 222 2222');
INSERT INTO Users VALUES ('00000003', '03', 'password3', 'Test', '03', 'test address 3', '333 333 3333');
INSERT INTO Users VALUES ('00000004', '04', 'password4', 'Test', '04', 'test address 4', '444 444 4444');
INSERT INTO Users VALUES ('00000005', '05', 'password5', 'Test', '05', 'test address 5', '555 555 5555');
INSERT INTO Users VALUES ('00000006', '06', 'password6', 'Test', '06', 'test address 6', '666 666 6666');
INSERT INTO Users VALUES ('00000007', '07', 'password7', 'Test', '07', 'test address 7', '777 777 7777');
INSERT INTO Users VALUES ('00000008', '08', 'password8', 'Test', '08', 'test address 8', '888 888 8888');
INSERT INTO Users VALUES ('00000009', '09', 'password9', 'Test', '09', 'test address 9', '999 999 9999');
INSERT INTO Users VALUES ('00000010', '10', 'password10', 'Test', '19', 'test address 10', '101 010 1010');

-- plain customer users
INSERT INTO Users VALUES ('00000011', '11', 'password1', 'Test', '11', 'test address 1', '111 111 1111');
INSERT INTO Users VALUES ('00000012', '12', 'password2', 'Test', '12', 'test address 2', '222 222 2222');
INSERT INTO Users VALUES ('00000013', '13', 'password3', 'Test', '13', 'test address 3', '333 333 3333');
INSERT INTO Users VALUES ('00000014', '14', 'password4', 'Test', '14', 'test address 4', '444 444 4444');
INSERT INTO Users VALUES ('00000015', '15', 'password5', 'Test', '15', 'test address 5', '555 555 5555');
INSERT INTO Users VALUES ('00000016', '16', 'password6', 'Test', '16', 'test address 6', '666 666 6666');
INSERT INTO Users VALUES ('00000017', '17', 'password7', 'Test', '17', 'test address 7', '777 777 7777');
INSERT INTO Users VALUES ('00000018', '18', 'password8', 'Test', '18', 'test address 8', '888 888 8888');
INSERT INTO Users VALUES ('00000019', '19', 'password9', 'Test', '19', 'test address 9', '999 999 9999');
INSERT INTO Users VALUES ('00000020', '20', 'password10', 'Test', '20', 'test address 10', '101 010 1010');

-- employees 
INSERT INTO Users VALUES ('00000021', '21', 'password1', 'Test', '21', 'test address 1', '111 111 1111');
INSERT INTO Users VALUES ('00000022', '22', 'password2', 'Test', '22', 'test address 2', '222 222 2222');
INSERT INTO Users VALUES ('00000023', '23', 'password3', 'Test', '23', 'test address 3', '333 333 3333');
INSERT INTO Users VALUES ('00000024', '24', 'password4', 'Test', '24', 'test address 4', '444 444 4444');
INSERT INTO Users VALUES ('00000025', '25', 'password5', 'Test', '25', 'test address 5', '555 555 5555');
INSERT INTO Users VALUES ('00000026', '26', 'password6', 'Test', '26', 'test address 6', '666 666 6666');
INSERT INTO Users VALUES ('00000027', '27', 'password7', 'Test', '27', 'test address 7', '777 777 7777');
INSERT INTO Users VALUES ('00000028', '28', 'password8', 'Test', '28', 'test address 8', '888 888 8888');
INSERT INTO Users VALUES ('00000029', '29', 'password9', 'Test', '29', 'test address 9', '999 999 9999');
INSERT INTO Users VALUES ('00000030', '30', 'password10', 'Test', '30', 'test address 10', '101 010 1010');

INSERT INTO Users VALUES ('00000031', '31', 'password1', 'Test', '31', 'test address 1', '111 111 1111');
INSERT INTO Users VALUES ('00000032', '32', 'password2', 'Test', '32', 'test address 2', '222 222 2222');
INSERT INTO Users VALUES ('00000033', '33', 'password3', 'Test', '33', 'test address 3', '333 333 3333');
INSERT INTO Users VALUES ('00000034', '34', 'password4', 'Test', '34', 'test address 4', '444 444 4444');
INSERT INTO Users VALUES ('00000035', '35', 'password5', 'Test', '35', 'test address 5', '555 555 5555');
INSERT INTO Users VALUES ('00000036', '36', 'password6', 'Test', '36', 'test address 6', '666 666 6666');
INSERT INTO Users VALUES ('00000037', '37', 'password7', 'Test', '37', 'test address 7', '777 777 7777');
INSERT INTO Users VALUES ('00000038', '38', 'password8', 'Test', '38', 'test address 8', '888 888 8888');
INSERT INTO Users VALUES ('00000039', '39', 'password9', 'Test', '39', 'test address 9', '999 999 9999');
INSERT INTO Users VALUES ('00000040', '40', 'password10', 'Test', '40', 'test address 10', '101 010 1010');

INSERT INTO Customer VALUES ('00000000');
INSERT INTO Customer VALUES ('11111111');
INSERT INTO Customer VALUES ('22222222');
INSERT INTO Customer VALUES ('33333333');
INSERT INTO Customer VALUES ('44444444');
INSERT INTO Customer VALUES ('55555555');
INSERT INTO Customer VALUES ('66666666');
INSERT INTO Customer VALUES ('77777777');
INSERT INTO Customer VALUES ('88888888');
INSERT INTO Customer VALUES ('99999999');
INSERT INTO Customer VALUES ('00000001');
INSERT INTO Customer VALUES ('00000002');
INSERT INTO Customer VALUES ('00000003');
INSERT INTO Customer VALUES ('00000004');
INSERT INTO Customer VALUES ('00000005');
INSERT INTO Customer VALUES ('00000006');
INSERT INTO Customer VALUES ('00000007');
INSERT INTO Customer VALUES ('00000008');
INSERT INTO Customer VALUES ('00000009');
INSERT INTO Customer VALUES ('00000010');
INSERT INTO Customer VALUES ('00000011');
INSERT INTO Customer VALUES ('00000012');
INSERT INTO Customer VALUES ('00000013');
INSERT INTO Customer VALUES ('00000014');
INSERT INTO Customer VALUES ('00000015');
INSERT INTO Customer VALUES ('00000016');
INSERT INTO Customer VALUES ('00000017');
INSERT INTO Customer VALUES ('00000018');
INSERT INTO Customer VALUES ('00000019');
INSERT INTO Customer VALUES ('00000020');

INSERT INTO Member VALUES('00000000', '01-01-01', 0);
INSERT INTO Member VALUES('11111111', '02-02-02', 1);
INSERT INTO Member VALUES('22222222', '03-03-03', 2);
INSERT INTO Member VALUES('33333333', '04-04-04', 3);
INSERT INTO Member VALUES('44444444', '05-05-05', 4);
INSERT INTO Member VALUES('55555555', '06-06-06', 5);
INSERT INTO Member VALUES('66666666', '07-07-07', 6);
INSERT INTO Member VALUES('77777777', '08-08-08', 7);
INSERT INTO Member VALUES('88888888', '09-09-09', 8);
INSERT INTO Member VALUES('99999999', '10-10-10', 9);

INSERT INTO Student VALUES('00000001');
INSERT INTO Student VALUES('00000002');
INSERT INTO Student VALUES('00000003');
INSERT INTO Student VALUES('00000004');
INSERT INTO Student VALUES('00000005');
INSERT INTO Student VALUES('00000006');
INSERT INTO Student VALUES('00000007');
INSERT INTO Student VALUES('00000008');
INSERT INTO Student VALUES('00000009');
INSERT INTO Student VALUES('00000010');

INSERT INTO Employee VALUES('00000021', 11111);
INSERT INTO Employee VALUES('00000022', 22222);
INSERT INTO Employee VALUES('00000023', 33333);
INSERT INTO Employee VALUES('00000024', 44444);
INSERT INTO Employee VALUES('00000025', 55555);
INSERT INTO Employee VALUES('00000026', 66666);
INSERT INTO Employee VALUES('00000027', 77777);
INSERT INTO Employee VALUES('00000028', 88888);
INSERT INTO Employee VALUES('00000029', 99999);
INSERT INTO Employee VALUES('00000030', 100000);
INSERT INTO Employee VALUES('00000031', 11111);
INSERT INTO Employee VALUES('00000032', 22222);
INSERT INTO Employee VALUES('00000033', 33333);
INSERT INTO Employee VALUES('00000034', 44444);
INSERT INTO Employee VALUES('00000035', 55555);
INSERT INTO Employee VALUES('00000036', 66666);
INSERT INTO Employee VALUES('00000037', 77777);
INSERT INTO Employee VALUES('00000038', 88888);
INSERT INTO Employee VALUES('00000039', 99999);
INSERT INTO Employee VALUES('00000040', 100000);

INSERT INTO Instructor VALUES('00000021');
INSERT INTO Instructor VALUES('00000022');
INSERT INTO Instructor VALUES('00000023');
INSERT INTO Instructor VALUES('00000024');
INSERT INTO Instructor VALUES('00000025');
INSERT INTO Instructor VALUES('00000026');
INSERT INTO Instructor VALUES('00000027');
INSERT INTO Instructor VALUES('00000028');
INSERT INTO Instructor VALUES('00000029');
INSERT INTO Instructor VALUES('00000030');
INSERT INTO Instructor VALUES('00000031');
INSERT INTO Instructor VALUES('00000032');

INSERT INTO Baker VALUES('00000029', 'Cakes');
INSERT INTO Baker VALUES('00000030', 'Pies');
INSERT INTO Baker VALUES('00000031', 'Cakes');
INSERT INTO Baker VALUES('00000032', 'Pies');
INSERT INTO Baker VALUES('00000033', 'Bread');
INSERT INTO Baker VALUES('00000034', 'Tarts');
INSERT INTO Baker VALUES('00000035', 'Rolls');
INSERT INTO Baker VALUES('00000036', 'Cakes');
INSERT INTO Baker VALUES('00000037', 'Pies');
INSERT INTO Baker VALUES('00000038', 'Bread');
INSERT INTO Baker VALUES('00000039', 'Tarts');
INSERT INTO Baker VALUES('00000040', 'Rolls');

INSERT INTO Item VALUES ('00000', 'Item0', 'Type0',  0.99);
INSERT INTO Item VALUES ('11111', 'Item1', 'Type1',  1.99);
INSERT INTO Item VALUES ('22222', 'Item2', 'Type2',  2.99);
INSERT INTO Item VALUES ('33333', 'Item3', 'Type3',  3.99);
INSERT INTO Item VALUES ('44444', 'Item4', 'Type4',  4.99);
INSERT INTO Item VALUES ('55555', 'Item0', 'Type0',  5.99);
INSERT INTO Item VALUES ('66666', 'Item1', 'Type1',  6.99);
INSERT INTO Item VALUES ('77777', 'Item2', 'Type2',  7.99);
INSERT INTO Item VALUES ('88888', 'Item3', 'Type3',  8.99);
INSERT INTO Item VALUES ('99999', 'Item4', 'Type4',  9.99);

-- tasks in progress
INSERT INTO BakerTasks VALUES ('00000', '00000029', '00000', 1, '11-11-13', NULL);
INSERT INTO BakerTasks VALUES ('00001', '00000029', '11111', 10, '12-11-13', NULL);
INSERT INTO BakerTasks VALUES ('00002', '00000030', '22222', 20, '13-11-13', NULL);
INSERT INTO BakerTasks VALUES ('00003', '00000030', '33333', 30, '14-11-13', NULL);
INSERT INTO BakerTasks VALUES ('00004', '00000031', '44444', 40, '15-11-13', NULL); 
INSERT INTO BakerTasks VALUES ('00005', '00000031', '55555', 50, '16-11-13', NULL);
INSERT INTO BakerTasks VALUES ('00006', '00000032', '66666', 60, '17-11-13', NULL);
INSERT INTO BakerTasks VALUES ('00007', '00000032', '77777', 70, '18-11-13', NULL);
INSERT INTO BakerTasks VALUES ('00008', '00000033', '88888', 80, '19-11-13', NULL);
INSERT INTO BakerTasks VALUES ('00009', '00000033', '99999', 90, '20-11-13', NULL); 
-- completed tasks
INSERT INTO BakerTasks VALUES ('00010', '00000034', '00000', 1, '11-11-13', '12-11-13');
INSERT INTO BakerTasks VALUES ('00011', '00000034', '11111', 10, '12-11-13', '13-11-13');
INSERT INTO BakerTasks VALUES ('00012', '00000035', '22222', 20, '13-11-13', '14-11-13');
INSERT INTO BakerTasks VALUES ('00013', '00000035', '33333', 30, '14-11-13', '15-11-13');
INSERT INTO BakerTasks VALUES ('00014', '00000036', '44444', 40, '15-11-13', '16-11-13'); 
INSERT INTO BakerTasks VALUES ('00015', '00000036', '55555', 50, '16-11-13', '17-11-13');
INSERT INTO BakerTasks VALUES ('00016', '00000037', '66666', 60, '17-11-13', '18-11-13');
INSERT INTO BakerTasks VALUES ('00017', '00000037', '77777', 70, '18-11-13', '19-11-13');
INSERT INTO BakerTasks VALUES ('00018', '00000038', '88888', 80, '19-11-13', '20-11-13');
INSERT INTO BakerTasks VALUES ('00019', '00000038', '99999', 90, '20-11-13', '21-11-13'); 

-- shipping details for shipped orders (not pending)	
INSERT INTO ShippingDetails VALUES ('00000000', 'Ground', '11-11-13', '21-11-13', 5);
INSERT INTO ShippingDetails VALUES ('00000001', 'Ground', '12-11-13', '13-11-13', 5);
INSERT INTO ShippingDetails VALUES ('00000002', 'Ground', '13-11-13', '23-11-13', 5);
INSERT INTO ShippingDetails VALUES ('00000003', 'Ground', '14-11-13', '15-11-13', 5);
INSERT INTO ShippingDetails VALUES ('00000004', 'Ground', '15-11-13', '25-11-13', 5);
INSERT INTO ShippingDetails VALUES ('00000005', 'Ground', '16-11-13', '27-11-13', 5);

-- shipping details for pending orders
INSERT INTO ShippingDetails VALUES ('00000006', 'Ground', null, null, 5);
INSERT INTO ShippingDetails VALUES ('00000007', 'Ground', null, null, 5);
INSERT INTO ShippingDetails VALUES ('00000008', 'Ground', null, null, 5);
INSERT INTO ShippingDetails VALUES ('00000009', 'Ground', null, null, 5);
INSERT INTO ShippingDetails VALUES ('00000010', 'Ground', null, null, 5);

--completed/shipped orders
INSERT INTO Orders VALUES ('00000', '10-11-13', '00000000', '00000', 1, '00000000', 'T');
INSERT INTO Orders VALUES ('00000', '10-11-13', '00000000', '11111', 2, '00000000', 'T');
INSERT INTO Orders VALUES ('00001', '11-11-13', '11111111', '00000', 3, '00000001', 'T');
INSERT INTO Orders VALUES ('00002', '12-11-13', '22222222', '11111', 4, '00000002', 'T');
INSERT INTO Orders VALUES ('00003', '13-11-13', '33333333', '22222', 5, '00000003', 'T'); 
INSERT INTO Orders VALUES ('00004', '14-11-13', '44444444', '33333', 6, '00000004', 'T'); 
INSERT INTO Orders VALUES ('00005', '15-11-13', '55555555', '44444', 7, '00000005', 'T');
INSERT INTO Orders VALUES ('00005', '15-11-13', '55555555', '55555', 5, '00000005', 'T');
--pending pickup orders
INSERT INTO Orders VALUES ('00006', '16-11-13', '66666666', '55555', 8, null, null);
INSERT INTO Orders VALUES ('00007', '17-11-13', '77777777', '66666', 9, null, null);
INSERT INTO Orders VALUES ('00008', '18-11-13', '88888888', '77777', 10, null, null);
INSERT INTO Orders VALUES ('00009', '19-11-13', '99999999', '88888', 11, null, null); 
INSERT INTO Orders VALUES ('00009', '19-11-13', '99999999', '99999', 12, null, null);
--pending shipped orders
INSERT INTO Orders VALUES ('00015', '16-11-13', '00000000', '55555', 1, '00000006', null);
INSERT INTO Orders VALUES ('00016', '17-11-13', '11111111', '66666', 2, '00000007', null);
INSERT INTO Orders VALUES ('00017', '18-11-13', '22222222', '77777', 3, '00000008', null);
INSERT INTO Orders VALUES ('00018', '19-11-13', '33333333', '88888', 4, '00000009', null); 
INSERT INTO Orders VALUES ('00019', '20-11-13', '44444444', '99999', 5, '00000010', null);
--completed/picked up orders 
INSERT INTO Orders VALUES ('00010', '16-11-13', '66666666', '00000', 8, null, 'T');
INSERT INTO Orders VALUES ('00011', '17-11-13', '77777777', '11111', 9, null, 'T');
INSERT INTO Orders VALUES ('00012', '18-11-13', '88888888', '22222', 10, null, 'T');
INSERT INTO Orders VALUES ('00013', '19-11-13', '99999999', '33333', 11, null, 'T'); 
INSERT INTO Orders VALUES ('00014', '20-11-13', '99999999', '44444', 12, null, 'T');

--suppliers
INSERT INTO Supplier VALUES ('00000', 'Supplier 0', 'Type 0', 0.99, 'lb');
INSERT INTO Supplier VALUES ('00001', 'Supplier 1', 'Type 1', 1.99, 'kg');
INSERT INTO Supplier VALUES ('00002', 'Supplier 2', 'Type 2', 2.99, 'g');
INSERT INTO Supplier VALUES ('00003', 'Supplier 3', 'Type 3', 3.99, 'kg');
INSERT INTO Supplier VALUES ('00004', 'Supplier 4', 'Type 4', 4.99, 'lb'); 
INSERT INTO Supplier VALUES ('00005', 'Supplier 5', 'Type 5', 5.99, 'lb');
INSERT INTO Supplier VALUES ('00006', 'Supplier 6', 'Type 6', 6.99, 'kg');
INSERT INTO Supplier VALUES ('00007', 'Supplier 7', 'Type 7', 7.99, 'g');
INSERT INTO Supplier VALUES ('00008', 'Supplier 8', 'Type 8', 8.99, 'kg');
INSERT INTO Supplier VALUES ('00009', 'Supplier 9', 'Type 9', 9.99, 'lb'); 

--baking classes offered now
INSERT INTO BakingClass VALUES ('00001', 'Class 1', '00000021', 10, '01-11-13', '30-11-13');
INSERT INTO BakingClass VALUES ('00002', 'Class 2', '00000021', 20, '02-11-13', '30-11-13');
INSERT INTO BakingClass VALUES ('00003', 'Class 3', '00000022', 30, '03-11-13', '30-11-13');
INSERT INTO BakingClass VALUES ('00004', 'Class 4', '00000022', 40, '04-11-13', '30-11-13');
INSERT INTO BakingClass VALUES ('00005', 'Class 5', '00000023', 50, '05-11-13', '30-11-13');
INSERT INTO BakingClass VALUES ('00006', 'Class 6', '00000023', 60, '06-11-13', '30-11-13');
INSERT INTO BakingClass VALUES ('00007', 'Class 7', '00000024', 70, '07-11-13', '30-11-13');
INSERT INTO BakingClass VALUES ('00008', 'Class 8', '00000024', 80, '08-11-13', '30-11-13');
INSERT INTO BakingClass VALUES ('00009', 'Class 9', '00000025', 90, '09-11-13', '30-11-13');
INSERT INTO BakingClass VALUES ('00010', 'Class 10', '00000025', 10, '10-11-13', '30-11-13');

--baking classes offered in the past
INSERT INTO BakingClass VALUES ('00011', 'Class 11', '00000026', 20, '01-10-13', '31-10-13');
INSERT INTO BakingClass VALUES ('00012', 'Class 12', '00000026', 30, '02-10-13', '31-10-13');
INSERT INTO BakingClass VALUES ('00013', 'Class 13', '00000027', 40, '03-10-13', '31-10-13');
INSERT INTO BakingClass VALUES ('00014', 'Class 14', '00000027', 50, '04-10-13', '31-10-13');
INSERT INTO BakingClass VALUES ('00015', 'Class 15', '00000028', 60, '05-10-13', '31-10-13');
INSERT INTO BakingClass VALUES ('00016', 'Class 16', '00000028', 70, '06-10-13', '31-10-13');
INSERT INTO BakingClass VALUES ('00017', 'Class 17', '00000029', 80, '07-10-13', '31-10-13');
INSERT INTO BakingClass VALUES ('00018', 'Class 18', '00000030', 90, '08-10-13', '31-10-13');
INSERT INTO BakingClass VALUES ('00019', 'Class 19', '00000031', 10, '09-10-13', '31-10-13');
INSERT INTO BakingClass VALUES ('00020', 'Class 20', '00000032', 10, '10-10-13', '31-10-13');

--baking classes offered in the future
INSERT INTO BakingClass VALUES ('00021', 'Class 21', '00000021', 20, '01-01-14', '31-01-14');
INSERT INTO BakingClass VALUES ('00022', 'Class 22', '00000022', 30, '01-01-14', '31-01-14');
INSERT INTO BakingClass VALUES ('00023', 'Class 23', '00000023', 40, '01-01-14', '31-01-14');
INSERT INTO BakingClass VALUES ('00024', 'Class 24', '00000024', 50, '01-01-14', '31-01-14');
INSERT INTO BakingClass VALUES ('00025', 'Class 25', '00000025', 60, '01-01-14', '31-01-14');
INSERT INTO BakingClass VALUES ('00026', 'Class 26', '00000026', 70, '01-01-14', '31-01-14');
INSERT INTO BakingClass VALUES ('00027', 'Class 27', '00000027', 80, '01-01-14', '31-01-14');
INSERT INTO BakingClass VALUES ('00028', 'Class 28', '00000028', 90, '01-01-14', '31-01-14');
INSERT INTO BakingClass VALUES ('00029', 'Class 29', '00000029', 10, '01-01-14', '31-01-14');
INSERT INTO BakingClass VALUES ('00030', 'Class 30', '00000030', 10, '01-01-14', '31-01-14');

-- students enrolled in classes happening now
INSERT INTO EnrollsIn VALUES ('00000001', '00001');
INSERT INTO EnrollsIn VALUES ('00000001', '00002');
INSERT INTO EnrollsIn VALUES ('00000002', '00003');
INSERT INTO EnrollsIn VALUES ('00000002', '00004');
INSERT INTO EnrollsIn VALUES ('00000003', '00005');
INSERT INTO EnrollsIn VALUES ('00000003', '00006');
INSERT INTO EnrollsIn VALUES ('00000004', '00007');
INSERT INTO EnrollsIn VALUES ('00000004', '00008');
INSERT INTO EnrollsIn VALUES ('00000005', '00009');
INSERT INTO EnrollsIn VALUES ('00000005', '00010');

-- students enrolled in classes that ended
INSERT INTO EnrollsIn VALUES ('00000006', '00011');
INSERT INTO EnrollsIn VALUES ('00000007', '00012');
INSERT INTO EnrollsIn VALUES ('00000007', '00013');
INSERT INTO EnrollsIn VALUES ('00000008', '00014');
INSERT INTO EnrollsIn VALUES ('00000008', '00015');
INSERT INTO EnrollsIn VALUES ('00000009', '00016');
INSERT INTO EnrollsIn VALUES ('00000009', '00017');
INSERT INTO EnrollsIn VALUES ('00000010', '00018');
INSERT INTO EnrollsIn VALUES ('00000010', '00019');
                                                           
-- check to see if constraints are correct (these should all fail)
-- INSERT INTO Users VALUES ('FAILUSER', 'FAIL', 'FAIL', 'FAIL', 'FAIL', 'FAIL', 'FAIL');
--INSERT INTO Employee VALUES('10000000', -100000);
--INSERT INTO Item VALUES ('44444', 'Item4', 'Type4',  -4.99);
--INSERT INTO Member VALUES('44444444', '05-05-05', -1);
--INSERT INTO BakerTasks VALUES ('00011', '06666666', '11111', 50, '15-11-13', '14-11-13'); 
--INSERT INTO Supplier VALUES ('00005', 'Supplier 6', 'Type 6', -5.99, 'lb'); 
--INSERT INTO BakingClass VALUES ('00005', 'Class 6', '01111111', 10, to_date('11/01/2013','mm/dd/yyyy'), to_date('10/30/2013','mm/dd/yyyy'));
--INSERT INTO ShippingDetails VALUES ('00000005', 'Air', to_date('11/16/2013','mm/dd/yyyy'), to_date('11/15/2013','mm/dd/yyyy'), 9);
--INSERT INTO ShippingDetails VALUES ('00000006', 'Air', to_date('11/16/2013','mm/dd/yyyy'), to_date('11/17/2013','mm/dd/yyyy'), -1);
--INSERT INTO Orders VALUES ('00006', to_date('11/16/2013','mm/dd/yyyy'), '55555555', '44444', 0, '00000004'); 


