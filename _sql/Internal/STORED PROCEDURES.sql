DROP PROCEDURE IF EXISTS NEW_RESIDENT
DELIMITER $$
CREATE PROCEDURE NEW_RESIDENT(IN in_family_name VARCHAR(45), IN in_middle_name VARCHAR(45), IN in_first_name VARCHAR(45), IN in_gender VARCHAR(10), IN in_precinctNo VARCHAR(20), IN in_birth_date DATE, IN in_birth_place VARCHAR(128), IN in_civilstatus VARCHAR(28), IN in_height VARCHAR(8), IN in_weight int(11), IN in_dependent TINYINT(1), IN in_personal_income BIGINT(20), IN in_username VARCHAR(60), IN in_password VARCHAR(128), IN in_email VARCHAR(255), IN in_contact_number VARCHAR(128), IN in_address VARCHAR(255))
BEGIN
	DECLARE HouseholdExistence int;
	DECLARE existingHouseholdID int;
	DECLARE existingHouseholdIncome int;
	DECLARE in_purokNo int;
	SET HouseholdExistence = 0;
	SET existingHouseholdID = 0;
	SET existingHouseholdIncome = 0;
	SET in_purokNo = 0;
	SET in_address = RTRIM(in_address);
	SET in_address = LTRIM(in_address);


	/* *************************
		DESCRIPTION: Gather existing household data
		Select existing hID, Select existing total income, add new income
		If existing hID doesn't exist, add new.
	   *************************
	*/ 
	SELECT COUNT(*) INTO HouseholdExistence FROM household WHERE UPPER(address)=UPPER(in_address);
	IF HouseHoldExistence > 0 THEN
		SELECT id INTO existingHouseholdID FROM household WHERE address=in_address; 
		SELECT totalHouseholdIncome INTO existingHouseholdIncome FROM household WHERE id=existingHouseholdID;
		SET existingHouseholdIncome=existingHouseholdIncome+in_personal_income; 
		UPDATE household SET totalHouseholdIncome=existingHouseholdIncome WHERE id = existingHouseholdID; 
	ELSEIF HouseHoldExistence = 0 THEN
		INSERT INTO household VALUES(NULL,in_address,in_purokNo,in_personal_income,NULL);
		SELECT id INTO existingHouseholdID FROM household WHERE address=in_address;
		
	END IF;
    	INSERT INTO resident VALUES(NULL, in_family_name, in_middle_name, in_first_name, in_gender, in_precinctNo, in_birth_date, in_birth_place, in_civilstatus , in_height , in_weight, in_dependent, in_personal_income , 0, 0, 0, in_username, in_password, NOW(), in_email,in_contact_number, existingHouseholdID , NULL, 1);
		INSERT INTO requests VALUES(NULL, 0, NULL, NOW(), NULL,  GET_RESIDENTID(in_family_name,in_middle_name,in_first_name,in_username), 1);
 

                
END$$
DELIMITER ;
/* CALL NEW_RESIDENT('Mejia', 'B', 'Neil Marc', 'M', 'First', '1997-03-26', 'Kidaps', 'Single', '5''8', 75, 1, 0, 'Neil', '12345678', 'm.neilmarc@yahoo.com', '09369565269', 'Toril'); */


DROP PROCEDURE IF EXISTS NEW_TRANSACTION
DELIMITER $$
CREATE PROCEDURE NEW_TRANSACTION(IN in_request_id INT(11), IN in_transactions_type_id INT(11), IN in_resident_id INT(11), IN in_employee_id INT(11), in_amount INT(11), in_comment VARCHAR(64))
BEGIN
	DECLARE in_transaction_id INT DEFAULT 0;
	DECLARE in_transaction2_id INT DEFAULT 0;
	DECLARE in_transaction3_id INT DEFAULT 0;
	
	IF in_comment = '' THEN 
		SET in_comment = NULL;
	END IF;
		
	IF in_transactions_type_id <> 6 THEN
		INSERT INTO transactions VALUES(NULL, in_amount, NOW(), in_resident_id, in_employee_id, in_transactions_type_id);
		SET in_transaction_id = last_insert_id();
		UPDATE requests SET verified = 1, optional_comment = in_comment, transactions_id = in_transaction_id WHERE id = in_request_id;           
	ELSEIF in_transactions_type_id = 6 THEN
		INSERT INTO requests VALUES(NULL, 1, in_comment, NOW(), NULL, in_resident_id, in_transactions_type_id);
		SET in_transaction2_id = last_insert_id();
		INSERT INTO transactions VALUES(NULL, in_amount, NOW(), in_resident_id, in_employee_id, in_transactions_type_id);
		SET in_transaction3_id = last_insert_id();
		UPDATE requests SET transactions_id = in_transaction3_id WHERE id = in_transaction2_id;      
	END IF;
END$$
DELIMITER ;

DROP PROCEDURE IF EXISTS DENY_TRANSACTION
DELIMITER $$
CREATE PROCEDURE DENY_TRANSACTION(IN in_requestID INT(11), IN in_transactionType TINYINT(5), IN in_optionalReason VARCHAR(128), IN in_transResidentID INT(11), IN in_transEmpID INT(11))
BEGIN
	DECLARE tempid INT DEFAULT 0;
	DECLARE curTime TIMESTAMP DEFAULT NOW();
	
	IF in_optionalReason = '' THEN 
		SET in_optionalReason = NULL;
	END IF;
		
	IF in_transactionType <> 1 AND in_transactionType <> 7 THEN
		INSERT INTO transactions VALUES(NULL, NULL, curTime, in_transResidentID, in_transEmpID, in_transactionType);
		SET tempid = last_insert_id();
		UPDATE requests SET verified=2, optional_comment = in_optionalReason, transactions_id=tempid WHERE id = in_requestID AND resident_id = in_transResidentID AND request_type_id = in_transactionType;
	ELSEIF in_transactionType = 1 THEN
		DELETE FROM requests WHERE id = in_requestID AND resident_id = in_transResidentID;
		DELETE FROM resident WHERE id = in_transResidentID;
		
	ELSEIF in_transactionType = 7 THEN
		INSERT INTO transactions VALUES(NULL, NULL, curTime, in_transResidentID, in_transEmpID, 7);
		SET tempid = last_insert_id();
		UPDATE requests SET verified=2, optional_comment = in_optionalReason, transactions_id = tempid WHERE id = in_requestID AND resident_id = in_transResidentID AND request_type_id = in_transactionType;
	END IF;
END$$
DELIMITER ;




DROP PROCEDURE IF EXISTS NEW_BLOTTER
DELIMITER $$
CREATE PROCEDURE NEW_BLOTTER(IN in_complaint MEDIUMTEXT, IN in_status VARCHAR(128), IN in_complainant_name VARCHAR(45), IN in_complainant_address TEXT, IN in_contactNo VARCHAR(128), IN in_rescomplainant_id INT(11), IN in_complaint_type_id INT(11), IN dateSubmitted TIMESTAMP, IN in_valid TINYINT(2), IN in_requestID INT(11))
BEGIN

	IF in_rescomplainant_id IS NULL OR in_rescomplainant_id = '' THEN
		INSERT INTO complainant VALUES(NULL, in_complainant_name, in_complainant_address, in_contactNo, NULL);
		INSERT INTO blotter VALUES(NULL, in_complaint, dateSubmitted, in_status, LAST_INSERT_ID(), in_complaint_type_id, NULL, NULL, in_valid, in_requestID);
	END IF;
	IF in_rescomplainant_id IS NOT NULL AND in_rescomplainant_id <> '' THEN
		INSERT INTO complainant VALUES (NULL, NULL, NULL, NULL, in_rescomplainant_id);
		INSERT INTO blotter VALUES(NULL, in_complaint, dateSubmitted, in_status, LAST_INSERT_ID(), in_complaint_type_id, NULL, NULL, in_valid, in_requestID);
	END IF;
END $$
DELIMITER ;




DROP PROCEDURE IF EXISTS NEW_RESPONDENT
DELIMITER $$
CREATE PROCEDURE NEW_RESPONDENT(IN in_blotterid INT, IN in_residentid INT)
BEGIN
	INSERT INTO respondents VALUES(0, in_residentid, in_blotterid);
END$$
DELIMITER ;

DROP PROCEDURE IF EXISTS NEW_EMPLOYEE
DELIMITER $$
CREATE PROCEDURE NEW_EMPLOYEE(IN in_resid INT, IN in_position VARCHAR(64))
BEGIN
	DECLARE existID INT DEFAULT 0;
	SELECT id INTO existID FROM employee WHERE resident_id = in_resid LIMIT 1;
	
	IF in_position IS NULL OR in_position = '' THEN
		SET in_position = NULL;
	END IF;
	
	IF existID <> 0 THEN 
		UPDATE employee SET position = in_position WHERE resident_id = in_resid;
	ELSE 
		INSERT INTO employee SET position = in_position, resident_id = in_resid;
	END IF;
END $$
DELIMITER ;



DROP FUNCTION IF EXISTS GET_RESIDENTID
DELIMITER $$
CREATE FUNCTION GET_RESIDENTID(in_familyname VARCHAR(45), in_middlename VARCHAR(45), in_firstname VARCHAR(45), in_username VARCHAR(128))
RETURNS int
BEGIN
	DECLARE out_id int default 0;
	SELECT id INTO out_id FROM resident WHERE family_name=in_familyname AND middle_name=in_middlename AND first_name=in_firstname AND username=in_username LIMIT 1;
	return out_id;
END$$
DELIMITER ;

DROP FUNCTION IF EXISTS GET_ADDRESS
DELIMITER $$
CREATE FUNCTION GET_ADDRESS(in_residentid INT)
RETURNS VARCHAR(128)
BEGIN
	DECLARE out_address VARCHAR(128) DEFAULT NULL;
	SELECT address INTO out_address FROM resident INNER JOIN household ON resident.household_id = household.id WHERE resident.id = in_residentid;
	return out_address;
END$$
DELIMITER ;



DROP FUNCTION IF EXISTS GET_FULLNAME
DELIMITER $$
CREATE FUNCTION GET_FULLNAME(in_userid INT, in_middleinitial INT)
RETURNS VARCHAR(60)
BEGIN

    DECLARE out_name VARCHAR(60) DEFAULT NULL;
	IF in_middleinitial = 1 THEN
	    SELECT CONCAT(family_name, ', ',first_name,' ', LEFT(middle_name , 1), '.') INTO out_name FROM resident WHERE id=in_userid;
	ELSEIF in_middleinitial = 0 THEN
		SELECT CONCAT(family_name, ', ',first_name,' ', middle_name) INTO out_name FROM resident WHERE id=in_userid;
	END IF;
	return out_name;
END$$
DELIMITER ;

/* SELECT GET_FULLNAME(10) AS fullname; */



DROP FUNCTION IF EXISTS GET_FAMILYNAME
DELIMITER $$
CREATE FUNCTION GET_FAMILYNAME(in_userid INT)
RETURNS VARCHAR(60)
BEGIN

    DECLARE out_name VARCHAR(60) DEFAULT NULL;
	
	 SELECT family_name INTO out_name FROM resident WHERE id=in_userid;

	return out_name;
END$$
DELIMITER ;



DROP FUNCTION IF EXISTS GET_EMPNAME
DELIMITER $$
CREATE FUNCTION GET_EMPNAME(in_empid INT, in_form INT)
RETURNS VARCHAR(60)
BEGIN

    DECLARE out_name VARCHAR(60) DEFAULT NULL;
	DECLARE in_userid INT DEFAULT 0;
	
	SELECT resident_id INTO in_userid FROM employee WHERE id = in_empid;

	IF in_form = 0 THEN 
	    SELECT family_name INTO out_name FROM resident WHERE id=in_userid;
	ELSEIF in_form = 1 THEN
		SELECT CONCAT(family_name, ', ',first_name,' ', LEFT(middle_name , 1), '.') INTO out_name FROM resident WHERE id=in_userid;
	ELSEIF in_form = 2 THEN	
		SELECT CONCAT(family_name, ', ',first_name,' ', middle_name) INTO out_name FROM resident WHERE id=in_userid;
	ELSEIF in_form = 3 THEN
		SELECT first_name INTO out_name FROM resident WHERE id=in_userid;
	END IF;
	return out_name;
END$$
DELIMITER ;

/* SELECT GET_EMPNAME(10) AS fullname; 0 - Family name, 1 - Full name with initial, 2 - full name with mid name*/

DROP FUNCTION IF EXISTS GET_TOTALREQUESTS
DELIMITER $$
CREATE FUNCTION GET_TOTALREQUESTS(in_residentid INT(11), in_type TINYINT(2))
RETURNS int
BEGIN
	DECLARE out_count INT(2) DEFAULT 0;
	IF in_type = 0 THEN
		SELECT COUNT(*) INTO out_count FROM requests WHERE resident_id = in_residentid LIMIT 1;
	ELSEIF in_type = 1 THEN
		SELECT COUNT(*) INTO out_count FROM requests WHERE resident_id = in_residentid AND verified = 0;
	ELSEIF in_type = 2 THEN
		SELECT COUNT(*) INTO out_count FROM requests WHERE resident_id = in_residentid AND verified = 1;
	END IF;
	return out_count;
END$$
DELIMITER ;
/* SELECT GET_TOTALREQUESTS(2, 0) AS fullname; 0 - All Requests, 1 - Non-Verified, 2 - Verified*/

DROP FUNCTION IF EXISTS GET_TOTALREQUESTSBYTYPE
DELIMITER $$
CREATE FUNCTION GET_TOTALREQUESTSBYTYPE(in_residentid INT(11), in_type TINYINT(2))
RETURNS int
BEGIN
	DECLARE out_count INT(2) DEFAULT 0;
	SELECT COUNT(id) INTO out_count FROM requests WHERE resident_id = in_residentid AND request_type_id = in_type AND verified = 0 LIMIT 1;
	return out_count;
END$$
DELIMITER ;

DROP FUNCTION IF EXISTS GET_BLOTTERTYPE
DELIMITER $$
CREATE FUNCTION GET_BLOTTERTYPE(in_type VARCHAR(128))
RETURNS INT
BEGIN
	DECLARE out_id INT DEFAULT 0;
	
	SELECT id INTO out_id FROM complaint_type WHERE complaint_name = in_type;
	return out_id;
END$$
DELIMITER ;

DROP FUNCTION IF EXISTS GET_BLOTTERTYPEBYID
DELIMITER $$
CREATE FUNCTION GET_BLOTTERTYPEBYID(in_type INT)
RETURNS VARCHAR(60)
BEGIN
	DECLARE out_type VARCHAR(60) DEFAULT NULL;
	
	SELECT complaint_name INTO out_type FROM complaint_type WHERE id = in_type;
	return out_type;
END$$
DELIMITER ;


DROP FUNCTION IF EXISTS GET_COMPLAINANTNAME 
DELIMITER $$
CREATE FUNCTION GET_COMPLAINANTNAME(in_complainantID INT(11))
RETURNS VARCHAR(60)
BEGIN
  DECLARE in_complainant_name VARCHAR(60) DEFAULT NULL;
  DECLARE in_resID INT DEFAULT NULL;
  
    SELECT resident_id INTO in_resID FROM complainant WHERE id = in_complainantID LIMIT 1;
    SELECT complainant_name INTO in_complainant_name FROM complainant WHERE id = in_complainantID LIMIT 1;
    
  IF !ISNULL(in_resID) THEN
    SELECT CONCAT(family_name,', ', first_name, ' ', middle_name) INTO in_complainant_name FROM resident WHERE id = in_resID;
  END IF;
  return in_complainant_name;
END $$
DELIMITER ;


DROP FUNCTION IF EXISTS GET_COMPLAINANTRESID
DELIMITER $$
CREATE FUNCTION GET_COMPLAINANTRESID(in_complainantID INT)
RETURNS INT
BEGIN
	DECLARE out_id INT DEFAULT NULL;
	SELECT resident_id INTO out_id FROM complainant WHERE id = in_complainantID LIMIT 1;
	return out_id;
END$$
DELIMITER ;

DROP FUNCTION IF EXISTS GET_COMPLAINANTADDRESS
DELIMITER $$
CREATE FUNCTION GET_COMPLAINANTADDRESS(in_complainantID INT(11))
RETURNS VARCHAR(60)
BEGIN
	DECLARE in_complainant_address VARCHAR(128) DEFAULT NULL;
	DECLARE in_resID INT DEFAULT NULL;
	
		SELECT resident_id INTO in_resID FROM complainant WHERE id = in_complainantID LIMIT 1;
		SELECT complainant_address INTO in_complainant_address FROM complainant WHERE id = in_complainantID LIMIT 1;
		
	IF !ISNULL(in_resID) THEN
		SELECT household.address INTO in_complainant_address FROM complainant INNER JOIN resident ON resident.id = complainant.resident_id INNER JOIN household ON resident.household_id = household.id WHERE resident_id = in_resID LIMIT 1; 
	END IF;
	return in_complainant_address;
END$$
DELIMITER ;