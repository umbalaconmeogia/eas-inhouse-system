## Coding convention

### See PHP coding convetion.

### Another rules

## System design

### DB table
Every table should contains columns below:
   1. id: primary key, contains uuid.
   1. data_status: integer, Record status: 1: new, 2: update, 9: deleted.
   1. created_at: timestamp
   1. created_by: uuid của creating user.
   1. updated_at: timestamp
   1. updated_by: uuid của updating user.

Notice that because id is set as text type, it should be set as primary key explicitly by using Migration#addPrimaryKey().

### Model

Every model should inherits BaseBatsgModel class.

Model naming

| DB table name | Model class |
|---|---|
| system_user | app\models\system\User |
| company_customer | app\models\company\Customer |
| company_project | app\models\company\Project |
| company_division | app\models\company\Division |
| company_employee | app\models\company\Employee |
| workhour_task | app\models\workhour\Task |
| workhour_task | app\models\workhour\Task |
| workhour_project_task | app\models\workhour\ProjectTask |
| workhour_time_record | app\models\workhour\TimeRecord |
