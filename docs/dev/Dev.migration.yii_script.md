php yii migrate/create create_system_user_login_table --fields="id:text:notNull,account:text:notNull,password_encryption:text,access_token:text,auth_key:text"

php yii migrate/create create_company_customer_table --fields="id:text:notNull,name:text"

php yii migrate/create create_company_division_table --fields="id:text:notNull,name:text"

php yii migrate/create create_company_project_table --fields="id:text:notNull,name:text,customer_id:text:notNull:foreignKey(company_customer)"

php yii migrate/create create_company_employee_table --fields="id:text:notNull,name:text,division_id:text:notNull:foreignKey(company_division)"

php yii migrate/create create_workhour_task_table --fields="id:text:notNull,name:text,display_order:integer"

php yii migrate/create create_workhour_project_task_table --fields="id:text:notNull,project_id:text:notNull:foreignKey(company_project),task_id:text:notNull:foreignKey(workhour_task)"

php yii migrate/create create_workhour_time_record_table --fields="id:text:notNull,project_task_id:text:notNull:foreignKey(workhour_project_task),working_time:float,working_date:date,employee_id:text:notNull:foreignKey(company_employee)"