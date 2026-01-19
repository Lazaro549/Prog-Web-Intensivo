# Class 18 - CSS, calling things by their names

Tipos de definición de estilos:


- Tag redefinition: Changes the behavior of a particular tag (modifies its defaults)

Example:
```
p {
attribute: value;
attribute2: value;
...
}
```

- Class: can be applied to any element, and multiple classes can be applied to the same element; it is the most commonly used.

Example:
```
.classname {
...
}
```
- ID (by identifier): This is ideal for applying styles to a unique element or subset within the page (it's based on the element's ID, which shouldn't be repeated).

Example:
```
#elementid{

...
}
```

Style Cascade (Precedence): 

Styles are respected according to their specificity, in order of importance: first id, second classes, and last tag redefinitions.
If two styles are applied to the same tag, the attributes of both are merged, except for those present in both. In that case, the most specific or last-declared style is respected.

