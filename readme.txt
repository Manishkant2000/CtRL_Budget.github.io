*---- To run the php file  ------*
i).The php files and other folders are inside the Final_Project folder.
It can implemented starting with index.php file.
ii). sql database is within SQL_file folder.
iii). sql connection has been made in the Final_Project/includes/common.php file.


*--- Description of SQL database  ------*
The folder 'SQL_file' contains the MySQLi database.
It contains a database which is named as 'project'.
This database contains four tables: users, plans, person and expense.

i). users: It contains all the information provided(name, email, password, phone) by the user at the time of signing up along with a primary key id.

ii). plans: It contains the details of all the plans created by any user. 'start'  row is meant to contain starting date of the plan while 'end'  row is meant to contain ending date for the plan. 'user_id' is also associated with every plan.

iii). person: It contains name of all person associated with any plan. Every person is also associated with plan_id and user_id. Any person can be uniquely identified with his plan_id and user_id.

iv). expense: It contains the details of all the expenses. 
           e.g. 'name' is meant to store title of the expense, 
	'date'  is meant to store the date on which expense is occured.
	'amount' is meant to contain the amount of a particular expense.
	'person' is meant to contain the person's name who has spend the amount for an expense.
	'bill' is meant to contain the path of the bill if it has been uploaded else it will remain null.	
	it can be uniquely identified by the user_id and plan_id.