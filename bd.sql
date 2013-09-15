
lectors 	
Add field
lector_id 	int(10) 	
lector_name 	text(255) 	
lector_position 	text(255) 	
lector_email 	text(255) 	
lector_login 	text(10) 	
lector_password 	text(10) 	
subjects 	
Add field
subject_id 	int(10) 	
subject_title 	text(255) 	

CREATE TABLE `lectors` (
  `lector_id` INT(10) NOT NULL AUTO_INCREMENT,
  `lector_name` TEXT(255),
  `lector_position` TEXT(255),
  `lector_email` TEXT(255),
  `lector_login` TEXT(10),
  `lector_password` TEXT(10),
  PRIMARY KEY  (`lector_id`)
);

CREATE TABLE `subjects` (
  `subject_id` INT(10) NOT NULL AUTO_INCREMENT,
  `subject_title` TEXT(255),
  `subject_credits` INT,
  `lector_id` INT(10),
  PRIMARY KEY  (`subject_id`)
);

CREATE TABLE `students` (
  `student_id` INT(10) NOT NULL AUTO_INCREMENT,
  `student_name` TEXT(255),
  `student_notes` TEXT(255),
  `student_email` TEXT(255),
  `group_id` INT(10),
  PRIMARY KEY  (`student_id`)
);

CREATE TABLE `groups` (
  `group_id` INT(10) NOT NULL AUTO_INCREMENT,
  `group_name` TEXT(255),
  PRIMARY KEY  (`group_id`)
);

CREATE TABLE `group_subjects` (
  `group_id` INT(10),
  `subject_id` INT(10)
);

CREATE TABLE `modules` (
  `module_id` INT(10) NOT NULL AUTO_INCREMENT,
  `module_name` TEXT(255),
  `subject_id` INT(10),
  PRIMARY KEY  (`module_id`)
);

CREATE TABLE `groups_modules` (
  `group_module_id` INT(10) NOT NULL AUTO_INCREMENT,
  `group_id` INT(10),
  `module_id` INT(10),
  `dead_line` DATE,
  PRIMARY KEY  (`group_module_id`)
);

CREATE TABLE `grades` (
  `group_module_id` INT(10),
  `student_id` INT(10),
  `grade_first` CHAR,
  `grade_second` CHAR
);


ALTER TABLE `subjects` ADD CONSTRAINT `subjects_fk1` FOREIGN KEY (`lector_id`) REFERENCES lectors(`lector_id`);
ALTER TABLE `students` ADD CONSTRAINT `students_fk1` FOREIGN KEY (`group_id`) REFERENCES groups(`group_id`);

ALTER TABLE `group_subjects` ADD CONSTRAINT `group_subjects_fk1` FOREIGN KEY (`group_id`) REFERENCES groups(`group_id`);
ALTER TABLE `group_subjects` ADD CONSTRAINT `group_subjects_fk2` FOREIGN KEY (`subject_id`) REFERENCES subjects(`subject_id`);
ALTER TABLE `modules` ADD CONSTRAINT `modules_fk1` FOREIGN KEY (`subject_id`) REFERENCES subjects(`subject_id`);
ALTER TABLE `groups_modules` ADD CONSTRAINT `groups_modules_fk1` FOREIGN KEY (`group_id`) REFERENCES groups(`group_id`);
ALTER TABLE `groups_modules` ADD CONSTRAINT `groups_modules_fk2` FOREIGN KEY (`module_id`) REFERENCES modules(`module_id`);
ALTER TABLE `grades` ADD CONSTRAINT `grades_fk1` FOREIGN KEY (`group_module_id`) REFERENCES groups_modules(`group_module_id`);
ALTER TABLE `grades` ADD CONSTRAINT `grades_fk2` FOREIGN KEY (`student_id`) REFERENCES students(`student_id`);

