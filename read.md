1. register on the top right
2. log in 
3.run this command to upgrade user to admin: UPDATE registered_user SET fk_role_id = (SELECT role_id FROM roles WHERE role_name = 'admin') WHERE user_id IN (1);
