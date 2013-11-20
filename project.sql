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
	shippingDate DATE NOT NULL,
	expectedDeliveryDate DATE NOT NULL,
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
	PRIMARY KEY(orderID, itemID),	
	FOREIGN KEY(customerID) REFERENCES Customer(customerID),
	FOREIGN KEY(itemID) REFERENCES Item(itemID),
	FOREIGN KEY(trackingID) REFERENCES ShippingDetails(trackingID),
	CONSTRAINT minimum_order_quantity
		CHECK (itemQuantity > 0));
	
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
INSERT INTO Users VALUES ('01111111', 'testUser01', 'testpassword1', 'Test', '1', 'test address 1', '111 111 1111');
INSERT INTO Users VALUES ('02222222', 'testUser02', 'testpassword2', 'Test', '2', 'test address 2', '222 222 2222');
INSERT INTO Users VALUES ('03333333', 'testUser03', 'testpassword3', 'Test', '3', 'test address 3', '333 333 3333');
INSERT INTO Users VALUES ('04444444', 'testUser04', 'testpassword4', 'Test', '4', 'test address 4', '444 444 4444');
INSERT INTO Users VALUES ('05555555', 'testUser05', 'testpassword5', 'Test', '5', 'test address 5', '555 555 5555');
INSERT INTO Users VALUES ('06666666', 'testUser06', 'testpassword6', 'Test', '6', 'test address 6', '666 666 6666');
INSERT INTO Users VALUES ('07777777', 'testUser07', 'testpassword7', 'Test', '7', 'test address 7', '777 777 7777');
INSERT INTO Users VALUES ('08888888', 'testUser08', 'testpassword8', 'Test', '8', 'test address 8', '888 888 8888');
INSERT INTO Users VALUES ('09999999', 'testUser09', 'testpassword9', 'Test', '9', 'test address 9', '999 999 9999');
INSERT INTO Users VALUES ('10000000', 'testUser010', 'testpassword10', 'Test', '10', 'test address 10', '111 111 1111');

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

INSERT INTO Member VALUES('00000000', '01-01-01', 0);
INSERT INTO Member VALUES('11111111', '02-02-02', 1);
INSERT INTO Member VALUES('22222222', '03-03-03', 2);
INSERT INTO Member VALUES('33333333', '04-04-04', 3);
INSERT INTO Member VALUES('44444444', '05-05-05', 4);

INSERT INTO Student VALUES('44444444');
INSERT INTO Student VALUES('55555555');
INSERT INTO Student VALUES('66666666');
INSERT INTO Student VALUES('77777777');
INSERT INTO Student VALUES('88888888');
INSERT INTO Student VALUES('99999999');

INSERT INTO Employee VALUES('01111111', 11111);
INSERT INTO Employee VALUES('02222222', 22222);
INSERT INTO Employee VALUES('03333333', 33333);
INSERT INTO Employee VALUES('04444444', 44444);
INSERT INTO Employee VALUES('05555555', 55555);
INSERT INTO Employee VALUES('06666666', 66666);
INSERT INTO Employee VALUES('07777777', 77777);
INSERT INTO Employee VALUES('08888888', 88888);
INSERT INTO Employee VALUES('09999999', 99999);
INSERT INTO Employee VALUES('10000000', 100000);

INSERT INTO Instructor VALUES('01111111');
INSERT INTO Instructor VALUES('02222222');
INSERT INTO Instructor VALUES('03333333');
INSERT INTO Instructor VALUES('04444444');
INSERT INTO Instructor VALUES('05555555');

INSERT INTO Baker VALUES('05555555', 'Cakes');
INSERT INTO Baker VALUES('06666666', 'Pies');
INSERT INTO Baker VALUES('07777777', 'Bread');
INSERT INTO Baker VALUES('08888888', 'Tarts');
INSERT INTO Baker VALUES('09999999', 'Rolls');

INSERT INTO Item VALUES ('00000', 'Item0', 'Type0',  0.99);
INSERT INTO Item VALUES ('11111', 'Item1', 'Type1',  1.99);
INSERT INTO Item VALUES ('22222', 'Item2', 'Type2',  2.99);
INSERT INTO Item VALUES ('33333', 'Item3', 'Type3',  3.99);
INSERT INTO Item VALUES ('44444', 'Item4', 'Type4',  4.99);

		
INSERT INTO BakerTasks VALUES ('00000', '05555555', '00000', 10, '11-11-13', NULL);
INSERT INTO BakerTasks VALUES ('00001', '05555555', '00000', 20, '12-11-13', NULL);
INSERT INTO BakerTasks VALUES ('00002', '05555555', '00000', 30, '13-11-13', NULL);
INSERT INTO BakerTasks VALUES ('00003', '05555555', '00000', 40, '14-11-13', NULL);
INSERT INTO BakerTasks VALUES ('00004', '05555555', '00000', 50, '15-11-13', NULL); 

INSERT INTO BakerTasks VALUES ('00006', '06666666', '11111', 10, '11-11-13', '11-11-13');
INSERT INTO BakerTasks VALUES ('00007', '06666666', '11111', 20, '12-11-13', '12-11-13');
INSERT INTO BakerTasks VALUES ('00008', '06666666', '11111', 30, '13-11-13', '13-11-13');
INSERT INTO BakerTasks VALUES ('00009', '06666666', '11111', 40, '14-11-13', '14-11-13');
INSERT INTO BakerTasks VALUES ('00010', '06666666', '11111', 50, '15-11-13', '15-11-13'); 

INSERT INTO ShippingDetails VALUES ('00000000', 'Ground', to_date('11/11/2013','mm/dd/yyyy'), to_date('11/12/2013','mm/dd/yyyy'), 5);
INSERT INTO ShippingDetails VALUES ('00000001', 'Ground', to_date('11/13/2013','mm/dd/yyyy'), to_date('11/14/2013','mm/dd/yyyy'), 6);
INSERT INTO ShippingDetails VALUES ('00000002', 'Ground', to_date('11/14/2013','mm/dd/yyyy'), to_date('11/15/2013','mm/dd/yyyy'), 7);
INSERT INTO ShippingDetails VALUES ('00000003', 'Air', to_date('11/15/2013','mm/dd/yyyy'), to_date('11/16/2013','mm/dd/yyyy'), 8);
INSERT INTO ShippingDetails VALUES ('00000004', 'Air', to_date('11/16/2013','mm/dd/yyyy'), to_date('11/17/2013','mm/dd/yyyy'), 9);

INSERT INTO Orders VALUES ('00000', to_date('11/11/2013','mm/dd/yyyy'), '00000000', '00000', 1, '00000000');
INSERT INTO Orders VALUES ('00000', to_date('11/11/2013','mm/dd/yyyy'), '00000000', '11111', 2, '00000000');
INSERT INTO Orders VALUES ('00002', to_date('11/13/2013','mm/dd/yyyy'), '22222222', '11111', 3, '00000001');
INSERT INTO Orders VALUES ('00003', to_date('11/14/2013','mm/dd/yyyy'), '33333333', '22222', 4, '00000002');
INSERT INTO Orders VALUES ('00004', to_date('11/15/2013','mm/dd/yyyy'), '44444444', '33333', 5, '00000003'); 
INSERT INTO Orders VALUES ('00005', to_date('11/16/2013','mm/dd/yyyy'), '55555555', '44444', 6, '00000004'); 

INSERT INTO Supplier VALUES ('00000', 'Supplier 1', 'Type 1', 1.99, 'lb');
INSERT INTO Supplier VALUES ('00001', 'Supplier 2', 'Type 2', 2.99, 'kg');
INSERT INTO Supplier VALUES ('00002', 'Supplier 3', 'Type 3', 3.99, 'g');
INSERT INTO Supplier VALUES ('00003', 'Supplier 4', 'Type 4', 4.99, 'kg');
INSERT INTO Supplier VALUES ('00004', 'Supplier 5', 'Type 5', 5.99, 'lb'); 

INSERT INTO BakingClass VALUES ('00000', 'Class 1', '01111111', 10, to_date('11/01/2013','mm/dd/yyyy'), to_date('11/30/2013','mm/dd/yyyy'));
INSERT INTO BakingClass VALUES ('00001', 'Class 2', '01111111', 20, to_date('11/02/2013','mm/dd/yyyy'), to_date('11/30/2013','mm/dd/yyyy'));
INSERT INTO BakingClass VALUES ('00002', 'Class 3', '02222222', 30, to_date('11/03/2013','mm/dd/yyyy'), to_date('11/30/2013','mm/dd/yyyy'));
INSERT INTO BakingClass VALUES ('00003', 'Class 4', '03333333', 40, to_date('11/04/2013','mm/dd/yyyy'), to_date('11/30/2013','mm/dd/yyyy'));
INSERT INTO BakingClass VALUES ('00004', 'Class 5', '04444444', 50, to_date('11/05/2013','mm/dd/yyyy'), to_date('11/30/2013','mm/dd/yyyy')); 

INSERT INTO EnrollsIn VALUES ('44444444', '00000');
INSERT INTO EnrollsIn VALUES ('44444444', '00001');
INSERT INTO EnrollsIn VALUES ('55555555', '00000');
INSERT INTO EnrollsIn VALUES ('55555555', '00001');
INSERT INTO EnrollsIn VALUES ('66666666', '00002'); 
INSERT INTO EnrollsIn VALUES ('66666666', '00003'); 

-- check to see if constraints are correct (these should all fail)
INSERT INTO Users VALUES ('FAILUSER', 'FAIL', 'FAIL', 'FAIL', 'FAIL', 'FAIL', 'FAIL');
INSERT INTO Employee VALUES('10000000', -100000);
INSERT INTO Item VALUES ('44444', 'Item4', 'Type4',  -4.99);
INSERT INTO Member VALUES('44444444', '05-05-05', -1);
INSERT INTO BakerTasks VALUES ('00011', '06666666', '11111', 50, '15-11-13', '14-11-13'); 
INSERT INTO Supplier VALUES ('00005', 'Supplier 6', 'Type 6', -5.99, 'lb'); 
INSERT INTO BakingClass VALUES ('00005', 'Class 6', '01111111', 10, to_date('11/01/2013','mm/dd/yyyy'), to_date('10/30/2013','mm/dd/yyyy'));
INSERT INTO ShippingDetails VALUES ('00000005', 'Air', to_date('11/16/2013','mm/dd/yyyy'), to_date('11/15/2013','mm/dd/yyyy'), 9);
INSERT INTO ShippingDetails VALUES ('00000006', 'Air', to_date('11/16/2013','mm/dd/yyyy'), to_date('11/17/2013','mm/dd/yyyy'), -1);
INSERT INTO Orders VALUES ('00006', to_date('11/16/2013','mm/dd/yyyy'), '55555555', '44444', 0, '00000004'); 


