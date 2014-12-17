Sendy-WPCF
==========

Sendy integration for WP Contact Form 7 (https://wordpress.org/plugins/contact-form-7/) that we use for Awesome Presentation (awesome-presentation.com). Because the other plugins were featureless, complicated and mostly people use the Contact Form plugin anyway.

It's pretty easy and automatic. All you need to do is use the Contact Form 7 to build you form like so:

```
<p>Name *<br />
    [text* name] </p>

<p>Your Email *<br />
    [email* email] </p>

<p>[acceptance acceptance-175 default:on] Yes! Sign me up for the BETA list!</p>

[sendywpcf id=""]

[quiz quiz-44 "4+2=?|6" "2+10=?|12" "X+Y=?|Z" "33+33=?|66" "A+B=?|C"]

<p>[submit "Sign ME Up!"]</p>
```

... and in the shortcode [sendywpcd id=""] add in your list id from Sendy. I recommend a quiz, and acceptance checkbox. I also recommend double opt-in on the Sendy side :)
