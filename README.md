# Consoler Color Printer
Simplistic, lightweight class to help with printing ANSI codes for colorful console output.

**Usage Example:**
```php
ColorPrinter::putln("<bgblack:green>Here <yellow:b>we</yellow:b> go!</bgblack> No background but green!</green>");
```
This will print the following line to the console:

<span style="color: green; background-color:black;">
Here <strong style="color: yellow">we</strong> go!</span>
<span style="color: green;">No background but green!</span>

## Installation
If you add this repository to your `composer.json`:
```javascript
...
"repositories": [
    {
        "type": "git",
        "url": "https://github.com/npx/console-color-printer"
    }
]
...
```
you can install it via composer:
```
composer require npx/console-color-printer
```

and use it in your project:
```php
use ColorPrinter\ColorPrinter;
```

## Syntax and usage
You can start and end every modifier in an HTML-like tag, separating the modifiers by a colon `:`.

**Syntax of a Tag**
```
<[/]mod[:mod[:mod[:...]]]>
```

In the example above,
```php
<bgblack:green>Here <yellow:b>we</yellow:b> go!</bgblack> No background but green!</green>
```
* we open a black background with green text color
* we open a yellow and bold tag
* after `we`, we cancel the yellow and bold
* after the `!` we end the black background, but keep the green color
* we cancel the green in the end

## Colors and Modifiers

| Backgrounds   | Colors    | Modifiers              |
|---------------|-----------|------------------------|
| `bgblack`     | `black`   | `n` *normal*           |
| `bgred`       | `red`     | `b` *bold*             |
| `bggreen`     | `green`   | `l` *faint (light)* \* |
| `bgyellow`    | `yellow`  | `i` *italic* \*        |
| `bgblue`      | `blue`    | `u` *underline*        |
| `bgmagenta`   | `magenta` |
| `bgcyan`      | `cyan`    |
| `bgwhite`     | `white`   |

\* *not widely supported*

More information on the colors and modifiers can be found here:
[https://en.wikipedia.org/wiki/ANSI_escape_code#Colors](https://en.wikipedia.org/wiki/ANSI_escape_code#Colors).
## License
The MIT License (MIT)

Copyright (c) 2015 Yannick Baron

Permission is hereby granted, free of charge, to any person obtaining a copy
of this software and associated documentation files (the "Software"), to deal
in the Software without restriction, including without limitation the rights
to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
copies of the Software, and to permit persons to whom the Software is
furnished to do so, subject to the following conditions:

The above copyright notice and this permission notice shall be included in all
copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE
SOFTWARE.
