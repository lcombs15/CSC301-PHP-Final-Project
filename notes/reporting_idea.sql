SELECT * FROM information_schema.views where table_schema='db_fall17_combsl10' and table_name like 'report_%'





create view report_inventory_on_order as select itemnmbr as Item, "desc" as Description,qty_on_order as "Quantity on Order" from project_INVENTORY where qty_on_order > 0



SELECT * FROM report_inventory_on_order