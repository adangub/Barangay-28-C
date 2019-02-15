SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL';

CREATE SCHEMA IF NOT EXISTS `28C` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci ;
USE `28C` ;

-- -----------------------------------------------------
-- Table `28C`.`household`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `28C`.`household` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `address` VARCHAR(255) NULL ,
  `purokNo` TINYINT NULL ,
  `totalHouseholdIncome` BIGINT NULL ,
  `household_head_id` INT NULL ,
  PRIMARY KEY (`id`) ,
  INDEX `fk_household_resident1_idx` (`household_head_id` ASC) ,
  CONSTRAINT `fk_household_resident1`
    FOREIGN KEY (`household_head_id` )
    REFERENCES `28C`.`resident` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `28C`.`resident`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `28C`.`resident` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `family_name` VARCHAR(45) NULL ,
  `middle_name` VARCHAR(45) NULL ,
  `first_name` VARCHAR(45) NULL ,
  `gender` VARCHAR(10) NULL ,
  `precinctNo` VARCHAR(20) NULL ,
  `birth_date` DATE NULL ,
  `birth_place` VARCHAR(128) NULL ,
  `civilstatus` VARCHAR(28) NULL ,
  `height` VARCHAR(8) NULL ,
  `weight` INT NULL ,
  `dependent` TINYINT NULL ,
  `personal_income` BIGINT NULL ,
  `fathers_id` INT NULL ,
  `mothers_id` INT NULL ,
  `guardians_id` INT NULL ,
  `username` VARCHAR(60) NULL ,
  `password` VARCHAR(128) NULL ,
  `regdate` TIMESTAMP NULL ,
  `email` VARCHAR(255) NULL ,
  `contact_number` VARCHAR(128) NULL ,
  `household_id` INT NULL ,
  `image` VARCHAR(60) NULL ,
  `eligibility` TINYINT NULL ,
  PRIMARY KEY (`id`) ,
  INDEX `fk_resident_household1_idx` (`household_id` ASC) ,
  CONSTRAINT `fk_resident_household1`
    FOREIGN KEY (`household_id` )
    REFERENCES `28C`.`household` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `28C`.`employee`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `28C`.`employee` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `position` VARCHAR(50) NULL ,
  `resident_id` INT NOT NULL ,
  PRIMARY KEY (`id`) ,
  INDEX `fk_employee_resident1_idx` (`resident_id` ASC) ,
  CONSTRAINT `fk_employee_resident1`
    FOREIGN KEY (`resident_id` )
    REFERENCES `28C`.`resident` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `28C`.`request_type`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `28C`.`request_type` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `request_name` VARCHAR(45) NULL ,
  PRIMARY KEY (`id`) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `28C`.`transactions`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `28C`.`transactions` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `amount` INT NULL ,
  `date` TIMESTAMP NULL ,
  `resident_id` INT NOT NULL ,
  `employee_id` INT NOT NULL ,
  `request_type_id` INT NOT NULL ,
  PRIMARY KEY (`id`) ,
  INDEX `fk_transactions_resident1_idx` (`resident_id` ASC) ,
  INDEX `fk_transactions_employee1_idx` (`employee_id` ASC) ,
  INDEX `fk_transactions_request_type1_idx` (`request_type_id` ASC) ,
  CONSTRAINT `fk_transactions_resident1`
    FOREIGN KEY (`resident_id` )
    REFERENCES `28C`.`resident` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_transactions_employee1`
    FOREIGN KEY (`employee_id` )
    REFERENCES `28C`.`employee` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_transactions_request_type1`
    FOREIGN KEY (`request_type_id` )
    REFERENCES `28C`.`request_type` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `28C`.`complainant`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `28C`.`complainant` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `complainant_name` VARCHAR(45) NULL ,
  `complainant_address` TEXT NULL ,
  `contactNo` BIGINT NULL ,
  `resident_id` INT NULL ,
  PRIMARY KEY (`id`) ,
  INDEX `fk_complainant_resident1_idx` (`resident_id` ASC) ,
  CONSTRAINT `fk_complainant_resident1`
    FOREIGN KEY (`resident_id` )
    REFERENCES `28C`.`resident` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `28C`.`complaint_type`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `28C`.`complaint_type` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `complaint_name` VARCHAR(128) NULL ,
  PRIMARY KEY (`id`) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `28C`.`requests`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `28C`.`requests` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `verified` VARCHAR(45) NULL ,
  `optional_comment` VARCHAR(64) NULL ,
  `date` DATETIME NULL ,
  `transactions_id` INT NULL ,
  `resident_id` INT NOT NULL ,
  `request_type_id` INT NOT NULL ,
  PRIMARY KEY (`id`) ,
  INDEX `fk_requests_resident1_idx` (`resident_id` ASC) ,
  INDEX `fk_requests_request_type1_idx` (`request_type_id` ASC) ,
  INDEX `fk_requests_transactions1_idx` (`transactions_id` ASC) ,
  CONSTRAINT `fk_requests_resident1`
    FOREIGN KEY (`resident_id` )
    REFERENCES `28C`.`resident` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_requests_request_type1`
    FOREIGN KEY (`request_type_id` )
    REFERENCES `28C`.`request_type` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_requests_transactions1`
    FOREIGN KEY (`transactions_id` )
    REFERENCES `28C`.`transactions` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `28C`.`blotter`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `28C`.`blotter` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `complaint` MEDIUMTEXT NULL ,
  `date` DATETIME NULL ,
  `status` VARCHAR(128) NULL ,
  `complainant_id` INT NOT NULL ,
  `complaint_type_id` INT NOT NULL ,
  `lupong_id` INT NULL ,
  `lupong2_id` INT NULL ,
  `valid` TINYINT NULL ,
  `requests_id` INT NULL ,
  PRIMARY KEY (`id`) ,
  INDEX `fk_blotter_complainant1_idx` (`complainant_id` ASC) ,
  INDEX `fk_blotter_compaint_type1_idx` (`complaint_type_id` ASC) ,
  INDEX `fk_blotter_employee1` (`lupong_id` ASC) ,
  INDEX `fk_blotter_employee2` (`lupong2_id` ASC) ,
  INDEX `fk_blotter_requests1_idx` (`requests_id` ASC) ,
  CONSTRAINT `fk_blotter_complainant1`
    FOREIGN KEY (`complainant_id` )
    REFERENCES `28C`.`complainant` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_blotter_compaint_type1`
    FOREIGN KEY (`complaint_type_id` )
    REFERENCES `28C`.`complaint_type` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_blotter_employee1`
    FOREIGN KEY (`lupong_id` )
    REFERENCES `28C`.`employee` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_blotter_employee2`
    FOREIGN KEY (`lupong2_id` )
    REFERENCES `28C`.`employee` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_blotter_requests1`
    FOREIGN KEY (`requests_id` )
    REFERENCES `28C`.`requests` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `28C`.`hearing_schedule`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `28C`.`hearing_schedule` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `schedule_date` DATE NULL ,
  `start_time` TIME NULL ,
  `end_time` TIME NULL ,
  `blotter_id` INT NOT NULL ,
  PRIMARY KEY (`id`) ,
  INDEX `fk_hearing_schedule_blotter1_idx` (`blotter_id` ASC) ,
  CONSTRAINT `fk_hearing_schedule_blotter1`
    FOREIGN KEY (`blotter_id` )
    REFERENCES `28C`.`blotter` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `28C`.`program`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `28C`.`program` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `title` VARCHAR(255) NULL ,
  `date` DATE NULL ,
  `place` VARCHAR(255) NULL ,
  `status` VARCHAR(128) NULL ,
  `timeFrom` TIME NULL ,
  `timeTo` TIME NULL ,
  `budget` INT NULL ,
  PRIMARY KEY (`id`) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `28C`.`employee_program_assignment`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `28C`.`employee_program_assignment` (
  `programs_id` INT NOT NULL ,
  `employee_id` INT NOT NULL ,
  PRIMARY KEY (`programs_id`, `employee_id`) ,
  INDEX `fk_programs_has_employee_employee1_idx` (`employee_id` ASC) ,
  INDEX `fk_programs_has_employee_programs1_idx` (`programs_id` ASC) ,
  CONSTRAINT `fk_programs_has_employee_programs1`
    FOREIGN KEY (`programs_id` )
    REFERENCES `28C`.`program` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_programs_has_employee_employee1`
    FOREIGN KEY (`employee_id` )
    REFERENCES `28C`.`employee` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `28C`.`participants`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `28C`.`participants` (
  `resident_id` INT NOT NULL ,
  `program_id` INT NOT NULL ,
  PRIMARY KEY (`program_id`, `resident_id`) ,
  INDEX `fk_resident_has_programs_programs1_idx` (`program_id` ASC) ,
  INDEX `fk_resident_has_programs_resident1_idx` (`resident_id` ASC) ,
  CONSTRAINT `fk_resident_has_programs_resident1`
    FOREIGN KEY (`resident_id` )
    REFERENCES `28C`.`resident` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_resident_has_programs_programs1`
    FOREIGN KEY (`program_id` )
    REFERENCES `28C`.`program` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `28C`.`program_expense`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `28C`.`program_expense` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `expense_name` VARCHAR(128) NULL ,
  `amount` INT NULL ,
  `date` DATETIME NULL ,
  `program_id` INT NOT NULL ,
  PRIMARY KEY (`id`) ,
  INDEX `fk_program_expense_programs1_idx` (`program_id` ASC) ,
  CONSTRAINT `fk_program_expense_programs1`
    FOREIGN KEY (`program_id` )
    REFERENCES `28C`.`program` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `28C`.`announcements`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `28C`.`announcements` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `date` TIMESTAMP NULL ,
  `content` TEXT NULL ,
  `priority` TINYINT UNSIGNED NULL ,
  `employee_id` INT NOT NULL ,
  PRIMARY KEY (`id`) ,
  INDEX `fk_announcements_employee1_idx` (`employee_id` ASC) ,
  CONSTRAINT `fk_announcements_employee1`
    FOREIGN KEY (`employee_id` )
    REFERENCES `28C`.`employee` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `28C`.`respondents`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `28C`.`respondents` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `resident_id` INT NOT NULL ,
  `blotter_id` INT NOT NULL ,
  INDEX `fk_respondents_resident1_idx` (`resident_id` ASC) ,
  INDEX `fk_respondents_blotter1_idx` (`blotter_id` ASC) ,
  PRIMARY KEY (`id`) ,
  CONSTRAINT `fk_respondents_resident1`
    FOREIGN KEY (`resident_id` )
    REFERENCES `28C`.`resident` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_respondents_blotter1`
    FOREIGN KEY (`blotter_id` )
    REFERENCES `28C`.`blotter` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `28C`.`editProfile`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `28C`.`editProfile` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `precinctNo` VARCHAR(20) NULL ,
  `civilstatus` VARCHAR(28) NULL ,
  `height` VARCHAR(8) NULL ,
  `weight` INT NULL ,
  `personal_income` BIGINT NULL ,
  `contact_number` VARCHAR(28) NULL ,
  `email` VARCHAR(255) NULL ,
  `password` VARCHAR(128) NULL ,
  `dependent` TINYINT NULL ,
  `position` VARCHAR(64) NULL ,
  `fathers_id` INT NULL ,
  `mothers_id` INT NULL ,
  `guardians_id` INT NULL ,
  `new_household_id` INT NOT NULL ,
  `resident_id` INT NOT NULL ,
  PRIMARY KEY (`id`) ,
  INDEX `fk_editProfile_household1_idx` (`new_household_id` ASC) ,
  INDEX `fk_editProfile_resident1_idx` (`resident_id` ASC) ,
  CONSTRAINT `fk_editProfile_household1`
    FOREIGN KEY (`new_household_id` )
    REFERENCES `28C`.`household` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_editProfile_resident1`
    FOREIGN KEY (`resident_id` )
    REFERENCES `28C`.`resident` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;



SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;



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
	DELETE FROM blotter WHERE GET_COMPLAINANTRESID(complainant_id) = in_requestID;
	DELETE FROM complainant WHERE resident_id = in_requestID;
	DELETE FROM respondents WHERE resident_id = in_requestID;
    DELETE FROM requests WHERE id = in_requestID AND resident_id = in_transResidentID;
	DELETE FROM participants WHERE resident_id = in_transResidentID;
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

DROP PROCEDURE IF EXISTS DELETE_BLOTTERBYREQUESTID
DELIMITER $$
CREATE PROCEDURE DELETE_BLOTTERBYREQUESTID(IN in_reqid INT(11))
BEGIN
  DECLARE bID INT DEFAULT 0;
  SELECT id INTO bID FROM blotter WHERE requests_id = in_reqid LIMIT 1;
  
  DELETE FROM respondents WHERE blotter_id = bID;
  DELETE FROM blotter WHERE requests_id = in_reqid;
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


DROP FUNCTION IF EXISTS GET_REQUESTID
DELIMITER $$
CREATE FUNCTION GET_REQUESTID(in_residentid INT(11), in_requesttype INT(11), in_verified INT(11))
RETURNS int
BEGIN
  DECLARE out_id int default 0;
  SELECT id INTO out_id FROM requests WHERE resident_id=in_residentid AND verified=in_verified AND request_type_id = in_requesttype LIMIT 1;
  return out_id;
END$$
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

DROP FUNCTION IF EXISTS IS_RESIDENT
DELIMITER $$
CREATE FUNCTION IS_RESIDENT(in_userid INT)
RETURNS TINYINT(2)
BEGIN

    DECLARE out_bool TINYINT(2) DEFAULT 0;
  
   SELECT COUNT(resident.id) INTO out_bool FROM requests INNER JOIN resident ON resident.id = requests.resident_id WHERE verified = 1 AND requests.resident_id = in_userid;
	
  return out_bool;
END$$
DELIMITER ;


DROP FUNCTION IF EXISTS GET_EMPNAME
DELIMITER $$
CREATE FUNCTION GET_EMPNAME(in_empid INT, in_form INT)
RETURNS VARCHAR(60)
BEGIN

    DECLARE out_name VARCHAR(60) DEFAULT NULL;
  DECLARE in_userid INT DEFAULT 0;
  
  SELECT resident_id INTO in_userid FROM employee WHERE id = in_empid AND position IS NOT NULL;

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

DROP FUNCTION IF EXISTS GET_TOTALVERIFIEDREQUESTS
DELIMITER $$
CREATE FUNCTION GET_TOTALVERIFIEDREQUESTS(in_residentid INT(11), in_type TINYINT(2), in_verify TINYINT(2))
RETURNS int
BEGIN
  DECLARE out_count INT(2) DEFAULT 0;
  SELECT COUNT(id) INTO out_count FROM requests WHERE resident_id = in_residentid AND request_type_id = in_type AND verified = in_verify LIMIT 1;
  return out_count;
END$$
DELIMITER ;


DROP FUNCTION IF EXISTS GET_ISSTILLRESP
DELIMITER $$
CREATE FUNCTION GET_ISSTILLRESP(in_residentid INT(11))
RETURNS TINYINT
BEGIN
  DECLARE out_count TINYINT(2) DEFAULT 0;
  SELECT COUNT(respondents.id) INTO out_count FROM respondents INNER JOIN blotter ON respondents.blotter_id = blotter.id WHERE respondents.resident_id = in_residentid AND status <> 'Settled (Not Guilty)';
  return out_count;
END$$
DELIMITER ;

DROP FUNCTION IF EXISTS GET_SCHEDULECONFLICT
DELIMITER $$
CREATE FUNCTION GET_SCHEDULECONFLICT(in_date DATE, in_sTime TIME, in_eTime TIME)
RETURNS TINYINT
BEGIN
  DECLARE out_count TINYINT(2) DEFAULT 0;
  DECLARE temp TINYINT(2) DEFAULT 0;
  SELECT COUNT(id) INTO temp FROM program WHERE date = in_date AND timeFrom < in_eTime AND timeTo > in_sTime;
  IF temp > 0 THEN
	SET out_count = 1;
  END IF;
  return out_count;
END$$
DELIMITER ;

DROP FUNCTION IF EXISTS GET_BLOTSCHEDULECONFLICT
DELIMITER $$
CREATE FUNCTION GET_BLOTSCHEDULECONFLICT(in_date DATE, in_sTime TIME, in_eTime TIME)
RETURNS TINYINT
BEGIN
  DECLARE out_count TINYINT(2) DEFAULT 0;
  DECLARE temp TINYINT(2) DEFAULT 0;
  SELECT COUNT(id) INTO temp FROM hearing_schedule WHERE schedule_date = in_date AND start_time < in_eTime AND end_time > in_sTime;
  IF temp > 0 THEN
	SET out_count = 1;
  END IF;
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