Shopping Cart - With Laravel
===

> "A shopping cart with everything you'd expect. Built to be easily extendable, plus flexible payment integration with Braintree." - Codecourse https://www.codecourse.com/library/lessons/build-a-shopping-cart

This is a repo containing two series ([**Generating PDF files from HTML and CSS**](https://www.codecourse.com/library/lessons/generate-pdf-from-html-css/introduction) and [**Build a shopping cart**](https://www.codecourse.com/library/lessons/build-a-shopping-cart/introduction)) merged together in order to make a dynamic PDF invoice from the order you made with the Shopping Cart system.

Here is how it looks like:

![The result](http://puu.sh/pyrf3/fd6a5257c3.png)

You can click on the download button on the order page. It will generate a PDF file from another view (specifically for the PDF) and download.

Happy coding!

### [Important!] Supported operation systems
In order to let the PDF downloader function work, you have to replace the [`phantomjs`](https://github.com/matthijs110/shopping-cart/blob/master/resources/phantomjs) file depending on your operation system. You can download this file at the [website](http://phantomjs.org/download.html) of PhantomJS. Unzip the file and put `bin/phantomjs` inside `resources/assets`. 

### Support
If you have any questions about the Shopping cart or the code, please create a new topic at:
https://www.codecourse.com/forum
