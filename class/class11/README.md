#  Clase 11 - Loops (Part one)
**Loops**: This is a structure that enables repetition in many situations. When the programmer specifies a certain condition and that condition is met (i.e., it is true), the loop executes and will only stop when the condition is no longer met. This type of structure allows an action to be repeated over and over again without requiring identical code. This results in cleaner final code that can be modified more easily.

Finite Loop **for**


```
for($contador=<inicio>;<condición>;<avance>){
       linea a repetir1
       linea a repetir2 
       .... 
}
```

- In the loop, a variable **$counter** (which can be used within the loop) is declared with an initial value `<start>`.

- A condition `<condition>` is established, which must be `true` for the loop to continue repeating (iterating).

- A step value `<step>` is established, which will increment or decrement **$counter** in each iteration.

The increment formats are:

**$counter=$counter+x** (or any other mathematical expression)

**$counter++** Increments by one

**$counter--** Decrements by one

**WARNING!** Beware of infinite loops!...(due to a design error they never end) they can crash the browser or even in some cases the computer.

## ⌨️ Practical Work:

- Generate a form for the exercise **tabladel3.php** so that the user can enter the number from which to display the table.

- Generate a form for the exercise **contarhasta.php** so that the user can enter the starting number ($desde) and an ending number ($hasta).

- Bonus track for the previous exercise: if $desde is greater than $hasta, perform the countdown.
