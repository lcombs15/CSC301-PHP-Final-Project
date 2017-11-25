SELECT project_order_items.*
FROM project_order_items 
inner join project_orders on project_order_items.order_number=project_orders.order_number 
where project_orders.order_number=:order_number and customer_id=:customer_id