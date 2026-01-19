# Clase 20 - Bootstrap, construyendo mas prolijo y bonito ;)
Bootstrap:

It's a front-end framework (for UI development) used to develop web applications and mobile-first sites, meaning with a design that adapts to the screen of the user's device. The magic happens in the browser, so we need to use its development tools (right-click and select "Inspect" or Ctrl + Shift + i). It consists of at least two files that we can use from our site or from third-party servers (CDNs): one CSS file for aesthetics and style, and another JS file for components and interactions. Everything is based on modeling through combined tags (generally DIVs or SPANs) associated with **class** attributes.

For this course, we will be using version 4.6.x:

https://getbootstrap.com/docs/4.6/getting-started/introduction/

To use the tool correctly, you need to master four aspects:

- Grid

- Responsive Behavior

- Styling

- Control Components/JavaScript

Example of use: (always have the documentation on hand)

`<p class="btn btn-primary btn-lg">Button</p>`

In this example, we convert a paragraph (`<p>`) into a button using:

**btn**: invoked component

**btn-primary**: appearance for the component

**btn-lg**: Display scale (lg=large, default md=normal, medium)

Note: This will not work if the bootstrap.min.css and bootstrap.min.js files are not included and available.

What we covered:

- Example of a basic template explained
- Beginning of interface construction
- Third-party libraries
