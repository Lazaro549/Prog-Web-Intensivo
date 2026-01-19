# Clase 12 - Form (part two)

Prácticas, reconstrucción de ejemplos:
- Count from - to
- Tables

**$_POST Channel**: (used the same as GET, but only works with forms) data travels in a secondary channel unlike GET, which can be seen attached by querystring

`<form>` tag

method: **POST or GET**. The method by which information is sent to the action (also determines which variable to use on the action side, $_GET or $_POST, in PHP)

action: The file to which the information collected by the form will be sent upon **submission** (ready for processing)

`<input>` tag

type: **text, submit, radio**,... Determines the type of interaction field the user will see

value: Sets the pre-loaded or default value of an input field

name: Is the element's identifier, allowing it to be located by the action to retrieve its information

`<select>` tag

name: is the identifier of the element, the value of the option selected by the user will be stored

The `<option value="1">This value is 1</option>` tag is a sub-tag of `select`, which allows me to set the possible values ​​the user can choose. The `value` is what we're interested in, since this is what we can process in the action. In the example, **"This value is 1"** is only visible to the user; it's not accessible from the action itself, unlike the "1".
