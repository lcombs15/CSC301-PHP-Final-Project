INSERT INTO `db_fall17_combsl10`.`project_order_items`
(`order_number`,
`itemnmbr`,
`desc`,
`qty`,
`price_each`,
`line_total`)
select
:order_number,
itemnmbr,
project_inventory.`desc`,
:qty,
price,
:qty * price
from project_inventory where itemnmbr=:itemnmbr
