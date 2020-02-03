DROP TABLE judge_accounts;
DROP TABLE team_accounts;
DROP TABLE project_eval_forms;
DROP TABLE senior_design_exp_forms;

-- table for judge accounts: contains judge name, id, hashed password, and session
CREATE TABLE judge_accounts (
	judge_name     VARCHAR2(150),
	judge_id       VARCHAR2(150),
	judge_password VARCHAR2(150),
	session_name   VARCHAR2(150),
	year		   INTEGER
);

-- table for team accounts: contains team name, students in team, and session 
CREATE TABLE team_accounts (
	session_name VARCHAR2(150),
	team_name    VARCHAR2(150),
	student_name VARCHAR2(150),
	year		 INTEGER
);

-- table for judges' responses to a specific team's presentation
CREATE TABLE project_eval_forms (
	session_name      VARCHAR2(150),
	judge_name        VARCHAR2(150),
	project_name	  VARCHAR2(150),
	question1_answer  INTEGER,
	question2_answer  INTEGER,
	question3_answer  INTEGER,
	question4_answer  INTEGER,
	question5_answer  INTEGER,
	question6_answer  INTEGER,
	question7_answer  INTEGER,
	question8_answer  INTEGER,
	question9_answer  INTEGER,
	question10_answer INTEGER,
	question11_answer INTEGER,
	question12_answer INTEGER,
	checkboxes		  VARCHAR2(500),
	other_comments	  VARCHAR2(500),
	year			  INTEGER
);

-- table for judges' responses to overall seniro design experience 
CREATE TABLE senior_design_exp_forms (
	session_name      VARCHAR2(150),
	judge_name        VARCHAR2(150),
	question0_answer  INTEGER,
    question1_answer  INTEGER,
    question2_answer  INTEGER,
    question3_answer  INTEGER,
    question4_answer  INTEGER,
    question5_answer  INTEGER,
    question6_answer  INTEGER,
    question7_answer  INTEGER,
    question8_answer  INTEGER,
    question9_answer  INTEGER,
    question10_answer INTEGER,
    question11_answer INTEGER,
    question12_answer INTEGER,
	other_comments	  VARCHAR2(500),
	year			  INTEGER
);
