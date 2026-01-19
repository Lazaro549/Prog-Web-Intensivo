# Class 09 - Forms! (Part one)
## ⚙ Operation
**Visitor ---------> Server**

The visitor requests a page (Request)

**UI <------ Server**

The server sends a user interface (Form) as a response.

**Visitor ----------> Submit**

The visitor completes the form and then submits the data with the submit event.
The data completed in the form is "attached" via GET or POST, depending on the form configuration.

**Visitor <------------- Action**

Once the data is received from the action, it is processed and a response is returned.

## 📝 Composition

`<form method="POST" action="arch.php"></form>`

method = GET or POST (POST preferred) is the way the information is transmitted
action = file to which the data collected by the form is sent

`<label for="<nombre>">Indicación</label>`
`<input type="<tipo>" name="<nombre>">`

input = means input, most controls use this tag

type = type of control to display

name = identifier for later server-side processing

label = Visitor guidance label, irrelevant to programming

for = associated control (name)

## ⌨ Controls so far
`<input type="text" name="control">`   = Free text control, the user can write whatever they want

`<input type="submit" name="button">`   = The Submit button is responsible for "triggering" the submit

📝 notes:

-The **input** tag does not have a closing tag </input> It does not exist!

-The form must enclose all the controls; otherwise, the data will not be sent to the action.

## ⌨️ TP
Calculation of fees

