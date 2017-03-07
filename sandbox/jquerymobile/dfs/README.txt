2017-03-07
Raymond Byczko
Subject: JQuery Mobile, placement of data-fullscreen

There seems to be inconsistent advice on the place of the
data-fullscreen attribute in JQueryMobile html or php pages.
Where should it be put so the header and footer both slide up
upon clicking the content?

The book "JQueryMobile - Up and Running' by Maximiliano Firtman
advises to put this in the 'page' div, that is the one with
data-role="page".  In this scenario, one would get something
like:

	<div data-role="page" data-fullscreen="true">

On the page of the book, that is 65, the above is indicated.
data-fullscreen is not used in the header or footer.

Another source, a URL as follows, indicates something different.

https://www.w3schools.com/jquerymobile/tryit.asp?filename=tryjqmob_toolbars_fullscreen

w3schools seems to indicate to put data-fullscreen="true" in
the header and footer, but does not specify the page.

What is going on here?

One technique to figure this out is to try different combinations and observe
bevahior.  The contents of this directory serves this purpose.

fullscreen1.php is largely copied without changes from the w3schools website.
It works as expected. fullscreen2.php to fullscreen5.php were
each derived from fullscreen1.php. 

fullscreen3.php corresponds to the advice given in the work by
Firtman.  data-fullscreen=true is specified in the page, but
not the header, nor the footer.  It does not work in that
there is not slider action whatsoever whenever the mouse is clicked
in the content area.  The header and footer do not move at all.

Conclusion: Individual results are identified with an '@outcome'
area in each file.  However, here is the summary.  data-fullscreen=true
does not help in the page div.  It is best when it is in both
the header, and the footer.  If it is found in only one, the behavior
is close to what is expected but not exact.  The one not
specified seems to 'disappear' instead of 'gracefully sliding'.

These experiments were with content with limited <pre> content of about 11
lines.
