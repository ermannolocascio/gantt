# gantt
** WORK IN PROGRESS... **

**Booking Calendar**

In this code I have created a CRM for booking purposes. 

In a nutshell: the client can select the single timeslot (or the timerange) and send a booking proposal to the slot owner. If he/she accepts, a payment process starts and once the bank confirms the payment the calendar is reserved for the client. 

**Technologies**

The calendar has been created starting from a simple bootstrap 4 table. 
The table becomes interactive (modals opening on click, cell highlighted on mouse over, rows adding etc) thanks to the JavaScript (and partly PHP).
The table is manipulated via AJAX and all the booking information are stored into a MySQL database. 
The database involves two SQL tables: one refers to the *proposals*, one to the *bookings* (a proposal is transformed in a booking once the payment has been confirmed).

**Validations** and software structure. 

**Calendar availability**

The calendar owner can set the status of a spot as ‘not available’ only if no booking are set for the selected period. To achieve this, I have used a simple bootstrap table which is enhanced through Javascript and PHP. The bookings are stored into a MySQL database and modify through AJAX calls. 


**Payment process**

There are several validation steps to ensure consistent booking and avoid overlaps, e.g. if at least 1 day within the selected time-range is occupied the booking cannot be finalized. Same if the spot is set as ‘not available’. 
When the payment process starts the spots are temporarily frozen (in order to avoid overlaps during the payment process). Once the payment is finalized and the bank send a positive feedback the slot is updates and locked. If the payment is not successful the slot is unlocked.


