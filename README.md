Forensic Database Project
This forensic database project provides a platform for two types of users - Officers and Technical Team members. Officers have access to view all cases, while the Technical Team has additional permissions to add, delete, and update cases. The data is stored in a MySQL database, and PHP is used to connect the frontend with the backend.

Features
Officer Login: Officers can log in to view all cases.
Technical Team Login: Technical Team members has some special username and password through which they can log in and add, delete, and update cases.

See all Cases: Officers and technical team can see all cases in the database.
See particular cases: Technical team can see particular case by using unique case id.
Add Cases: Technical Team members can add new cases to the database.
Delete Cases: Technical Team members can delete cases from the database.
Update Cases: Technical Team members can update case details.

Technologies Used

Frontend:
HTML, CSS

Backend:
PHP
MySQL

Database Setup:
Set up your MySQL database with the required table structure.

Database Structure

add_case table to add, delete, update and see cases.
officers table to store officers details.
technical_team table to store technical team details.

Usage
Access the website through a web browser.
Login as an Officer or a Technical Team member using the provided login functionality.
Officers can view cases, while the Technical Team can perform CRUD operations on cases.
