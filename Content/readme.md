LORE Blog System
================

A minimal flatfile based blog system designed with the Tor Network in mind.

It is small, fast, and secure while also being extensible and extremely easy
for anyone to use.


Features
--------
- Markdown syntax
- Caching
- No database required
- Lightweight and fast


Installation
------------
1. Place `index.php`, `.htaccess`, and `media/` inside of your web root.
2. Put `lore/` above your web root.
3. Specify `BASE_PATH` and `ROOT_PATH` in `Config/config.php`.


Use
---
To use just upload `.md` files to the `Content/` directory. URLs then 
point directly to the `Content/` and `View/` directories so that

    http://example.com/Blog/Fun/Post

Will publish (case-insensitive)

    Content/Blog/Fun/post.md

Using the view

    View/Blog/Fun/post.php

Or, if `View/Blog/Fun/post.php` doesn't exist `View/Blog/Fun/default.php` will
be used instead. If that doesn't exist Lore will use the default view as specified
in `Config/config.php`.


To Do
-----
- Plugin functionality
- Model interfacing for optional databases
