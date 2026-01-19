# Class 24 - Databases, advancing in SQL

- Practical exercise in database backup and restoration for transport.

- Practical exercise in creating tables: Tables
  - Create the PK (primary key) field `marca_id`: mark it as AI (auto-incrementing) so that phpMyAdmin converts it to a PRIMARY index (this can also be done manually, but be careful! Only one field in the table can be PRIMARY).

  - The `description` field should have a VARCHAR data type (variable-length text). It's necessary to set the maximum length for it to work.

  - The `votes` field should have an INT data type and a default value of 0.

  - The `status` field should have a TinyINT data type (since it will be a small number) and a default value of 1.

- Inclusion of Files

As our code becomes denser, it's likely we'll need to segment it or simply divide it into reusable pieces. This allows us to include files within others, resulting in a more consistent and maintainable code. The instruction is simple:

`include "<file to include>";`

The place where you put this line is where it will be executed.

- First query: INSERT

General Format:

`INSERT INTO` tableName(fieldToInsert1, fieldToInsert2) `VALUES`('text value', Number)

`INSERT INTO:` Verb, the action to be performed
`tableName`: Name of the table to be inserted

`(fieldToInsert1, fieldToInsert2):` List of fields to insert (those not listed will be used with their default or automatic values)

`VALUES('text value', Number):` Values ​​to be added; these must correspond to the fields to be inserted, and if text, they must be enclosed in single quotes '<text>'
