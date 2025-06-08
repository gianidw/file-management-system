v1.26
Updates:

- 


Missed Requirements and To-Do List:

Notification Function(assigned devs - Gian):
- improve notification display
- update database from unread to read after either hovering or opening the notification
- have the notifications be clickable
- update notification code to also be filtered if file is exlusive for a specific office

Per Office Page(assigned devs - Gian):
- improve/polish display of files and functions for this module

Issuances Module(assigned devs - Gian):
- UI can be displayed in Categorized Approach or Listed Approach
- Display grouped files together, with separate and group download as zip

Events & Training (assigned dev - Gian):
- Creating/Posting of event/training should trigger notification sending to all user.
- Notification Reminder to be set on x days prior to the actual date/day of events/training.
- Events/Training should be display in a Calendar Mode containing the minimal details / title of the event for the certain date ( you can use the google calendar or similar calendar as reference for the UI.

Directory Module(assigned devs - Arlond & Bryan, then Gian):
- Fix download function always printing all data, instead of the active sheet

Downloads Module(assigned dev - Gian):
- add more relevant files
- separate forms per purpose/use

User Management(assigned devs - Gian):
- Track user activity, including downloaded files

Other To-Do:
- Fix sticky table headers
- Code review and cleanup (continuous)
- Pagination for modules
* improvement of overall UI
* be consistent in display on all modules


=======================================================================================================================================


v1.25
Updates:


- added notifications_tb in the database
- updated uploading of file to call notification function and update it's database table
- creates an 'unread' marker for each user in the database by default
- added notification icon on header
- icon should change between animated and idle when there's unread notification (untested yet if it dynamically changes)
- notifications are appearing with animation
- added user type slider on admin panel
- updated database to include user's office
- added user's office in registration module
- changed user information display on header to display office and only display (Admin) if applicable
- updated form display/format in login, register, and add user modules
- added dropdown select for changing user office in admin panel
- added office filter for header display
- added module skeleton for office page
- adjusted controller modules to allow viewing of system without account
- adjusted controller functiions to align display for non-users, regular users, admins, and devs
- updated office page display (needs further polishing)
- added option to file uploads to be marked as exclusive to the user's office
- office page now properly displaying only the files marked exclusive by checking the user's registered office and the isExclusive field in the database
- added user list to office page, filtered by just users of that office
- added new user type 'Office Admin', to be assigned to an admin for a a specific office
- updated redirects for new user_type 'Office Admin'
- updated button visibility for 'Office Admin' in other modules
- added exclusive file option in file editing module
- updated Homepage and Events module table filters to exclude office-exclusive files from being displayed
- adjusted office files tab display
- added office events tab
- optimized some text displays


Missed Requirements and To-Do List:

Notification Function:
- improve notification display
- update database from unread to read after either hovering or opening the notification
- have the notifications be clickable
- update notification code to also be filtered if file is exlusive for a specific office

Per Office Page:
- improve/polish display of files and functions for this module


Issuances Module(assigned devs - Gian):
- UI can be displayed in Categorized Approach or Listed Approach
- Display grouped files together, with separate and group download as zip

Events & Training (assigned dev - Gian):
- Creating/Posting of event/training should trigger notification sending to all user.
- Notification Reminder to be set on x days prior to the actual date/day of events/training.
- Events/Training should be display in a Calendar Mode containing the minimal details / title of the event for the certain date ( you can use the google calendar or similar calendar as reference for the UI.
- IF the Event/Training covers date range -> UI must reflect this range coverage.

Directory Module(assigned devs - Arlond & Bryan, then Gian):
- Fix download function always printing all data, instead of the active sheet

Downloads Module(assigned dev - Gian):
- add more relevant files
- separate forms per purpose/use

User Management(assigned devs - Gian):
- Track user activity, including downloaded files

Other To-Do:
- Fix sticky table headers
- Code review and cleanup (continuous)
- Look into integrating wordpress or squarespace design into existing project
- Pagination for modules
* improvement of overall UI
* be consistent in display on all modules

* - post-demo notes; feedback from sir Germel & ma'am Emily


=======================================================================================================================================

v1.24
Updates:


- re-worked Directory module's backend (frontend is similar) and cleaned up code
- shortened directory.php to generate tables using a single table structure, improving scalability
- fixed select-all checkbox to work with the dynamic tables
- fixed checkboxes remaining ticked after switching tabs



Missed Requirements and To-Do List:


Issuances Module(assigned devs - Gian):
- UI can be displayed in Categorized Approach or Listed Approach
- Display grouped files together, with separate and group download as zip

Events & Training (assigned dev - Gian):
- Creating/Posting of event/training should trigger notification sending to all user.
- Notification Reminder to be set on x days prior to the actual date/day of events/training.
- Events/Training should be display in a Calendar Mode containing the minimal details / title of the event for the certain date ( you can use the google calendar or similar calendar as reference for the UI.
- IF the Event/Training covers date range -> UI must reflect this range coverage.

Directory Module(assigned devs - Arlond & Bryan, then Gian):
- Fix download function always printing all data, instead of the active sheet

Downloads Module(assigned dev - Gian):
- add more relevant files
- separate forms per purpose/use

User Management(assigned devs - Gian):
- Track user activity, including downloaded files

Other To-Do:
- Fix sticky table headers
- Code review and cleanup (continuous)
- Look into integrating wordpress or squarespace design into existing project
- Pagination for modules
* improvement of overall UI
* be consistent in display on all modules

* - post-demo notes; feedback from sir Germel & ma'am Emily


=======================================================================================================================================


v1.23
Updates:


- multiple minor display adjustments based on feedback
- updated sqls in preparation for upload to NHDR devs' drive
- updated/overhauled login and registration validations for better security
- testing selected printing function on Directory module
- fixed 'print all' display error after adding checkbox
- removed edit and delete access for regular users in Directory Module
- updated view button in Directory Module
- added working modals for directory module
- added working individual print function for directory module
- checkbox selection for printing also works, but needs better formatting



Missed Requirements and To-Do List:


Issuances Module(assigned devs - Gian):
- UI can be displayed in Categorized Approach or Listed Approach
- Display grouped files together, with separate and group download as zip

Events & Training (assigned dev - Gian):
- Creating/Posting of event/training should trigger notification sending to all user.
- Notification Reminder to be set on x days prior to the actual date/day of events/training.
- Events/Training should be display in a Calendar Mode containing the minimal details / title of the event for the certain date ( you can use the google calendar or similar calendar as reference for the UI.
- IF the Event/Training covers date range -> UI must reflect this range coverage.

Directory Module(assigned devs - Arlond & Bryan):
- Improve Directory viewing/display
- Fix download function always printing all data, instead of the active sheet

Downloads Module(assigned dev - Gian):
- add more relevant files
- separate forms per purpose/use

User Management(assigned devs - Gian):
- Track user activity, including downloaded files

Other To-Do:
- Fix sticky table headers
- Code review and cleanup (continuous)
- Look into integrating wordpress or squarespace design into existing project
- Pagination for modules
* improvement of overall UI
* be consistent in display on all modules

* - post-demo notes; feedback from sir Germel & ma'am Emily


=======================================================================================================================================


v1.22
Updates:


- added download and view counter for files
- updated file display modal to have a separate button for viewing and downloading
- updated downloads module, transferred forms into a database structure similar to issuances
- added download counter to form downloads
- added function to add more forms to downloads module from admin panel
- forms in download module are properly sorted alphabetically
- added delete button for forms in download module
- fixed modal bugs
- fixed file data layout
- fixed cascading dropdown options in adding personnel to directory
- updated view count incrementation to trigger at a different event
- fixed table display in issuances module
- added toggle/slider in user management to toggle user status between Active/Inactive
- general code update
- updated module access validation
- updated redirect logic across the system
- moved viewFile function for incrementing view count to footer for global use
- linked view count function to home and events modules



Missed Requirements and To-Do List:


Issuances Module(assigned devs - Gian):
- Print Issuances
- UI can be displayed in Categorized Approach or Listed Approach
- Display grouped files together, with separate and group download as zip

Events & Training (assigned dev - Gian):
- Creating/Posting of event/training should trigger notification sending to all user.
- Notification Reminder to be set on x days prior to the actual date/day of events/training.
- Events/Training should be display in a Calendar Mode containing the minimal details / title of the event for the certain date ( you can use the google calendar or similar calendar as reference for the UI.
- IF the Event/Training covers date range -> UI must reflect this range coverage.

Directory Module(assigned devs - Arlond & Bryan):
- Improve Directory viewing/display
- Add selectable entries for printing

Downloads Module(assigned dev - Gian):
- add more relevant files

User Management(assigned devs - Gian):
- Track user activity, including downloaded files

Other To-Do:
- Fix sticky table headers
- Code review and cleanup (continuous)
- Look into integrating wordpress or squarespace design into existing project
- Pagination for modules
* improvement of overall UI
* be consistent in display on all modules

* - post-demo notes; feedback from sir Germel & ma'am Emily


=======================================================================================================================================


v1.21
Updates:


- added events and training
- multiple display adjustments
- added function to group files together when uploading bulk files (displaying together, separate and group download as zip functions to follow)
- updated database and functions to sync with added data info
- adjusted event date checking functions in home.php and events.php to properly categorize current and past events respectively
- added download and view counter for files
- updated file display modal to have a separate button for viewing and downloading
- updated downloads module, transferred forms into a database structure similar to issuances
- added download counter to form downloads

Missed Requirements and To-Do List:


Issuances Module(assigned devs - Arlond & Gian):
- Print Issuances
- UI can be displayed in Categorized Approach or Listed Approach
- Display grouped files together, with separate and group download as zip

Events & Training (assigned dev - Gian):
- Creating/Posting of event/training should trigger notification sending to all user.
- Notification Reminder to be set on x days prior to the actual date/day of events/training.
- Events/Training should be display in a Calendar Mode containing the minimal details / title of the event for the certain date ( you can use the google calendar or similar calendar as reference for the UI.
- IF the Event/Training covers date range -> UI must reflect this range coverage.

Directory Module(assigned devs - Arlond & Bryan):
- Print Specific Directory Information

Downloads Module(assigned dev - Gian):
- Download Counter
- add more relevant files

User Management(assigned devs - Bryan & Gian):
- Track user activity, including downloaded files

Other To-Do:
- Fix sticky table headers
- Code review and cleanup (continuous)
- Look into integrating wordpress or squarespace design into existing project
- Pagination for modules
* improvement of overall UI
* be consistent in display on all modules

* - post-demo notes; feedback from sir Germel & ma'am Emily


=======================================================================================================================================


v1.20
Updates:


- fixed edit and delete buttons on modals and functions
- added download directory function
- moved test homepage to home
- added events and training
- multiple display adjustments
- updated database and functions to sync with added data info

Missed Requirements and To-Do List:


Issuances Module(assigned devs - Arlond & Gian):
- Print Issuances
- Restrict to PDF Files
- Multiple File Attachment per Issuance
--> Can be alphabetically sorted
- UI can be displayed in Categorized Approach or Listed Approach

Events & Training (assigned dev - Gian):
- Creating/Posting of event/training should trigger notification sending to all user.
- Notification Reminder to be set on x days prior to the actual date/day of events/training.
- Events/Training should be display in a Calendar Mode containing the minimal details / title of the event for the certain date ( you can use the google calendar or similar calendar as reference for the UI.
- IF the Event/Training covers date range -> UI must reflect this range coverage.

Directory Module(assigned devs - Arlond & Bryan):
- Print Specific Directory Information

Downloads Module(assigned dev - Gian):
- Download Counter
- add more relevant files

User Management(assigned devs - Bryan & Gian):
- Track user activity, including downloaded files

Other To-Do:
- Fix sticky table headers
- Gather more information regarding Office, Teams, and Positions for more accurate options
- Code review and cleanup (continuous)
- Look into integrating wordpress or squarespace design into existing project
- Pagination for modules
* improvement of overall UI
* be consistent in display on all modules

* - post-demo notes; feedback from sir Germel & ma'am Emily


=======================================================================================================================================



v1.19
Updates:


- working "more file information" modal now working (expandable)
- homepage displaying different modules as panels, with content preview
- fixed table displays
- added directory print function
- updated downloads module (need more files)


Missed Requirements and To-Do List:


Issuances Module(assigned devs - Arlond & Gian):
- Print Issuances
- Restrict to PDF Files
- Multiple File Attachment per Issuance
--> Can be alphabetically sorted
- UI can be displayed in Categorized Approach or Listed Approach

Events & Training (not started; no dev assigned yet):
- All Created Events / Training and Details should be searchable in the system site global search.
- Allow Admin/Authorized User to perform the Following
--> Create Events / Training
--> Edit Created Events / Training
--> Delete Created Events / Training
- Creating/Posting of event/training should trigger notification sending to all user.
- Notification Reminder to be set on x days prior to the actual date/day of events/training.
- Events/Training should be display in a Calendar Mode containing the minimal details / title of the event for the certain date ( you can use the google calendar or similar calendar as reference for the UI.
- IF the Event/Training covers date range -> UI must reflect this range coverage.

Directory Module(assigned devs - Arlond & Bryan):
- Download All Directory Information

Downloads Module(assigned dev - Gian):
- Download Counter
- add more relevant files

User Management(assigned devs - Bryan & Gian):
- Track user activity, including downloaded files

Other To-Do:
- Update issuances displays (better details of issuance titles, codes, description, preview contents, etc)
- Fix sticky table headers
- Gather more information regarding Office, Teams, and Positions for more accurate options
- Code review and cleanup (continuous)
- Look into integrating wordpress or squarespace design into existing project
- Pagination for modules
* improvement of overall UI
* be consistent in display on all modules

* - post-demo notes; feedback from sir Germel & ma'am Emily


=======================================================================================================================================




v1.18
Updates:


- fixed add personnel to directory
- added edit personnel function
- renamed download_info to file_data for template of displaying file information
- added working "view more" buttons in issuances and file list
- added dynamic modal titles
- added collapsible sidebar
- modals re-organized to work globally to reduce redundancy
- fixed bulk upload of files now including date of upload
- added print function in directory module



Missed Requirements and To-Do List:


Homepage(assigned devs - Bryan & Arlond):
- Homepage draws from database and auto-cycles different files according to recency (to be also used in Events & Training Module)
* display other modules as panels (ie. 5 most recent CO, CPO, advisories, etc)

Issuances Module(assigned devs - Arlond & Gian):
- Print Issuances
- Restrict to PDF Files
- Multiple File Attachment per Issuance
- Sorted by most recent by default
--> Can be alphabetically sorted
- UI can be displayed in Categorized Approach or Listed Approach

Events & Training (not started; no dev assigned yet):
- All Created Events / Training and Details should be searchable in the system site global search.
- Allow Admin/Authorized User to perform the Following
--> Create Events / Training
--> Edit Created Events / Training
--> Delete Created Events / Training
- Creating/Posting of event/training should trigger notification sending to all user.
- Notification Reminder to be set on x days prior to the actual date/day of events/training.
- Events/Training should be display in a Calendar Mode containing the minimal details / title of the event for the certain date ( you can use the google calendar or similar calendar as reference for the UI.
- IF the Event/Training covers date range -> UI must reflect this range coverage.

Directory Module(assigned devs - Arlond & Bryan):
- Download All Directory Information
- Print All / Specific Directory Information
* Prioritize and group per office
* Re-organize display; improve UI(data/fields displayed & navigation)
* Remove unneccessary fields from initial display

Downloads Module(assigned dev - Gian):
- Download Counter
* change content to PhilHealth-related forms and other documents

User Management(assigned devs - Bryan & Gian):
- Track user activity, including downloaded files

Other To-Do:
- Update issuances displays (better details of issuance titles, codes, description, preview contents, etc)
-- (look into file reading and displaying a portion, probably with hidden overflow)
- Fix sticky table headers
- Gather more information regarding Office, Teams, and Positions for more accurate options
- Code review and cleanup (continuous)
- Look into integrating wordpress or squarespace design into existing project
- Pagination for modules
* improvement of overall UI
* be consistent in display on all modules

* - post-demo notes; feedback from sir Germel & ma'am Emily


=======================================================================================================================================


v1.17
Updates:


- added data tabs to admin panel
- added the option to add personnel to the directory 
- added clickable table rows in downloads to display data entry through a modal popup
- added add user function to admin panel, sharing one modal with file upload
- updated the active search bars to work on backspace and clear
- added active search bar to admin panel for user search
- added a working global search, temporarily showing output to the old downloads table (which will serve as an index table in the future)


To do:

- download table modal also popping-up when pressing buttons

- Update upload modal for better functionality between modules
- Update issuances displays (better details of issuance titles, codes, description, preview contents, etc)
-- (look into file reading and displaying a portion, probably with hidden overflow)
- Fix sticky table headers
- Gather more information regarding Office, Teams, and Positions for more accurate options
- Code review and cleanup (ongoing)
- Look into integrating wordpress or squarespace design into existing project
- Pagination for modules

<--Post-demo-->
- improvement of UI
- add instructions in regular user's POV (ie. click here to download file)
- be consistent in display on all modules

Homepage
hide/collapsible navbar
display other modules as panels (ie. 5 most recent CO, CPO, advisories, etc)


Issuances
add a "view more details" function


Directory
Prioritize and group per office
Re-organize display
Remove unneccessary fields from display


File Details:
add more details regarding file content


=======================================================================================================================================


v1.16
Updates:


- added Directory pages and functions
- added local search/filter for tables
- separate admin and regular user
- hide admin_dash for regular user
- display account name & email while logged in
- check for duplicate email upon registration


To do:

- Update upload modal for better functionality between modules
- Update issuances displays (better details of issuance titles, codes, description, preview contents, etc)
-- (look into file reading and displaying a portion, probably with hidden overflow)
- Fix sticky table headers
- Gather more information regarding Office, Teams, and Positions for more accurate options
- Code review and cleanup (ongoing)
- Look into integrating wordpress or squarespace design into existing project
- Pagination for modules


=======================================================================================================================================


v1.15
Updates:


- added quick search for issuances and downloads modules
- fixed global footer
- organized some file structures
- added template for global search bar on header(throws to a placeholder search module)
- fixed header and footer formatting



To do:

- Update upload modal for better functionality between modules
- Update issuances displays (better details of issuance titles, codes, description, preview contents, etc)
-- (look into file reading and displaying a portion, probably with hidden overflow)
- Fix sticky table headers
- Gather more information regarding Office, Teams, and Positions for more accurate options
- Code review and cleanup (ongoing)
- Look into authentication, and create restriction on who can upload files
- Look into integrating wordpress or squarespace design into existing project
- Polish UI for home page and downloads modules
- Pagination for modules


=======================================================================================================================================


v1.14
Updates:


- updated login/logout function
- fixed login approval
- updated readme


To do:

- Update upload modal for better functionality between modules
- Update issuances displays (better details of issuance titles, codes, description, preview contents, etc)
-- (look into file reading and displaying a portion, probably with hidden overflow)
- Fix sticky table headers
- Gather more information regarding Office, Teams, and Positions for more accurate options
- Look into search function (try jquery filters)
- Merging of codes for user management and main branch
- Code review and cleanup (ongoing)
- Look into authentication, and create restriction on who can upload files
- Look into integrating wordpress or squarespace design into existing project
- Polish UI for home page and downloads modules
- Pagination for modules


=======================================================================================================================================


v1.13
Updates:


- fixed upload and download bugs
- restructured admin approval into admin dashboard
- added modal upload button to work globally
- a lot of minor adjustments to keep all modules up-to-date
- rolled-back some changes for presentation
- merging of codes
- homepage now has a better placeholder
- account approval and deny now working
- added toastr notifications (currently minimal)
- fixed login check again
= fixed toastr and flashdata popups
- moved controller login_check to model m_home
- updated readme


To do:

- Update upload modal for better functionality between modules
- Update issuances displays (better details of issuance titles, codes, description, preview contents, etc)
- Fix sticky table headers
- Gather more information regarding Office, Teams, and Positions for more accurate options
- Look into search function
- Merging of codes for user management and main branch
- Code review and cleanup (ongoing)
- Look into authentication, and create restriction on who can upload files
- Look into integrating wordpress or squarespace design into existing project
- Polish UI for home page and downloads modules
- Pagination for modules


=======================================================================================================================================


v1.12
Updates:


- uploaded files now categorize base on 'uploaded by' option
- uploading files now checks for required fields/data
- updated redirect links
- adjusted display icons
- fixed login check
- removed file icons
- updated readme
- removed some features as requested
- re-aligned frontend display with backend changes
- added working edit function in file management
- added modal template

To do:

- Look into search function
- Add approve and deny functionality in user approval module
- Merging of codes for user management and main branch
- Code review and cleanup (ongoing)
- Look into authentication, and create restriction on who can upload files
- Update carousel template to create a sample home page
- Look into integrating wordpress design into existing project
- Polish UI for home page and downloads modules
- Pagination for modules

- Posted by Team (not needed/optional)
- deprioritize user management module
	-focus on module development
	-work on UI
- remove file icon


=======================================================================================================================================


v1.11
Updates:


- added basic approval module for admin, upon user registration
- uploaded sql file for required databases for easier syncing between devs


To do:

- Update upload form with more the other required details
- Add approve and deny functionality in user approval module
- Merging of codes for user management and main branch
- Code review and cleanup (ongoing)
- Look into authentication, and create restriction on who can upload files
- Update carousel template to create a sample home page
- Polish UI for home page and downloads modules
- Pagination for modules


=======================================================================================================================================


v1.10
Updates:


- updated issuances in sidebar (now drops down)
-> minimized and streamlined code to run on one module and dynamically change depending on link used to auto-filter
- further updated upload form
- expanded file table in database
- cleaned up more codes


To do:

- Update upload form with more the other required details
- Merging of codes for user management and main branch
- Code review and cleanup (ongoing)
- Look into authentication, and create restriction on who can upload files
- Update carousel template to create a sample home page
- Polish UI for home page and downloads modules
- Pagination for modules


=======================================================================================================================================


v1.09
Updates:


- updated sidebar with dropdowns, placeholder for account accessibilities and other possible options
- updated download function, differentiated hyperlink from download button
        > hyperlink now opens pdf files in new tab, otherwise closes tab and downloads
        > download button is used for force downloading (quicker)
- added display table to issuances module
- added navigation to issuances module

To do:

- Merging of codes for user management and main branch
- Code review and cleanup, ongoing
- Look into authentication, and create restriction on who can upload files
- Update carousel template to create a sample home page
- Polish UI for home page and downloads modules
- Pagination for modules


=======================================================================================================================================


v1.08
Updates:


- login and registration module (early version)
- account registration and login connects to database
(v1.08d)
- updated sidebar with dropdowns, placeholder for account accessibilities and other possible options
- updated download function, differentiated hyperlink from download button
        > hyperlink now opens pdf files in new tab, otherwise closes tab and downloads
        > download button is used for force downloading (quicker)

To do:

- Merging of codes for user management and main branch
- Code review and cleanup, ongoing
- Look into authentication, and create restriction on who can upload files
- Update carousel template to create a sample home page
- Polish UI for home page and downloads modules
- Start on basic UI for the other modules
- Pagination for modules


=======================================================================================================================================


v1.07
Updates:

- Display logo beside the download link, or create a separate download button in a different table column/cell
- Deleting of files from database now deletes it from local storage
- Uploading files now parses file for it's type and upload to database icon path
- Removed "index.php" from url

To do:

- Update carousel template to create a sample home page
- Polish UI for home page and downloads modules
- Look into authentication, and create restriction on who can upload files
- Start on basic UI for the other modules


=======================================================================================================================================


v1.06
Updates:

- Make the download function able to pull file info from database, then locate local file using that information
- Display list of downloadable files in a table
- Make sure table is dynamic
- Upload and download functions working so far

To do:

- Display logo beside the download link, or create a separate download button in a different table column/cell
- Update carousel template to create a sample home page
- Polish UI for home page and downloads modules
- Look into authentication, and create restriction on who can upload files
- Start on basic UI for the other modules


=======================================================================================================================================


v1.05
Updates:

- Basic template and placeholders.
- Updated and prepared navbar.
- Cleaned up old unnecessary codes from old activity.
- Created basic uploading function (saved to local folder).
- Enclosed basic modules between header and footer templates.
- Updated basic uploading function, now sends file name and extension to database.
- Basic table displaying database entries. For checking of uploaded data.
- Working on basic download function

To do:

- Make the download function able to pull file info from database, then locate local file using that information
- Display list of downloadable files in a table
- Make sure table is dynamic
