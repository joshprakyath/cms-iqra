# iqra-cms
This is a Content Management System (C.M.S) with all the CRUD Operations.

**Technologies**  
PHP Version 7.0.9  
Database : MySQLi  

Entry Point : **index.php**  

### Operations  
* Browse Subjects and Pages
* Signup
* Login
 * Manage Admins
 * Manage Subjects
 * Manage Pages


**Note**: The [images](static/includes/images) used are taken from internet, and thus the copyrights are held by the respective owners. Take care of it before you may use it in production.  

**Note**: The database setup can be found [here](static/includes/dbsetup.php). Update the values to match your environment.

**Bugs/ Issues**:
* [X] Add duplicate value check for usernames - edit_admin.php 
* [ ] No RESPECT for position - two subjects can have same position - the other doesn't readjust itself!
* [X] Take care of the navigation bar when user is logged in/out
