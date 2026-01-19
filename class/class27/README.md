# Class 27 - Working on user authentication

We work with the login.php file, which is responsible for verifying user data against the database.
We incorporate the concept of session variables through the server variable $_SESSION, which functions like all server variables (as an array), but unlike $_POST and $_GET (which are read-only), $_SESSION allows not only reading but also creating and modifying sections.

## ⚙️ How do the sessions work?
First of all, sessions are disabled by default; I must initialize them with the `session_start()` function before my PHP code. This function must be included on every page where we want to use or preserve user session variables.
Session variables ($_SESSION) are stored on the server side, which is a great security advantage, but inconvenient in terms of resource usage (imagine a page with viral traffic... we would have to store data for every user on our site!). The only thing saved in the browser is a cookie containing the user's session ID: a variable that PHP monitors on every page and uses to load the data associated with that session.

Unless configured otherwise, sessions work by automatically setting a cookie in the user's browser containing the session ID: a string of text and numbers that identifies the user throughout their visit. The browser sends this cookie when requesting any page on the server, allowing PHP to track the information recorded in each session and its values.

The 3 ways session variables can be destroyed (deleted):

- I didn't put `session_start()` at the beginning of the page
- A timeout occurred
- Deliberate destruction using `session_destroy()`

**En el ejemplo:**

We created a variable $_SESSION["usuario"] which stores the name of the user who authenticated on the site, to then verify its existence from the protec.php file, responsible for protecting against unauthorized access to private areas.
