This program has 2 backend servers and two front end UI's for leveraging Google Calendar as a embedded event schedualer.

I wasn't planning on publishing all parts of this.  Still working on local copy.  I left out the python and just included the meat b/c who wants to read 10k lines of code.

Gcloud 3
You have a web page https://z-cal.xyz which creates users / api keys and dumps them to a mlab mongodb cloud.

Appengine 2
https://zcalevent.appspotmail.com
Mail handler redirects new Google Events adding them to your remote server.

https://z-calendar.club
CGI backended.  Apache or nginx whith soft link enabled. mariadb 10.
Handles incoming events from google calendar, in/out to wordpress plugin frontend/backend, checks api, methods


Wordpress Plugin??? Wordpress is for users
