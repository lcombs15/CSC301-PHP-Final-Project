INSERT INTO `db_fall17_combsl10`.`project_orders`
(`order_date`,
`customer_id`,
`address1`,
`address2`,
`city`,
`state`,
`zip`,
`total`,
`subtotal`,
`shipping`,
first,
last)
select
CURRENT_DATE(),
userid,
address1,
address2,
city,
state,
zip,
:total,
:subtotal,
:shipping,
first,
last
from project_users where userid=:customer_id
-- Pull data over from users table to lessen work in PHP
