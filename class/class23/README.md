# Class 23 - Database: Things got serious!

**Using phpMyAdmin to Manage MySQL**

To manage our database, we can use a database management tool, which in most cases is phpMyAdmin. In XAMPP, phpMyAdmin is installed in:

http://localhost/phpmyadmin

Within this tool, we can find three interface areas:

- The inventory: the left sidebar, where we can see all the databases we have access to.

- The context area: the upper right of the inventory, where we can find two rows: a dark gray row, which indicates the current context, and a row with buttons that allow us to perform actions for that context.

- The work area: the central part of the interface, where all the details of the action we want to perform are located.

**Contexts**:

- Server
  - Database Management

- Database
  - Table Management or Database Operations

- Tables
  - Table Structure Management
  - Data Management
 
**Character sets suitable for our language**:

- utf8-general-ci

- utf8mb4-general-ci

To transport a database, you need to export it (mysqldump).
To do this, select the "server" context, then go to the "export" operation, which will generate a **.sql** file (a complete database backup).

To perform the opposite operation (restore), it is necessary to create the database first (it does not need to have the same name as the backup). Then select it from the inventory (to be in its context) and choose the "import" operation where we can provide a backup file (*.sql).

Note 1: Attached is an alternative database manager, HeidiSQL.

Note 2: In XAMPP we can create and manage as many databases as we want, but in real life (in production) this is not the case; we will be provided with a database with a particular name, username, and password (in XAMPP we have by default only one user: root, which does not have a password).
