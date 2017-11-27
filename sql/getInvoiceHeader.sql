SELECT * FROM project_orders where order_number=:order_number and customer_id=:customer_id
-- Only show order_number if it belongs to the customer