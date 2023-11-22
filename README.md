# gantt
** WORK IN PROGRESS... **

# Booking Calendar

In this code, I have created a CRM for booking purposes.

In a nutshell, the client can select a single timeslot or timerange and send a booking proposal to the slot owner. If accepted, a payment process starts, and once the bank confirms the payment, the calendar is reserved for the client.

## Technologies

The calendar has been created starting from a simple Bootstrap 4 table. The table becomes interactive (modals open on click, cells highlighted on mouseover, rows added, etc.) thanks to JavaScript (and partly PHP). The table is manipulated via AJAX, and all booking information is stored in a MySQL database. The database involves two SQL tables: one for *proposals* and one for *bookings* (a proposal is transformed into a booking once the payment is confirmed).

## Validations and Software Structure

### Calendar Availability

The calendar owner can set the status of a spot as 'not available' only if no bookings are set for the selected period. To achieve this, I have used a simple Bootstrap table enhanced through JavaScript and PHP. The bookings are stored in a MySQL database and modified through AJAX calls.

### Payment Process

There are several validation steps to ensure consistent booking and avoid overlaps, e.g., if at least one day within the selected time-range is occupied, the booking cannot be finalized. The same applies if the spot is set as 'not available'. When the payment process starts, the spots are temporarily frozen to avoid overlaps during the payment process. Once the payment is finalized and the bank sends a positive feedback, the slot is updated and locked. If the payment is not successful, the slot is unlocked.



