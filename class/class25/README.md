# Class 25 - SQL: Instructions
SQL Queries

The way to interact with the database is through SQL statements (queries), for which we have at least four verbs or actions:

- **SELECT**: Read information

- **INSERT**: Add data

- **UPDATE**: Modify existing data

- **DELETE**: Delete or destroy information

In general, when we build a query of

**UPDATE** or

**DELETE**, we rely on or use something related to the primary key as a condition.

- In the case of

**INSERT**, we can omit fields for which we have set default or automatic values ​​(such as Auto-Increment).

- The

**SELECT** query is the only one that returns a recordset (result set), so it is necessary to assign the mysqli_query() function to a variable to store it.

- **INSERT**, **UPDATE**, and **DELETE** are considered action queries, so they do not return a result other than confirmation or error.

Note: prototypes and examples can be found in the attached material.
