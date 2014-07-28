KEC-CIA
=====
An online web application for tracking CIA(Continuous Internal Assessment) marks of students of Kongu Engineering College. All you have to do is to visit [the site][1] and signup to get started.

There is a good possibility that your class timetable is present in our database. If not, you will be prompted to enter the timetable data.

Contributing
=====
We welcome all contributions towards development, bug fixes(listed in the [issues page][2]) and enhancement of existing code and features. The source code contains two branches, `master` and `local`.

`master` branch is the main branch that is pushed to the OpenShift servers that currently hosts the website. `local` branch can be used for debugging purposes in your local machine. The only difference between these two branches were the database connectivity file `db/db.php`.

If you're writing some code, then create a new branch named in the following structure
<pre>git branch #issueno</pre>

The `issueno` is the issue or bug fix that is listed in the [issues page][2]. After you're done with the code, create a new pull request and we will review and update the code.

Some Extra Quote
=====
<pre>There nothing a code can't do in this world.</pre>

[1]: http://www.kec-cia.com "Homepage of KEC-CIA"
[2]: /gowthamgts/kec-cia/issues "Issues page of this project"